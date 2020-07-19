<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer as Customer;
use App\Wallet as Wallet;
Use Session;
use \SendGrid\Mail\From as From;
use \SendGrid\Mail\To as To;
use \SendGrid\Mail\Subject as Subject;
use \SendGrid\Mail\PlainTextContent as PlainTextContent;
use \SendGrid\Mail\HtmlContent as HtmlContent;
use \SendGrid\Mail\Mail as Mail;

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
        $customerId = 20;
        $sessionId = "asfdsdf";
        $token = "token";
        $customer = Customer::find($customerId);        

        $from = new From("erkarebolledo@gmail.com", "Erka Rebolledo");
        $tos = [
            new To(
                $customer->email,
                $customer->name,
                [
                    'name' => $customer->name,
                    'token' => $token,
                    'sessionId' => $sessionId
                ]
            ),
        ];
        $email = new Mail($from, $tos);
        $email->setTemplateId(env('SENDGRIDTEMPLATE'));
        $sendgrid = new \SendGrid(env('SENDGRID'));
        $response = $sendgrid->send($email);
        print_r($response);        
        die();
        $customerId = 5;
        $sessionId = "YhkCTqaqoh0GD9IzZBAUfWoko07oA3BUz2aRXUzA";
        $token = "d10349";
        $discount = 2;
        $balance = Wallet::where('customer_id', $customerId)
        ->where('session_id', $sessionId)
        ->where('token', $token)
        ->pluck('balance');

        if (!isset($balance[0])) {
            return ['success'=>false, 'msg'=>'Token y/o session incorrectos'];            
        }

        $balance = $balance[0];

        if ($discount > $balance) {
            return ['success'=>false, 'msg'=>'El saldo no es suficiente'];            
        }

        $balance = ($balance - $discount)*1;

        $wallet = Wallet::updateOrCreate(['customer_id' => $customerId], ['balance' => $balance]);
        return ['success'=>true, 'msg'=>'Operacion exitosa'];            
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

    public function payment($customerId) {
        try{
            $sessionId = session()->getId();            
            $token = bin2hex(openssl_random_pseudo_bytes(3));

            $wallet = Wallet::updateOrCreate(['customer_id' => $customerId], ['session_id' => $sessionId, 'token' => $token]);

            $this->sendEmail($customerId, $sessionId, $token);

            return ['success'=>true, 'msg'=>'El correo fue enviado, si no lo visualiza revise la carpeta spam'];
        }catch(\Exception $e){
            return ['success'=>false, 'msg'=>'Ocurrio un error favor intentelo mas tarde'];
        }
    }  

    public function sendEmail($customerId, $sessionId, $token) {
        $customer = Customer::find($customerId);        

        $from = new From("erkarebolledo@gmail.com", "Erka Rebolledo");
        $tos = [
            new To(
                $customer->email,
                $customer->name,
                [
                    'name' => $customer->name,
                    'token' => $token,
                    'sessionId' => $sessionId
                ]
            ),
        ];
        $email = new Mail($from, $tos);
        $email->setTemplateId(env('SENDGRIDTEMPLATE'));
        $sendgrid = new \SendGrid(env('SENDGRID'));
        $response = $sendgrid->send($email);
    }
    
    public function debit($customerId, $sessionId, $token, $discount) {
        try{
            $balance = Wallet::where('customer_id', $customerId)
            ->where('session_id', $sessionId)
            ->where('token', $token)
            ->pluck('balance');
    
            if (!isset($balance[0])) {
                return ['success'=>false, 'msg'=>'Token y/o session incorrectos'];            
            }
    
            $balance = $balance[0];
    
            if ($discount > $balance) {
                return ['success'=>false, 'msg'=>'El saldo no es suficiente'];            
            }
    
            $balance = ($balance - $discount)*1;
    
            $wallet = Wallet::updateOrCreate(['customer_id' => $customerId], ['balance' => $balance]);

            return ['success'=>true, 'msg'=>'Operacion exitosa'];            
        }catch(\Exception $e){
            return ['success'=>false];
        }
    } 
    
    public function balance($customerId) {
        try{
            $balance = Wallet::where('customer_id', $customerId)->pluck('balance')[0];

            return ['success'=>true, 'balance'=>$balance];
        }catch(\Exception $e){
            return ['success'=>false];
        }
    }
}
