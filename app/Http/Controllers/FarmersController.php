<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Farmer as farmer;
use DB;
use Flash;
use Illuminate\Http\Request;
use Session;
use Auth;
use Entrust;

class FarmersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
	if(isset(Session::all()['user_details']))
		{
		$male_farmers=farmer::where('gender','male')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$female_farmers=farmer::where('gender','female')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$BC_farmer=farmer::where('caste','BC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$ST_farmer=farmer::where('caste','ST')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$SC_farmer=farmer::where('caste','SC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$OC_farmer=farmer::where('caste','OC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		}
	elseif(!isset(Session::all()['user_details']))
		{
		$male_farmers=farmer::where('gender','male')->count();
		$female_farmers=farmer::where('gender','female')->count();
		$BC_farmer=farmer::where('caste','BC')->count();
		$ST_farmer=farmer::where('caste','ST')->count();
		$SC_farmer=farmer::where('caste','SC')->count();
		$OC_farmer=farmer::where('caste','OC')->count();
		}
	else
		{
			return "No data found";
		}	


		return view('farmers.index',compact('male_farmers','female_farmers','BC_farmer','ST_farmer','SC_farmer','OC_farmer'));

	}

	public function getAll()
	{
	
		
		if(isset(Session::all()['user_details']))
		{
		$farmers=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->get();
		$male_farmers=farmer::where('gender','male')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$female_farmers=farmer::where('gender','female')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$BC_farmer=farmer::where('caste','BC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$ST_farmer=farmer::where('caste','ST')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$SC_farmer=farmer::where('caste','SC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		$OC_farmer=farmer::where('caste','OC')->where('entered_by_id',Session::all()['user_details']->id)->count();
		return view('farmers.all',compact('farmers','male_farmers','female_farmers','BC_farmer','ST_farmer','SC_farmer','OC_farmer'));
		
		}
		elseif(!isset(Session::all()['user_details']))
		{
		$farmers=farmer::all();	
		$male_farmers=farmer::where('gender','male')->count();
		$female_farmers=farmer::where('gender','female')->count();
		$BC_farmer=farmer::where('caste','BC')->count();
		$ST_farmer=farmer::where('caste','ST')->count();
		$SC_farmer=farmer::where('caste','SC')->count();
		$OC_farmer=farmer::where('caste','OC')->count();
		return view('farmers.all',compact('farmers','male_farmers','female_farmers','BC_farmer','ST_farmer','SC_farmer','OC_farmer'));

		}
		else
		{
			return "No data found";
		}


	}

	public function selectiveFarmerView()
	{
		return view('farmers.selective');
	}


	public function getSelectiveFarmer($state=null, $district=null, $mandal=null, $mvk=null, $panchayat=null, $village=null, $habitation=null)
	{
		// print_r(Session::all());

		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($mvk=='' || $mvk=='Do Not Mention') && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention'))
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->get();	
			}
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention') && ($mvk=='' || $mvk=='Do Not Mention') && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) {
			
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention') && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}



			
		$farmers=$farmers_list	;
	

		return view('farmers.getFarmers',compact('farmers'));


	}



	/**
	 * Show the form for creating a new farmer
	 *
	 * @return Response
	 */
	public function create()
	{
		

		if(Session::get('insert_farmer'))
		{
			$farmers_location_insert=Session::get('insert_farmer');

			// print_r($farmers_location_insert);
			if($farmers_location_insert['state'][0]!=null || $farmers_location_insert['district'][0]!=null || $farmers_location_insert['mandal'][0]!=null || $farmers_location_insert['village'][0]!=null )
			{
				return view('farmers.create');
			}
		}
		else
		{
			return view('farmers.createInitial');
		}
		
	}

	
	/**
	 * Show the form for creating a new farmer group.
	 *
	 * @return Response
	 */
	public function createGroup()
	{
		

		if(Session::get('insert_farmer_group_at_location'))
		{
			

			$farmers_group_location_insert=Session::get('insert_farmer_group_at_location');		
			/* get the locationd data from previous saved group and do not show the select location page again */




		
		}
		else
		{

			/* if location data is not set in session then go to initial page where location page will be displayed */
			 return view('farmers.createGroupInitial');
		}
		
	}

	




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	

	public function store()
	{

		// print_r($_POST);

		$data=$_POST;
		$data['entered_by']=Auth::user()->email;
		$data['entered_by_table']=Auth::user()->linked_table;
		$data['entered_by_id']=Auth::user()->linked_id;
		unset($data['_token']);
		// print_r($data);
		
		$insert_id=DB::table('farmers')->insertGetId($data);

		Session::push('insert_farmer.state',$_POST['state']);
		Session::push('insert_farmer.district',$_POST['district']);
		Session::push('insert_farmer.mandal',$_POST['mandal']);
		Session::push('insert_farmer.mvk',$_POST['mvk']);
		Session::push('insert_farmer.panchayat',$_POST['panchayat']);
		Session::push('insert_farmer.village',$_POST['village']);
		Session::push('insert_farmer.habitation',$_POST['habitation']);
		
		
		// echo $insert_id;
		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$user=DB::table('farmers')->find($id);

	
		return view('farmers.edit',compact('user'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		unset($_POST['_method']);
		unset($_POST['_token']);
	
		
		DB::table('farmers')->where('id',$_POST['id'])->update($_POST);

		return 'success';
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$user=farmer::where('id',$id)->delete();
		

		Flash::success('User successfully deleted');

		return redirect()->back();
	}




	public function selectFarmer()
	{
		
		$state='';
		$district='';
		$mandal='';
		$village='';
		
		// set state value
		if(isset($_POST['state']))
		{
			if($_POST['state']=='Do Not Mention' || $_POST['state']=='')
				$state="";
			else
				$state=$_POST['state'];
			
		}
		else
		{
			$state='';
		}

		// set district value
		if(isset($_POST['district']))
		{
			if($_POST['district']=='Do Not Mention' || $_POST['district']=='')
				$district="";
			else
				$district=$_POST['district'];
			
		}
		else
		{
			$district='';
		}
		

		// set mandal value
		if(isset($_POST['mandal']))
		{
			if($_POST['mandal']=='Do Not Mention' || $_POST['mandal']=='')
				$mandal="";
			else
				$mandal=$_POST['mandal'];
			
		}
		else
		{
			$mandal='';
		}
		
		
		// set village value
		if(isset($_POST['village']))
		{
			if($_POST['village']=='Do Not Mention' || $_POST['village']=='')
				$village="";
			else
				$village=$_POST['village'];
			
		}
		else
		{
			$village='';
		}
		
//		echo $state."|".$district."|".$mandal."|".$village;

		if($state!='' && $district=='' && $mandal=='' && $village=='')
		{
		$farmers=DB::table('farmers')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && $mandal=='' && $village=='') {
			$farmers=DB::table('farmers')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $village=='') {
			$farmers=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $village!='') {
			$farmers=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			echo "not found anything";
		}

		$post_data=serialize($_POST);
		//print_r($farmers);
		return view('farmers.selectfarmer',compact('farmers','post_data'));

	}

	public function getFarmersByLocation($state=null,$district=null,$mandal=null,$mvk=null,$panchayat=null,$village=null,$habitation=null,$select_type='radio')
	{
		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention'))
		{
		$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='Do Not Mention') && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}

		$farmers_list_html='';

		foreach ($farmers_list as $farmer) {
			
			 $farmers_list_html.="<option data-content=\"<img src='".asset('portraits/farmer.jpg')."'> $farmer->name/$farmer->fname \" value='$farmer->id'>$farmer->name/$farmer->fname</option>";

		}

		
		return $farmers_list_html;   
	                

	}


public function getFarmersRecordByLocation($state=null,$district=null,$mandal=null,$village=null,$select_type='radio')
	{
		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention'))
		{
		$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='Do Not Mention') && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($village=='' || $village=='Do Not Mention')) {
			$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}

		// $farmers_list_html='';

		// foreach ($farmers_list as $farmer) {
			
		// 	$farmers_list_html.="<tr>";

  //               $farmers_list_html.="<td>$farmer->name</td>";
  //               $farmers_list_html.="<th>$farmer->fname</th>";
  //               $farmers_list_html.="<th>$farmer->gender</th>";
  //               $farmers_list_html.="<th>$farmer->caste</th>";
  //               $farmers_list_html.="<th>$farmer->contact_number</th>";
  //               $farmers_list_html.="<th>$farmer->mandal</th>";
  //               $farmers_list_html.="<th>$farmer->village</th>";
              
  
  //             $farmers_list_html.="</tr>";
		
		// }

		
		// return $farmers_list_html; 

		return $farmers_list;
	                

	}


	public function storeGroup()
	{
		$group_data=$_POST;
		$group_farmer_link=$_POST;

// check if logged in user is field incharge

                
        $group_data['entered_by']=Auth::user()->email;
        $group_data['ngo_id']=$_POST['ngo_id'];


		unset($group_data['_token']);

		unset($group_data['farmer_id']);
	$group_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();

	
	$group_insert_id=DB::table('farmer_groups')->insertGetId($group_data);

	foreach($_POST['farmer_id'] as $farmer_id)
		{
			$farmer_data=$group_data;
			unset($farmer_data['name']);
		
			$farmer_data['group_id']=$group_insert_id;
			$farmer_data['farmer_id']=$farmer_id;
			
			$insert_id[]=DB::table('farmer_group_links')->insertGetId($farmer_data);
		}
		
		return $insert_id;
	}



}
