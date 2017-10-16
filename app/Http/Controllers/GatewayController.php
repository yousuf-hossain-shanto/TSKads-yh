<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function get_ads( $user_id )

    {

        $ads = get_publisher_ads($user_id);

        if ($ads){
            return response()->json(['status' => '1', 'ads' => $ads]);
        } else {
            return response()->json(['status' => '0', 'message' => 'No Ads Found']);
        }

    }
}
