<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seed Purchase</title>

{!! Html::script('plugins/jquery/jquery.js') !!}
{!! Html::style('plugins/formvalidation/formValidation.css')	!!}
{!! Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}
{!! Html::style('plugins/bootstrap-dateranger-picker/daterangepicker.css') !!}
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/bootstrap-extend.css') !!}

  <style>




.inner-accordion>div
{
	background: #e3e3e3;
	padding:5px 10px;
}



.inner-accordion>div>a
{
	text-decoration: none;
	color:#222;
	font-weight: bold;
}
table tr td
{
	vertical-align: top;
padding:2px 5px;
}


  </style>

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
 				
 				 
 				
 				 // print_r($ngo_details);


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
	<div class="btn-danger" id="check_seed_purchase_error" style="display:none;">
	Same farmer already purchased seed in the same season. 
	</div>
            <div class="panel-body">
         	<!-- accordion starts here -->

         	<div class="col-lg-6">
            <!-- Example Default Accordion -->
           
       
                <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                  <div class="panel inner-accordion">
                    <div class="panel-heading" id="exampleHeadingDefaultOne" role="tab"  >
                      <a class="collapsed" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultOne">
                     Farmer's Basic Details
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
                            	<div class="row">

				@if($farmer->farmer_image!='')                            	
         		<div class="col-sm-3">
         		<img class="medium_pic" src="{{$farmer->farmer_image}}" alt="">
         		</div>
         		@endif
				<div class="col-sm-4">
				<table>
					<tr>
						<td>Name:</td>
						<td> {{$farmer->name}}</td>
					</tr>
					<tr>
						<td>Father's Name:</td>
						<td> {{$farmer->fname}}</td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td> {{$farmer->gender}}</td>
					</tr>
					<tr>
						<td>Caste:</td>
						<td> {{$farmer->caste}}</td>
					</tr>
				</table>

				</div>
				<div class="col-sm-4">
					
				<table>
					@if($farmer->contact_number!='0')
					<tr>
						<td>Contact Number: </td>
						<td> {{$farmer->contact_number}}</td>
					</tr>
					@endif
					<tr>
						<td>Address: </td>
						<td> {{$farmer->full_address}}</td>
					</tr>
					<tr>
						<td>Adhar Card Number:</td>
						<td> {{$farmer->adhar_card_number}}</td>
					</tr>
				</table>



				</div>

         	</div>

                      </div>
                    </div>
                  </div>
  
                </div>
        
     
            <!-- End Example Default Accordion -->
          </div>

         	<!-- accordion ends here -->
  

	<form method="POST" action="{{URL::to('seed_management/store_seed_purchaser')}}">
        <div class="col-sm-3">
		
		{!! Form::token() !!}

		<input type="hidden" name="farmer_id" value="{{$farmer->id}}">
		<input type="hidden" name="entered_by" value="{{serialize($ngo_details)}}">


		<div>
		
		
				 <label class="control-label" for="data_collection_date">Data collected on</label>

				 <input class="form-control form-group" required name="data_collection_date" id="data_collection_date" />


		</div>

		<div id="season_area">
				 <label class="control-label" for="season">Season</label>

				 <select class="form-control form-group" name="season" id="season">

				 <option value="rabi" data-id="rabi">Rabi</option>
				 <option value="kharif" data-id="kharif">Kharif</option>
				 <option value="summer" data-id="summer">Summer</option>


				</select>
		</div>
		


	</div>

	  <div class="col-sm-3">
		


		<div id="season_area">
				 <label class="control-label" for="season">Year</label>

				 <select class="form-control form-group " name="year" id="year">

				<?php $current_year=(int)date('Y'); ?>
				 <option value="{{$current_year}}" data-id="{{$current_year}}">{{$current_year}}</option>
				 <option value="{{$current_year+1}}" data-id="{{$current_year+1}}">{{$current_year+1}}</option>


				</select>
		</div>
		


	</div>

	<div class="col-sm-3">
		


		<div id="seed_crop_area">
				 <label class="control-label" for="crop">Seed Crop</label>

				 <select class="form-control form-group " name="crop" id="crop">

				 <option value="1" data-id="1">Groundnut</option>

				</select>
		</div>
		


	</div>
		<div class="col-sm-3">
		
		<div id="seed_variety_area">
				 <label class="control-label" for="state">Seed variety</label>

				 <select class="form-control form-group" name="seed_variety" id="seed_variety">

				 <option value="K-6" data-id="">K-6</option>
				 <option value="K-9" data-id="">K-9</option>
				 <option value="K-H" data-id="">K-H</option>
				 <option value="Dharani" data-id="">Dharani</option>
				 <option value="Narayani" data-id="">Narayani</option>

				 

				</select>
		</div>
		


	</div>



	<div class="col-sm-3">
		
		<div id="seed_class_area">
				 <label class="control-label" for="state">Seed Class</label>

				 <select class="form-control form-group" name="seed_class" id="seed_class">

				 <option value="breeder" data-id="">Breeder</option>
				 <option value="foundation1" data-id="">Foundation-1</option>
				 <option value="foundation2" data-id="">Foundation-2</option>
				 <option value="certified1" data-id="">Certified-1</option>
				 <option value="certified2" data-id="">Certified-2</option>

				 

				</select>
		</div>
		


	</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="area_to_be_sown">Area to be sown(Acre)</label>

				 <input class="form-control form-group" required name="area_to_be_sown" id="area_to_be_sown" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="bag">No. of Bags purchased</label>

				 <input class="form-control form-group" required name="bag" id="bag" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="bag_price">Rate per bag (&#8377;)</label>

				 <input class="form-control form-group" required name="bag_price" id="bag_price" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="farmer_contribution">Farmer Contribution  (&#8377;)</label>

				 <input class="form-control form-group" required name="farmer_contribution" id="farmer_contribution" />


		</div>

		<div class="col-sm-3">
		
		
				 <label class="control-label" for="govt_subsidy">Govt. Subsidy  (&#8377;)</label>

				 <input class="form-control form-group" required  name="govt_subsidy" id="govt_subsidy" />


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
   {!! Html::script('plugins/bootstrap/bootstrap.js') !!}


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
        locale: {
      		format: 'DD/MM/YYYY'
    	},
		});





// check seed purchase code starts from here



// ajax call to check if seed is already taken in same season for same farmer

			var url=route_address+"seed_management/check_seed_purchaser";

		 $('#bag').on('input',function(e){



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
				var farmer_id='{{$farmer->id}}';
				var is_seed_taken_alrady='false';
   
		
				$.ajax({
					type:'POST',
					url:url,
					data:{
					'_token':'{{ Session::token() }}',
					'season':selected_season,
					'year':selected_year,
					'crop':selected_crop,
					'farmer_id':farmer_id
					

					},
					cache:false,
					success:function(data)
					{
					
						is_seed_taken_alrady=data;
						if(is_seed_taken_alrady=='true')
						{
							$('#save_form').hide();
							$('#check_seed_purchase_error').show();
							
						}
						else
						{
							$('#save_form').show();
							$('#check_seed_purchase_error').hide();
						}

					}
				});


    });


	$('#year').on('change',function(e){

	

		 	
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
				var farmer_id='{{$farmer->id}}';
				var is_seed_taken_alrady='false';
   
					$.ajax({
					type:'POST',
					url:url,
					data:{
					'_token':'{{ Session::token() }}',
					'season':selected_season,
					'year':selected_year,
					'crop':selected_crop,
					'farmer_id':farmer_id
					

					},
					cache:false,
					success:function(data)
					{
						is_seed_taken_alrady=data;
						if(is_seed_taken_alrady=='true')
						{
							
							$('#save_form').hide();
							$('#check_seed_purchase_error').show();
							
						}
						else
						{
							$('#save_form').show();
							$('#check_seed_purchase_error').hide();
						}

					}
				});


    });


	$('#season').on('change',function(e){
   
		

		 	
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
				var farmer_id='{{$farmer->id}}';
				var is_seed_taken_alrady='false';
   
		
				$.ajax({
					type:'POST',
					url:url,
					data:{
					'_token':'{{ Session::token() }}',
					'season':selected_season,
					'year':selected_year,
					'crop':selected_crop,
					'farmer_id':farmer_id
					

					},
					cache:false,
					success:function(data)
					{
						is_seed_taken_alrady=data;
						if(is_seed_taken_alrady=='true')
						{
							
							$('#save_form').hide();
							$('#check_seed_purchase_error').show();
							
						}
						else
						{
							$('#save_form').show();
							$('#check_seed_purchase_error').hide();
						}

					}
				});


    });



		 // check seed purchase code ends here

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