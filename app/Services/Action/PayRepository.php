<?php

namespace App\Services\Action;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\Interface\PayRepositoryInterface;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;



class PayRepository implements PayRepositoryInterface
{

    public function payment( $gateway_id, $order_id ) {
        $price = 0;   
        $gateWayName = $driver =  'zarinpal';
        $invoice = new Invoice;      
        $invoice->amount( $price );
        $invoice->detail( [ 'gateway_id' => $gateway_id, 'order_id' => $order_id ] );
        $transaction = null;
        $pay =  Payment::via( $driver )->purchase(
            ( new Invoice )->amount( $price ),
            $transaction = function ( $driver, $transactionId ) use ( $order, $transaction, $gateway_id, $gateWayName, $price ) {
                $trans = Transaction::create( [
                    'gateway_id' => $gateway_id, 'order_id'=> $order->id, 'user_id' => auth()->user()->id, 'user_card_id' => null, 'name' => $gateWayName, 'amount' => $price, 'bank_transaction_code' => $transactionId, 'bank_reference_code' => 0,
                    'type' => 'online', 'status' => 0
                ] );

            }
        )->pay()->toJson();
        $pay =  json_decode( $pay, true );
        return response()->json( $pay[ 'action' ] );

    }

    public function paymentVerify( Request $request ) {
        

        $transaction_id = $request->input( 'Authority' );
        $status = $request->input( 'Status' );
        $transaction = Transaction::where( 'bank_transaction_code', $transaction_id )->first();
        $order = Order::where( 'id', $transaction->order_id )->first();
        try {
            if ( $status == 'OK' ) {
                $receipt = Payment::via( 'zarinpal' )->amount( $order->end_price )->transactionId( $transaction_id )->verify();
                $order = Order::where( 'id', $transaction->order_id )->first();
                $receipt = Payment::amount( $order->end_price )->transactionId( $transaction_id )->verify();
                Order::where( 'id', $order->id )->update( [ 'status' => Order::STATUS_SUBMITTED, 'transaction_date'=>$transaction->created_at ] );              
                $transaction->update( [
                    'status' => Transaction::STATUS_SUCCESSFUL,
                    'bank_reference_code' => $receipt->getReferenceId()
                ] );
             
                return redirect()->away( env( 'FRONT_BASE_URL' ) .'/my-account/payment-result?status=true&order_id=' . $order->id . '&transaction_id=' . $transaction_id );
            } else {
                return redirect()->away( env( 'FRONT_BASE_URL' ) .'/my-account/payment-result?status=false&order_id=' . $order->id );
            }
        } catch ( InvalidPaymentException $exception ) {
            return redirect()->away( env( 'FRONT_BASE_URL' ) .'/my-account/payment-result?status=false&order_id=' . $order->id );
        }
    }
}