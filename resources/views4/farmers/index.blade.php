@extends('app')

@section('head')

{!! Html::style('plugins/c3/c3.css')!!}





  <!-- Inline -->
  <style>
    @media (max-width: 480px) {
      .panel-actions .dataTables_length {
        display: none;
      }
    }
    
    @media (max-width: 320px) {
      .panel-actions .dataTables_filter {
        display: none;
      }
    }
    
    @media (max-width: 767px) {
      .dataTables_length {
        float: left;
      }
    }
    
    #exampleTableAddToolbar {
      padding-left: 30px;
    }

  </style>

@endsection

@section('content')

 <div class="panel-body" style="background:#fff; margin-bottom:10px;">
          <div class="row row-lg">
          <!-- Male female ration chart -->
            <div class="col-md-6">
         
              <div class="example-wrap margin-md-0">
				
				<!-- Chart options -->
                	<div class="btn-group ">
                    <button type="button" class="btn btn-primary dropdown-toggle custom-print" data-toggle="dropdown" aria-expanded="true">
					         Male Female Ratio 
                    <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="javascript:void(0)" onclick="jQuery('#male_female_ratio').print()" role="menuitem">Print</a></li>
                      <!-- <li role="presentation"><a href="javascript:void(0)" id="male_female_ratio_pdf" role="menuitem">pdf</a></li> -->
                  
                    </ul>
                  </div>
              <!--End  Chart options -->

                <div class="example">
                  <div id="male_female_ratio"></div>
                </div>
              </div>
            
            </div>
  			<!-- End male female ratio chart -->
            <div class="col-md-6 ">
              <!-- cast distribution chart-->
              	<!-- Chart options -->
                	<div class="btn-group ">
                    <button type="button" class="btn btn-rounded btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					Caste Distribution 
                    <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="javascript:void(0)" onclick="jQuery('#caste_distribution').print()" role="menuitem">Print</a></li>
                  
                    </ul>
                  </div>
              <!--End  Chart options -->
              <div class="example-wrap">
               
                <div class="example">
                  <div id="caste_distribution"></div>
                </div>
              </div>
              <!-- End caste distribution chart -->
            </div>
          </div>
        </div>





@endsection


@section('body_bottom')

{!!  Html::script('plugins/d3/d3.min.js')	!!}
{!!  Html::script('plugins/c3/c3.min.js')	!!}
{{--  Html::script('plugins/js-pdf/jspdf.min.js') --}}

  <script>
    (function(document, window, $) {
      'use strict';
      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
      });



     
      // Example C3 Pie
      // --------------
      (function() {
        var pie_chart = c3.generate({
          bindto: '#male_female_ratio',
          data: {
            // iris data from R
            columns: [
              ['Male', {{$male_farmers}}],
              ['Female', {{$female_farmers}}],
            ],
            type: 'pie',
          },
          color: {
            pattern: [$.colors("blue-grey", 400), $.colors("yellow",
              700)]
          },
          legend: {
            position: 'right'
          },
          pie: {
            label: {
              show: true
            },
            onclick: function(d, i) {},
            onmouseover: function(d, i) {},
            onmouseout: function(d, i) {}
          }
        });
      })();

      // Example C3 Donut
      // ----------------
      (function() {
        var donut_chart = c3.generate({
          bindto: '#caste_distribution',
          data: {
            columns: [
              ['SC', {{ $SC_farmer }}],
              ['ST', {{ $ST_farmer }}],
              ['OC', {{ $OC_farmer }}],
              ['BC', {{ $BC_farmer }}]
            ],
            type: 'donut'
          },
          color: {
            pattern: [$.colors("primary", 500), $.colors("blue-grey",
              200), $.colors("red", 400), $.colors("green",600)]
          },
          legend: {
            position: 'right'
          },
          donut: {
            label: {
              show: true
            },
            width: 50,
            title: "Caste",
            onclick: function(d, i) {},
            onmouseover: function(d, i) {},
            onmouseout: function(d, i) {}
          }
        });
      })();
  
	  $("#male_female_ratio").find('.print-link').on('click', function() {
	     //Print ele2 with default options
	      $.print("#male_female_ratio");
	  });

 		$("#caste_distribution").find('.print-link').on('click', function() {
	     //Print ele2 with default options
	      $.print("#caste_distribution");
	  });



 		var doc = new jsPDF();
		var specialElementHandlers = {
		    '#editor': function (element, renderer) {
		        return true;
		    }
		};

		$('#male_female_ratio_pdf').click(function () {
		    doc.fromHTML($('#male_female_ratio').html(), 15, 15, {
		        'width': 170,
		            'elementHandlers': specialElementHandlers
		    });
		    doc.save('sample-file.pdf');
		});




    })(document, window, jQuery);
  </script>

@endsection