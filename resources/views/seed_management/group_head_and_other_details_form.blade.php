<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seed Purchase</title>

  	


{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}

{!! 	Html::style('plugins/bootstrap-dateranger-picker/daterangepicker.css') !!}
{!! 	Html::style('css/bootstrap.min.css') !!}
{!! 	Html::style('css/bootstrap-extend.css') !!}
{!! 	Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}
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



@if($selected_farmer_group_id!='')





<form method="POST" action="{{URL::to('seed_management/store_group_head_and_other_details')}}">
        <div class="col-sm-3">
		
		{!! Form::token() !!}

	
		<input type="hidden" id="entered_by" name="entered_by" value="{{serialize($ngo_details)}}">
		<input type="hidden" id="group_id" name="group_id" value="{{$selected_farmer_group_id}}">


		<div>
		
		
				 <label class="control-label" for="group_creation_date">Group created on</label>

				 <input class="form-control form-group" required name="group_creation_date" id="group_creation_date" />


		</div>



	</div>

		<div class="form-group col-md-5" id="name_area">
		
		<select multiple 
			
			id="farmers_singleselect_list" style="width:100%; max-height:70px;" >
		             
		@foreach($farmers as $farmer)


			<option  value='{{$farmer->id}}'>{{$farmer->name}}/{{$farmer->fname}}</option>
			

				
		@endforeach

		</select>


		</div>





	  <div class="col-sm-3">
		
	<div id="season_area">
				 <label class="control-label" for="season">Only for Season</label>

				 <select class="form-control form-group" name="season" id="season">

				 <option value="rabi" data-id="rabi">Rabi</option>
				 <option value="kharif" data-id="rabi">Kharif</option>
				 <option value="summer" data-id="rabi">Summer</option>


				</select>
		</div>
		



	</div>


	  <div class="col-sm-3">
		


		<div id="season_area">
				 <label class="control-label" for="season">Only for Year</label>

				 <select class="form-control form-group " name="year" id="year">

				<?php $current_year=(int)date('Y'); ?>
				 <option value="{{$current_year}}" data-id="{{$current_year}}">{{$current_year}}</option>
				 <option value="{{$current_year+1}}" data-id="{{$current_year+1}}">{{$current_year+1}}</option>


				</select>
		</div>
		


	</div>


		<div class="col-sm-3">
		
		
				 <label class="control-label" for="assigned_mr_number">MR number assigned</label>

				 <input class="form-control form-group" required name="assigned_mr_number" id="assigned_mr_number"/>


		</div>

		<div class="col-sm-3">
		
		
			

				 <input type="submit" class="btn btn-primary" id="save_form" value="save" />


		</div>

</form>


	

@else

Coudn't found The Farmer in Database.

@endif
</div>	
<!-- Scripts -->
 {!! Html::script('plugins/jquery/jquery.js') !!}
  {!! Html::script('plugins/formvalidation/formValidation.js') !!}
  {!! Html::script('plugins/formvalidation/framework/bootstrap.js') !!}


  {!! Html::script('plugins/bootstrap-dateranger-picker/moment.min.js') !!}
 {!! Html::script('plugins/bootstrap-dateranger-picker/daterangepicker.js') !!}
 {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
<script>
   $(function(){

   var base_url = window.location.origin;

    var sub_domain='/cmss';

    var route_address=base_url+sub_domain+'/';

	$(".selectpicker").selectpicker(); 
		$(".selectpicker").selectpicker("refresh"); 

      'use strict';

      // Example Wizard Form
      // -------------------
   
	
		$('input[name="group_creation_date"]').daterangepicker({
			 singleDatePicker: true,
        showDropdowns: true,
        locale: {
      		format: 'DD/MM/YYYY'
    	},
		});


		$("#save_form").click(function(e){
			e.preventDefault();

			var selected_season=$('#season option:selected').val();
				var selected_year=$('#year option:selected').val();
				var group_creation_date=$('#group_creation_date').val();
			
				var group_head=$('#farmers_singleselect_list option:selected').val();
				var assigned_mr_number=$('#assigned_mr_number').val();
				var group_id=$('#group_id').val();
				var entered_by=$('#entered_by').val();
		
			var url=route_address+"seed_management/store_group_head_and_other_details";
			
				$.ajax({
					type:'POST',
					url:url,
					data:{
					'_token':'{{ Session::token() }}',
					'only_for_season':selected_season,
					'only_for_year':selected_year,
					'group_head':group_head,
					'entered_by':entered_by,
					'group_creation_date':group_creation_date,
					'assigned_mr_number':assigned_mr_number,
					'farmer_group_id':group_id
					

					},
					cache:false,
					success:function(data)
					{
						alert(data);
					}
				});







			
			
		});
       


      });




  </script>




</body>
</html>