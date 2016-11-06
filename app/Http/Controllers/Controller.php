<?php namespace App\Http\Controllers;

// use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use DB;
use URL;
use Auth;
use Entrust;
use Session;

abstract class Controller extends BaseController {

	use  ValidatesRequests;

	public function __construct()
	{
	
	/**
	* Enable the following code to enable only guest
	* for now it is disabled
	*
	*	$this->middleware('guest');
	*
	*/

	

	/**
	* Only logged in user can see the dashboard 
	* to enable this functionality use the following middleware
	*/	
		// $this->middleware('auth', ['only' => 'logged']);


		if(!Session::has('user_details'))
		{

			error_log('Session varibale is not set');

			// print_r(Entrust::user());
			// echo "<div style='float:left;'>";
			// echo "<br>--------------------------------------------------------------------------------------<br>";
			// echo "<script on-load> alert('".Entrust::hasRole('project_monitor')."') </script>";
			// echo "<br>--------------------------------------------------------------------------------------<br>";
			// echo "<div>";

	/**
	* set Session variable for users extra information
	*
	*/


			 
		}

	}


}
