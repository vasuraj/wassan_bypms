@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}
{!! 	Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}

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
	              <h3 class="panel-title">Add BYPMS Cluster</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	                <div class="step col-md-12 current" data-target="#location-details" role="tab">
	                  <span class="step-number">1</span>
	                  <div class="step-desc">
	                    <span class="step-title">Location Details</span>
	                    <!-- <p>Farmer's location</p> -->
	                  </div>
	                </div>

	              </div>
	              <!-- End Steps -->

	              <!-- Wizard Content -->
	              <div class="wizard-content">
	                <div class="wizard-pane active" id="location-details" role="tabpanel">
	                  <form id="location-form">

	   				           @include('code_snip.location_dropdown_add_bypms_cluster')
	                 
	                 <div class="example">


                  <label class="control-label" for="village_area_multiselect_liste">Select villages under this cluster</label>
                 
                 <select multiple class="selectpicker"id="village_area_multiselect_list" data-plugin="selectpicker">  
                 </select>
                 </div>


	               <div class="form-group ">
                    <label class="control-label" for="bypms_cluster_name">Cluster Name</label>
                    <input type="text" class="form-control " id="bypms_cluster_name" name="bypms_cluster_name" placeholder="Cluster name">
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
  
  {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
 
  {!! Html::script("js/location_dropdown_add_bypms_cluster.js") !!}


<script>
    (function(document, window, $) {


  

$('.selectpicker').selectpicker('refresh');

      'use strict';

      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
      });

      // Example Wizard Form
      // -------------------
      (function() {

         $("#basic-details-form").formValidation({
          framework: 'bootstrap',
          fields: {
            name: {
              validators: {
                notEmpty: {
                  message: "Farmer's Name is reqired"
                }
                // creditCard: {
                //   message: 'The credit card number is not valid'
                // }
              }
            },
            fname: {
              validators: {
                notEmpty: {
                  message: "Father/Husband's Name is required"
                }
            
            }
           
            },
             contact_number:  {
            	validators: {
            	
            	stringLength: {
                  min:10,
                  max:10,
                  message:'Contact Number should be at least 10 character long'
                	},
            	
            		regexp: {
            			regexp: /^[0-9]+$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             }
          }
        });

  
        // init the wizard
        var defaults = $.components.getDefaults("wizard");
        var options = $.extend(true, {}, defaults, {
          buttonsAppendTo: '.panel-body',
          onFinish: function(){
          	$('.thanks').fadeIn();
           	$('a.reload_form').hide();
          	$('.wizard-buttons').html('<a  class="btn btn-success btn-outline pull-right reload_form" role="button" style="display: inline-block;">Enter New data</a> <a class="btn btn-success btn-outline pull-right" href="#exampleWizardForm" data-wizard="finish" role="button">Finish</a>')
          	$('a[data-wizard=finish]').hide();
          	$('a.reload_form').on('click',function(){
          		$(this).hide();
          		  location.reload();
          		// $('a[data-wizard=finish]').show();
          	})

          	// ajax code starts here
        		 
        		var url=route_address+"locations/add_bypms_cluster";
        		console.log('post data sent to:'+url);
        		var selected_village_id = $('.selectpicker').val();

        		// alert(selected_panchayat_id);
        		// alert($("#mandal option:selected").attr('data-id'));
        		// alert($("#mvk_name").val());

            var ajax_request_data={
                  '_token':'{{ csrf_token() }}',
                  'state_id':$("#state option:selected").attr('data-id'),
                  'state_name':$("#state option:selected").val(),
                  'district_id':$("#district option:selected").attr('data-id'),
                  'district_name':$("#district option:selected").val(),
                  'mandal_id':$("#mandal option:selected").attr('data-id'),
                  'mandal_name':$("#mandal option:selected").val(),
                  'panchayat_id':$("#panchayat option:selected").attr('data-id'),
                  'panchayat_name':$("#panchayat option:selected").val(),
                  'selected_village_ids':selected_village_id,
                  'name':$("#bypms_cluster_name").val()
                  
                };

        		$.ajax({
        	        type: "POST",
        	        url: url,
        	        data: ajax_request_data,
        	        cache: false,
        	        success: function(data){
        	           console.log(data);
        	        }
        	    });

            console.log(ajax_request_data);
		     //  ajax code ends here



        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');
		

 	

      })();




    })(document, window, jQuery);
  </script>

 <script>

// var x = document.getElementById("demo");

// function getLocation() {
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(showPosition);
//     } else { 
//         x.innerHTML = "Geolocation is not supported by this browser.";
//     }
// }

// function showPosition(position) {
//     x.innerHTML = "Latitude: " + position.coords.latitude + 
//     "<br>Longitude: " + position.coords.longitude;	
// }
</script>

@endsection