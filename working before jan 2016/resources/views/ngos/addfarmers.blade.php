@extends('app')

@section('head')

{!! 	Html::style('plugins/jquery-wizard/jquery-wizard.css')	!!}
{!! 	Html::style('plugins/formvalidation/formValidation.css')	!!}

{!! 	Html::style('plugins/filament-tablesaw/tablesaw.css')	!!}

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
	              <h3 class="panel-title">Ngo Details</h3>
	            </div>
	            <div class="panel-body">
	              <!-- Steps -->
	              <div class="steps steps-sm row" data-plugin="matchHeight" data-by-row="true" role="tablist">
	                <div class="step col-md-3 current" data-target="#location-filter-ngo" role="tab">
	                  <span class="step-number">1</span>
	                  <div class="step-desc">
	                    <span class="step-title">Filter Ngo</span>
	                    <!-- <p>ngo's location</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-3" data-target="#select-ngo" role="tab">
	                  <span class="step-number">2</span>
	                  <div class="step-desc">
	                    <span class="step-title">Select a Ngo</span>
	                    <!-- <p>ngo's basic details</p> -->
	                  </div>
	                </div>

	                <div class="step col-md-3" data-target="#location-filter-farmer" role="tab">
	                  <span class="step-number">3</span>
	                  <div class="step-desc">
	                    <span class="step-title">Filter Farmers</span>
	                    <!-- <p>ngo's advance details</p> -->
	                  </div>
	                </div>


	                <div class="step col-md-3" data-target="#select-farmer-multiselect" role="tab">
	                  <span class="step-number">4</span>
	                  <div class="step-desc">
	                    <span class="step-title">Select Farmers</span>
	                    <!-- <p>ngo's advance details</p> -->
	                  </div>
	                </div>
	              </div>
	              <!-- End Steps -->

	              <!-- Wizard Content -->
	              <div class="wizard-content">
	                
					<div class="wizard-pane active" id="location-filter-ngo" role="tabpanel">
					 <form id="location-filter-ngo-form">
					 </form>
					</div>


			



	                <div class="wizard-pane" id="select-ngo" role="tabpanel">
	                  <form id="select-ngo"  action="">

	                  <div id="ngos_area" select-type="radio">
	              
		     
					<!-- table select ngo  -->
		              <table class="tablesaw table-striped table-bordered table-hover" data-tablesaw-mode="swipe"
		              data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
		              data-tablesaw-mode-switch>
		                <thead>
		                  <tr>
		                    <th data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="4">Select</th>
		                    <th data-tablesaw-sortable-col data-tablesaw-priority="3">Name</th>

		                    <th data-tablesaw-sortable-col data-tablesaw-priority="2">
		                      <abbr title="Head of the NGO">Head of the Ngo</abbr>
		                    </th>
		                   
		                  </tr>
		                </thead>
		                <tbody id="select_ngo_table">

		                  
		                </tbody>
		              </table>
		              <!-- tbale code end -->
      				</div>
      				</form>
		        </div>
		                

	              	<div class="wizard-pane" id="location-filter-farmer" role="tabpanel">
					 <form id="location-filter-farmer-form">
					 </form>
					</div>


	                <div class="wizard-pane" id="select-farmer-multiselect" role="tabpanel">
	                <div id="progress_bar_area_farmer_list"></div>
	                  <form id="farmers_area_multiselect-form"  action="">

			            <div class="example">
		                  <select multiple class="selectpicker"id="farmers_area_multiselect_list" data-plugin="selectpicker">
									              
		                  </select>
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
  {!! Html::script('plugins/filament-tablesaw/tablesaw.js') !!}

 
  {!! Html::script("js/select_location_dropdown_plugin_updated.js") !!}

 {!! Html::script('plugins/bootstrap-select/bootstrap-select.js') !!}
<script>
$(function(){
	
    });

</script>
 
<script>
    (function(document, window, $) {

	$("#location-filter-ngo-form").locationDropdown({
		callback:function(){
 		

		}
	});
	$("#location-filter-farmer-form").locationDropdown({
		callback:function(){
			
		}
	});




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
          onNext: function(from,to){ 
          	// filter ngo by location
          	if(from.index==0 && to.index==1){

			 		var id=$('#location-filter-ngo').attr('id');
				    
					
						
						var selected_state_name=$( "#state_"+id+"-form option:selected" ).text().trim();
						var selected_district_name=$( "#district_"+id+"-form option:selected" ).text().trim();
						var selected_mandal_name=$( "#mandal_"+id+"-form option:selected" ).text().trim();
						var selected_village_name=$( "#village_"+id+"-form option:selected" ).text().trim();
						console.log('------>'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name);
						if($("#ngos_area").length)
				        {
				          $("#select_ngo_table").html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');

				            var ngos_list=route_address+'ngo/getngosbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;

				            $.get(ngos_list,function(data){
				                $( "#select_ngo_table" ).html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');

				                $("#select_ngo_table").html(data);
				            });
				        }
				        
          	}
			//ngo filter code ends here


			// filter select by location
          	if(from.index==2 && to.index==3){

			 		var id=$('#location-filter-farmer').attr('id');
				   $("#progress_bar_area_farmer_list").html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');
  
					
						
						var selected_state_name=$( "#state_"+id+"-form option:selected" ).text().trim();
						var selected_district_name=$( "#district_"+id+"-form option:selected" ).text().trim();
						var selected_mandal_name=$( "#mandal_"+id+"-form option:selected" ).text().trim();
						var selected_village_name=$( "#village_"+id+"-form option:selected" ).text().trim();
						console.log('------>'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name);
						
			        if($("#farmers_area_multiselect_list").length)
			        {
			          
			            var farmers_list=route_address+'farmer/getfarmersbylocation/'+selected_state_name+'/'+selected_district_name+'/'+selected_mandal_name+'/'+selected_village_name;
			           
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
          		 $('a[data-wizard=finish]').show();
          	})
  		
  		

  	
      // ajax code starts here

  		var selected_farmers_id = $('.selectpicker').val();
		 
		var url=route_address+"ngo/storengofarmers";
		var $post={};
		
		var selected_ngo=$('input[name=ngo]:checked', '#select-ngo').val();
		
		
		$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        'ngo_id':selected_ngo,
	        'farmer_id':selected_farmers_id,
	        'project_name':'CMSS',
	        'project_id':'1',
	      	

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


        // wizard.get("#select-ngo").setValidator(function() {
        //   var fv = $("#select-ngo").data('formValidation');
        //   fv.validate();

        //   if (!fv.isValid()) {
        //     return false;
        //   }

        //   return true;
        // });
      })();



    })(document, window, jQuery);
  </script>



@endsection
