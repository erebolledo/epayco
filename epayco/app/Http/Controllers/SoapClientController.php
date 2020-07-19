<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoapClientController extends Controller {
	private $client;	

	public function __construct() {        
        $uri = env('URI');        
        $params = array('location' => "http://$uri", 'uri' => "urn://$uri", 'trace' => 1);
        $this->client = new \SoapClient(null, $params);    
    }

	function customerRegistry(Request $request) {
		try {
            $data = $request->input();            
            $response = $this->client->customerRegistry($data);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
		} catch (Exception $ex) {
			exit("soap error: " . $ex->getMessage());
		}
    }
    
	function credit(Request $request) {
		try {
            $customerId = $request->input('customerId');            
            $add = $request->input('add');               

            $response = $this->client->credit($customerId, $add);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
		} catch (Exception $ex) {
			exit("soap error: " . $ex->getMessage());
        }
    }    
        
    function payment(Request $request) {
        try {
            $customerId = $request->input('customerId');            

            $response = $this->client->payment($customerId);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    }    
    
    function debit(Request $request) {
        try {
            $customerId = $request->input('customerId');            
            $sessionId = $request->input('sessionId');
            $token = $request->input('token');
            $discount = $request->input('discount');               

            $response = $this->client->debit($customerId, $sessionId, $token, $discount);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    } 
    
    function balance(Request $request) {
        try {
            $customerId = $request->input('customerId');            

            $response = $this->client->balance($customerId);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    }    
    
    function verifyEmail(Request $request) {
        try {
            $email = $request->input('email');           

            $response = $this->client->verifyEmail($email);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    }        

    function getCustomers(Request $request) {
        try {     
            $response = $this->client->getCustomers();

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    }           
    
    function getCustomer(Request $request) {
        try {     
            $id = $request->input('id');

            $response = $this->client->getCustomer($id);

            return response()
            ->json($response, 200)
            ->header('Content-Type', 'application/json');               
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }        
    }               
}
