<?php namespace App\Http\Controllers;

use App\Farmer;

class HomeController extends Controller {


	public function index()
	{
    
		 return view('auth.login');
	}

}