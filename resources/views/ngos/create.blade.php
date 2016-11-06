@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}

{!! 	Html::style('plugins/bootstrap-select/bootstrap-select.css') !!}
<!-- {!! 	Html::style('plugins/croppic/croppic.css')	!!} -->
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

<script>
  $(function(){
 

$("#cmss").parent().parent().addClass('open ');
$("#ngos").parent().parent().addClass('open');


$("#ngos_create").parent().parent().addClass('active bold active_3d');


});


</script>



@endsection

@section('content')

	        <div class="row" >
	          <!-- Panel Wizard Form -->
	          <div class="panel" id="wizard-form">
	            <div class="panel-heading">
	              <h3 class="panel-title">Ngo Details</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	                <div class="step col-md-4 current" data-target="#location-details" role="tab">
	                  <span class="step-number">1</span>
	                  <div class="step-desc">
	                    <span class="step-title">Location Details</span>
	                    <!-- <p>ngo's location</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-4" data-target="#basic-details" role="tab">
	                  <span class="step-number">2</span>
	                  <div class="step-desc">
	                    <span class="step-title">Basic Details</span>
	                    <!-- <p>ngo's basic details</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-4" data-target="#advance-details" role="tab">
	                  <span class="step-number">3</span>
	                  <div class="step-desc">
	                    <span class="step-title">Advance Details</span>
	                    <!-- <p>ngo's advance details</p> -->
	                  </div>
	                </div>
	              </div>
	              <!-- End Steps -->

	              <!-- Wizard Content -->
	              <div class="wizard-content">
	                <div class="wizard-pane active" id="location-details" role="tabpanel">
	                  <form 	 id="location-form">

	   				@include('code_snip.location_dropdown')
	                 
	                  </form>
	                </div>



	                <div class="wizard-pane" id="basic-details" role="tabpanel">
	                  <form id="basic-details-form"  action="">
	                  <div class="col-md-12">
    					<!-- <div class="col-md-4" id="ngo_logo" style="margin-left:15px; height:120px;"></div> -->
	                   
	                  
		                    <div class="form-group col-md-9">
		                      <!-- <label class="control-label" for="name">Name of the NGO</label> -->
		                      <input type="text" class="form-control " id="name" name="name" required placeholder="NGO Name">
		                    </div>

		                     <div class="form-group col-md-3">
		                      <!-- <label class="control-label" for="name">Registration No</label> -->
		                      <input type="text" class="form-control " id="registration_number" required  name="registration_number" placeholder="NGO Registartion Number">
		                    </div>


	                    <div class="form-group col-md-12">
	                      <!-- <label class="control-label" for="name">Full Address of the NGO</label> -->
	                      <input type="text" class="form-control " id="full_address" name="full_address" required  placeholder="NGO address">
	                    </div>



	                  </div>
	                  
	                  <label class="control-label" for="about">About NGO's work</label>

	                  <textarea name="about" id="about" rows="10" cols="80">
                			
            		</textarea>
	            

	      					

			</form>
	        </div>
	                
	         <div class="wizard-pane" id="advance-details" role="tabpanel">
				<form id="advance-details-form"  action="">
	                 
	                  <div class="row">
	                   
		                   <!-- <div class="col-md-4" id="HON_image"  style="margin-left:10px;"></div> -->
		                   

		                    <div class="form-group col-md-12">
			                    <!-- <label class="control-label" for="HON">Head of the Ngo</label> -->
			                    <input type="text" class="form-control" id="HON" name="HON" placeholder="Name of the Head of the ngo">
			                    
	 							<div class="gender_area_HON">
			              
				                <div class="radio-custom radio-primary" style="display:inline-block;">
				                  <input type="radio" id="inputRadiosChecked" name="gender_HON" value="male" checked="">
				                  <label for="">Male</label>
				                </div>

				                <div class="radio-custom radio-primary" style="display:inline-block;">
				                  <input type="radio" id="inputRadiosUnchecked" name="gender_HON" value="female" >
				                  <label for="">Female</label>
				                </div>
			               
			              		</div>

								<div class="row">
			                      	<div class="form-group col-md-6" >
				                      <!-- <label class="control-label" for="contact_number">Contact Number</label> -->
				                      <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="contact number for Head of the Ngo">
				                    </div>
				                     
				                     <div class="form-group col-md-6">
				                      <!-- <label class="control-label" for="email">email</label> -->
				                      <input type="text" class="form-control" id="email" name="email" placeholder="Email address for Head of the Ngo">
				                    </div>
		      					</div>    	


		                    </div>

		                   

	                   </div>
				
					
	            		


	                    <div class="row">
	                   
		                   <!-- <div class="col-md-4" id="field_incharge_image" style="margin-left:10px;"></div> -->
		                   

		                    <div class="form-group col-md-12">
	                    
	                      	<!-- <label class="control-label" for="field_incharge">Field Incharge</label> -->
	                      	<input type="text" class="form-control" id="field_incharge" name="field_incharge" placeholder="Name of the field incharge">
	                    	

	                    	<div class="gender_area_field_incharge">
	              
			                <div class="radio-custom radio-primary" style="display:inline-block;">
			                  <input type="radio" id="inputRadiosChecked" name="gender_field_incharge" value="male" checked="">
			                  <label for="">Male</label>
			                </div>

			                <div class="radio-custom radio-primary" style="display:inline-block;">
			                  <input type="radio" id="inputRadiosUnchecked" name="gender_field_incharge" value="female" >
			                  <label for="">Female</label> 
			                </div>
		               
		              		</div>
				
	                      	<div class="row">
			                   <div class="form-group col-md-6" >
			                      <!-- <label class="control-label" for="contact_number_incharge">Incharge Contact Number</label> -->
			                      <input type="text" class="form-control" id="contact_number_incharge" name="" placeholder="contact number for incharge person">
		                    	</div>
	                     
			                     <div class="form-group col-md-6">
			                      <!-- <label class="control-label" for="email_inchrage">Incharge email</label> -->
			                      <input type="text" class="form-control" id="email_incharge" name="email_incharge" placeholder="Email address for Incharge">
			                    </div>
		                    </div>
      						</div>

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
	            <!-- panel body ends here -->
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

	<!-- {!! Html::script('plugins/croppic/croppic.min.js')	!!} -->
	{!! Html::script('plugins/ckeditor/ckeditor.js')	!!}

   {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
  {!! Html::script("js/location_dropdown_v1.js") !!}


<script>
    (function(document, window, $) {

    	$(".selectpicker").selectpicker("refresh");  

	   	CKEDITOR.editorConfig = function( config ) {
	    config.language = 'fr';
	    config.uiColor = '#AADC6E';
	};
 	
 	CKEDITOR.replace( 'about' );

	// var HON_image='';
	// var field_incharge_image='';
	// var logo_image='';
	// var type='ngo_logo';

	// var ngo_logo_upload_option = {
	// 			uploadUrl:"{{URL::to('image/img_save_to_file')}}/"+type,
	// 			cropUrl:"{{URL::to('image/img_crop_to_file')}}/"+type,
	// 			modal:true,
				
			
	// 		doubleZoomControls:true,
	// 			//loaderHtml:'<img class="loader" src="loader.png" >',
	// 			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
	// 			onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
	// 			onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
	// 			onImgDrag: function(){ console.log('onImgDrag') },
	// 			onImgZoom: function(){ console.log('onImgZoom') },
	// 			onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
	// 			onAfterImgCrop:function(){logo_image=$('div#ngo_logo img.croppedImg').attr('src') },
	// 			onReset:function(){ console.log('onReset') },
	// 			onError:function(errormessage){ console.log('onError:'+errormessage) }
	// 	}

	// type='HON_image';

	// var HON_image_upload_option = {
	// 			uploadUrl:"{{URL::to('image/img_save_to_file')}}/"+type,
	// 			cropUrl:"{{URL::to('image/img_crop_to_file')}}/"+type,
	// 			modal:true,
	// 			imgEyecandyOpacity:0.4,
	// 			//loaderHtml:'<img class="loader" src="loader.png" >',
	// 			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
	// 			onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
	// 			onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
	// 			onImgDrag: function(){ console.log('onImgDrag') },
	// 			onImgZoom: function(){ console.log('onImgZoom') },
	// 			onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
	// 			onAfterImgCrop:function(){ HON_image=$('div#HON_image img.croppedImg').attr('src') },
	// 			onReset:function(){ console.log('onReset') },
	// 			onError:function(errormessage){ console.log('onError:'+errormessage) }
	// 	}

	// type='field_incharge_image';

	// var field_incharge_image_upload_option = {
	// 			uploadUrl:"{{URL::to('image/img_save_to_file')}}/"+type,
	// 			cropUrl:"{{URL::to('image/img_crop_to_file')}}/"+type,
	// 			modal:true,
	// 			imgEyecandyOpacity:0.4,
	// 			//loaderHtml:'<img class="loader" src="loader.png" >',
	// 			loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
	// 			onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
	// 			onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
	// 			onImgDrag: function(){ console.log('onImgDrag') },
	// 			onImgZoom: function(){ console.log('onImgZoom') },
	// 			onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
	// 			onAfterImgCrop:function(){ field_incharge_image=$('div#field_incharge_image img.croppedImg').attr('src') },
	// 			onReset:function(){ console.log('onReset') },
	// 			onError:function(errormessage){ console.log('onError:'+errormessage) }
	// 	}
	// 	var cropContainerModal1 = new Croppic('HON_image', HON_image_upload_option);
	// 	var cropContainerModal2 = new Croppic('field_incharge_image', field_incharge_image_upload_option);
	// 	var cropContainerModal3 = new Croppic('ngo_logo', ngo_logo_upload_option);




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
                  message: "Reqired"
                }
               
              }
            },
            registration_number:
            {
            validators: {
                notEmpty: {
                  message: "Required"
                }
            }
           
          },
            full_address:
            {
            validators: {
                notEmpty: {
                  message: "Required"
                }
            }
           
          }
        }
    });

          $("#advance-details-form").formValidation({
          framework: 'bootstrap',
          fields: {
            
         HON: {
              validators: {
                notEmpty: {
                  message: "Head of the Ngo's name is required"
                }
            
            }
           
            },
           contact_number: {
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
             },
             email: {
              validators: {
              	 notEmpty: {
                  message: "Required"
                },
                emailAddress: {
                  message: "email is not valid"
                },
                different: {
                    field: 'email_incharge',
                    message: "The email cannot be the same as Field incharge's email"
                }
            
            }
           
            },
             field_incharge: {
              validators: {
                notEmpty: {
                  message: "Field Incharge's name is required"
                }
            
            }
           
            },
              contact_number_incharge: {
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
             },
             email_incharge: {
              validators: {
              	 notEmpty: {
                  message: "Required"
                },
                emailAddress: {
                  message: "email is not valid"
                },
                different: {
                    field: 'email',
                    message: "The email cannot be the same as Head of the Ngo's email"
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

          if($("#email").val()===$("#email_incharge").val())
			{
				alert("Do not enter same email ID for both");
			}
		else
		{
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
		 
		var url=route_address+"ngo";
	
	$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        '_token':'{{ Session::token() }}',
	        'state':$( "#state option:selected" ).val(),
	        'district':$("#district option:selected").val(),
	        'mandal':$("#mandal option:selected").val(),
	        'mvk':$("#mvk option:selected").val(),
	        'panchayat':$("#panchayat option:selected").val(),
	        'village':$("#village option:selected").val(),
	        'habitation':$("#habitation option:selected").val(),
	        'name':$("#name").val(),
	        'registration_number':$("#registration_number").val(),
	        'full_address':$("#full_address").val(),
	        'about':CKEDITOR.instances.about.getData(),
	        'mvk_linked_with':$( "#mvk_multiselect_list" ).val(),
	        // 'logo_image':logo_image,
	        // 'HON_image':HON_image,
	        // 'field_incharge_image':field_incharge_image,
	        
	        'HON':$("#HON").val(),
	        'gender_HON':$('input[name=gender_HON]:checked', '#advance-details-form').val(),
	        'contact_number_HON':$("#contact_number").val(),
	        'email_HON':$("#email").val(),

	        
	        'field_incharge':$("#field_incharge").val(),
	        'gender_field_incharge':$('input[name=gender_field_incharge]:checked', '#advance-details-form').val(),
	        'contact_number_incharge':$("#contact_number_incharge").val(),
	        'email_incharge':$("#email_incharge").val(),

	    	},
	        cache: false,
	        success: function(data){
	           console.log(data);
	        }
	    });
		     //  ajax code ends here
		}
        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');
	

        wizard.get("#basic-details").setValidator(function() {
          var fv = $("#basic-details-form").data('formValidation');
          fv.validate();
         if (!fv.isValid()) {
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

@endsection
