<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    public function register(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'email' => 'required | email | unique:users,email',
    		'password' => 'required',
    		'c_password' => 'required | same:password',
    	]);

    	if ($validator->fails()) {
    		return $this->sendError('Validator is error', $validator->errors(), 202);
    	}
    	$input = $request->all();
    	$input['password'] = bcrypt($input['password']);
    	$user = User::create($input);
    	$success['token'] = $user->createToken('myApp')->accessToken;
    	$success['name'] = $user->name;
    	return $this->sendResponse($success, 'user register successfully');
    }
}
