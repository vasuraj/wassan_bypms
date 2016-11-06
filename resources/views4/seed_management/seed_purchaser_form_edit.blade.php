<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seed Purchase</title>
 {!! Html::script('plugins/jquery/jquery.js') !!}
  	


{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}
{!! 	Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}
{!! 	Html::style('plugins/bootstrap-dateranger-picker/daterangepicker.css') !!}
	 {!! Html::style('css/bootstrap.min.css') !!}
  {!! Html::style('css/bootstrap-extend.css') !!}

</head>
<body>
<div class="page-content">

 
         @if(Entrust::hasRole('admin'))

           <?php
                 $user_details=session('user_details');
                     
 				 // print_r($user_details);

                 $ngo_details=array();
 				 $ngo_details['id']="";
 				  $ngo_details['ngo_name']="";
 				 $ngo_details['data_entered_by']='admin';
 				
 				 
 							


            ?>
         

         @elseif(Session::has('user_details'))
 
          

           <?php
                 $user_details=session('user_details');
                     
 				 // print_r($user_details);

                 $ngo_details=array();
 				 $ngo_details['id']=$user_details->id;
 				  $ngo_details['ngo_name']=$user_details->name;
 				 $ngo_details['data_entered_by']='';
 				 if(Entrust::hasRole('ngo_head'))
 				 {
 				 	 $ngo_details['data_entered_by']=$user_details->email_HON;
 				 }
 				 else
 				 {
 				 	 $ngo_details['data_entered_by']=$user_details->email_incharge;
 				 }

 				 // print_r($ngo_details);


            ?>
			@endif



@if($selected_farmer_id!='')




    <div class="col-sm-12" style="height:auto;">
	          <!-- Panel Wizard Form -->
	          <div class="panel" id="wizard-form">
	            <div class="panel-heading">
	              <h3 class="panel-title">Seed Purchase Details</h3>
	    </div>


	  
	<div class="panel">

            <div class="panel-body">
         	
         	<div class="row">
         		<div class="col-sm-3">
         		<img class="medium_pic" src="{{$farmer->farmer_image}}" alt="">
         		</div>
				<div class="col-sm-4">
				<table>
					<tr>
						<td>Father's Name</td>
						<td>{{$farmer->fname}}</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>{{$farmer->gender}}</td>
					</tr>
					<tr>
						<td>Caste</td>
						<td>{{$farmer->caste}}</td>
					</tr>
				</table>

				</div>
				<div class="col-sm-4">
					
				<table>
					<tr>
						<td>Contact Number</td>
						<td>{{$farmer->contact_number}}</td>
					</tr>
					<tr>
						<td>Adress</td>
						<td>{{$farmer->full_address}}</td>
					</tr>
					<tr>
						<td>Adhar Card Number</td>
						<td>{{$farmer->adhar_card_number}}</td>
					</tr>
				</table>



				</div>

         	</div>


	<form method="POST" action="{{URL::to('seed_management/store_seed_purchaser')}}/{{$transaction_id}}">
        <div class="col-sm-3">
		
		<input type="hidden" name="return_to" value="{{$return_to}}" >

		{!! Form::token() !!}

		<input type="hidden" name="farmer_id" value="{{$farmer->id}}">
		<input type="hidden" name="entered_by" value="{{serialize($ngo_details)}}">


		<div>
		<?php

				 $date=DateTime::createFromFormat('Y-m-d', $transaction_detail->data_collection_date);
				$data_collection_date=$date->format('d/m/Y');

				 ?>
		
				 <label class="control-label" for="data_collection_date">Data collected on</label>

				 <input class="form-control form-group" required name="data_collection_date" value="" id="data_collection_date" />


		</div>

		<div id="season_area">
				 <label class="control-label" for="season">Season</label>

				 <select class="form-control form-group" name="season" id="season">

				 <option value="rabi" data-id="rabi"  @if($transaction_detail->season=="rabi") selected="selected" @endif >Rabi</option>
				 <option value="kharif" data-id="rabi" @if($transaction_detail->season=="kharif") selected="selected" @endif >Kharif</option>
				 <option value="summer" data-id="rabi" @if($transaction_detail->season=="summer") selected="selected" @endif >Summer</option>


				</select>
		</div>
		


	</div>

	  <div class="col-sm-3">
		


		<div id="season_area">
				 <label class="control-label" for="season">Year</label>

				 <select class="form-control form-group " name="year" id="year">

				<?php $current_year=(int)date('Y'); ?>
				 <option value="{{$current_year}}" data-id="{{$current_year}}" @if($transaction_detail->year==$current_year)selected="selected" @endif>{{$current_year}}</option>
				 <option value="{{$current_year+1}}" data-id="{{$current_year+1}}"  @if($transaction_detail->year==$current_year+1) selected="selected" @endif >{{$current_year+1}}</option>


				</select>
		</div>
		


	</div>

	<div class="col-sm-3">
		


		<div id="seed_crop_area">
				 <label class="control-label" for="crop">Seed Crop</label>

				 <select class="form-control form-group " name="crop" id="crop">

				 <option value="1" data-id="1" @if($transaction_detail->crop=="1") selected="selected" @endif >Groundnut</option>

				</select>
		</div>
		


	</div>
		<div class="col-sm-3">
		
		<div id="seed_variety_area">
				 <label class="control-label" for="state">Seed variety</label>

				 <select class="form-control form-group" name="seed_variety" id="seed_variety">

				 <option value="K-6" data-id="" @if($transaction_detail->seed_variety=="K-6") selected="selected" @endif  >K-6</option>
				 <option value="K-9" data-id="" @if($transaction_detail->seed_variety=="K-9") selected="selected" @endif   >K-9</option>
				 <option value="K-H" data-id="" @if($transaction_detail->seed_variety=="K-H") selected="selected" @endif   >K-H</option>
				 <option value="Dharani" data-id="" @if($transaction_detail->seed_variety=="Dharani") selected="selected" @endif   >Dharani</option>
				 <option value="Narayani" data-id="" @if($transaction_detail->seed_variety=="Narayani") selected="selected" @endif   >Narayani</option>

				 

				</select>
		</div>
		


	</div>



	<div class="col-sm-3">
		
		<div id="seed_class_area">
				 <label class="control-label" for="state">Seed Class</label>

				 <select class="form-control form-group" name="seed_class" id="seed_class">

				 <option value="breeder" data-id="" @if($transaction_detail->seed_class=="breeder") selected="selected" @endif  >Breeder</option>
				 <option value="foundation1" data-id="" @if($transaction_detail->seed_class=="foundation1") selected="selected" @endif >Foundation-1</option>
				 <option value="foundation2" data-id="" @if($transaction_detail->seed_class=="foundation2") selected="selected" @endif >Foundation-2</option>
				 <option value="certified1" data-id="" @if($transaction_detail->seed_class=="certified1") selected="selected" @endif >Certified-1</option>
				 <option value="certified2" data-id="" @if($transaction_detail->seed_class=="certified2") selected="selected" @endif >Certified-2</option>

				 

				</select>
		</div>
		


	</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="area_to_be_sown">Area to be sown(Acre)</label>

				 <input class="form-control form-group" required name="area_to_be_sown" value="{{$transaction_detail->area_to_be_sown}}" id="area_to_be_sown" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="bag">No. of Bags purchased</label>

				 <input class="form-control form-group" required name="bag" value="{{$transaction_detail->bag}}" id="bag" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="bag_price">Rate per bag (&#8377;)</label>

				 <input class="form-control form-group" required name="bag_price" value="{{$transaction_detail->bag_price}}"  id="bag_price" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="farmer_contribution">Farmer Contribution  (&#8377;)</label>

				 <input class="form-control form-group" required name="farmer_contribution" value="{{$transaction_detail->farmer_contribution}}"  id="farmer_contribution" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="govt_subsidy">Govt. Subsidy  (&#8377;)</label>

				 <input class="form-control form-group" required  name="govt_subsidy" value="{{$transaction_detail->govt_subsidy}}"  id="govt_subsidy" />


		</div>
		<div class="col-sm-3">
		
		

		</div>
		<div class="col-sm-3">
		
		
			

				 <input type="submit" class="btn btn-primary" id="save_form" value="save" />


		</div>

</form>





            </div>
          </div>


		       
	               
	          
	              <!-- End Wizard Content -->

	            </div>
	          </div>
	          <!-- End Panel Wizard One Form -->
	        </div>






	

@else

Coudn't found The Farmer in Database.

@endif
</div>	
<!-- Scripts -->

  {!! Html::script('plugins/formvalidation/formValidation.js') !!}
  {!! Html::script('plugins/formvalidation/framework/bootstrap.js') !!}

 {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
  {!! Html::script('plugins/bootstrap-dateranger-picker/moment.min.js') !!}
 {!! Html::script('plugins/bootstrap-dateranger-picker/daterangepicker.js') !!}

<script>
    (function(document, window, $) {

    var base_url = window.location.origin;

    var sub_domain='/cmss';

    var route_address=base_url+sub_domain+'/';



      'use strict';

      // Example Wizard Form
      // -------------------
      (function() {

		$('input[name="data_collection_date"]').daterangepicker({
			 singleDatePicker: true,
        showDropdowns: true,
        startDate: '{{$data_collection_date}}',
        locale: {
      		format: 'DD/MM/YYYY'
    	},
		});


		$("#save_form").click(function(e){
				var selected_data_collection_date=$('#data_collection_date').val();
				var selected_season=$('#season option:selected').val();
				var selected_year=$('#year option:selected').val();
				var selected_crop=$('#crop option:selected').val();
				var selected_seed_variety=$('#seed_variety option:selected').val();
				var selected_seed_class=$('#seed_class option:selected').val();
				var area_to_be_sown=$('#area_to_be_sown').val();
				var bags=$('#bag').val();
				var farmer_contribution=$('#farmer_contribution').val();
				var govt_subsidy=$('#govt_subsidy').val();

			var url=route_address+"seed_management/store_seed_purchaser/{{$transaction_id}}";
			
	





			
			
		});
       


      })();




    })(document, window, jQuery);
  </script>

 <script>

var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;	
}
</script>


</body>
</html>