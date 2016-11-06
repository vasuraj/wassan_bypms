@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}

{!! 	Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}
<script>
  $(function(){
 

$("#cmss").parent().parent().addClass('open ');
$("#cmss_farmers").parent().parent().addClass('open');


$("#cmss_farmers_group_create").parent().parent().addClass('active bold active_3d');


});


</script>

<style>
	

select{
  width: 150px;
  height: 30px;
  padding: 5px;
  color:#000;
}
select option { color: #222; }

</style>

@endsection

@section('content')


	        <div class="col-md-12" style="height:auto;">
	          <!-- Panel Wizard Form -->
	          <div class="panel" id="wizard-form">
	            <div class="panel-heading">
	              <h3 class="panel-title">Farmer Group Details</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	                <div class="step col-md-6 current" data-target="#location-details" role="tab">
	                  <span class="step-number">1</span>
	                  <div class="step-desc">
	                    <span class="step-title">Filter by Location</span>
	                    <!-- <p>Farmer's location</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-6" data-target="#select-farmer-multiselect" role="tab">
	                  <span class="step-number">2</span>
	                  <div class="step-desc">
	                    <span class="step-title">Assign Farmer to Group</span>
	                    <!-- <p>Farmer's basic details</p> -->
	                  </div>
	                </div>

	          
	              </div>
	              <!-- End Steps -->
{{print_r(Auth::user()->email)}}
		@if(Entrust::hasRole('admin') || Entrust::hasRole('ngo_head'))

			

		@endif

	              <!-- Wizard Content -->
	              <div class="wizard-content">
	                <div class="wizard-pane active" id="location-details" role="tabpanel">
	                  <form 	 id="location-form">

	   					@include('code_snip.location_dropdown_mvk')
	                 
	                  </form>
	                </div>

	                <div class="wizard-pane" id="select-farmer-multiselect" role="tabpanel">
	                <div id="progress_bar_area_farmer_list"></div>
	                  <form id="farmers_area_multiselect-form"  action="">

			            <div class="example">
		                  <select multiple class="selectpicker"id="farmers_area_multiselect_list" data-plugin="selectpicker">
									              
		                  </select>
		                </div>


		                  <div class="form-group">
	                      <label class="control-label" for="fallow_land">Group Name</label>
	                      <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Group Name">
	                    </div>
				

      				</form>
		        </div>

     

	              </div>
	              <!-- End Wizard Content -->

	            </div>
	          </div>
	          <!-- End Panel Wizard One Form -->
	        </div>





@endsection

@section('body_bottom')
<!-- Core  -->




  {!! Html::script('plugins/formvalidation/formValidation.js') !!}
  {!! Html::script('plugins/formvalidation/framework/bootstrap.js') !!}

  {!! Html::script('js/components/jquery-wizard.js') !!}
  {!! Html::script('plugins/jquery-wizard/jquery-wizard.js') !!}
  {{-- Html::script('plugins/combobox/jquery.eComboBox.js') --}}

  {!! Html::script("js/location_dropdown_mvk.js") !!}
   {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}


<script>
    (function(document, window, $) {

      'use strict';

      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
      });

      // Example Wizard Form
      // -------------------
      (function() {


        // init the wizard
        var defaults = $.components.getDefaults("wizard");
        var options = $.extend(true, {}, defaults, {
          buttonsAppendTo: '.panel-body',
            onNext: function(from,to){ 


			// filter select by location
          	if(from.index==0 && to.index==1){

			 		var id=$('#location-filter-farmer').attr('id');
				   $("#progress_bar_area_farmer_list").html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');
  
					
						
						var selected_state_name=$( "#state option:selected" ).text().trim();
						var selected_district_name=$( "#district option:selected" ).text().trim();
						var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
						var selected_mvk_name=$( "#mvk option:selected" ).text().trim();
						var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();
						var selected_village_name=$( "#village option:selected" ).text().trim();
						var selected_habitation_name=$( "#habitation option:selected" ).text().trim();
						console.log('------>'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_mvk_name+'/'+selected_panchayat_name+'/'+selected_village_name+'/'+selected_habitation_name);
						
			        if($("#farmers_area_multiselect_list").length)
			        {
			          console.log('working');
			            var farmers_list=route_address+'farmer/getfarmersbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_mvk_name+'/'+selected_panchayat_name+'/'+selected_village_name+'/'+selected_habitation_name;
			           
			            $.get(farmers_list,function(data){
			           //	alert(data);
			            
			           
			        $("#farmers_area_multiselect_list").html(data);
			      
			        $('.selectpicker').selectpicker('refresh');
					// $('.selectpicker').selectpicker('val', ['1','2','4','6','56','57','58']);

 					$("#progress_bar_area_farmer_list").html('Loading complete');
  


	            });

        	}
			        
         }
			//ngo filter code ends here
          },
          onFinish: function(){
          	$('.thanks').fadeIn();
          	
          	$('a.reload_form').hide();
          	$('.wizard-buttons').html('<a  class="btn btn-success btn-outline pull-right reload_form" role="button" style="display: inline-block;">Enter New data</a> <a class="btn btn-success btn-outline pull-right" href="#exampleWizardForm" data-wizard="finish" role="button">Finish</a>')
          	$('a[data-wizard=finish]').hide();
          	$('a.reload_form').on('click',function(){
          		$(this).hide();
          		  location.reload();
          		// $('a[data-wizard=finish]').show();
          	});
			var url=route_address+"farmer";
          	// alert(url);

       
      // ajax code starts here

  		var selected_farmers_id = $('.selectpicker').val();
		 
		var url=route_address+"farmer/storeGroup";
		
	
		var group_name=$('#group_name').val();
		
		
		var selected_ngo=@if(Entrust::hasRole('ngo_field_incharge') || Entrust::hasRole('ngo_head')){{(session('user_details')->id)}}@endif


	
		$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        '_token':'{{ Session::token() }}',
	       	'state':$( "#state option:selected").val(),
	        'district':$("#district option:selected").val(),
	        'mandal':$("#mandal option:selected").val(),
	        'panchayat':$("#panchayat option:selected").val(),
	        'mvk':$("#mvk option:selected").val(),
	        'village':$("#village option:selected").val(),
	        'habitation':$("#habitation option:selected").val(),
	        'ngo_id':selected_ngo,
	        'farmer_id':selected_farmers_id,
	        'project_name':'CMSS',
	        'project_id':'1',
	        'name':group_name,

	      	

	    	},
	        cache: false,
	        success: function(data){
	           console.log(data);
	        }
	    });

		   //   ajax code ends here

        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');
		
        // setup validator
        // http://formvalidation.io/api/#is-valid


 	

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

@endsection