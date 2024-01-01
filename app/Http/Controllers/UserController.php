<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Routing\Controller as BaseController;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

 
    public function showAllUsers(){
        return response()->json(User::all());
    }
 

    public function showUser($id){
        return response()->json(User::find($id));
    }

    public function updateUser($id, Request $request){
        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = $request->password;        

        $user->save();
        return response()->json($user);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return response()->json("deletado com sucesso", 200);
    }
}
