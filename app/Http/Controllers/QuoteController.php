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
			$arrayRoutes = [];
			$cont = 0;

			foreach ($originRoutes as $originRoute) {
				if(count($arrayRoutes) < 2){
					$arrayRoutes = $this->calculate($destination,$originRoute,$arrayRoutes,$cont);
				}
			}

			$finalRoutes = Route::whereIn('id',$arrayRoutes)->get();
			$response 	 = $finalRoutes;

		}

		return response()->json($response);

	}

	public function calculate($destination,$originRoute,$arrayRoutes,$cont){

		$secondStep = Route::where('origin',$originRoute->destination)->get();

		foreach ($secondStep as $second) {

			if($second->destination == $destination){

				array_push($arrayRoutes,$originRoute->id);
				array_push($arrayRoutes,$second->id);

				break;

			}else if($cont > 5){

				break;

			}else{

				array_push($arrayRoutes,$second->id);
				$cont ++;
				$arrayRoutes = $this->calculate($destination,$second,$arrayRoutes,$cont);

			}

			$arrayRoutes = [];
			array_push($arrayRoutes,$originRoute->id);

		}

		return $arrayRoutes;

	}

}
