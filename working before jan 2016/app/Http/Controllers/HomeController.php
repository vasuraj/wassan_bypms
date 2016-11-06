<?php namespace App\Http\Controllers;

use App\Farmer;

class HomeController extends Controller {


	public function index()
	{
        //set_state();
        //set_district();
        //set_mandal();
        //set_village();
        //parse_village();
        //parse_mandal();
        // $users = Farmer::select('name')->get()->toArray();
        // if(count($users)>1) {
        //     $total_groups=count($users);
        //     echo "Total no. of group found: $total_groups<br><br>";
        //     foreach ($users as $user) {
        //         print_r($user);
        //         echo "<br><br>";
        //     }
        // }
        // else{
        //     print_r($users['original']);
        // }
		return view('auth.login');
	}

}