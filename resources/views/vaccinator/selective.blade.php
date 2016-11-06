
@extends('app')

@section('head')
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
{!! Html::style('plugins/fancybox/jquery.fancybox.css')  !!}

<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    $( ".loader_area" ).html('');

  }
</script>

<script>
  $(function(){
 

$("#cmss").parent().parent().addClass('open ');
$("#vaccinators").parent().parent().addClass('open');

$("#vaccinators_report").parent().parent().addClass('open');
$("#vaccinators_view").parent().parent().addClass('active bold active_3d');


});


</script>

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
   <div class="col-md-12" style="height:auto;">
            <!-- Panel Wizard Form -->
            <div class="panel" id="wizard-form">
              <div class="panel-heading">
                <h3 class="panel-title">Search vaccinators by location</h3>
              </div>
              <div class="panel-body">
                <div class="wizard-pane active" id="location-filter-farmer"  role="tabpanel">
                 <form id="location-filter-farmer-form">

            @include('code_snip.location_dropdown_with_bypms_cluster_and_ngo')
                 </form>

                </div>
                
                <button class="btn btn-primary submit-right" id="get_records">Get list</button>
              </div>
            </div>
         

            <!-- Records will be render below -->




<!-- Panel Table Tools -->


      <div id="records_display_area" class="panel" style="margin-top:-20px;">
       
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="vaccinators_table">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>Aadhar Number</th>
                         
                <th></th>
               
               
              </tr>
            </thead>
    
            <tbody id="records_datatable_tbody">
             
                  
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->


            <!-- records rendering ends here -->


            <!-- Eearlier Iframe was used to render data  -->
            <!-- <iframe id="records_area" class="records_ifr" src="" style="min-height:800px; width:100%;" frameborder="0"  onload='javascript:resizeIframe(this);'></iframe> -->
    </div>


@endsection

@section('tour')

  {
          title: "Select location",
          content: "Here you can get select location to filter vaccinators",
         target: document.querySelector("#get_records"),
          placement: "left",
          yOffset:-12,

        },

   {
         title: "Results",
         content: "Once the location is set you can get your result down here",
         target: document.querySelector("#records_display_area"),
         placement: "top",
         yOffset:-12
        },

 

@stop

@section('body_bottom')


  {!! Html::script("js/location_dropdown_v1_with_bypms_cluster_and_ngo.js") !!}
  {!!  Html::script('plugins/datatables/jquery.dataTables.js')  !!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js') !!}
{!!  Html::script('plugins/fancybox/jquery.fancybox.js') !!}

<script>
  
  $(function(){

      
      var id='location-filter-farmer';
      $('#get_records').on('click',function(){

        $( ".loader_area" ).html('<img class="loader" src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');
        
        var selected_state_name=$( "#state option:selected" ).text().trim();
            var selected_district_name=$( "#district option:selected" ).text().trim();
             var selected_ngo_id=$( "#ngo option:selected" ).text().trim();
            var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
            var selected_panchayat_name=$( "#panchayat option:selected" ).text().trim();
            var selected_bypms_cluster_id=$( "#bypms_cluster_id option:selected" ).text().trim();
            var selected_village_name=$( "#village option:selected" ).text().trim();
            var selected_habitation_name=$( "#habitation option:selected" ).text().trim();
          
            
      
          var url=route_address+'vaccinator/getselective';

      var request_data={
            '_token':csrf_token,
            'state':selected_state_name,
            'district':selected_district_name,
            'ngo_id':selected_ngo_id,
            'mandal':selected_mandal_name,
            'panchayat':selected_panchayat_name,
            'bypms_cluster_id':selected_bypms_cluster_id,
            'village':selected_village_name,
            'habitation':selected_habitation_name
          };


       var request=$.ajax({
          type: "POST",
          url:url,
          data:request_data,
          cache: false,
       });

       request.done(function(data){

      if(data!='')
      {
         $('#vaccinators_table').dataTable().fnDestroy();
        console.log("vaccinators data is not empty");
        $("#records_datatable_tbody").html(data);


              // destroy the current table
             



              // reinitialize the table with new data
              var table = $('#vaccinators_table').DataTable({
                  

                      "paging":true,
                      
                        "info":true,
                        "pagingType": "full_numbers",
                        "scrollX": true,
                         colReorder: true,
                    select: true,
                    
                    dom: 'Bfrtip',
                  
                   
                    buttons: [
                    
                          
                        
                        'colvis',
                      {
                        extend: 'print',
                                exportOptions: {
                                    columns: ':visible'
                                }
                       },
                       // {
                       //  extend: 'copy',
                       //          exportOptions: {
                       //              columns: ':visible'
                       //          }
                       // },
                    {
                        extend: 'pdf',
                              extend: 'pdfHtml5',
                              orientation: 'landscape',
                              pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: ':visible'
                                }
                       },
                       {
                        extend: 'excel',
                                exportOptions: {
                                    columns: ':visible'
                                }
                       },
                       {
                        extend: 'csv',
                                exportOptions: {
                                    columns: ':visible'
                                }
                       },



                        ],
                        columnDefs: [ {
                            targets: -1,
                            // chnage it if some colums are hidden
                            visible: true
                        } ]

                  

                    });

         


                    // activate fancybox code starts

                        
                          $(".fancybox_cropped_img").fancybox({
                             
                          
                              width   : '150',
                                height    : '200',
                                autoSize  : false,
                                closeClick  : false,
                          
                            
                                openEffect  : 'elastic',
                             closeEffect : 'elastic',

                              helpers : {
                                title : {
                                  type : 'inside'
                                }
                              }
                            });


            }else{

               console.log("vaccinators data is empty");
                // $('#vaccinators_table').dataTable().fnDestroy();
                var table = $('#vaccinators_table').DataTable();
                table
                    .clear()
                    .draw();

            }


       });

request.fail(function(){
 console.log("request faild while fatching vaccinators list filtered by selected lcoation");
});


                 

      });


  });

</script>

@endsection