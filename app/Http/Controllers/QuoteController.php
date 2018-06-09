<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;

class QuoteController extends Controller
{
    
	public function home(){

		$routes = Route::all();
		return view('quote.quote',compact('routes'));

	}

	public function price(Request $request){

		$origin 		= $request->input('origin');
		$destination 	= $request->input('destination');

		$route = Route::where('origin',$origin)->where('destination',$destination)->get();
		
		if(count($route) > 0){

			$response = $route;

		}else{

			$originRoutes = Route::where('origin',$origin)->get();			
			$destinationRoutes = Route::where('destination',$destination)->get();
			$arrayRoutes = [];

			foreach ($originRoutes as $originRoute) {

				foreach ($destinationRoutes as $destinationRoute) {

					if($originRoute->destination == $destinationRoute->origin){

						array_push($arrayRoutes,$originRoute->id);

						if($destination == $destinationRoute->destination ){
							
							array_push($arrayRoutes,$destinationRoute->id);

						}

					}else{

						continue;

					}

				}

			}

			$finalRoutes = Route::whereIn('id',$arrayRoutes)->get();
			$response 	 = $finalRoutes;

		}

		return response()->json($response);

	}

}
