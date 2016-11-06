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
{!! Html::style('fonts/font-awesome/font-awesome.min.css') !!}
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

  .table_option
    {
      display: inline-block;
    }
    .flash
    {
      background: #DFF2BF;
      color:#DFF2BF;
      text-align:center;
    }

    .flash:hover
    {
      color:#222;
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
                <th>Password for HON</th>
                <th>Password for HON last changed on </th>
                <th>Field incharge (FI)</th>
                <th>FI contact</th>
                <th>FI Email</th>
                <th>Password for FI</th>
                <th>Password for FI last changed on </th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
                <th></th>
               
               
              </tr>
            </thead>
            <tfoot>
              <tr>
               <th>Name</th>
                <th>Head of the NGO(HON)</th>
                <th>HON contact</th>
                <th>Email</th>
                <th>Password for HON</th>
                <th>Password for HON last changed on </th>
                <th>Field incharge (FI)</th>
                <th>FI contact</th>
                <th>FI Email</th>
                <th>Password for FI</th>
                <th>Password for FI last changed on </th>
                <th>State</th>
                <th>District</th>
                <th>Mandal</th>
                <th>village</th>
                <th></th>
               
              
              </tr>
            </tfoot>
            <tbody>
             
      @foreach($ngos as $ngo)
              <tr>
                
                <td >
                <b>{{$ngo->name}}</b>
                     
                </td>
                <td> 
              @if($ngo->HON_image!='')
                <a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location"  class="fancybox_cropped_img fancybox.iframe" href="{{$ngo->HON_image}}">{{$ngo->HON}}</a> 
              @else
              {{$ngo->HON}}

              @endif
                </td>
                <td>{{$ngo->contact_number_HON}}</th>
                <td>{{$ngo->email_HON}}</td>
                <td class="flash">
                  
             
            {{$ngo->current_password_HON}}
             
              

                </td>
                <td>@if($ngo->password_changed_on!='0000-00-00 00:00:00'){{$ngo->password_changed_on}} @else <span style="color: #9F6000; background-color: #FEEFB3; padding:3px 5px;">Never</span> @endif</td>
                <td>

            @if($ngo->field_incharge_image!='')
                 <a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location"  class="fancybox_cropped_img fancybox.iframe" href="{{$ngo->field_incharge_image}}">{{$ngo->field_incharge}}</a> </th>
             @else
                {{$ngo->field_incharge}}
             @endif 
                <td>{{$ngo->contact_number_incharge}}</td>
                <td>{{$ngo->email_incharge}}</td>
                <td class="flash">      
                
                
               {{$ngo->current_password_incharge}}
             
              
              </td>
                 <td>@if($ngo->incharge_password_changed_on!='0000-00-00 00:00:00'){{$ngo->incharge_password_changed_on}} @else <span style="color: #9F6000; background-color: #FEEFB3; padding:3px 5px;">Never</span> @endif</td>
                <td>{{$ngo->state}}</td>
                <td>{{$ngo->district}}</td>
                <td>{{$ngo->mandal}}</td>
                <td>{{$ngo->village}}</td>
                <th style="min-width:120px;">
                

                <a  id="{{$ngo->id}}" class="table_option" target="_blank" href="{{URL::to('ngo')}}/{{$ngo->id}}/edit">
                <button type="button" class="btn btn-icon btn-primary">
                <li class="fa fa-pencil" style="color"></li>
                </button>
                </a>


                <a  id="{{$ngo->id}}" class=" table_option" href="{{URL::to('ngo/ngo_profile_pdf')}}/{{$ngo->id}}">
                <button type="button" class="btn btn-icon btn-danger">
                <li class="fa fa-file-pdf-o" style="color"></li>
                </button>
                </a>


                <a id="{{$ngo->id}}" class="download_ngo_profile table_option" href="{{URL::to('ngo/delete')}}/{{$ngo->id}}">
                <button type="button" class="btn btn-icon btn-danger">
                <li class="fa fa-close" style="color"></li>
                </button>
                </a>


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



  } );
    </script>
</body>
</html>