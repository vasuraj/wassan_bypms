<?php namespace App\Http\Controllers;
use DB;
use URL;
use Auth;
use Entrust;
use Session;
use Input;
use Excel;
use Request;


class VaccinatorController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Vaccinator Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "Vaccinator" for the application and
	| is configured to only allow guests. 
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	
	// /**
	// * Enable the following code to enable only guest
	// * for now it is disabled
	// *
	// *	$this->middleware('guest');
	// *
	// */



	public function index()
	{		

	 	return view('Vaccinator.selective');	

	}

	public function fileUploadForm()
	{		

		$ngos_list=DB::table('ngos')->select('id','name')->get();
	 	return view('Vaccinator.fileUploadForm')->with('ngos_list',$ngos_list);


	}

	public function migrateExcelData()
	{
		/* Declared important valribale before staring varibale
		* 
		*	$file_purpose = '';
		*
		*/
		
		$file_purpose = '';


		/* 
		*	Check if Input has desired file
		*/

		if(Input::hasFile('excelFile') && !empty($_POST))
		{
			/*
			*
			*	If file is accessible then upload this file in relevant folder
			*
			*/

			$file=Input::file('excelFile');
			$file_name=$file->getClientOriginalName();
			if($file->isValid())
			{
				$this->file_purpose='farmer_data';
				$file_destination=storage_path().'/uploads/excel/'.$file_purpose;
				$file->move($file_destination,$file_name);

				// $file_destination;


			/*
			*
			*	Once the file upload finished read this file
			*
			*/
			try{

				Excel::load(storage_path('uploads\excel\\'.$file_purpose.'\\'.$file_name),function($reader)
				{
					$number_of_colums=0;
					$error_inserting_record_for=array();
					$error_inserting_record_count=0;

					$data_category=$this->file_purpose.'_data';
					$$data_category=$reader->get();
				
					$baseline_data_rows=$$data_category;


					foreach ($baseline_data_rows as $sheet) 
					{
						//foreach ($excel_records as $excel_record) {

						// foreach ($sheet as $excel_record) 
						// {
							
						$excel_record=$sheet;
						// print_r($excel_record);
						if(!empty($excel_record))
						{
							$first_cell=str_replace(' ','',strtolower($excel_record[1]));
							// echo "<br>----------------------<br>";
							// echo " $first_cell";
							// echo "<br>----------------------<br>";

						
							if($first_cell=='slno')
							{
								continue;
							}
							else
							{
							$Vaccinator_baseline_data=array();


							 // print_r($excel_record);

							

							$Vaccinator_baseline_data['ngo_id'] = $_POST['selected_ngo'];
							$Vaccinator_baseline_data['survey_date'] = $excel_record[2];
							$Vaccinator_baseline_data['name_of_the_itda'] = $excel_record[3];
							$Vaccinator_baseline_data['name_of_the_state'] = $_POST['state'];
							$Vaccinator_baseline_data['name_of_the_district'] = $_POST['district'];
							$Vaccinator_baseline_data['name_of_the_mandal'] = $_POST['mandal'];
							$Vaccinator_baseline_data['name_of_the_ngo'] = $_POST['selected_ngo'];
							$Vaccinator_baseline_data['bypms_cluster_id'] = $_POST['bypms_cluster_id'];
							$Vaccinator_baseline_data['name_of_the_panchayat'] =$_POST['panchayat'];
							$Vaccinator_baseline_data['name_of_the_village'] = $_POST['village'];
							$Vaccinator_baseline_data['name_of_the_habitation'] = $_POST['habitation'];
							$Vaccinator_baseline_data['name_of_the_Vaccinator_woman'] = $excel_record[9];
							$Vaccinator_baseline_data['caste'] = $excel_record[10];
							$Vaccinator_baseline_data['land_holding_in_acre'] = $excel_record[11];
							$Vaccinator_baseline_data['area_under_irrigation_in_acre'] = $excel_record[12];
							$Vaccinator_baseline_data['crop_shown'] = $excel_record[13];
							$Vaccinator_baseline_data['aadhar_card_number'] = $excel_record[14];
							$Vaccinator_baseline_data['mobile_number'] = $excel_record[15];
							$Vaccinator_baseline_data['member_of_shg'] = $excel_record[16];
							$Vaccinator_baseline_data['name_of_the_shg'] = $excel_record[17];
							$Vaccinator_baseline_data['name_of_the_cig'] = $excel_record[18];
							$Vaccinator_baseline_data['membership_fee_deposited_in_rs'] = $excel_record[19];
							$Vaccinator_baseline_data['amount_deposited_for_vaccination_payment_for_poultry_fund'] = $excel_record[20];
							$Vaccinator_baseline_data['number_of_hens_laying_eggs_as_on_survey_date'] = $excel_record[21];
							$Vaccinator_baseline_data['number_of_hens_started_brooding_or_hatching_as_on_survey_date'] = $excel_record[22];
							$Vaccinator_baseline_data['number_of_hens_with_chicks_as_on_survey_date'] = $excel_record[23];
							$Vaccinator_baseline_data['number_of_dry_hens_as_on_survey_date'] = $excel_record[24];
							$Vaccinator_baseline_data['total_number_of_hens_as_on_survey_date'] = $excel_record[25];
							$Vaccinator_baseline_data['number_of_cocks_as_on_survey_date'] = $excel_record[26];
							$Vaccinator_baseline_data['number_of_chicks_as_on_survey_date'] = $excel_record[27];
							$Vaccinator_baseline_data['number_of_growers_as_on_survey_date'] = $excel_record[28];
							$Vaccinator_baseline_data['total_number_of_birds_as_on_survey_date'] = $excel_record[29];
							$Vaccinator_baseline_data['what_kind_of_shelter_is_there_for_birds'] = $excel_record[30];
							$Vaccinator_baseline_data['is_there_any_specific_places_made_for_laying_eggs'] = $excel_record[31];
							$Vaccinator_baseline_data['where_Vaccinator_keep_hatching_nest'] = $excel_record[32];
							$Vaccinator_baseline_data['ingredients_used_as_feed_to_poultry'] = $excel_record[33].','.$excel_record[34].''.$excel_record[35];
							$Vaccinator_baseline_data['supplementary_feed_given_to_birds_kg_per_day'] = $excel_record[36];
							$Vaccinator_baseline_data['source_of_feed_supplementary'] = $excel_record[37];
							$Vaccinator_baseline_data['source_of_water_for_birds_in_monsoon'] = $excel_record[38];
							$Vaccinator_baseline_data['source_of_water_for_birds_in_winter'] = $excel_record[39];
							$Vaccinator_baseline_data['source_of_water_for_birds_in_summer'] = $excel_record[40];
							$Vaccinator_baseline_data['number_of_birds_dewormed'] = $excel_record[41];
							$Vaccinator_baseline_data['date_of_previous_deworming'] = $excel_record[42];
							$Vaccinator_baseline_data['date_of_previous_vaccination_against_raniket'] = $excel_record[43];
							$Vaccinator_baseline_data['date_of_previous_vaccination_against_fowl_pox'] = $excel_record[44];
							$Vaccinator_baseline_data['numbers_of_chicks_died_last_year'] = $excel_record[45];
							$Vaccinator_baseline_data['numbers_of_growers_died_last_year'] = $excel_record[46];
							$Vaccinator_baseline_data['numbers_of_hens_died_last_year'] = $excel_record[47];
							$Vaccinator_baseline_data['numbers_of_cocks_died_last_year'] = $excel_record[48];
							$Vaccinator_baseline_data['value_last_year'] = $excel_record[49];
							$Vaccinator_baseline_data['reasons_for_chicks_death_last_year'] = $excel_record[50];
							$Vaccinator_baseline_data['reasons_for_growers_death_last_year'] = $excel_record[51];
							$Vaccinator_baseline_data['reasons_for_hens_death_last_year'] = $excel_record[52];
							$Vaccinator_baseline_data['reasons_for_cocks_death_last_year'] = $excel_record[53];
							$Vaccinator_baseline_data['predation_of_chicks_last_year'] = $excel_record[54];
							$Vaccinator_baseline_data['predation_of_growers_last_year'] = $excel_record[55];
							$Vaccinator_baseline_data['predation_of_hens_last_year'] = $excel_record[56];
							$Vaccinator_baseline_data['predation_of_cocks_last_year'] = $excel_record[57];
							$Vaccinator_baseline_data['numbers_of_chicks_died_in_past_month'] = $excel_record[58];
							$Vaccinator_baseline_data['numbers_of_growers_died_in_past_month'] = $excel_record[59];
							$Vaccinator_baseline_data['numbers_of_hens_died_in_past_month'] = $excel_record[60];
							$Vaccinator_baseline_data['numbers_of_cocks_died_in_past_month'] = $excel_record[61];
							$Vaccinator_baseline_data['value_in_past_month'] = $excel_record[62];
							$Vaccinator_baseline_data['reasons_for_chicks_death_in_past_month'] = $excel_record[63];
							$Vaccinator_baseline_data['reasons_for_growers_death_in_past_month'] = $excel_record[64];
							$Vaccinator_baseline_data['reasons_for_hens_death_in_past_month'] = $excel_record[65];
							$Vaccinator_baseline_data['reasons_for_cocks_death_in_past_month'] = $excel_record[66];
							$Vaccinator_baseline_data['predation_of_chicks_in_past_month'] = $excel_record[67];
							$Vaccinator_baseline_data['predation_of_growers_in_past_month'] = $excel_record[68];
							$Vaccinator_baseline_data['predation_of_hens_in_past_month'] = $excel_record[69];
							$Vaccinator_baseline_data['predation_of_cocks_in_past_month'] = $excel_record[70];
							$Vaccinator_baseline_data['number_of_chicks_sold_in_past_one_year'] = $excel_record[71];
							$Vaccinator_baseline_data['number_of_growers_sold_in_past_one_year'] = $excel_record[72];
							$Vaccinator_baseline_data['number_of_hens_sold_in_past_one_year'] = $excel_record[73];
							$Vaccinator_baseline_data['number_of_cocks_sold_in_past_one_year'] = $excel_record[74];
							$Vaccinator_baseline_data['number_of_growers_consumed_by_Vaccinator_in_past_one_year'] = $excel_record[75];
							$Vaccinator_baseline_data['number_of_hens_consumed_by_Vaccinator_in_past_one_year'] = $excel_record[76];
							$Vaccinator_baseline_data['number_of_cocks_consumed_by_Vaccinator_in_past_one_year'] = $excel_record[77];
							$Vaccinator_baseline_data['price_of_growers_sold_in_past_one_year'] = $excel_record[78];
							$Vaccinator_baseline_data['price_of_hens_sold_in_past_one_year'] = $excel_record[79];
							$Vaccinator_baseline_data['price_of_cocks_sold_in_past_one_year'] = $excel_record[80];
							$Vaccinator_baseline_data['value_of_chicks_sold_in_past_one_year'] = $excel_record[81];
							$Vaccinator_baseline_data['value_of_growers_sold_in_past_one_year'] = $excel_record[82];
							$Vaccinator_baseline_data['value_of_hens_sold_in_past_one_year'] = $excel_record[83];
							$Vaccinator_baseline_data['value_of_cocks_sold_in_past_one_year'] = $excel_record[84];
							$Vaccinator_baseline_data['number_of_chicks_sold_in_past_one_month'] = $excel_record[85];
							$Vaccinator_baseline_data['number_of_growers_sold_in_past_one_month'] = $excel_record[86];
							$Vaccinator_baseline_data['number_of_hens_sold_in_past_one_month'] = $excel_record[87];
							$Vaccinator_baseline_data['number_of_cocks_sold_in_past_one_month'] = $excel_record[88];
							$Vaccinator_baseline_data['number_of_growers_consumed_by_hh_in_past_one_month'] = $excel_record[89];
							$Vaccinator_baseline_data['number_of_hens_consumed_by_hh_in_past_one_month'] = $excel_record[90];
							$Vaccinator_baseline_data['number_of_cocks_consumed_by_hh_in_past_one_month'] = $excel_record[91];
							$Vaccinator_baseline_data['price_of_growers_sold_in_past_one_month'] = $excel_record[92];
							$Vaccinator_baseline_data['price_of_hens_sold_in_past_one_month'] = $excel_record[93];
							$Vaccinator_baseline_data['price_of_cocks_sold_in_past_one_month'] = $excel_record[94];
							$Vaccinator_baseline_data['value_of_chicks_sold_in_past_one_month'] = $excel_record[95];
							$Vaccinator_baseline_data['value_of_growers_sold_in_past_one_month'] = $excel_record[96];
							$Vaccinator_baseline_data['value_of_hens_sold_in_past_one_month'] = $excel_record[97];
							$Vaccinator_baseline_data['value_of_cocks_sold_in_past_one_month'] = $excel_record[98];
							$Vaccinator_baseline_data['where_whom_birds_are_sold_by_the_Vaccinator_in_past_one_month'] = $excel_record[99];
							$Vaccinator_baseline_data['where_is_the_nearest_market'] = $excel_record[100];
							$Vaccinator_baseline_data['distance_of_nearest_market_in_km'] = $excel_record[101];
							$Vaccinator_baseline_data['name_of_the_data_collector'] = $excel_record[102];

							$valid_number_of_colums=count($Vaccinator_baseline_data);
							$number_of_colums_in_current_record=count($excel_record);
							

								if($valid_number_of_colums==($number_of_colums_in_current_record-2)+3)
								{

								 	
									$if_exist_already=DB::table('household_baseline_survey_data')->where('aadhar_card_number',$Vaccinator_baseline_data['aadhar_card_number'])->first();
									if(!$if_exist_already)
									{
									 	DB::table('household_baseline_survey_data')->insert($Vaccinator_baseline_data);
									 
									}
									else
									{
										$error_inserting_record_count++;
										$error_inserting_record_for[$error_inserting_record_count]=$Vaccinator_baseline_data;
										
									}


									if($error_inserting_record_count>0)
									{
										$failed_insert_message="";
										$failed_insert_message_html="";

										foreach($error_inserting_record_for as $failed_insert)
										{
											

												$failed_insert_message.=$failed_insert['aadhar_card_number'].' with Name : '.$failed_insert['name_of_the_Vaccinator_women'].'\n';
												$failed_insert_message_html.=$failed_insert['aadhar_card_number'].' with Name : '.$failed_insert['name_of_the_Vaccinator_women'].' and survey date is '.$failed_insert['survey_date'].' <br>';

										}

										Session::flash('status_type', 'error');
										Session::flash('status_title', 'Failed for '.$error_inserting_record_count.' Adhar Number');
										Session::flash('status', 'We could not instert Baseline data for these Adhar numbers\n'.$failed_insert_message);
										Session::flash('fixed_status', 'We could not instert Baseline data for these Adhar numbers<br>'.$failed_insert_message_html);

									}
									else
									{
										Session::flash('status_type', 'success');
										Session::flash('status_title', 'Success');
										Session::flash('status', 'Data Migrated Sucessfully');
										
									}


								}
								else
								{
									
								 	Session::flash('status_type', 'error');
									Session::flash('status_title', 'Failed');
									Session::flash('status', 'Please double check if the uploaded excel file has same number of colums as suggested');
								}
							


							}

							//  if first line is header with the string slno after removing data 
							//  ignore and skip this record
							//  do not insert it in the database

							
						
						}	
								
							// }
						}
					});

						
				}	
				catch(\Exception $e)
				{
					if($e instanceof \ErrorException)
					{
						Session::flash('status_type', 'error');
						Session::flash('status_title', 'Failed');
						Session::flash('status', 'Please check if the uploaded excel file is properly formatted.');

					}

					if($e instanceof \QueryException)
					{
						Session::flash('status_type', 'error');
						Session::flash('status_title', 'Failed');
						Session::flash('status', 'Please double check if the uploaded excel file has same number of colums as requested');

					}

					if($e instanceof \PDOException)
					{
						Session::flash('status_type', 'error');
						Session::flash('status_title', 'Failed');
						Session::flash('status', 'Please double check if the uploaded excel file has same number of colums as requested.');

					}
					
				}
				
				 return back();




			}

		}
		
		

		
	}




/*
*	Get selective Vaccinator code starts here
*
*/


	public function getSelectiveVaccinators()
	{
		$ngos_list=array();

		$state=$_POST['state'];
		$ngo_id=$_POST['ngo_id'];
		$district=$_POST['district'];
		$mandal=$_POST['mandal'];
		$panchayat=$_POST['panchayat'];
		$bypms_cluster_id=$_POST['bypms_cluster_id'];
		$village=$_POST['village'];
		$habitation=$_POST['habitation'];

		// echo $state;
		// echo $district;
		// echo $mandal;
		// echo $mvk;
		// echo $panchayat;
		// echo $village;	
		// echo $habitation;
			// print_r(Session::all());

		$bypms_Vaccinators_list=array();

		
		
		if($state!='' && ($district=='' || $district=='Do Not Mention') && ($mandal=='' || $mandal=='Do Not Mention') && ($panchayat=='' || $panchayat=='Do Not Mention') && ($bypms_cluster_id=='' || $bypms_cluster_id=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention'))
		{
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('aadhar_number_of_the_data_collector','!=','')->groupby('aadhar_number_of_the_data_collector')->get();



			}else{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('aadhar_number_of_the_data_collector','!=','')->groupby('aadhar_number_of_the_data_collector')->get();	
			}

		}elseif ($state!='' && $district!='' && ($mandal=='' || $mandal=='Do Not Mention')  && ($panchayat=='' || $panchayat=='Do Not Mention')  && ($bypms_cluster_id=='' || $bypms_cluster_id=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) {
			
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->groupby('aadhar_number_of_the_data_collector')->get();

			}else{

			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->get();
			}

		}elseif ($state!='' && $district!='' && $mandal!=''   && ($panchayat=='' || $panchayat=='Do Not Mention')  && ($bypms_cluster_id=='' || $bypms_cluster_id=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 	{
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->groupby('aadhar_number_of_the_data_collector')->get();

			} else	{
			
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->groupby('aadhar_number_of_the_data_collector')->get();
				
			}
		} elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''    && ($bypms_cluster_id=='' || $bypms_cluster_id=='Do Not Mention') && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 	{
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->groupby('aadhar_number_of_the_data_collector')->get();

			}else{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->groupby('aadhar_number_of_the_data_collector')->get();
				
			}
		}elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!='' && $bypms_cluster_id=='' && ($village=='' || $village=='Do Not Mention') && ($habitation=='' || $habitation=='Do Not Mention')) 	{
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->where('bypms_cluster_id',$bypms_cluster_id)->groupby('aadhar_number_of_the_data_collector')->get();

			}else{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->groupby('aadhar_number_of_the_data_collector')->get();
				
			}
		}elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''  && $bypms_cluster_id==''&& $village!='' && ($habitation=='' || $habitation=='Do Not Mention')) 	{
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->where('bypms_cluster_id',$bypms_cluster_id)->where('name_of_the_village',$village)->groupby('aadhar_number_of_the_data_collector')->get();

			}else{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->where('name_of_the_village',$village)->groupby('aadhar_number_of_the_data_collector')->get();
				
			}
		}elseif ($state!='' && $district!='' && $mandal!=''  && $panchayat!=''  && $bypms_cluster_id==''&& $village!='' && $habitation!='') {
			if(isset(Session::all()['user_details']))
			{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('entered_by_id',Session::all()['user_details']->id)->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->where('bypms_cluster_id',$bypms_cluster_id)->where('name_of_the_village',$village)->where('name_of_the_habitation',$habitation)->groupby('aadhar_number_of_the_data_collector')->get();

			}else{
			$bypms_Vaccinators_list=DB::table('household_baseline_survey_data')->where('name_of_the_state',$state)->where('name_of_the_district',$district)->where('name_of_the_mandal',$mandal)->where('name_of_the_panchayat',$panchayat)->where('name_of_the_village',$village)->where('name_of_the_ habitation',$habitation)->groupby('aadhar_number_of_the_data_collector')->get();
				
			}
		}else{
			// echo "$state | $district | $mandal | $village";
			// echo "not found anything";
		}



			
		$bypms_Vaccinators=$bypms_Vaccinators_list;




	$return_records_string='';


      foreach($bypms_Vaccinators as $bypms_Vaccinator)
      {
         

        $return_records_string.="<tr>";
        $return_records_string.="<td>".$bypms_Vaccinator->name_of_the_data_collector."</td>";
        $return_records_string.="<td>".$bypms_Vaccinator->aadhar_number_of_the_data_collector."</td>";



      

                $return_records_string.="<th style='min-width:60px;'>
                

                <a  id='$bypms_Vaccinator->aadhar_card_number' class='table_option' target='_blank' href='".URL::to('bypms_Vaccinator')."/".$bypms_Vaccinator->aadhar_card_number."/edit'>
                <button type='button' class='btn btn-xs btn-icon btn-primary'>
                <li class='fa fa-pencil' style='color'></li>
                </button>
                </a>";


                // $return_records_string.=" <a  id='$bypms_Vaccinator->aadhar_card_number' class='table_option' href='".URL::to('bypms_Vaccinator/bypms_Vaccinator_profile_pdf')."/".$bypms_Vaccinator->aadhar_card_number."'>";


                // $return_records_string.="<button type='button' class='btn btn-xs btn-icon btn-danger'>
                // <li class='fa fa-file-pdf-o' style='color'></li>
                // </button>
                // </a>";


                $return_records_string.="<a id='$bypms_Vaccinator->aadhar_card_number' class='download_bypms_Vaccinator_profile table_option' href='".URL::to('bypms_Vaccinator/delete')."/".$bypms_Vaccinator->aadhar_card_number."'>
                <button type='button' class='btn btn-icon btn-xs btn-danger'>
                <li class='fa fa-close' style='color'></li>
                </button>
                </a>


                </th>


              </tr>";
           }
        

		return $return_records_string;

	


	}

/*
*	Get selective Vaccinator code ends at above code
*
*/


}

