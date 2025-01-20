<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    private User $user;

    public function  __construct(User $user) {
        $this->user = $user;
    }

    public function index()
    {
        //$users = $this->user->all();
        $users = User::all();
        $resp = ['msg'=> count($users).' usuário(s) encontrado(s)', 'data'=>$users];
        return response()->json($resp);

    }

    public function store(Request $request)
    {

        $data = $request->all();
        //$user = $this->user->create($data);
        $user = User::create($data);
        $resp = ['msg'=>'Usuario cadastrado', 'data'=>$user];
        return response()->json($resp);
    }

    public function show(string $id)
    {
        //$user = $this->user->findOrFail($id);
        $user = User::findOrFail($id);
        $resp = ['msg'=> 'Usuario encontrado', 'data'=>$user];
        return response()->json($resp);
    }


    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        $user->name  = $data[ 'name'];
        $user->email = $data['email'];
        $user->about = $data['about'];        

        $user->saveOrFail();

        $resp = ['msg'=>'Usuario atualizado', 'data'=>$user];
        return response()->json($resp);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    	$user->delete();

    	return response()->json(['msg' => 'Registro deletado do sistema!', 'data' => $user]);
    }
}
