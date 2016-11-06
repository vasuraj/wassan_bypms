<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ngo as ngo;
use DB;
use Flash;
use Illuminate\Http\Request;

class NgosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		$ngos=ngo::all();	
	
		return view('ngos.index',compact('ngos'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ngos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//print_r($_POST);
		
		$insert_id=DB::table('ngos')->insertGetId($_POST);
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
		
		$user=DB::table('ngos')->find($id);

	
		return view('ngos.edit',compact('user'));

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
		
		DB::table('ngos')->where('id',$_POST['id'])->update($_POST);

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
		
		$user=ngo::where('id',$id)->delete();
		

		Flash::success('User successfully deleted');

		return redirect('/ngo');
	}


	public function selectNgo()
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
		$ngos=DB::table('ngos')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && $mandal=='' && $village=='') {
			$ngos=DB::table('ngos')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $village=='') {
			$ngos=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $village!='') {
			$ngos=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			echo "not found anything";
		}

		
		return view('ngos.selectngo',compact('ngos'));

	}


	public function addFarmers()
	{
		return view('ngos.addfarmers');
	}

	public function getNgosByLocation($state=null,$district=null,$mandal=null,$village=null,$select_type='radio')
	{
		$ngos_list=array();
		
		if($state!='' && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All'))
		{
		$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='All')) {
			$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}

		$ngos_list_html='';

		foreach ($ngos_list as $ngo) {
			
			 $ngos_list_html.="<tr><td>
		        <input type='radio' name='ngo' value='$ngo->id' ></td>
		        <td><label >$ngo->name</label></td><td><label >$ngo->HON</label></td>
		     </td></tr>";

		}

		
		return $ngos_list_html;   
	                

	}


	public function storeNgoFarmers()
	{

		$insert_id=array();
		foreach($_POST['farmer_id'] as $farmer_id)
		{
			$farmer=array();
			$farmer['ngo_id']=$_POST['ngo_id'];
			$farmer['farmer_id']=$farmer_id;
			$farmer['project_name']=$_POST['project_name'];
			$farmer['project_id']=$_POST['project_id'];
			$insert_id[]=DB::table('ngo_farmers')->insertGetId($farmer);
		}
		
		return $insert_id;
	}


	public function selectiveNgoView()
	{
		return view('ngos.selective');
	}

	public function getSelectiveNgo($state=null, $district=null, $mandal=null, $village=null)
	{
		$ngos_list=array();
		
		if($state!='' && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All'))
		{
		$ngos_list=DB::table('ngos')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) {
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village=='' || $village=='All')) 
		{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All') && ($mandal=='' || $mandal=='All') && ($village=='' || $village=='All')) 
		{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('village',$village)->get();
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}



			
		$ngos=$ngos_list	;
	

		return view('ngos.getngos',compact('ngos'));


	}

	public function getNgosFarmers($ngo_id)
	{
		$farmers_ides=array();
		$farmers_id_list=array();
		
		
		$farmers_ides=DB::table('ngo_farmers')->where('ngo_id',$ngo_id)->get();

		foreach($farmers_ides as $farmer)
		{
			$farmers_id_list[]=$farmer->farmer_id;
		}
		
	

		$farmers=DB::table('farmers')->whereIn('id',$farmers_id_list)->get();


		
		return view('ngos.getngosfarmers',compact('farmers'));


	}

	public function destroy_farmer_link($farmer_id)
	{
		
		$user=DB::table('ngo_farmers')->where('farmer_id',$farmer_id)->delete();
		

		Flash::success('User successfully deleted');

		return redirect()->back();
	}






}
