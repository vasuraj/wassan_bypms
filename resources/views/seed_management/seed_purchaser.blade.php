@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}
{!! 	Html::style('plugins/croppic/croppic.css')	!!}
{!! 	Html::style('plugins/croppic/main.css')	!!}

<script>
  $(function(){
 

$("#cmss").parent().parent().addClass('open ');
$("#seed_management").parent().parent().addClass('open');
$("#seed_management_get_report").parent().parent().addClass('open');

$("#get_report_{{$report_name}}").parent().parent().addClass('active bold active_3d');

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
	              <h3 class="panel-title">Seed Purchaser Details</h3>
	            </div>

	            <div class="well well-sm well-primary">
					Select Location
	            </div>

	            
	               <div class="wizard-pane active"  style="padding:20px;" id="location-details" role="tabpanel">
	                 
	                <form 	id="location-form">

		   				@include('code_snip.location_dropdown')
		                <button class="btn btn-primary" id="get_farmer_list_form_by_location">Get All Farmers list</button>
	                 
	                  


	                </form>
	                <div id="farmer_search_form">
	                	

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

 
  	{!! Html::script("js/location_dropdown.js") !!}


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
		 
		var url=route_address+"ngo";
	
		$.ajax({
	        type: "POST",
	        url: url,
	        data: {
            '_token':'{{ Session::token() }}',
	        'state':$( "#state option:selected" ).val(),
	        'district':$("#district option:selected").val(),
	        'mandal':$("#mandal option:selected").val(),
	        'panchayat':$("#panchayat option:selected").val(),
	        'village':$("#village option:selected").val(),
	        'habitation':$("#habitation option:selected").val(),
	        'name':$("#name").val(),
	         'registration_number':$("#registration_number").val(),
	        'full_address':$("#full_address").val(),
	         'about':CKEDITOR.instances.about.getData(),
	        
	        'logo_image':logo_image,
	        'HON_image':HON_image,
	        'field_incharge_image':field_incharge_image,
	        
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
