<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ngo as ngo;
use DB;
use Flash;
use URL;
use Request;
use Input;
use Html;
use PDF;
use Auth;
use Session;


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

		print_r($_POST);
		$data=$_POST;
		$data['verification_HON_email']='N';
		$data['current_password_HON']=date('dmYhisA').rand();
		$data['verification_incharge_email']='N';
		$data['current_password_incharge']=date('dmYhisA').rand();
		$data['created_at']= \Carbon\Carbon::now()->toDateTimeString();
		// $mvk_linked=$data['mvk_linked_with'];
		// unset($data['mvk_linked_with']);
		unset($data['_token']);


		
		 $ngo_insert_id=DB::table('ngos')->insertGetId($data);
		
		// create ngo head as user in user table

		$data_user=array();
		$data_user['email']=$data['email_HON'];
		$data_user['password']=bcrypt($data['current_password_HON']);
		$data_user['linked_id']=$ngo_insert_id;
		$data_user['linked_table']='ngos';
		$data_user['linked_with_property']='email_HON';
		$data_user['created_at']=\Carbon\Carbon::now()->toDateTimeString();

		$user_insert_id=DB::table('users')->insertGetId($data_user);

		// assigning role to  ngo head in role_user table

		$data_user_role=array();
		$data_user_role['user_id']=$user_insert_id;
		$data_user_role['role_id']=4;


		$insert_user_role_id=DB::table('role_user')->insertGetId($data_user_role);


		// create ngo field incharge as user in user table

		
		$data_user['email']=$data['email_incharge'];
		$data_user['password']=bcrypt($data['current_password_incharge']);
		$data_user['linked_id']=$ngo_insert_id;
		$data_user['linked_table']='ngos';
		$data_user['linked_with_property']='email_incharge';
		$data_user['created_at']=\Carbon\Carbon::now()->toDateTimeString();

		$user_insert_id=DB::table('users')->insertGetId($data_user);

		// assigning role to  ngo field incharge in role_user table

	
		$data_user_role['user_id']=$user_insert_id;
		$data_user_role['role_id']=5;

		$insert_user_role_id=DB::table('role_user')->insertGetId($data_user_role);

		
		// lining mvks with ngo

			// 	if(isset($mvk_linked) && !empty($mvk_linked))
			// 	{
			// 	foreach ($mvk_linked as $mvk) {

					
			// 		$data_link_mvk['ngo_id']=$ngo_insert_id;
			// 		$data_link_mvk['mvk_id']=$mvk;
			// 		$data_user['created_at']=\Carbon\Carbon::now()->toDateTimeString();

			// 		$insert_user_role_id=DB::table('ngo_mvk_link')->insertGetId($data_link_mvk);
					
			// 	}
			// }
					



	}




	public function change_password()
	{

		$data=array();
		$table=Auth::user()->linked_table;
		$row_id_in_table=Auth::user()->linked_id;
		

		if(Auth::user()->linked_with_property==='email_HON')
		$data['user_specific']=DB::table($table)->select('name','full_address','HON','HON_image','gender_HON','contact_number_HON','email_HON','password_changed_on')->where('id','=',$row_id_in_table)->first();
		elseif(Auth::user()->linked_with_property==='email_incharge')
		$data['user_specific']=DB::table($table)->select('name','full_address','field_incharge','field_incharge_image','gender_field_incharge','contact_number_incharge','email_incharge','incharge_password_changed_on')->where('id','=',$row_id_in_table)->first();


		return view('ngos.change_password',$data);
	}

	public function store_password()
	{
		
		print_r($_POST);
		$result=DB::table($_POST['table_name'])->select($_POST['password_field_name'])->where('id','=',$_POST['row_id'])->first();

		// print_r($result);

		///echo $result->current_password_HON;
		$old_password_from_database='';
		$eval= '$old_password_from_database=$result->'.$_POST['password_field_name'].';';

		eval($eval);
	
		
		if(trim($_POST['old_password'])==$old_password_from_database)
		{
			if($_POST['new_password']===$_POST['new_password_confirm'])
			{

			if($_POST['new_password']==='')
			{
				$_POST['new_password']='demo_password';
			}
			$data[$_POST['password_field_name']]=$_POST['new_password'];

			if($_POST['password_field_name']=='current_password_HON')
			{
			$data['password_changed_on']=\Carbon\Carbon::now()->toDateTimeString();
			}
			elseif($_POST['password_field_name']=='current_password_incharge')
			{
			$data['incharge_password_changed_on']=\Carbon\Carbon::now()->toDateTimeString();
			}

			DB::table($_POST['table_name'])->where('id','=',$_POST['row_id'])->update($data);
			

			$data_users_table=array();
			$data_users_table['password']=bcrypt($_POST['new_password']);
			DB::table('users')->where('id','=',Auth::user()->id)->update($data_users_table);
			$status="successfully updated";
			}
			else
			{
				$status="It seems your new password and confirmation password didn't match";
			}

		}
		else
		{
			$status="It seems your old password you entered didn't match";
		}

		return $status;
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
		
		$ngo=DB::table('ngos')->find($id);

		// print_r($ngo);
	
		return view('ngos.edit',compact('ngo'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id=null)
	{

		// print_r($_POST);
		unset($_POST['_method']);
		unset($_POST['_token']);
		$data['updated_at']= \Carbon\Carbon::now()->toDateTimeString();

		// print_r($_POST);
		
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
		
		$ngo_details=DB::table('ngos')->select('email_HON','email_incharge')->where('id',$id)->first();
		ngo::where('id',$id)->delete();
		if($ngo_details->email_HON!='')
		{
		DB::table('users')->where('email',$ngo_details->email_HON)->delete();
		}
		if($ngo_details->email_incharge!='')
		{
		DB::table('users')->where('email',$ngo_details->email_incharge)->delete();
		}
		

		Flash::success('User successfully deleted');

		// return redirect('/ngo');
		return redirect()->back();
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
		
		if($state!='' && ($district=='' || $district=='All'  || $district=='Do Not Mention') && ($mandal==''  || $mandal=='All'  || $mandal=='Do Not Mention') && ($village==''  || $village=='All'  || $village=='Do Not Mention'))
		{
		$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->get();
		}
		elseif ($state!='' && $district!='' && ($mandal==''  || $mandal=='All'  || $mandal=='Do Not Mention') && ($village==''  || $village=='All'  || $village=='Do Not Mention')) {
			$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->where('district',$district)->get();
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && ($village==''  || $village=='All'  || $village=='Do Not Mention')) {
			$ngos_list=DB::table('ngos')->select('id','name','HON')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
		}
		elseif (($state!='' || $state=='All') && ($district=='' || $district=='All'  || $district=='Do Not Mention') && ($mandal==''  || $mandal=='All'  || $mandal=='Do Not Mention') && ($village==''  || $village=='All'  || $village=='Do Not Mention')) {
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

	public function getSelectiveNgo($state=null, $district=null, $mandal=null, $panchayat=null, $village=null, $habitation=null)
	{
		$ngos_list=array();

		// $state=$_POST['state'];
		// $district=$_POST['district'];
		// $mandal=$_POST['mandal'];
		// $panchayat=$_POST['pancahayat'];
		// $village=$_POST['village'];
		// $habitation=$_POST['habitation'];

		// echo $state;
		// echo $district;
		// echo $mandal;
		// echo $mvk;
		// echo $panchayat;
		// echo $village;	
		// echo $habitation;
			// print_r(Session::all());

		$ngos_list=array();
		
		if($state!='' && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention'))
		{
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->get();
			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->get();	
			}
		}
		elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention')  && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) {
			
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->get();

			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->get();

			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''   && ($panchayat=='' || $panchayat=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();

			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->get();
				
			}
		}
	
		elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''  && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->get();

			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->get();
				
			}
		}
		elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''  && $village!='' && ($habitation=='' || $habitation=='Do Not Mention')) 
		{
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->where('village',$village)->get();

			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->where('village',$village)->get();
				
			}
		}

		elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''  && $village!='' && $habitation!='') 
		{
			if(isset(Session::all()['user_details']))
			{
			$ngos_list=DB::table('ngos')->where('entered_by_id',Session::all()['user_details']->id)->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();

			}
			else
			{
			$ngos_list=DB::table('ngos')->where('state',$state)->where('district',$district)->where('mandal',$mandal)->where('panchayat',$panchayat)->where('village',$village)->where('habitation',$habitation)->get();
				
			}
		}
		else
		{
			// echo "$state | $district | $mandal | $village";
			echo "not found anything";
		}



			
		$ngos=$ngos_list;




	$return_records_string='';


      foreach($ngos as $ngo)
      {
         

         $return_records_string.="<tr><td>".$ngo->name."</td>";


        $return_records_string.="<td> Name : ";

              if($ngo->HON_image!='')
              {
                $return_records_string.='<a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location"  class="fancybox_cropped_img fancybox.iframe" href="'.$ngo->HON_image.'">'.$ngo->HON.'</a>'; 
              }
              else
              {
              $return_records_string.=$ngo->HON;

              }
          $return_records_string.='<br>';  // write </td> here to close the cell 
        
	         $return_records_string.='Mobile No. : '.$ngo->contact_number_HON.'<br>';
	         $return_records_string.='Email : '.$ngo->email_HON.'</td>';
		         // $return_records_string.='<td class="flash">';
	                  
	             
	            // $return_records_string.=$ngo->current_password_HON;
	             
              

                // $return_records_string.='</td>';
                // $return_records_string.='<td>'.$ngo->password_changed_on.'</td>';

                $return_records_string.='<td> Name : ';

		          if($ngo->field_incharge_image!='')
		          {
		                  $return_records_string.='<a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location"  class="fancybox_cropped_img fancybox.iframe" href="'.$ngo->field_incharge_image.'">'.$ngo->field_incharge.'</a> <br>';
		           }else{

		                 $return_records_string.=$ngo->field_incharge;
		           } 

                $return_records_string.="Mobile No. : $ngo->contact_number_incharge<br>
                Email : $ngo->email_incharge</td>";
              //   $return_records_string.="<td class='flash'>      
                
                
              //  $ngo->current_password_incharge
             
              
              // </td>
              //    <td>$ngo->incharge_password_changed_on</td>
              //   <td>$ngo->state</td>
              //   <td>$ngo->district</td>
              //   <td>$ngo->mandal</td>
              //   <td>$ngo->village</td>";

                $return_records_string.="<th style='min-width:120px;'>
                

                <a  id='$ngo->id' class='table_option' target='_blank' href='".URL::to('ngo')."/".$ngo->id."/edit'>
                <button type='button' class='btn  btn-xs  btn-icon btn-primary'>
                <li class='fa fa-pencil' style='color'></li>
                </button>
                </a>";


               // $return_records_string.=" <a  id='$ngo->id' class='table_option' href='".URL::to('ngo/ngo_profile_pdf')."/".$ngo->id."'>";


               //  $return_records_string.="<button type='button' class='btn  btn-xs  btn-icon btn-danger'>
               //  <li class='fa fa-file-pdf-o' style='color'></li>
               //  </button>
               //  </a>";


                $return_records_string.="<a id='$ngo->id' class='download_ngo_profile table_option' href='".URL::to('ngo/delete')."/".$ngo->id."'>
                <button type='button' class='btn btn-xs btn-icon btn-danger'>
                <li class='fa fa-close' style='color'></li>
                </button>
                </a>


                </th>


              </tr>";
           }
        

		return $return_records_string;

		// return response()->json($ngos);

		// return view('ngos.getngos',compact('ngos'));



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


	public function ngo_profile_pdf($ngo_id=null)
	{

		$ngo_profile_data=DB::table('ngos')->where('id','=',$ngo_id)->get();
		$ngo_profile_data[0]->html_about=Html::entities($ngo_profile_data[0]->about);
	//print_r($ngo_profile_data[0]);
		$pdf = PDF::loadView('pdf.invoice', (array)$ngo_profile_data[0]);
		return $pdf->download(strtolower(str_replace(' ','_',$ngo_profile_data[0]->name).'_'.date('dmY')).'.pdf');
	}


	


}
