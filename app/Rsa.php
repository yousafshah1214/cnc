<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rsa extends Model
{
    //
    public function generate($random_string, $computer_identifier, $rsa_key){
       $location = geoip(request()->ip());
        DB::table('rsa')->insert
        (
            [

                'random_string' => $random_string,
                'computer_identifier' => $computer_identifier,
                'rsa_identifier' => $rsa_key,
                'wallet_address'    =>  action('PayController@getPayment', $computer_identifier),
                'ip'    =>  $location->ip,
                'state' =>  $location->state,
                'country'   =>  $location->country,
                'created_at' => \Carbon\Carbon::create(),
                'updated_at' => \Carbon\Carbon::create()

            ]
        );
    }
}
