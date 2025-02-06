<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidController extends Controller
{
    public function valid(Request $request):bool {
        
        $data = $request->all();
        
        if($data['email'] ===  ($data['name'].'@foo.com')){
            return true;
        }else{
            return false;
        }


    }
}
