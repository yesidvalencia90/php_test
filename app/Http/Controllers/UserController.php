<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
	public function home(){

		$users = User::all();
		return view('users.users',compact('users'));

	}

	public function store(Request $request){

		$validationRules = [
                'name'  	=> 'required',
                'email'  	=> 'required|email',
                'password'  => 'required',
        ];

        $validator = \Validator::make(
                $request->all(), 
                $validationRules
        );
        
        if ($validator->fails()){

        	$response = ['status'=>0,'errors'=>$validator->errors()->all()];

        }else{

        	$user = new User();
        	$user->name 	= $request->input('name');
        	$user->email 	= $request->input('email');
        	$user->password = bcrypt($request->input('password'));
        	$user->save();

        	$response = ['status'=>1];

    	}

    	return response()->json($response);

	}

	public function get(){

		$users = User::all();
		return response()->json($users);

	}

	public function delete($id){

		$user = User::find($id);
		$user->delete();

	}

	public function edit($id,Request $request){

		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->update();

	}

}

