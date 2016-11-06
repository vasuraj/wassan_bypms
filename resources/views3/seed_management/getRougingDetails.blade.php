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
  

<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">{{ucwords(str_replace('_',' ',$module_name))}} Details</h3>
     

        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="transaction_details_table">
            <thead>
              <tr>
                
                <th>NGO name</th>
                <th>Farmer Name</th>
                <th>Year</th>
                <th>season</th>
                <th>crop</th>
                <th>Seed Variety</th>
                <th>Seed Class</th>
                <th>Sowing Date</th>
                <th>Vittna Mitra</th>
                <th>Rouging date</th>
                <th>Percentage of Rouged out Plant</th>
                <th>Remark</th>
              
     
                <th></th>
                
               
               
              </tr>
            </thead>
            <tfoot>
              <tr>
              
                <th>NGO name</th>
                <th>Farmer Name</th>
                <th>Year</th>
                <th>season</th>
                <th>crop</th>
                <th>Seed Variety</th>
                <th>Seed Class</th>
                 <th>Sowing Date</th>
                <th>Vittna Mitra</th>
                <th>Rouging date</th>
                <th>Percentage of Rouged out Plant</th>
                <th>Remark</th>
               
                <th></th>
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($transaction_details as $transaction_details)
              <tr>
                
                <th>{{$transaction_details->ngo_name}}</th>
                <th><?php
                $farmer=DB::table('farmers')->select('name','fname','farmer_image', 'full_address','adhar_card_number', 'patta_pass_book_number', 'survey_number')->where('id',$transaction_details->farmer_id)->first();
               
                ?>
              <a  data-placement="top" class="farmer_details" data-farmer-adhar-card-number="{{$farmer->adhar_card_number}}" data-farmer-patta-pass-book-number="{{$farmer->patta_pass_book_number}}" data-farmer-survey-number="{{$farmer->survey_number}}" data-farmer-fname="{{$farmer->fname}}" data-farmer-image="{{$farmer->farmer_image}}" data-farmer-name="{{$farmer->name}}" style="text-decoration:none; color:#222;" data-toggle="tooltip" data-original-title="Selected Ngo filter by location" href="#" data-slug="">
              {{$farmer->name}}
              </a>


                </th>
                <th>{{$transaction_details->year}}</th>
                <th>{{$transaction_details->season}}</th>
                <td>@if($transaction_details->crop=='1') Groundnut @else{{$transaction_details->crop}}@endif</td>
                <th>{{$transaction_details->seed_variety}}</th>
                <th>{{$transaction_details->seed_class}}</th>
                <th>{{$transaction_details->sowing_date}}</th>
                <th>{{$transaction_details->vittna_mitra}}</th>
                <th>{{$transaction_details->rouging_date}}</th>
                <th>{{$transaction_details->percentage_rouged_out_plant}}</th>
                <th>{!! $transaction_details->remark !!}</th>
              
                <th class="row-options">
                                                   
                  <!-- table-menu button -->
                               <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                                    <div class="btn-group" style="width:72px;"role="group">
                                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a  href='{{URL::to("seed_management/$module_name/".$transaction_details->id."/edit")}}'><i class="fa fa-pencil" aria-hidden="true"></i></a></button>

                                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px;"><a  href='{{URL::to("seed_management/$module_name/".$transaction_details->id."/delete")}}'><i class="fa fa-remove" style="color:#444;" aria-hidden="true"></i></a></button>
         
                                    </div>
                                  </div>
           


                  </th>

              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->



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


