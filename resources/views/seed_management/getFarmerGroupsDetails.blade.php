<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>transaction_details</title>
  {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-extend.min.css') !!}
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
 {!! Html::script('plugins/jquery/jquery.js') !!}
{!! Html::style('css/site.min.css') !!}
 {!! Html::style('plugins/asnotification/pnotify.custom.min.css') !!}
  <!-- Fonts -->
  {!! Html::style('fonts/font-awesome/font-awesome.min.css') !!}
<style>
  
body
{
  height:auto;

}

</style>


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

</head>
<body>
  





          
              <h4 class="example-title" style="text-align:center; font-size:24px; margin-top:-40px;">{{ucwords(str_replace('_',' ',$module_name))}} Details</h4>
              <div class="example">
                <div class="panel-group panel-group-continuous" id="exampleAccordionContinuous" aria-multiselectable="true" role="tablist" >
                 
            @foreach($group_details as $group_detail)

               


              <!-- starting Continuous Accordion -->

                  <div class="panel">
                    <div class="panel-heading btn-primary"  id="exampleHeadingContinuous_{{$group_detail['basic_info']->id}}" role="tab">
                      <a class="panel-title collapsed" data-parent="#exampleAccordionContinuous" data-toggle="collapse" href="#exampleCollapseContinuous_{{$group_detail['basic_info']->id}}" aria-controls="exampleCollapseContinuous_{{$group_detail['basic_info']->id}}" aria-expanded="false" style="color:#fff; font-weight:bold; font-size:20px; border:1px solid blue;">
                      {{$group_detail['basic_info']->name}}
                    </a>
                    </div>
                    <div class="panel-collapse collapse" id="exampleCollapseContinuous_{{$group_detail['basic_info']->id}}" aria-labelledby="exampleHeadingContinuous_{{$group_detail['basic_info']->id}}" role="tabpanel" aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">

          Group Created On :{{date('j M, Y',strtotime(str_replace(' 00:00:00','',$group_detail['advance_info']->group_creation_date)))}}
          <br>
          Only for:{{$group_detail['advance_info']->only_for_season}}/{{$group_detail['advance_info']->only_for_year}}
     
          <br>
          Assigned MR Number:{{$group_detail['advance_info']->assigned_mr_number}}
                      <div class="example table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                           
                              <th>Name</th>
                              <th>Father's Name</th>
                              <th>Gender</th>
                              <th>Contact Number</th>
                              <th>Type</th>
                            </tr>
                          </thead>
                          <tbody>

                        @foreach($group_detail['linked_farmers'] as $farmer)

                        

                      <tr>
                        <td>{{$farmer->name}}</td>
                        <td>{{$farmer->fname}}</td>
                        <td>{{$farmer->gender}}</td>
                        <td>@if($farmer->contact_number!=0){{$farmer->contact_number}}@else <span style="background:#eef; padding:3px 5px;">Not mentioned</span> @endif</td>
                        <td>
                        @if($group_detail['advance_info']->group_head==$farmer->id)

                          <span class="label label-danger">Group Head</span>
                        @else
                          <span class="label label-success">Member</span>
                        @endif
                        </td>
                      </tr>
                 
                

                        @endforeach


        

                            </tbody>
                  </table>
                </div>
              
                      </div>
                    </div>
        
            
             
   
    @endforeach  
       </div>
              </div>
            </div>
            <!-- End Continuous Accordion -->
        
     


  {!! Html::script('plugins/bootstrap/bootstrap.js') !!}
{!!  Html::script('plugins/datatables/jquery.dataTables.js')  !!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js') !!}
 {!! Html::script('plugins/asnotification/pnotify.custom.min.js') !!}



  <script>
      $(document).ready(function() {

$('.farmer_details').click(function(){
  
    new PNotify({
            title: $(this).attr('data-farmer-name'),
           
            text: '<table style="color:#fff;"><tr><td><img style="width:100px; border-radius:3px; margin:5px;" src="'+$(this).attr('data-farmer-image')+'"></td><td><div></div>Father:'+$(this).attr('data-farmer-fname')+'<div>Adhar No.:'+$(this).attr('data-farmer-adhar-card-number')+'</div>'+'<div>Patta Passbook No.:'+$(this).attr('data-farmer-patta-pass-book-number')+'</div>'+'<div>Survey No.:'+$(this).attr('data-farmer-survey-number')+'</div></td><tr><table>',
            animate_speed: 'fast',
            icon: false,
            desktop: {
              desktop: false
            },
            nonblock: {
                nonblock: true,
                nonblock_opacity: .5
            },
            animation:'show',
            shadow:true,
            opacity:1
          
      
        });
});



      var table = $('#transaction_details_table').DataTable({
    

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
         {
          extend: 'copy',
                  exportOptions: {
                      columns: ':visible'
                  }
         },
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

table.on( 'order.dt search.dt', function () {
        // table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //     cell.innerHTML = i+1;
        // } );
        //  table.rows().invalidate('dom');

         //var iColumns = table.fnSettings().aoColumns.length;
        //alert(iColumns);
    } ).draw();




  } );
    </script>
</body>
</html>


