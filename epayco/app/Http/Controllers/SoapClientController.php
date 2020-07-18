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
}
