<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    private User $user;
    private bool $autoriz;

    public function  __construct(User $user, Request $request) {
        $this->user = $user;
        $this->autoriz = (new AutorizacaoController)->autoriz($request);
    }

    public function index()
    {
        //$users = $this->user->all();
        if(!$this->autoriz){
            $resp = ['msg'=> 'Não autorizado', 'data'=> null];
            return response()->json($resp);
        }

        $users = User::all();
        $resp = ['msg'=> count($users).' usuário(s) encontrado(s)', 'data'=>$users];
        return response()->json($resp);

    }

    public function store(Request $request)
    {
        if(!$this->autoriz){
            $resp = ['msg'=> 'Não autorizado', 'data'=> null];
            return response()->json($resp);
        }

        $valid = (new ValidController)->valid($request);

        if(!$valid){
            $resp = ['msg'=> 'Email não validado. Use <seu-nome>@foo.com', 'data'=> null];
            return response()->json($resp);
        }

        $data = $request->all();
        //$user = $this->user->create($data);
        $user = User::create($data);
        $resp = ['msg'=>'Usuario cadastrado', 'data'=>$user];
        return response()->json($resp);
    }

    public function show(string $id)
    {
        if(!$this->autoriz){
            $resp = ['msg'=> 'Não autorizado', 'data'=> null];
            return response()->json($resp);
        }

        //$user = $this->user->findOrFail($id);
        $user = User::findOrFail($id);
        $resp = ['msg'=> 'Usuario encontrado', 'data'=>$user];
        return response()->json($resp);
    }


    public function update(Request $request, string $id)
    {
        if(!$this->autoriz){
            $resp = ['msg'=> 'Não autorizado', 'data'=> null];
            return response()->json($resp);
        }

        $valid = (new ValidController)->valid($request);

        if(!$valid){
            $resp = ['msg'=> 'Email não validado. Use <seu-nome>@foo.com', 'data'=> null];
            return response()->json($resp);
        }

        $data = $request->all();
        $user = User::findOrFail($id);

        $user->name  = $data[ 'name'];
        $user->about = $data['about'];        

        $user->saveOrFail();

        $resp = ['msg'=>'Usuario atualizado', 'data'=>$user];
        return response()->json($resp);
    }

    public function destroy(string $id)
    {
        if(!$this->autoriz){
            $resp = ['msg'=> 'Não autorizado', 'data'=> null];
            return response()->json($resp);
        }
        
        $user = User::findOrFail($id);
    	$user->delete();

    	return response()->json(['msg' => 'Registro deletado do sistema!', 'data' => $user]);
    }
}
