<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 4/16/17
 * Time: 8:37 PM
 */

namespace App\Http\Controllers;

use Ixudra\Curl\Facades\Curl;
use Netshell\Paypal\Facades\Paypal;


class PaypalController
{
    private $_apiContext;

    public function __construct()
    {
//        $this->_apiContext = Paypal::ApiContext(
//            config('services.paypal.client_id'),
//            config('services.paypal.secret'));
//
//        $this->_apiContext->setConfig(array(
//            'mode' => 'sandbox',
//            'service.EndPoint' => 'https://api.sandbox.paypal.com',
//            'http.ConnectionTimeOut' => 30,
//            'log.LogEnabled' => true,
//            'log.FileName' => storage_path('logs/paypal.log'),
//            'log.LogLevel' => 'FINE'
//        ));

    }

    public static function getLastestPaymentByEmail($email,$temp=[],$returned_array=[]){

        $timestamp = strtotime("first day of");
        $startOfCurrentMonth  = date("Y-m-d 00:00:00", $timestamp);

        $timestampEnd = strtotime("last day of");
        $endOfCurrentMonth = date("Y-m-d 00:00:00", $timestampEnd);

        $postFields = [
            'USER' => config('services.paypal.user'),
            'PWD' => config('services.paypal.pwd'),
            'SIGNATURE' => config('services.paypal.sig'),
            'METHOD' => 'TransactionSearch',
            'TRANSACTIONCLASS' => 'RECEIVED',
            'EMAIL' => $email,
            'STARTDATE' => $startOfCurrentMonth.'Z',
            'ENDDATE' => $endOfCurrentMonth.'Z',
            'VERSION' => '94',
        ];

        $response = Curl::to('https://api-3t.paypal.com/nvp')
            ->withData($postFields)
            ->post();

        parse_str($response, $response);

        $info = self::getPaymentDetailsById(isset($response['L_TRANSACTIONID0']) ? $response['L_TRANSACTIONID0'] : null);

        return $info;
    }

    public static function getPaymentDetailsById($id)
    {
        $response = false;

        $postFields = [
            'USER' => config('services.paypal.user'),
            'PWD' => config('services.paypal.pwd'),
            'SIGNATURE' => config('services.paypal.sig'),
            'METHOD' => 'GetTransactionDetails',
            'TRANSACTIONCLASS' => 'RECEIVED',
            'TRANSACTIONID' => $id,
            'VERSION' => '94',
        ];

        if(isset($id))
        {
            $response = Curl::to('https://api-3t.paypal.com/nvp')
                ->withData($postFields)
                ->post();

            parse_str($response, $response);
        }

        return $response;
    }
}