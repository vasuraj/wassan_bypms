<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ngos</title>
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('css/bootstrap-extend.min.css') !!}
{!! Html::style('plugins/datatables/datatables.min.css')  !!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')  !!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')  !!}
{!! Html::style('plugins/fancybox/jquery.fancybox.css')  !!}
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
          <h3 class="panel-title">Ngos</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="ngos_table">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>Head of the NGO(HON)</th>
                <th>HON contact</th>
                <th>Email</th>
                <th>Field incharge (FI)</th>
                <th>FI contact</th>
                <th>FI Email</th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
               
               
              </tr>
            </thead>
            <tfoot>
              <tr>
              
                <th>Name</th>
                <th>Head of the NGO(HON)</th>
                <th>HON contact</th>
                <th>Email</th>
                <th>Field incharge (FI)</th>
                <th>FI contact</th>
                <th>FI Email</th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
              
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($ngos as $ngo)
              <tr>
                
                <td >
                <a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location"  class="fancybox fancybox.iframe" href="{{URL::to('ngo/getngosfarmers')}}/{{$ngo->id}}">{{$ngo->name}}</a> 
                     
                </td>
                <th>{{$ngo->HON}}</th>
                <th>{{$ngo->contact_number}}</th>
                <th>{{$ngo->email}}</th>
                <th>{{$ngo->field_incharge}}</th>
                <th>{{$ngo->contact_number_incharge}}</th>
                <th>{{$ngo->email_incharge}}</th>
                <th>{{$ngo->state}}</th>
                <th>{{$ngo->district}}</th>
                <th>{{$ngo->mandal}}</th>
                <th>{{$ngo->village}}</th>


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
{!!  Html::script('plugins/fancybox/jquery.fancybox.js') !!}



  <script>
      $(document).ready(function() {

      var table = $('#ngos_table').DataTable({
    

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

      $(".fancybox").fancybox({
         
            fitToView : true,
            width   : '100%',
            height    : '70%',
            autoSize  : true,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none'
        });



  } );
    </script>
</body>
</html>


