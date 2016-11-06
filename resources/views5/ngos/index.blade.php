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

 <div class="panel-body" style="display:none; background:#fff; margin-bottom:10px;">
          <div class="row row-lg">
          <!-- Male female ration chart -->
            <div class="col-md-6">
         
              <div class="example-wrap margin-md-0">
				
				<!-- Chart options -->
                	<div class="btn-group ">
                    <button type="button" class="btn btn-primary dropdown-toggle custom-print" data-toggle="dropdown" aria-expanded="true">
					     Male Female Ratio 
                    <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="javascript:void(0)" onclick="jQuery('#male_female_ratio').print()" role="menuitem">Print</a></li>
                      <li role="presentation"><a href="javascript:void(0)" id="male_female_ratio_pdf" role="menuitem">pdf</a></li>
                  
                    </ul>
                  </div>
              <!--End  Chart options -->

                <div class="example">
                  <div id="male_female_ratio"></div>
                </div>
              </div>
            
            </div>
  			<!-- End male female ratio chart -->
            <div class="col-md-6 ">
              <!-- cast distribution chart-->
              	<!-- Chart options -->
                	<div class="btn-group ">
                    <button type="button" class="btn btn-rounded btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					Caste Distribution 
                    <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="javascript:void(0)" onclick="jQuery('#caste_distribution').print()" role="menuitem">Print</a></li>
                  
                    </ul>
                  </div>
              <!--End  Chart options -->
              <div class="example-wrap">
               
                <div class="example">
                  <div id="caste_distribution"></div>
                </div>
              </div>
              <!-- End caste distribution chart -->
            </div>
          </div>
        </div>

<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">ngos 
                  
	<!-- table-menu button -->
                  <div class="btn-group table-menu">
                    <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown" aria-expanded="true">
                    <li class="icon wb-menu " ></li>
                      <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu dropdown-menu-right animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="{{URL::to('ngo/create')}}" role="menuitem">Add ngo</a></li>
                     
                    </ul>
                  </div>
                  
         </h3>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="ngos_table">
            <thead>
              <tr>
                <th>Name</th>
            
                <th>contact Number</th>
                <th>Mandal</th>
                <th>village</th>
                <th></th>
               
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
              
                <th>contact Number</th>
                <th>Mandal</th>
                <th>village</th>
                <th></th>
                
              </tr>
            </tfoot>
            <tbody>
             
			@foreach($ngos as $ngo)
              <tr>

                <td>{{$ngo->name}}</td>
            
                <th>{{$ngo->contact_number}}</th>
                <th>{{$ngo->mandal}}</th>
                <th>{{$ngo->village}}</th>
                <th class="row-options">
                	                 
	<!-- table-menu button -->
               <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                    <div class="btn-group" style="width:72px;"role="group">
                      <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a href="{{URL::to('ngo/'.$ngo->id.'/edit')}}"><i class="icon wb-pencil" aria-hidden="true"></a></i></button>

                  
 				{!! Form::open(['route' => ['ngo.update', $ngo->id], 'method' => 'DELETE']) !!}
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





@endsection


@section('body_bottom')

{!!  Html::script('plugins/datatables/jquery.dataTables.js')	!!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js')	!!}
{!!  Html::script('plugins/js-pdf/jspdf.min.js')	!!}


{!!  Html::script('plugins/d3/d3.min.js')	!!}
{!!  Html::script('plugins/c3/c3.min.js')	!!}

 
@endsection