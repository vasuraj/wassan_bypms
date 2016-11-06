@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}
{!! 	Html::style('plugins/croppic/croppic.css')	!!}
{!! 	Html::style('plugins/croppic/main.css')	!!}

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
	              <h3 class="panel-title">Farmer Details</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	                <div class="step col-md-4 current" data-target="#location-details" role="tab">
	                  <span class="step-number">1</span>
	                  <div class="step-desc">
	                    <span class="step-title">Location Details</span>
	                    <!-- <p>Farmer's location</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-4" data-target="#basic-details" role="tab">
	                  <span class="step-number">2</span>
	                  <div class="step-desc">
	                    <span class="step-title">Basic Details</span>
	                    <!-- <p>Farmer's basic details</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-4" data-target="#advance-details" role="tab">
	                  <span class="step-number">3</span>
	                  <div class="step-desc">
	                    <span class="step-title">Advance Details</span>
	                    <!-- <p>Farmer's advance details</p> -->
	                  </div>
	                </div>
	              </div>
	              <!-- End Steps -->

	              <!-- Wizard Content -->
	              <div class="wizard-content">
	                <div class="wizard-pane active" id="location-details" role="tabpanel">
	                  <form 	 id="location-form">

	   					@include('code_snip.location_dropdown_mvk')
	                 
	                  </form>
	                </div>



	                <div class="wizard-pane" id="basic-details" role="tabpanel">
	                  <form id="basic-details-form"  action="">
					
					  <div class="row">
    				    <div class="col-md-4" id="farmer_image" style="margin-left:10px; height:120px;"></div>
	                   
	                   <div class="col-md-9">
						<div class="row">	
		                    <div class="form-group col-md-9">
		                      <label class="control-label" for="name">Name</label>
		                      <input type="text" class="form-control " id="name" name="name" placeholder="name">
		                    </div>

		                     <div class="form-group col-md-3">
		                      <label class="control-label" for="name">Aadhar Card No</label>
		                      <input type="text" class="form-control " id="adhar_card_number" name="adhar_card_number" placeholder="Aadhar Card Number">
		                    </div>

						</div>
						<div class="form-group">
	                      <label class="control-label" for="fname">Father's Name</label>
	                      <input type="text" class="form-control" id="fname" name="fname" placeholder="father's/ Husband's Name">
	                    </div>
	                    
	                  	</div>
	                  </div>

	                    <div class="form-group ">
	                      <label class="control-label" for="name">Full Address</label>
	                      <input type="text" class="form-control " id="full_address" name="full_address" placeholder="Address of Farmer">
	                    </div>

	               		<div class="gender_area col-md-6">
	             	 	<label class="control-label" for="gender">Gender</label><br>
		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" id="inputRadiosChecked" name="gender" value="male" checked="">
		                  <label for="inputRadiosChecked">Male</label>
		                </div>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" id="inputRadiosUnchecked" name="gender" value="female" >
		                  <label for="inputRadiosUnchecked">Female</label>
		                </div>
	               
	              		</div>


	               <div class="caste_area col-md-6">
	              	<p>Caste</p>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio"  name="caste" value="BC" checked="">
		                  <label >BC</label>
		                </div>
		           
		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="SC" >
		                  <label >SC</label>
		                </div>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="ST">
		                  <label >ST</label>
		                </div>

		                 <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="OC" >
		                  <label >OC</label>
		                </div>
	          
	               
	              </div>


						<div class="form-group">
	                 		<lable class="control-label" for="contact_number">Contact Number</lable>
	                 		<input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number/ Mobile Number">
	                  	</div>

	    
			</form>
	        </div>
	                
	         <div class="wizard-pane" id="advance-details" role="tabpanel">
				<form id="advance-details-form"  action="">
	              

	                    <div class="form-group col-md-6">
	                      <label class="control-label" for="patta_pass_book_number">Patta Pass Book Number</label>
	                      <input type="text" class="form-control" id="patta_pass_book_number" name="patta_pass_book_number" placeholder="Patta Pass Book Number">
	                    </div>

	                    <div class="form-group  col-md-6">
	                      <label class="control-label" for="survey_number">Survey Number</label>
	                      <input type="text" class="form-control" id="survey_number" name="survey_number" placeholder="Survey Number">
	                    </div>

	                    
<hr>

	                    <div class="form-group  col-md-6">
	                      <label class="control-label" for="irrigated_land">Irrigated Land</label>
	                      <input type="text" class="form-control" id="irrigated_land" name="irrigated_land" placeholder="land in acre">
	                    </div>

	                    <div class="form-group  col-md-6">
	                      <label class="control-label" for="non_irrigated_land">Non irrigated Land</label>
	                      <input type="text" class="form-control" id="non_irrigated_land" name="non_irrigated_land" placeholder="land in acre">
	                    </div>

	                    <div class="form-group  col-md-6">
	                      <label class="control-label" for="fallow_land">Fallow Land</label>
	                      <input type="text" class="form-control" id="fallow_land" name="fallow_land" placeholder="land in acre">
	                    </div>

	                    <div class="form-group  col-md-6">
	                      <label class="control-label" for="fallow_land">Source of irrigation</label>
	                      <select class="form-control" name="irrigation_source" id="irrigation_source">
	                      	<option value="Borewell">Borewell</option>
	                      	<option value="Well">Well</option>
	                      	<option value="Canal">Canal</option>
	                      	<option value="Tanks">Tanks</option>
	                      	<option value="Lift Irrigation">Lift Irrigation</option>

	                      </select>
	                    </div>
<hr>
	                     <div class="form-group  col-md-6">
	                      <label class="control-label" for="bank_name">Name of Bank </label>
	                      <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Name of Bank">
	                    </div>
	                     
	                     <div class="form-group  col-md-6">
	                      <label class="control-label" for="bank_location">Location of bank</label>
	                      <input type="text" class="form-control" id="bank_location" name="bank_location" placeholder="Location of Bank">
	                    </div>

	                     <div class="form-group  col-md-6">
	                      <label class="control-label" for="bank_ifsc_code">IFSC CODE</label>
	                      <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" placeholder="IFSC Code">
	                    </div>

	     				<div class="form-group  col-md-6">
	                      <label class="control-label" for="bank_passbook_name">Name in Bank Passbook</label>
	                      <input type="text" class="form-control" id="bank_passbook_name" name="bank_passbook_name" placeholder="Name in Bank Passbook">
	                    </div>



	                     <div class="form-group  col-md-6">
	                      <label class="control-label" for="bank_account_number">Account Number</label>
	                      <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" placeholder="Account Number">
	                    </div>


	                  <div class="text-center margin-vertical-20 thanks" style="display:none;">
	                    <i class="icon wb-check font-size-40" aria-hidden="true"></i>
	                    <h4>Thank you !<br>
	                  
	                    </h4>
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

	{!! Html::script('plugins/croppic/croppic.min.js')	!!}
 
  {!! Html::script("js/location_dropdown_mvk.js") !!}


<script>
    (function(document, window, $) {
var farmer_image='';
var farmer_image_upload_option = {
				uploadUrl:"{{URL::to('image/img_save_to_file')}}",
				cropUrl:"{{URL::to('image/img_crop_to_file')}}",
				modal:true,
				imgEyecandyOpacity:0.4,
				//loaderHtml:'<img class="loader" src="loader.png" >',
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ farmer_image=$('div#farmer_image img.croppedImg').attr('src') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}


		var cropContainerModal1 = new Croppic('farmer_image', farmer_image_upload_option);




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
               adhar_card_number: {
              validators: {
                notEmpty: {
                  message: "Adhar card number is required"
                }
            
            }
           
            },
            full_address: {
              validators: {
                notEmpty: {
                  message: "Address is required"
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

  $("#advance-details-form").formValidation({
          framework: 'bootstrap',
          fields: {

          	 patta_pass_book_number:  {
            	validators: {
             	notEmpty: {
                  message: "Can't be empty"
                },
            
            	}
             },
              survey_number:  {
            	validators: {
             	notEmpty: {
                  message: "Can't be empty"
                },
            
            	}
             },
           
           
             irrigated_land:  {
            	validators: {
             	notEmpty: {
                  message: "Can't be empty"
                },
            		regexp: {
            			regexp: /^\d+\.?\d*$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             },
             non_irrigated_land:  {
            	validators: {
            	notEmpty: {
                  message: "Can't be empty"
                },
            		regexp: {
            			regexp: /^\d+\.?\d*$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             },
            fallow_land:  {
            	validators: {
            	notEmpty: {
                  message: "Can't be empty"
                },
            		regexp: {
            			regexp: /^\d+\.?\d*$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             },
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
          	});
			var url=route_address+"farmer";
          	// alert(url);

          	// ajax code starts here
		 
			
		console.log('post data sent to:'+url);

		$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        '_token':'{{Session::token()}}',
	        'state':$( "#state option:selected").val(),
	        'district':$("#district option:selected").val(),
	        'mandal':$("#mandal option:selected").val(),
	        'panchayat':$("#panchayat option:selected").val(),
	        'mvk':$("#mvk option:selected").val(),
	        'village':$("#village option:selected").val(),
	        'habitation':$("#habitation option:selected").val(),
	        'name':$("#name").val(),
	        'fname':$("#fname").val(),
	        'full_address':$("#full_address").val(),
	        'farmer_image':farmer_image,
	        'gender':$('input[name=gender]:checked', '#basic-details-form').val(),
	        'caste':$('input[name=caste]:checked', '#basic-details-form').val(),
	        'contact_number':$("#contact_number").val(),
	        'adhar_card_number':$("#adhar_card_number").val(),
	        'patta_pass_book_number':$("#patta_pass_book_number").val(),
	        'survey_number':$("#survey_number").val(),
	        'irrigated_land':$("#irrigated_land").val(),
	        'non_irrigated_land':$("#non_irrigated_land").val(),
	        'fallow_land':$("#fallow_land").val(),
	        'irrigation_source':$('#irrigation_source').val(),
	        'bank_name':$('#bank_name').val(),
	        'bank_location':$('#bank_location').val(),
	        'bank_ifsc_code':$('#bank_ifsc_code').val(),
	        'bank_account_number':$('#bank_account_number').val(),
	        'bank_passbook_name':$('#bank_passbook_name').val()

	        
	    	},
	        cache: false,
	        success: function(data){
	           console.log(data);
	        }
	    });

		     //  ajax code ends here

        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');
		
        // setup validator
        // http://formvalidation.io/api/#is-valid


        wizard.get("#basic-details").setValidator(function() {
          var fv = $("#basic-details-form").data('formValidation');
 
     
         
          fv.validate();
           

          if (!fv.isValid() ) {
            return false;
          }

          return true;
        });

          wizard.get("#advance-details").setValidator(function() {
          var fv = $("#advance-details-form").data('formValidation');
          fv.validate();

          if (!fv.isValid()) {
            return false;
          }

          return true;
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

@endsection