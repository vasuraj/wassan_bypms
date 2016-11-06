<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>mvks</title>
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/bootstrap-extend.min.css') !!}
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}

{!! Html::script('plugins/jquery/jquery.js') !!}
{!! Html::style('css/site.min.css') !!}

  <!-- Fonts -->
{!! Html::style('fonts/web-icons/web-icons.min.css') !!}
<style>
  
body
{
  height:auto;
  overflow-y:hidden; 
}

.fancybox-lock .fancybox-overlay {
    overflow-y: hidden !important;
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
          <h3 class="panel-title">mvks</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="mvks_table">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>Panchayats</th>
                <th></th>
               
               
              </tr>
            </thead>
            <tfoot>
              <tr>
              
                <th>Name</th>
                <th>Panchayats</th>
                <th></th>
               
              
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($mvks as $mvk)
              <tr>
                
                <td >
                <button  data-placement="top" data-toggle="tooltip" data-original-title="Selected mvk filter by location"  class="btn btn-primary" ">{{$mvk->name}}</button> 
                     
                </td>
               
                <td>
                  <?php
                      $panchayat_names=explode('+',$mvk->panchayat_names);
                  ?>
                 
                  @foreach($panchayat_names as $panchayat_name)

                  <span class="btn ">{{$panchayat_name}}</span>

                  @endforeach

                </td>
                <td><a id="{{$mvk->id}}" class="download_mvk_profile" href="{{URL::to('mvk/mvk_profile_pdf')}}/{{$mvk->id}}"><li class="fa fa-page"></li></a></td>


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




  <script>
      $(document).ready(function() {


      var table = $('#mvks_table').DataTable({
    

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



// activate fancybox code starts




  } );
    </script>
</body>
</html>


