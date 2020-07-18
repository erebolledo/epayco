<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer as Customer;
use App\Wallet as Wallet;

class SoapServerController extends Controller {
    public function __construct() {

    }

    public function server() {
        $uri = env('URI');
        $params = array('uri' => "http://$uri");
        $soapServer = new \SoapServer(null, $params);

        $service = new Service();
        $soapServer->setObject($service);
        $soapServer->handle();   
    }

    public function prueba() {
        /*$data = ['name'=>'asdfsdf', 'email'=>'asdfasdf', 'document'=>'adfasdf', 'cellphone'=>'adfadsf'];
        $customer_id = Customer::create($data)->id;
        Wallet::create(['customer_id' => $customer_id]);        */
        $customer_id = 5;
        $balanceAdd = "3.23";
        $balance = Wallet::where('customer_id', $customer_id)->pluck('balance')[0];
        $balance = ($balance + $balanceAdd)*1;    

        $wallet = Wallet::updateOrCreate(['customer_id' => $customer_id], ['balance' => $balance]);
    }
}

class Service {
    public function customerRegistry($data) {
        try{
            $customerId = Customer::create($data)->id;
            Wallet::create(['customer_id' => $customerId]);

            return ['success'=>true];
        }catch(\Exception $e){
            return ['success'=>false];
        }
    }

    public function credit($customerId, $add) {
        try{
            $balance = Wallet::where('customer_id', $customerId)->pluck('balance')[0];
            $balance = ($balance + $add)*1;    
            $wallet = Wallet::updateOrCreate(['customer_id' => $customerId], ['balance' => $balance]);

            return ['success'=>true];
        }catch(\Exception $e){
            return ['success'=>false];
        }
    }
}
