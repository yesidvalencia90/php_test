<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;

class BusController extends Controller
{
    public function home(){

		$buses = Bus::all();
		return view('buses.buses',compact('buses'));

	}

	public function store(Request $request){

		$validationRules = [
                'model'  	=> 'required',
                'driver'  	=> 'required',
        ];

        $validator = \Validator::make(
                $request->all(), 
                $validationRules
        );
        
        if ($validator->fails()){

        	$response = ['status'=>0,'errors'=>$validator->errors()->all()];

        }else{

        	$bus = new Bus();
        	$bus->model 	= $request->input('model');
        	$bus->driver 	= $request->input('driver');
        	$bus->save();

        	$response = ['status'=>1];

    	}

    	return response()->json($response);

	}

	public function get(){

		$buses = Bus::all();
		return response()->json($buses);

	}

	public function delete($id){

		$bus = Bus::find($id);
		$bus->delete();

	}

	public function edit($id,Request $request){

		$bus = Bus::find($id);
		$bus->model = $request->input('model');
		$bus->driver = $request->input('driver');
		$bus->update();

	}

}
