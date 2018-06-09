<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;
use App\Route;

class RouteController extends Controller
{
    public function home(){

		$routes = Route::all();
		$buses 	= Bus::all();

		return view('routes.routes',compact('routes','buses'));

	}

	public function store(Request $request){

		$validationRules = [
                'route_name'  	=> 'required',
                'origin'  	=> 'required',
                'destination'  	=> 'required',
                'bus'  	=> 'required',
                'price'  	=> 'required',
        ];

        $validator = \Validator::make(
                $request->all(), 
                $validationRules
        );
        
        $busAssigned = Route::where("bus_is",$request->input('bus'))->get();

        if ($validator->fails() || count($busAssigned) > 0){

        	if(count($busAssigned)>0){
        		$response = ['status'=>0,'errors'=>$validator->errors()->all(),'busAssigned'=>'1'];
    		}else{
        		$response = ['status'=>0,'errors'=>$validator->errors()->all(),'busAssigned'=>'0'];    			
    		}

        }else{

        	$route = new Route();
        	$route->route_name 	= $request->input('route_name');
        	$route->origin 		= $request->input('origin');
        	$route->destination 	= $request->input('destination');
        	$route->bus_is 		= $request->input('bus');
        	$route->price 		= $request->input('price');
        	$route->save();

        	$response = ['status'=>1];

    	}

    	return response()->json($response);

	}

	public function get(){

		$routes = Route::all();
		return response()->json($routes);

	}

	public function delete($id){

		$route = Route::find($id);
		$route->delete();

	}

	public function edit($id,Request $request){

		$route = Route::find($id);
		$route->route_name = $request->input('route_name');
		$route->origin = $request->input('origin');
		$route->destination = $request->input('destination');
		$route->bus_is = $request->input('bus');
		$route->price = $request->input('price');
		$route->update();

	}

}
