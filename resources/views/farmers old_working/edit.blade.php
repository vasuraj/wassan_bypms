@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}

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

	   				@include('code_snip.location_dropdown')
	                 
	                  </form>
	                </div>



	                <div class="wizard-pane" id="basic-details" role="tabpanel">
	                  <form id="basic-details-form"  action="">

	                  
	                    <div class="form-group ">
	                      <label class="control-label" for="name">Name</label>
	                      <input type="text" class="form-control " value="{{strtolower($user->name)}}" id="name" name="name" placeholder="name">
	                    </div>
	                    <div class="form-group">
	                      <label class="control-label" for="fname">Father's Name</label>
	                      <input type="text" class="form-control" id="fname" value="{{strtolower($user->fname)}}" name="fname" placeholder="father's/ Husband's Name">
	                    </div>

	               		<div class="gender_area">
	              		
		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio"  name="gender" value="male" @if(strtolower($user->gender)=='male') checked="checked" @endif >
		                  <label >Male</label>
		                </div>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="gender" value="female" @if(strtolower($user->gender)=='female') checked="checked" @endif  >
		                  <label >Female</label>
		                </div>
	               
	              		</div>


	               <div class="caste_area">
	              	<p>Caste</p>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio"  name="caste" value="BC" @if(strtoupper($user->caste)=='BC') checked="checked" @endif>
		                  <label >BC</label>
		                </div>
		           
		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="SC" @if(strtoupper($user->caste)=='SC') checked="checked" @endif >
		                  <label >SC</label>
		                </div>

		                <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="ST" @if(strtoupper($user->caste)=='ST') checked="checked" @endif >
		                  <label >ST</label>
		                </div>

		                 <div class="radio-custom radio-primary" style="display:inline-block;">
		                  <input type="radio" name="caste" value="OC" @if(strtoupper($user->caste)=='OC') checked="checked" @endif >
		                  <label >OC</label>
		                </div>
	          
	               
	              </div>


						<div class="form-group">
	                 		<lable class="control-label" for="contact_number">Contact Number</lable>
	                 		<input type="text" class="form-control" id="contact_number" name="contact_number" value="{{$user->contact_number}}" placeholder="Contact Number/ Mobile Number">
	                  	</div>

	    
			</form>
	        </div>
	                
	         <div class="wizard-pane" id="advance-details" role="tabpanel">
				<form id="advance-details-form"  action="">
	                 <div class="form-group">
	                    <label class="control-label" for="adhar_card_no">Aadhar Card Number</label>
	                    <input type="text" class="form-control" id="adhar_card_no" value="{{$user->adhar_card_no}}" name="adhar_card_no" placeholder="Number">
	                </div>


	                      <div class="form-group">
	                      <label class="control-label" for="patta_pass_book_number">Patta Pass Book Number</label>
	                      <input type="text" class="form-control" id="patta_pass_book_number" value="{{$user->patta_pass_book_number}}" name="patta_pass_book_number" placeholder="Patta Pass Book Number">
	                    </div>



	                    <div class="form-group">
	                      <label class="control-label" for="irrigated_land">Irrigated Land</label>
	                      <input type="text" class="form-control" id="irrigated_land"  value="{{$user->irrigated_land}}" name="irrigated_land" placeholder="land in acre">
	                    </div>

	                    <div class="form-group">
	                      <label class="control-label" for="non_irrigated_land">Non irrigated Land</label>
	                      <input type="text" class="form-control" id="non_irrigated_land" value="{{$user->non_irrigated_land}}" name="non_irrigated_land" placeholder="land in acre">
	                    </div>

	                    <div class="form-group">
	                      <label class="control-label" for="fallow_land">Fallow Land</label>
	                      <input type="text" class="form-control" id="fallow_land" name="fallow_land"  value="{{$user->fallow_land}}" placeholder="land in acre">
	                    </div>

	                    <div class="form-group">
	                      <label class="control-label" for="fallow_land">Source of irrigation</label>
	                      <select class="form-control" name="irrigation_source" id="irrigation_source">
	                      	<option value="Borewell" @if($user->irrigation_source=='Borewell') selected @endif>Borewell</option>
	                      	<option value="Well" @if($user->irrigation_source=='Well') selected @endif>Well</option>
	                      	<option value="Canal" @if($user->irrigation_source=='Canal') selected @endif>Canal</option>
	                      	<option value="Tanks" @if($user->irrigation_source=='Tanks') selected @endif>Tanks</option>
	                      	<option value="Lift Irrigation" @if($user->irrigation_source=='Lift Irrigation') selected @endif>Lift Irrigation</option>

	                      </select>
	                    </div>
	                  <div class="text-center margin-vertical-20 message" style="display:none;">
	                    <i class="icon wb-check font-size-40" aria-hidden="true"></i>
	                    <h4 style="color:green;">Updated Successfully!<br>
	                  
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

 
  {!! Html::script("js/location_dropdown.js") !!}



<script>
    (function(document, window, $) {

    var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain+'/';


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


  $("#advance-details-form").formValidation({
          framework: 'bootstrap',
          fields: {
           
             irrigated_land:  {
            	validators: {
            
            		regexp: {
            			regexp: /^\d+\.?\d*$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             },
             non_irrigated_land:  {
            	validators: {
            
            		regexp: {
            			regexp: /^\d+\.?\d*$/,
            			message: 'Contact Number can only contains numerice digit [0-9] only'
            		}
            	}
             },
            fallow_land:  {
            	validators: {
            
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
         
          	
          	$('a.reload_form').hide();
          	$('.wizard-buttons').html('')
          	$('a[data-wizard=finish]').hide();
          	$('a.reload_form').on('click',function(){
          		$(this).hide();
          		  location.reload();
          		// $('a[data-wizard=finish]').show();
          	})

          	// ajax code starts here
		 
		var url=route_address+"farmer/update";
	

		$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        "_method":"PUT",
	        'id':'{{$user->id}}',

	        'state':$( "#state option:selected" ).val(),
	        'district':$("#district option:selected").val(),
	        'mandal':$("#mandal option:selected").val(),
	        'village':$("#village option:selected").val(),
	        'name':$("#name").val(),
	        'fname':$("#fname").val(),
	        'gender':$('input[name=gender]:checked', '#basic-details-form').val(),
	        'caste':$('input[name=caste]:checked', '#basic-details-form').val(),
	        'contact_number':$("#contact_number").val(),
	        'adhar_card_no':$("#adhar_card_no").val(),
	        'patta_pass_book_number':$("#patta_pass_book_number").val(),
	        'irrigated_land':$("#irrigated_land").val(),
	        'non_irrigated_land':$("#non_irrigated_land").val(),
	        'fallow_land':$("#fallow_land").val(),
	        'irrigation_source':$('#irrigation_source').val()
	    	},
	        cache: false,
	        success: function(data){
	        	 	
	           console.log("status: "+data);
	           $('.message').fadeIn();
	        }
	    });

		     //  ajax code ends here

        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');
		
        // setup validator
        // http://formvalidation.io/api/#is-valid


        // wizard.get("#exampleAccount").setValidator(function() {
        //   var fv = $("#exampleAccountForm").data('formValidation');
        //   fv.validate();

        //   if (!fv.isValid()) {
        //     return false;
        //   }

        //   return true;
        // });

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