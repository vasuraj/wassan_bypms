@extends('app')

@section('head')

{!! Html::style('plugins/c3/c3.css')!!}
{!! Html::style('plugins/datatables/datatables.min.css')	!!}
{!! Html::style('plugins/datatables/dataTables.bootstrap.min.css')	!!}
{!! Html::style('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css')	!!}
{!! Html::style('plugins/multi-select/multi-select.css')	!!}




  <!-- Inline -->
  <style>
.ms-container
{
  min-width:96%;
  margin:auto;
}

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

<?php 
print_r(DB::table('users')->get());  
if(isset($_POST['selected_id']) && Session::has('form_databae'))
{
  echo Session::get('form_databae');
  echo $_POST['selected_id'];

}
?>

<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">Select a Farmer
                  
  

         </h3>
        </header>
        <div class="panel-body">
        {!! Form::open(array('method'=>'POST','url'=>'location/selectlocation/farmer', 'id'=>'select_farmer_form')) !!}
        <div id="error_msg">
          
        </div>


        <div class="row ">
    
              <!-- Example Multi-Select Public Methods -->
              <div class="select_box">
            
                <div class="example">
                  <select class="multi-select-methods form-control">
                    @foreach($farmers as $farmer)
                      <option value="{{$farmer->id}}"><img src="" style="background:#e3e3e3; height:50px; weight:50px;" alt="">{{$farmer->name}}/{{$farmer->fname}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="example-buttons">
                  <button class="btn btn-primary btn-outline" id="buttonSelectAll" type="button">select all</button>
                  <button class="btn btn-primary btn-outline" id="buttonDeselectAll" type="button">deselect all</button>
                  <!-- <button class="btn btn-primary btn-outline" id="buttonAdd" type="button">add some</button> -->
                  <button class="btn btn-primary btn-outline" id="buttonRefresh" type="button">refresh</button>
                </div>
              </div>
              <!-- End Example Multi-Select Public Methods -->
          
          </div>
  
     
          {!! Form::submit('select',array('class'=>'btn btn-primary')) !!}
          {!! Form::close() !!}
        </div>
      </div>
      <!-- End Panel Table Tools -->





@endsection


@section('body_bottom')

{!!  Html::script('plugins/datatables/jquery.dataTables.js')	!!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js')	!!}
{!! Html::script('plugins/formvalidation/formValidation.js') !!}
{!! Html::script('plugins/formvalidation/framework/bootstrap.js') !!}
{!! Html::script('plugins/multi-select/jquery.multi-select.js') !!}

<script>
$(function(){

// Example Multi-Select
      // --------------------
      (function() {
        // for multi-select public methods example
        $('.multi-select-methods').multiSelect();
        $('#buttonSelectAll').click(function() {
          $('.multi-select-methods').multiSelect('select_all');
          return false;
        });
        $('#buttonDeselectAll').click(function() {
          $('.multi-select-methods').multiSelect('deselect_all');
          return false;
        });
        $('#buttonSelectSome').click(function() {
          $('.multi-select-methods').multiSelect('select', ['Idaho',
            'Montana', 'Arkansas'
          ]);
          return false;
        });
        $('#buttonDeselectSome').click(function() {
          $('.multi-select-methods').multiSelect('select', ['Idaho',
            'Montana', 'Arkansas'
          ]);
          return false;
        });
        $('#buttonRefresh').on('click', function() {
          $('.multi-select-methods').multiSelect('refresh');
          return false;
        });
        $('#buttonAdd').on('click', function() {
          $('.multi-select-methods').multiSelect('addOption', {
            value: 42,
            text: 'test 42',
            index: 0
          });
          return false;
        });
      })();

         $("#select_farmer_form").formValidation({
          framework: 'bootstrap',
          err: {
            container: '#error_msg'
          },
          fields: {
           
            selected_farmer: {
              validators: {
                notEmpty: {
                  message: "Please select a farmer"
                }
              }
            }



          }
        });

});

</script>
 
@endsection