@extends('app')

@section('head')

{!! Html::style('plugins/c3/c3.css')!!}
{!! Html::style('plugins/datatables/datatables.min.css')	!!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')	!!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')	!!}






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

{{Session::get('form_database')}}

<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">Select a Ngo
       
 
	   <!-- table-menu button -->
                  <div class="btn-group table-menu">
                    <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown" aria-expanded="true">
                    <li class="icon wb-menu " ></li>
                      <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu dropdown-menu-right animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="{{URL::to('location/selectlocation/ngo')}}" role="menuitem">Select from another Location</a></li>
                     
                    </ul>
                  </div>
                  
         </h3>
        </header>
        <div class="panel-body">
        {!! Form::open(array('method'=>'POST','url'=>'location/selectlocation/farmer', 'id'=>'select_ngo_form')) !!}
      
        <div id="error_msg">
          
        </div>
  
          <table class="table table-hover dataTable table-striped width-full" id="ngos_table">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>contact Number</th>
                <th>Mandal</th>
                <th>village</th>
              
               
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Name</th>              
                <th>contact Number</th>
                <th>Mandal</th>
                <th>village</th>
                
                
              </tr>
            </tfoot>
            <tbody>
             
			       @foreach($ngos as $ngo)
              <tr>
               <td class="row-options">
                                   
               <div class="form-group">
                <input id="selected_ngo" class="to-labelauty-icon labelauty" name="selected_id"  value="{{$ngo->id}}" type="radio">
               </div>

                </td>
                <td>{{$ngo->name}}</td>
            
                <td>{{$ngo->contact_number}}</td>
                <td>{{$ngo->mandal}}</td>
                <td>{{$ngo->village}}</td>
             

              </tr>
             @endforeach
            </tbody>
          </table>
          {!! Form::submit('select',array('class'=>'btn btn-primary')) !!}
          {!! Form::close() !!}
        </div>
      </div>
      <!-- End Panel Table Tools -->
@endsection


@section('body_bottom')

{!! Html::script('plugins/datatables/jquery.dataTables.js')	!!}
{!! Html::script('plugins/datatables/buttons.colVis.min.js') !!}
{!! Html::script('plugins/formvalidation/formValidation.js') !!}
{!! Html::script('plugins/formvalidation/framework/bootstrap.js') !!}
<script>
$(function(){


    // window.onbeforeunload = function() {
    //     return "Dude, are you sure you want to leave? Think of the kittens!";
    // }

         $("#select_ngo_form").formValidation({
          framework: 'bootstrap',
          err: {
            container: '#error_msg'
          },
          fields: {
           
            selected_ngo: {
              validators: {
                notEmpty: {
                  message: "Please select a Ngo"
                }
              }
            }



          }
        });

});

</script>
 
@endsection