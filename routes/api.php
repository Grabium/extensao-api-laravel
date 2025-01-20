<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*******
 * Faça no powershell
 * Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/teste"
 */

Route::get('/teste', function(){
    return ['alfa','beta','gama', 'delta', 'eta'];
});


/********
use no cmd:
curl -H "HTTP-Method-Override: POST" -d "a=va&b=vb" http://127.0.0.1:8000/api/users

ou no powershell:

POST
$user="nome" ; $gosto="atividade"

$LoginParameters = @{
    Uri             = 'http://127.0.0.1:8000/api/users'        
    Method          = 'POST'
    Headers         =  @{
        "Accept-Charset" = "utf-8"
    }
    Body            = @{
        name=$user
        email=$user+"@"+$user
        password='1234'
        about="gosto de "+$gosto
    }
}
Invoke-WebRequest @LoginParameters 

GET
$id=
$uri="http://127.0.0.1:8000/api/users/"+$id
$r=Invoke-WebRequest -Uri $uri | Select-Object -ExpandProperty Content | ConvertFrom-Json 
$r | ConvertTo-Json -Depth 2

PUT
$user="novo_nome" ; $gosto="novo_gosto" ; $id='int'

$LoginParameters = @{
    Uri             = "http://127.0.0.1:8000/api/users/"+$id    
    Method          = 'PUT'
    Headers         =  @{
        "Accept-Charset" = "utf-8"
    }
    Body            = @{
        name=$user
        email=$user+"@"+$user
        password='1234'
        about="gosto de "+$gosto
    }
}
$r=Invoke-WebRequest @LoginParameters | Select-Object -ExpandProperty Content | ConvertFrom-Json 
$r | ConvertTo-Json -Depth 2
*/

Route::resource('/users', UserController::class);