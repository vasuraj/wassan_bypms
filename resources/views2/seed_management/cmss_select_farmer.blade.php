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

.wizard-pane
{
min-height: 200px;
}


</style>

@endsection

@section('content')
<?php

$user_details=Session::all();

//print_r($user_details['user_details']);
if(isset($user_details['user_details']->id) && $user_details['user_details']->id!='')
{
	$user_di=$user_details['user_details']->id;
}


?>
	        <div class="col-md-12" style="height:auto;">
	          <!-- Panel Wizard Form -->
	          <div class="panel" id="wizard-form">
	            <div class="panel-heading">
	              <h3 class="panel-title">{{str_replace('_',' ',$form_name)}} Details</h3>
	            </div>

	          
				
	            
	               <div class="wizard-pane active"  style="padding:20px;" id="location-details" role="tabpanel">
	                 
	                <form 	id="location-form">
  					<div class="well well-sm well-primary">
					Select Location
	            </div>
		   				@include('code_snip.location_dropdown_mvk')
		                <button class="btn btn-primary form_submit_button" id="get_farmer_list_form_by_location">Get All Farmers list</button>
	                 
	                  


	                </form>

	                <div id="farmer_search_form">
	                	

	                </div>
			        <div id="iframe_area">
					<iframe src="#" frameborder="0" id="result_iframe" name="result_iframe" style="width:100%; min-height:300px; display:none;"></iframe>
					</div>
	                </div>


	  		

		
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

  {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
  	{!! Html::script("js/location_dropdown_mvk.js") !!}


<script>
    (function(document, window, $) {

  


    var base_url = window.location.origin;

    var sub_domain='/cmss';

    var route_address=base_url+sub_domain+'/';


      'use strict';

      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
      });

      // Example Wizard Form
      // -------------------
      (function() {





		$('#get_farmer_list_form_by_location').click(function(e){
			e.preventDefault();

			$("#farmer_search_form").html('form will be here');
			$('#location-form').hide();
			$('#get_farmer_list_form_by_location').hide();

		var url=route_address+"seed_management/farmers_list";
	
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
	        'form_name':'{{$form_name}}'
	            
	    	},
	        cache: false,
	        success: function(data){
	           $("#farmer_search_form").html(data);
	        }
	    });


		});


         $("#basic-details-form").formValidation({
          framework: 'bootstrap',
          fields: {
            name: {
              validators: {
                notEmpty: {
                  message: "Ngo's Name is reqired"
                }
                // creditCard: {
                //   message: 'The credit card number is not valid'
                // }
              }
            },
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
                emailAddress: {
                  message: "email is not valid"
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
                emailAddress: {
                  message: "email is not valid"
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

		     //  ajax code ends here

        }
        });

        var wizard = $("#wizard-form").wizard(options).data(
          'wizard');

      //   wizard.get("#basic-details").setValidator(function() {
      //     var fv = $("#basic-details-form").data('formValidation');
      //     fv.validate();

      //     if (!fv.isValid()) {
      //       return false;
      //     }

      //     return true;
      //   });
      })();


    })(document, window, jQuery);
  </script>

@endsection
