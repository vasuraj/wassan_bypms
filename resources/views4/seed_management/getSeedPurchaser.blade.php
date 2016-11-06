<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>seed_purchases</title>
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
          <h3 class="panel-title">Seed Purchases</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="seed_purchases_table">
            <thead>
              <tr>
                
                <th>NGO name</th>
                <th>Farmer Name</th>
                <th>Year</th>
                <th>season</th>
                <th>crop</th>
                <th>Seed Variety</th>
                <th>Seed Class</th>
                <th>Area to be sown</th>
                <th>Bag purchased</th>
                <th>Per Bag price </th>
                <th>Total</th>
                <th>seed_purchase Contribution</th>
                <th>Govt. subsidy</th>
     
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
                <th>Area to be sown</th>
                <th>Bag purchased</th>
                <th>Per Bag price </th>
                <th>Total</th>
                <th>seed_purchase Contribution</th>
                <th>Govt. subsidy</th>
     
                <th></th>
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($seed_purchases as $seed_purchase)
              <tr>
                
                <th>{{$seed_purchase->ngo_name}}</th>
                <th><?php
                $farmer=DB::table('farmers')->select('name','fname','farmer_image', 'full_address','adhar_card_number', 'patta_pass_book_number', 'survey_number')->where('id',$seed_purchase->farmer_id)->first();
               
                ?>
              <a  data-placement="top" class="farmer_details" data-farmer-adhar-card-number="{{$farmer->adhar_card_number}}" data-farmer-patta-pass-book-number="{{$farmer->patta_pass_book_number}}" data-farmer-survey-number="{{$farmer->survey_number}}" data-farmer-fname="{{$farmer->fname}}" data-farmer-image="{{$farmer->farmer_image}}" data-farmer-name="{{$farmer->name}}" style="text-decoration:none; color:#222;" data-toggle="tooltip" data-original-title="Selected Ngo filter by location" href="#" data-slug="">
              {{$farmer->name}}
              </a>


                </th>
                <th>{{$seed_purchase->year}}</th>
                <th>{{$seed_purchase->season}}</th>
                <td>@if($seed_purchase->crop=='1') Groundnut @else{{$seed_purchase->crop}}@endif</td>
                <th>{{$seed_purchase->seed_variety}}</th>
                <th>{{$seed_purchase->seed_class}}</th>
                <th>{{$seed_purchase->area_to_be_sown}}</th>
                <th>{{$seed_purchase->bag}}</th>
                <th>{{$seed_purchase->bag_price}}</th>
                <th>{{(float)$seed_purchase->bag*(float)$seed_purchase->bag_price}}</th>
                <th>{{$seed_purchase->farmer_contribution}}</th>
                <th>{{$seed_purchase->govt_subsidy}}</th>

                <th class="row-options">
                                                   
                  <!-- table-menu button -->
                               <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                                    <div class="btn-group" style="width:72px;"role="group">
                                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a  href="{{URL::to('seed_management/seed_purchase/'.$seed_purchase->id.'/edit')}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></button>

                                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px;"><a  href="{{URL::to('seed_management/seed_purchase/'.$seed_purchase->id.'/delete')}}"><i class="fa fa-remove" style="color:#444;" aria-hidden="true"></i></a></button>
         
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



      var table = $('#seed_purchases_table').DataTable({
    

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


