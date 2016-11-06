<?php namespace App\Http\Controllers;
use DB;
use URL;
use Auth;
use Entrust;
use Session;

class DashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
		$this->middleware('auth', ['only' => 'logged']);


		if(!Session::has('user_details'))
		{
			  if($user_email=Auth::user()->email!=='admin@admin.com')
			  {
			  $user_id= Auth::user()->id;
	          $user_email=Auth::user()->email;
	          $linked_id=Auth::user()->linked_id;
	          $linked_table=Auth::user()->linked_table;
	          $linked_with_property=Auth::user()->linked_with_property;

	          $user_details= DB::table($linked_table)->where('id','=',$linked_id)->where($linked_with_property,'=', $user_email)->limit(1)->first();
			  Session::put('user_details',$user_details);
			  }
		}

	}

	public function index()
	{
		
		// $url1='http://www.templates.com/wp-content/uploads/2011/12/jquery-file-uploading-plugins-7.jpg';
		// $url2=URL::to('image/get_image').'/'.'jquery-file-uploading-plugins-7.jpg';
		// echo "<img src='$url1'>";
		// echo "<img src='$url2'>";
	 return view('dashboard.index');		


		// --------------------------------------
		//		code to remove ( from code
		//----------------------------------------

				// $habitations=DB::table('villages')->select('id','name')->get();
				// foreach ($habitations as $habitation) {
				// 	$data['name']=str_replace('(','',$habitation->name);
				// 	DB::table('villages')->where('id','=',$habitation->id)->update($data);
				// }

		// ------------------ends here--------------------


		// --------------------------------------
		// code to insert excel data of habitation to proper tables
		// --------------------------------------
				// $state_insert_key='';
				// $district_insert_key='';
				// $mandal_insert_key='';
				// $panchayat_insert_key='';
				// $village_insert_key='';
				// $habitation_insert_key='';

				// $states_data=DB::table('rough_andhra_pradesh_habitation_data')->select('state')->groupby('state')->get();

				

				// foreach ($states_data as $state) 
				// {
				// $state_data_to_insert=array();
				// $state_data_to_insert['country_id']='91';
				// $state_data_to_insert['name']=$state->state;
				// $state_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// $state_insert_key=DB::table('states')->insertGetId($state_data_to_insert);
				// //echo  $state_insert_key;

					
				// //echo  "<div class='state' style='background:red;'>".$state->state."</div>";
				// //echo  "<br>";
				
				// $districts_data=DB::table('rough_andhra_pradesh_habitation_data')->select('district')->where('state','=',$state->state)->groupby('district')->get();
				
				// 	foreach ($districts_data as $district) 
				// 	{
				// 			$district_data_to_insert=array();
				// 			$district_data_to_insert['state_id']=$state_insert_key;
				// 			$district_data_to_insert['name']=substr($district->district,0,-4);
				// 			$district_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// 			$district_insert_key=DB::table('districts')->insertGetId($district_data_to_insert);
				// 			//echo  $district_insert_key;

				// 		//echo  "<div class='district' style='background:orange;'>".substr($district->district,0,-4)."</div>";
				// 		//echo  "<br>";
							
				// 			$mandal_data=DB::table('rough_andhra_pradesh_habitation_data')->select('mandal')->where('state','=',$state->state)->where('district','=',$district->district)->groupby('mandal')->get();
					
				// 				foreach ($mandal_data as $mandal) 
				// 				{
									
				// 					$mandal_data_to_insert=array();
				// 					$mandal_data_to_insert['district_id']=$district_insert_key;
				// 					$mandal_data_to_insert['name']=substr($mandal->mandal,0,-4);
				// 					$mandal_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// 					$mandal_insert_key=DB::table('mandals')->insertGetId($mandal_data_to_insert);
				// 					//echo  $mandal_insert_key;


				// 					//echo  "<div class='mandal' style='background:gray; color:#fff;'>".substr($mandal->mandal,0,-4)."</div>";
				// 					//echo  "<br>";

				// 					$panchayat_data=DB::table('rough_andhra_pradesh_habitation_data')->select('panchayat')->where('state','=',$state->state)->where('district','=',$district->district)->where('mandal','=',$mandal->mandal)->groupby('panchayat')->get();
					
				// 						foreach ($panchayat_data as $panchayat) 
				// 						{

				// 							$panchayat_data_to_insert=array();
				// 							$panchayat_data_to_insert['mandal_id']=$mandal_insert_key;
				// 							$panchayat_data_to_insert['name']=substr($panchayat->panchayat,0,-4);
				// 							$panchayat_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// 							$panchayat_insert_key=DB::table('panchayats')->insertGetId($panchayat_data_to_insert);
				// 							//echo  $panchayat_insert_key;

											
				// 							//echo  "<div class='panchayat' style='background:green;  color:#fff;'>".substr($panchayat->panchayat,0,-4)."</div>";
				// 							//echo  "<br>";

				// 							$village_data=DB::table('rough_andhra_pradesh_habitation_data')->select('village')->where('state','=',$state->state)->where('district','=',$district->district)->where('mandal','=',$mandal->mandal)->where('panchayat','=',$panchayat->panchayat)->groupby('village')->get();
					
				// 							foreach ($village_data as $village) 
				// 							{

				// 								$village_data_to_insert=array();
				// 								$village_data_to_insert['mandal_id']=$mandal_insert_key;
				// 								$village_data_to_insert['panchayat_id']=$panchayat_insert_key;
				// 								$village_data_to_insert['name']=str_replace('(', '',substr($village->village,0,-5));
				// 								$village_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// 								$village_insert_key=DB::table('villages')->insertGetId($village_data_to_insert);
				// 								//echo  $village_insert_key;

												
				// 								//echo  "<div class='village' style='background:cyan;  color:#fff;'>".substr($village->village,0,-5)."</div>";
				// 								//echo  "<br>";
				// 								$habitation_data=DB::table('rough_andhra_pradesh_habitation_data')->select('habitation')->where('state','=',$state->state)->where('district','=',$district->district)->where('mandal','=',$mandal->mandal)->where('panchayat','=',$panchayat->panchayat)->where('village','=',$village->village)->groupby('habitation')->get();
					
				// 								foreach ($habitation_data as $habitation) 
				// 								{


				// 									$habitation_data_to_insert=array();
				// 									$habitation_data_to_insert['mandal_id']=$mandal_insert_key;
				// 									$habitation_data_to_insert['panchayat_id']=$panchayat_insert_key;
				// 									$habitation_data_to_insert['village_id']=$village_insert_key;
				// 									$habitation_data_to_insert['name']=substr($habitation->habitation,0,-18);
				// 									$habitation_data_to_insert['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				// 									$habitation_insert_key=DB::table('habitations')->insertGetId($habitation_data_to_insert);
				// 									echo '<br>'.$habitation_insert_key.' | ';

													
				// 									//echo  "<div class='habitation' style='background:blue;  color:#fff;'>".substr($habitation->habitation,0,-18)."</div>";
				// 									//echo  "<br>";
				// 								}
				// 							}
				// 						}

				// 				}

				// 	}


				// }
				
		// -------------------code ends here-------------------


	
	}

}

