<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Http\Request;

class SessionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function setFormDatabase($form_database,$url_to_return_to)
	{	
		Session::forget('form_database');
		$respones =Session::put('form_database',$form_database);

		$url_to_return_to= base64_decode($url_to_return_to);
		return Redirect::to($url_to_return_to);
	}


	public function set_variable()
	{
		// $$_POST['variable_name']=$_POST['value'];
		Session::put("user_details.$_POST['variable_name']",$_POST['value']);
		return "user_details.$_POST['variable_name']";

	}
	

}
