<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Http\Request;
use DB;
use URL;
use Form;
use Auth;
class SeedManagementController extends Controller {

	public function index($form_name=null)
	{
		if($form_name==null)
		{
			echo "index page of seed managment contoller";
		}
		else
		{
			$data['form_name']=$form_name;
			return view('seed_management.cmss_select_farmer',$data);
		}

	}

	public function group_head_and_other_details($form_name=null)
	{
	
			$data['form_name']='group_head_and_other_details';
			return view('seed_management.group_head_and_other_details',$data);
	

	}

	public function get_report($report_type=null)
	{
		if($report_type==null)
		{
			echo "index page of seed managment contoller";
		}
		else
		{
			$data['report_name']=$report_type;
			return view('seed_management.cmss_select_farmer_for_report',$data);
		}

	}

	public function get_report_seed_purchased($state=null, $district=null, $mandal=null, $mvk=null, $panchayat=null, $village=null, $habitation=null)
	{
		// echo $state;
		// echo $district;
		// echo $mandal;
		// echo $mvk;
		// echo $panchayat;
		// echo $village;
		// echo $habitation;

		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention'|| $district=='undefined') && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All'))
		{
			if(isset(Session::all()['user_details']))
			{
				
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->get();	
			}
		}
		elseif($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) {
			
			if(isset(Session::all()['user_details']))
			{
				
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
				
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$seed_purchasers_list=DB::table('seed_purchasers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}



			
		$data['seed_purchases']=$seed_purchasers_list	;
	

		return view('seed_management.getSeedPurchaser',$data);
		
	}


// report for rouging


	public function get_report_rouging($state=null, $district=null, $mandal=null, $mvk=null, $panchayat=null, $village=null, $habitation=null)
	{
		// echo $state;
		// echo $district;
		// echo $mandal;
		// echo $mvk;
		// echo $panchayat;
		// echo $village;
		// echo $habitation;
		$module_name="rouging";

		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention'|| $district=='undefined') && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All'))
		{
			if(isset(Session::all()['user_details']))
			{
				
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->get();	
			}
		}
		elseif($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) {
			
			if(isset(Session::all()['user_details']))
			{
				
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
				
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$rouging_details_list=DB::table('rouging_details')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$rouging_details_list=DB::table('rouging_details')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}


	
		$data['transaction_details']=$rouging_details_list;
		$data['module_name']=$module_name;
	

		return view('seed_management.getRougingDetails',$data);
		
	}



// report for farmer_group_cmss


	public function get_report_farmer_groups($state=null, $district=null, $mandal=null, $mvk=null, $panchayat=null, $village=null, $habitation=null)
	{
		// echo $state;
		// echo $district;
		// echo $mandal;
		// echo $mvk;
		// echo $panchayat;
		// echo $village;
		// echo $habitation;
		$module_name="farmer_groups";

		$farmers_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention'|| $district=='undefined') && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All'))
		{
			if(isset(Session::all()['user_details']))
			{
				
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->get();	
			}
		}
		elseif($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All'|| $mandal=='undefined') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) {
			
			if(isset(Session::all()['user_details']))
			{
				
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
				
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('ngo_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$farmer_groups_details_list=DB::table('farmer_groups')->select('id','name')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}


	
	
		$data['module_name']=$module_name;
		$data['group_farmers_info']=array();
		
	
	$group_details=array();

	foreach ($farmer_groups_details_list as $farmer_group) {
	
	$group_complete_info=array();
	$group_complete_info['basic_info']=$farmer_group;
	$group_complete_info['linked_farmers']=array();
	$group_complete_info['advance_info']=array();


	$advance_info=DB::table('ngo_farmer_group_links')->select('id','group_creation_date','project_name','group_head','only_for_season','only_for_year','assigned_mr_number')->where('farmer_group_id','=',$farmer_group->id)->first();
		$group_complete_info['advance_info']=$advance_info;
		$linked_farmers_ids=DB::table('farmer_group_links')->select('farmer_id')->where('group_id','=',$farmer_group->id)->get();


		foreach ($linked_farmers_ids as $linked_farmer_id) {
			
			$farmer_info=DB::table('farmers')->select('id','name','fname','farmer_image', 'gender', 'contact_number')->where('id','=',$linked_farmer_id->farmer_id)->first();
			$group_complete_info['linked_farmers'][]=$farmer_info;
		}
	
	
	$group_details[]=$group_complete_info;
}
	

$data['group_details']=$group_details;
return view('seed_management.getFarmerGroupsDetails',$data);
		

}







//
// seed purchase module
//

	public function seed_purchaser_form()
	{
		$data=array();
		$user_details=session('user_details');
		
		$adhar_number='';
		
		if($_POST['select_option']==='by_name')
		{
			if($_POST['selected_farmer_id']!='' && $_POST['selected_farmer_id']!='none')
			{
				$data['selected_farmer_id']=$_POST['selected_farmer_id'];
				$farmer_id=$_POST['selected_farmer_id'];
				$data['farmer']=DB::table('farmers')->where('id','=',$farmer_id)->first();

			}
		}
		elseif($_POST['select_option']==='by_adhar_number')
		{
			if($_POST['adhar_number']!='' && $_POST['adhar_number']!='none')
			{
				$adhar_number=$_POST['adhar_number'];
				$data['farmer']=DB::table('farmers')->where('adhar_card_number','=',$adhar_number)->where('entered_by_id','=',$user_details->id)->first();
				if(!empty($data['farmer']))
				{
					$data['selected_farmer_id']=$data['farmer']->id;
				}
				
				else
				{
					$data['selected_farmer_id']=array();
				}

				$farmer_id=$_POST['selected_farmer_id'];

			}
		}

		if(!empty($data['selected_farmer_id'])){
			return view('seed_management.seed_purchaser_form',$data);
		}
		else
		{
			return "<body style='text-align:center; padding:100px; font-size:20px; color:#fff; text-shadow:0px 2px 2px red;'><span style='text-align:center; padding:10px 20px; background:rgb(250, 122, 122);'>Couldn't find farmer in database</span>";


		}
		

	}


	public function seed_purchaser_form_edit($transaction_id=null)
	{

		
		$data=array();
		
		$data['transaction_detail']=$transaction_detail=DB::table('seed_purchasers')->where('id',$transaction_id)->first();
		$data['transaction_id']=$transaction_id;
		$data['return_to']=URL::previous();

		$data['selected_farmer_id']=$transaction_detail->farmer_id;
		$data['farmer']=DB::table('farmers')->where('id','=',$transaction_detail->farmer_id)->first();
		return view('seed_management.seed_purchaser_form_edit',$data);

	}

//
//  rouging modules //



	public function rouging_form()
	{
		$data=array();
		$user_details=session('user_details');
		
		$adhar_number='';
		
		if($_POST['select_option']==='by_name')
		{
			if($_POST['selected_farmer_id']!='' && $_POST['selected_farmer_id']!='none')
			{
				$data['selected_farmer_id']=$_POST['selected_farmer_id'];
				$farmer_id=$_POST['selected_farmer_id'];
				$data['farmer']=DB::table('farmers')->where('id','=',$farmer_id)->first();
				$data['seed_purchase_details']=DB::table('seed_purchasers')->where('farmer_id','=',$data['farmer']->id)->where('rouging_started','=','n')->first();
				$data['previous_rouging_details']=DB::table('rouging_details')->where('farmer_id','=',$data['farmer']->id)->where('season','=',$data['seed_purchase_details']->season)->where('year','=',$data['seed_purchase_details']->year)->where('is_cycle_end','=','n')->get();


			}
		}
		elseif($_POST['select_option']==='by_adhar_number')
		{
			if($_POST['adhar_number']!='' && $_POST['adhar_number']!='none')
			{
				$adhar_number=$_POST['adhar_number'];
				$data['farmer']=DB::table('farmers')->where('adhar_card_number','=',$adhar_number)->where('entered_by_id','=',$user_details->id)->first();
				if(!empty($data['farmer']))
				{
					$data['selected_farmer_id']=$data['farmer']->id;
					$data['seed_purchase_details']=DB::table('seed_purchasers')->where('farmer_id','=',$data['farmer']->id)->where('rouging_started','=','n')->first();

				}
				
				else
				{
					$data['selected_farmer_id']=array();
				}

				$farmer_id=$_POST['selected_farmer_id'];

			}
		}

		if(!empty($data['selected_farmer_id'])){
			
			return view('seed_management.rouging_form',$data);
		}
		else
		{
			return "<body style='text-align:center; padding:100px; font-size:20px; color:#fff; text-shadow:0px 2px 2px red;'><span style='text-align:center; padding:10px 20px; background:rgb(250, 122, 122);'>Couldn't find farmer in database</span>";


		}
		

	}



	public function rouging_form_edit($transaction_id=null)
	{

		
		$data=array();
		$data['transaction_detail']=$transaction_detail=DB::table('rouging_details')->where('id',$transaction_id)->first();
		$data['seed_purchase_details']=DB::table('seed_purchasers')->where('id',$transaction_detail->seed_purchase_id)->first();
		$data['transaction_id']=$transaction_id;
		$data['return_to']=URL::previous();

		$data['selected_farmer_id']=$transaction_detail->farmer_id;
		$data['farmer']=DB::table('farmers')->where('id','=',$transaction_detail->farmer_id)->first();
		return view('seed_management.rouging_form_edit',$data);

	}


//
// group_head_and_other_details module
//

	public function group_head_and_other_details_form()
	{
		$data=array();

		

			if($_POST['selected_farmer_group_id']!='' && $_POST['selected_farmer_group_id']!='none')
			{
				$data['selected_farmer_group_id']=$_POST['selected_farmer_group_id'];
				$farmer_group_id=$_POST['selected_farmer_group_id'];
				$data['group']=DB::table('farmer_groups')->where('id','=',$farmer_group_id)->first();
				$linked_farmers=DB::table('farmer_group_links')->where('ngo_id','=',$data['group']->ngo_id)->where('group_id','=',$farmer_group_id)->get();
				$data['farmers']=array();
				foreach ($linked_farmers as $linked_farmer) {
					$farmer_id= $linked_farmer->farmer_id;
					$farmer_info=DB::table('farmers')->select('id','name','fname','farmer_image')->where('id','=',$farmer_id)->first();

					array_push($data['farmers'],$farmer_info);
				}

			}

			// print_r($data);


		return view('seed_management.group_head_and_other_details_form',$data);

	}






//
// mid_season_report module
//


	public function mid_season_report_form()
	{
		$data=array();
 		$user_details=session('user_details');
		 print_r($user_details);
		$data['previous_rouging_details']=array();
		
		if($_POST['select_option']==='by_name')
		{
			if($_POST['selected_farmer_id']!='' && $_POST['selected_farmer_id']!='none')
			{

				$data['seed_purchase_details']=DB::table('seed_purchasers')->where('farmer_id',$_POST['selected_farmer_id'])->orderBy('created_at', 'desc')->first();
				$data['selected_farmer_id']=$_POST['selected_farmer_id'];
				$farmer_id=$_POST['selected_farmer_id'];
				$data['farmer']=DB::table('farmers')->where('id','=',$farmer_id)->first();
		

			}
		}
		elseif($_POST['select_option']==='by_adhar_number')
		{
			if($_POST['adhar_number']!='' && $_POST['adhar_number']!='none')
			{
				$data['seed_purchase_details']=DB::table('seed_purchasers')->where('farmer_id',$_POST['selected_farmer_id'])->orderBy('created_at', 'desc')->first();
				$data['selected_farmer_id']=$_POST['selected_farmer_id'];
				$adhar_number=$_POST['adhar_number'];
				$data['farmer']=DB::table('farmers')->where('adhar_card_number','=',$adhar_number)->where('entered_by_id','=',$user_details->id)->first();
			

			}
		}
			
		// check from database if rouging happened earlier
		
if($_POST['select_option']==='by_name')
{
		$data['previous_rouging_details']=DB::table('rouging_details')->where('farmer_id',$farmer_id)->get();
}
elseif($_POST['select_option']==='by_adhar_number')
{
	if(isset($data['farmer']->id))
	$data['previous_rouging_details']=DB::table('rouging_details')->where('farmer_id','=',$data['farmer']->id)->get();
}
	
		

		return view('seed_management.mid_season_report_form',$data);

	}	



	public function group_head_and_other_details_form_edit($transaction_id=null)
	{

		
		$data=array();
		
		$data['transaction_detail']=$transaction_detail=DB::table('seed_purchasers')->where('id',$transaction_id)->first();
		$data['transaction_id']=$transaction_id;
		$data['return_to']=URL::previous();

		$data['selected_farmer_id']=$transaction_detail->farmer_id;
		$data['farmer']=DB::table('farmers')->where('id','=',$transaction_detail->farmer_id)->first();
		return view('seed_management.seed_purchaser_form_edit',$data);

	}

	public function store_group_head_and_other_details($transaction_id=null)
	{

		$data=$_POST;
		$data_entered_by=unserialize($_POST['entered_by']);
		$data['project_id']=1;
		$data['project_name']='cmss';

		$data['ngo_id']=$data_entered_by['id'];
		$data['ngo_name']=$data_entered_by['ngo_name'];
		$data['data_entered_by']=$data_entered_by['data_entered_by'];
		$data['group_creation_date']=date_create_from_format('d/m/Y',$data['group_creation_date'])->format('Y-m-d');
		$data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
		unset($data['entered_by']);
		unset($data['_token']);

		
			if($transaction_id!=null)
			{
				$insert_id=DB::table('ngo_farmer_group_links')->where('id',$transaction_id)->update($data);
				return redirect()->to($_POST['return_to']);
			}
			else
			{ 

			$insert_id=DB::table('ngo_farmer_group_links')->insert($data); }

			if($insert_id>0)
			{

				echo "<style>";
				echo '.success-message {
  text-align: center;
  max-width: 500px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.success-message__icon {
  max-width: 75px;
}

.success-message__title {
  color: #3DC480;
  transform: translateY(25px);
  opacity: 0;
  transition: all 200ms ease;
}
.active .success-message__title {
  transform: translateY(0);
  opacity: 1;
}

.success-message__content {
  color: #B8BABB;
  transform: translateY(25px);
  opacity: 0;
  transition: all 200ms ease;
  transition-delay: 50ms;
}
.active .success-message__content {
  transform: translateY(0);
  opacity: 1;
}

.icon-checkmark circle {
  fill: #3DC480;
  transform-origin: 50% 50%;
  transform: scale(0);
  transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
}
.icon-checkmark path {
  transition: stroke-dashoffset 350ms ease;
  transition-delay: 100ms;
}
.active .icon-checkmark circle {
  transform: scale(1);
}';

echo "</style>";

				echo '<div class="success-message">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36" />
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7" />
    </svg>
    <h1 class="success-message__title">Sucessfully saved</h1>
    <div class="success-message__content">
        <p>Select another famer and click on get form button to enter new farmers group details.</p>
    </div>
</div>';

echo "<script>";

echo 'function PathLoader(el) {
	this.el = el;
    this.strokeLength = el.getTotalLength();
	
    // set dash offset to 0
    this.el.style.strokeDasharray =
    this.el.style.strokeDashoffset = this.strokeLength;
}

PathLoader.prototype._draw = function (val) {
    this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
}

PathLoader.prototype.setProgress = function (val, cb) {
	this._draw(val);
    if(cb && typeof cb === "function") cb();
}

PathLoader.prototype.setProgressFn = function (fn) {
	if(typeof fn === "function") fn(this);
}

var body = document.body,
    svg = document.querySelector("svg path");

if(svg !== null) {
    svg = new PathLoader(svg);
    
    setTimeout(function () {
        document.body.classList.add("active");
        svg.setProgress(1);
    }, 200);
}

document.addEventListener("click", function () {
    
    if(document.body.classList.contains("active")) {
        document.body.classList.remove("active");
        svg.setProgress(0);
        return;
    }
    document.body.classList.add("active");
    svg.setProgress(1);
});';

echo "</script>";
			}
		
			

	}






	//
	//  seed purchase module //
	//


// check if seed is already taken by farmerin same season

	public function check_seed_purchaser($transaction_id=null)
	{

		
		$seed_taken=DB::table('seed_purchasers')->where('farmer_id','=',$_POST['farmer_id'])->where('season','=',$_POST['season'])->where('year','=',$_POST['year'])->first();
		if(!empty($seed_taken))
			return 'true';
		else
			return 'false';

	} 


	public function store_seed_purchaser($transaction_id=null)
	{
		
			$data=$_POST;
			// print_r($_POST);
			$data_entered_by=unserialize($_POST['entered_by']);
			$farmer_location=DB::table('farmers')->select('state','district','mandal','mvk','panchayat','village','habitation')->where('id',$data['farmer_id'])->first();
			$data['state']=$farmer_location->state;
			$data['district']=$farmer_location->district;
			$data['mandal']=$farmer_location->mandal;
			$data['mvk']=$farmer_location->mvk;
			$data['panchayat']=$farmer_location->panchayat;
			$data['village']=$farmer_location->village;
			$data['habitation']=$farmer_location->habitation;
			$data['total']=(float)$data['bag']*(float)$data['bag_price'];
			$data['ngo_id']=$data_entered_by['id'];
			$data['ngo_name']=$data_entered_by['ngo_name'];
			$data['data_entered_by']=$data_entered_by['data_entered_by'];
			$data['data_collection_date']=date_create_from_format('d/m/Y',$data['data_collection_date'])->format('Y-m-d');
			$data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
			unset($data['return_to']);
			unset($data['_token']);
			unset($data['entered_by']);
			$insert_id=-1;

			if($transaction_id!=null)
			{
				$insert_id=DB::table('seed_purchasers')->where('id',$transaction_id)->update($data);
				return redirect()->to($_POST['return_to']);
			}
			else
			{ 

			$insert_id=DB::table('seed_purchasers')->insert($data); }

			if($insert_id>0)
			{

				echo "<style>";
				echo '.success-message {
  text-align: center;
  max-width: 500px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.success-message__icon {
  max-width: 75px;
}

.success-message__title {
  color: #3DC480;
  transform: translateY(25px);
  opacity: 0;
  transition: all 200ms ease;
}
.active .success-message__title {
  transform: translateY(0);
  opacity: 1;
}

.success-message__content {
  color: #B8BABB;
  transform: translateY(25px);
  opacity: 0;
  transition: all 200ms ease;
  transition-delay: 50ms;
}
.active .success-message__content {
  transform: translateY(0);
  opacity: 1;
}

.icon-checkmark circle {
  fill: #3DC480;
  transform-origin: 50% 50%;
  transform: scale(0);
  transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
}
.icon-checkmark path {
  transition: stroke-dashoffset 350ms ease;
  transition-delay: 100ms;
}
.active .icon-checkmark circle {
  transform: scale(1);
}';

echo "</style>";

				echo '<div class="success-message">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36" />
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7" />
    </svg>
    <h1 class="success-message__title">Sucessfully saved</h1>
    <div class="success-message__content">
        <p>Select another famer and click on get form button to enter new farmers seed purchase details.</p>
    </div>
</div>';

echo "<script>";

echo 'function PathLoader(el) {
	this.el = el;
    this.strokeLength = el.getTotalLength();
	
    // set dash offset to 0
    this.el.style.strokeDasharray =
    this.el.style.strokeDashoffset = this.strokeLength;
}

PathLoader.prototype._draw = function (val) {
    this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
}

PathLoader.prototype.setProgress = function (val, cb) {
	this._draw(val);
    if(cb && typeof cb === "function") cb();
}

PathLoader.prototype.setProgressFn = function (fn) {
	if(typeof fn === "function") fn(this);
}

var body = document.body,
    svg = document.querySelector("svg path");

if(svg !== null) {
    svg = new PathLoader(svg);
    
    setTimeout(function () {
        document.body.classList.add("active");
        svg.setProgress(1);
    }, 200);
}

document.addEventListener("click", function () {
    
    if(document.body.classList.contains("active")) {
        document.body.classList.remove("active");
        svg.setProgress(0);
        return;
    }
    document.body.classList.add("active");
    svg.setProgress(1);
});';

echo "</script>";
			}
		
			
		
	}




	public function store_rouging($transaction_id=null)
	{
		
			$data=$_POST;
			// print_r($_POST);
			$data_entered_by=unserialize($_POST['entered_by']);
			
			$data['state']=$data['state'];
			$data['district']=$data['district'];
			$data['mandal']=$data['mandal'];
			$data['mvk']=$data['mvk'];
			$data['panchayat']=$data['panchayat'];
			$data['village']=$data['village'];
			$data['habitation']=$data['habitation'];

			$data['ngo_id']=$data_entered_by['id'];
			$data['ngo_name']=$data_entered_by['ngo_name'];
			$data['data_entered_by']=$data_entered_by['data_entered_by'];
			
			if(isset($data['sowing_date']))
			{
				$data_sowing['sowing_date']=date_create_from_format('d/m/Y',$data['sowing_date'])->format('Y-m-d');

				$sowing_date_insert_id=DB::table('seed_purchasers')->where('id',$data_entered_by['seed_purchase_id'])->update($data_sowing);
			}
				
			$data['rouging_date']=date_create_from_format('d/m/Y',$data['rouging_date'])->format('Y-m-d');
			
			unset($data['return_to']);
			unset($data['_token']);
			unset($data['entered_by']);
			$insert_id=-1;

			// print_r($data);

			if($transaction_id!=null)
			{
				$data['updated_at']=\Carbon\Carbon::now()->toDateTimeString();
				$insert_id=DB::table('rouging_details')->where('id',$transaction_id)->update($data);
				return redirect()->to($_POST['return_to']);
			}
			else
			{ 
				$data['created_at']=\Carbon\Carbon::now()->toDateTimeString();
				 $insert_id=DB::table('rouging_details')->insert($data); 
			}

			if($insert_id>0)
			{

				echo "<style>";
				echo '.success-message {
				  text-align: center;
				  max-width: 500px;
				  position: absolute;
				  top: 50%;
				  left: 50%;
				  transform: translate(-50%, -50%);
				}

				.success-message__icon {
				  max-width: 75px;
				}

				.success-message__title {
				  color: #3DC480;
				  transform: translateY(25px);
				  opacity: 0;
				  transition: all 200ms ease;
				}
				.active .success-message__title {
				  transform: translateY(0);
				  opacity: 1;
				}

				.success-message__content {
				  color: #B8BABB;
				  transform: translateY(25px);
				  opacity: 0;
				  transition: all 200ms ease;
				  transition-delay: 50ms;
				}
				.active .success-message__content {
				  transform: translateY(0);
				  opacity: 1;
				}

				.icon-checkmark circle {
				  fill: #3DC480;
				  transform-origin: 50% 50%;
				  transform: scale(0);
				  transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
				}
				.icon-checkmark path {
				  transition: stroke-dashoffset 350ms ease;
				  transition-delay: 100ms;
				}
				.active .icon-checkmark circle {
				  transform: scale(1);
				}';

echo "</style>";

				echo '<div class="success-message">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36" />
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7" />
    </svg>
    <h1 class="success-message__title">Sucessfully saved</h1>
    <div class="success-message__content">
        <p>Select another famer and click on get form button to enter new farmers seed purchase details.</p>
    </div>
</div>';

echo "<script>";

echo 'function PathLoader(el) {
	this.el = el;
    this.strokeLength = el.getTotalLength();
	
    // set dash offset to 0
    this.el.style.strokeDasharray =
    this.el.style.strokeDashoffset = this.strokeLength;
}

PathLoader.prototype._draw = function (val) {
    this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
}

PathLoader.prototype.setProgress = function (val, cb) {
	this._draw(val);
    if(cb && typeof cb === "function") cb();
}

PathLoader.prototype.setProgressFn = function (fn) {
	if(typeof fn === "function") fn(this);
}

var body = document.body,
    svg = document.querySelector("svg path");

if(svg !== null) {
    svg = new PathLoader(svg);
    
    setTimeout(function () {
        document.body.classList.add("active");
        svg.setProgress(1);
    }, 200);
}

document.addEventListener("click", function () {
    
    if(document.body.classList.contains("active")) {
        document.body.classList.remove("active");
        svg.setProgress(0);
        return;
    }
    document.body.classList.add("active");
    svg.setProgress(1);
});';

echo "</script>";
			}
		
			
		
	}


public function seed_purchaser_delete($transaction_id=null)
{


DB::table('seed_purchasers')->where('id',$transaction_id)->delete();

return redirect()->back();


}



public function rouging_delete($transaction_id=null)
{


DB::table('rouging_details')->where('id',$transaction_id)->delete();

return redirect()->back();


}


public function farmers_list()
	{

		$farmers_list=array();
		$state=$_POST['state'];
		$district=$_POST['district'];
		$mvk=$_POST['mvk'];
		$mandal=$_POST['mandal'];
		$panchayat=$_POST['panchayat'];
		$village=$_POST['village'];
		$habitation=$_POST['habitation'];
		$form_name=$_POST['form_name'];
		$user_id='';

		$user_details=Session::all();
		if(isset($user_details['user_details']->id) && $user_details['user_details']->id!='')
		{
			$user_id=$user_details['user_details']->id;
		}



		if($state!='' && ($district=='' || $district=='Do Not Mention' || $district=='All') && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All'))
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->get();	
			}
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) {
			
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$farmers_list=DB::table('farmers')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

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
			$farmers_list=DB::table('farmers')->select('id','name','fname','farmer_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

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

		$farmers_list_html='';

			$farmers_list_html.='<FORM METHOD=POST target="result_iframe" ENCTYPE="multipart/form-data" ACTION="'.URL::to('seed_management/').'/'.$form_name.'/form'.'"> ';

			$farmers_list_html.=Form::token();

			$farmers_list_html.='<input type="hidden" name="selected_farmer_id" id="selected_farmer_id" value="none" />';

			$farmers_list_html.='<div><div class="btn-group" style="display:block;" data-toggle="buttons" role="group">
                      <label class="btn btn-outline btn-primary active">
                        <input name="select_option" autocomplete="off" value="by_name" checked="checked" type="radio">
                      Select By Name
                      </label>
                   
                      <label class="btn btn-outline btn-primary">
                        <input name="select_option" autocomplete="off" value="by_adhar_number" type="radio">
                      Select by Adhar Card Number
                      </label>
                 </div></div>';

		
		
		$farmers_list_html.='<div class="form-group col-md-5" id="name_area">
		
		<select multiple 
			class="selectpicker" 
			id="farmers_multiselect_list" 
			data-max-options="1" 
			data-plugin="selectpicker">';
		             
		foreach($farmers_list as $farmer)
		{

			 $farmers_list_html.="<option data-content=\"";

			 if($farmer->farmer_image!='')
			 {
			 	$farmers_list_html.="<img style='width:50px;' src='".$farmer->farmer_image."'>";
			 }
			 $farmers_list_html.="$farmer->name s/o $farmer->fname \" value='$farmer->id'>$farmer->name/$farmer->fname</option>";
					
					
		}

		 $farmers_list_html.= "</select></div>";



		$farmers_list_html.='<div class="form-group col-md-5" id="adhar_number_area">
		            <label class="control-label" for="name">Adhar Number</label>
		            <input type="text" class="form-control " id="adhar_number" name="adhar_number" placeholder="Adhar Card Number">
		         </div>
		
		          <div >
		           	<input type="submit" id="submit_button_iframe" value="Get Form" class="btn btn-primary">
		         </div>	';

		         
		$farmers_list_html.='<script>
		$(function()
		{var iframe_opened_times=0; 
			$(".selectpicker").selectpicker("refresh");  
			$("#adhar_number_area").hide(); 
			$("input[type=radio][name=select_option]").change(function() 
				{ 
					if(this.value=="by_adhar_number" )
						{   $("#name_area").hide(); 
							$("#adhar_number_area").show(); 
						}
					else
						{
							$("#adhar_number_area").hide();  
							$("#name_area").show();
						}    
				});  	

		$("#submit_button_iframe").click(function(e)
			{	 
				
				$("#selected_farmer_id").val($(".selectpicker").val());
				$("iframe#result_iframe").show();

	});  }); </script>';



	return $farmers_list_html;



	}


//  get farmer groups list


public function farmers_group_list()
	{

		$farmer_groups_list=array();
		$state=$_POST['state'];
		$district=$_POST['district'];
		$mvk=$_POST['mvk'];
		$mandal=$_POST['mandal'];
		$panchayat=$_POST['panchayat'];
		$village=$_POST['village'];
		$habitation=$_POST['habitation'];
		$form_name=$_POST['form_name'];
		$user_id='';

		$user_details=Session::all();
		if(isset($user_details['user_details']->id) && $user_details['user_details']->id!='')
		{
			$user_id=$user_details['user_details']->id;
		}



		if($state!='' && ($district=='' || $district=='Do Not Mention' || $district=='All') && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All'))
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','state','district','mandal','mvk','panchayat','village','habitation','name','created_at')->where('entered_by',Auth::user()->email)->get();
			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','state','district','mandal','mvk','panchayat','village','habitation','name','created_at')->where('entered_by',Auth::user()->email)->get();	
			}
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention' || $mandal=='All') && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) {
			
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($mvk=='' || $mvk=='Do Not Mention' || $mvk=='All') && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && ($panchayat=='' ||  $panchayat=='Do Not Mention' || $panchayat=='All') && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && ($village=='' ||  $village=='Do Not Mention' || $village=='All') && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && ($habitation=='' ||  $habitation=='Do Not Mention' || $habitation=='All')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!='' && $mvk!='' && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$farmer_groups_list=DB::table('farmer_groups')->select('id','name','fname','farmer_group_image')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$farmer_groups_list=DB::table('farmer_groups')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('mvk',$mvk)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}

		$farmer_groups_list_html='';

			$farmer_groups_list_html.='<FORM METHOD=POST target="result_iframe" ENCTYPE="multipart/form-data" ACTION="'.URL::to('seed_management/').'/'.$form_name.'/form'.'"> ';

			$farmer_groups_list_html.=Form::token();

			$farmer_groups_list_html.='<input type="hidden" name="selected_farmer_group_id" id="selected_farmer_group_id" value="none" />';

			$farmer_groups_list_html.='<div><div class="btn-group" style="display:block;" data-toggle="buttons" role="group">
                      <label class="btn btn-outline btn-primary active">
                        <input name="select_option" autocomplete="off" value="by_name" checked="checked" type="radio">
                      Select By Name
                      </label>
                  
                 </div></div>';

		
		
		$farmer_groups_list_html.='<div class="form-group col-md-5" id="name_area">
		
		<select multiple 
			class="selectpicker" 
			id="farmer_groups_multiselect_list" 
			data-max-options="1" 
			data-plugin="selectpicker">';
		             
		foreach($farmer_groups_list as $farmer_group)
		{

			 $farmer_groups_list_html.="<option data-content=\" $farmer_group->name\" value='$farmer_group->id'>$farmer_group->name</option>";
					
					
		}

		 $farmer_groups_list_html.= "</select></div>";



		$farmer_groups_list_html.='<div >
		           	<input type="submit" id="submit_button_iframe" value="Get Form" class="btn btn-primary">
		         </div>	';

		         
		$farmer_groups_list_html.='<script>
		$(function(){

			var iframe_opened_times=0; 
			$(".selectpicker").selectpicker("refresh");  
	  	

		$("#submit_button_iframe").click(function(e)
			{	 
				
				$("#selected_farmer_group_id").val($(".selectpicker").val());
				$("iframe#result_iframe").show();


		});  

		}); </script>';



	return $farmer_groups_list_html;



	}
	

}
