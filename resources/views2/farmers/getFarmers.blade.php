<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Farmers</title>
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
          <h3 class="panel-title">Farmers</h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="Farmers_table">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>Father / Husband</th>
                <th>Gender</th>
                <th>Caste</th>
                <th>contact Number</th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
                <th>Aadhar card no.</th>
                <th>Patta pass book no.</th>
                <th>Irrigated land</th>
                <th>Non-Irrigated land</th>
                <th>Fallow land</th>
                <th>Total land</th>
                <th></th>
                
               
               
              </tr>
            </thead>
            <tfoot>
              <tr>
              
                <th>Name</th>
                <th>Father / Husband</th>
                <th>Gender</th>
                <th>Caste</th>
                <th>contact Number</th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
                <th>Aadhar card no.</th>
                <th>Patta pass book no.</th>
                <th>Irrigated land</th>
                <th>Non-Irrigated land</th>
                <th>Fallow land</th>
                <th>Total land</th>
                <th></th>
              
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($farmers as $farmer)
              <tr>
                
                <td>{{$farmer->name}}</td>
                <th>{{$farmer->fname}}</th>
                <th>{{$farmer->gender}}</th>
                <th>{{$farmer->caste}}</th>
                <th>{{$farmer->contact_number}}</th>
                <th>{{$farmer->state}}</th>
                <th>{{$farmer->district}}</th>
                <th>{{$farmer->mandal}}</th>
                <th>{{$farmer->village}}</th>
                <th>{{$farmer->adhar_card_number}}</th>
                <th>{{$farmer->patta_pass_book_number}}</th>
                <th>{{$farmer->irrigated_land}}</th>
                <th>{{$farmer->non_irrigated_land}}</th>
                <th>{{$farmer->fallow_land}}</th>
                <th>{{(float)$farmer->fallow_land+(float)$farmer->irrigated_land+(float)$farmer->non_irrigated_land}}</th>
                <th class="row-options">
                                                   
                  <!-- table-menu button -->
                               <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                                    <div class="btn-group" style="width:72px;"role="group">
                                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a target="_blank" href="{{URL::to('farmer/'.$farmer->id.'/edit')}}"><i class="icon wb-pencil" aria-hidden="true"></i></a></button>

                                  
                        {!! Form::open(['route' => ['farmer.update', $farmer->id], 'method' => 'DELETE']) !!}
                                {!! Form::submit('X', ['class' => 'btn ','style'=>'width:30px; padding:5px 7px; height:33px; font-weight:bold;','onclick' => 'return confirm("Are you sure?");']) !!}
                                {!! Form::close() !!}

                            
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



  <script>
      $(document).ready(function() {

      var table = $('#Farmers_table').DataTable({
    

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


