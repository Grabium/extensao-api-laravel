<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutorizacaoController extends Controller
{
    public function autoriz(Request $request): bool{
        
        $token = 'asdfad78941555fASDFTGHYjusdfgTY4156123';

        $authorizationHeader = $request->header( 'Authorization');
        
        if($authorizationHeader != $token){
            return false;
        }else{
            return true;
        }


    }
}
