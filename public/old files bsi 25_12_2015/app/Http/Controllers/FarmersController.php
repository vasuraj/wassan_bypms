<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\farmer as farmer;
use DB;
use Flash;
use Illuminate\Http\Request;

class FarmersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
	
		$male_farmers=farmer::where('gender','male')->count();
		$female_farmers=farmer::where('gender','female')->count();
		$BC_farmer=farmer::where('caste','BC')->count();
		$ST_farmer=farmer::where('caste','ST')->count();
		$SC_farmer=farmer::where('caste','SC')->count();
		$OC_farmer=farmer::where('caste','OC')->count();



		return view('farmers.index',compact('male_farmers','female_farmers','BC_farmer','ST_farmer','SC_farmer','OC_farmer'));

	}

	public function getAll()
	{
	
		//$farmers=farmer::all();	
		$farmers=farmer::where('gender','female')->get();	
		$male_farmers=farmer::where('gender','male')->count();
		$female_farmers=farmer::where('gender','female')->count();
		$BC_farmer=farmer::where('caste','BC')->count();
		$ST_farmer=farmer::where('caste','ST')->count();
		$SC_farmer=farmer::where('caste','SC')->count();
		$OC_farmer=farmer::where('caste','OC')->count();

		return view('farmers.all',compact('farmers','male_farmers','female_farmers','BC_farmer','ST_farmer','SC_farmer','OC_farmer'));


	}

	public function selectiveFarmerView()
	{
		return view('farmers.selective');
	}

	public function getSelectiveFarmer($state=null, $district=null, $mandal=null, $village=null)
	{
		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All'))
		{
		$farmers_list=DB::table('farmers')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='All')) 
		{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) 
		{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}



			
		$farmers=$farmers_list	;
	

		return view('farmers.getFarmers',compact('farmers'));


	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('farmers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//print_r($_POST);
		
		$insert_id=DB::table('farmers')->insertGetId($_POST);
		echo $insert_id;
		

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

		return redirect('/farmer');
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
			if($_POST['state']=='all' || $_POST['state']=='')
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
			if($_POST['district']=='all' || $_POST['district']=='')
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
			if($_POST['mandal']=='all' || $_POST['mandal']=='')
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
			if($_POST['village']=='all' || $_POST['village']=='')
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

	public function getFarmersByLocation($state=null,$district=null,$mandal=null,$village=null,$select_type='radio')
	{
		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All'))
		{
		$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='All')) {
			$farmers_list=DB::table('farmers')->select('id','name','fname')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
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
		
		if($state!='' && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All'))
		{
		$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='All')) {
			$farmers_list=DB::table('farmers')->select('name','fname','gender','caste','contact_number','mandal','village')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
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


}
