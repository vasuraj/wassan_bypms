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
  .well
  {
   padding:3px 5px;
   margin:0px; 
  }


  </style>

@endsection

@section('content')



<!-- Panel Table Tools -->
      <div class="panel">
        <header class="panel-heading">
          <h3 class="panel-title">MVKS 
                  
	<!-- table-menu button -->
                  <div class="btn-group table-menu">
                    <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown" aria-expanded="true">
                    <li class="icon wb-menu " ></li>
                      <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu dropdown-menu-right animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="{{URL::to('mvk/create')}}" role="menuitem">Add mvk</a></li>
                     
                    </ul>
                  </div>
                  
         </h3>
        </header>

        
    
     
            @foreach($mvk_states as $state)
             


               <div class="well well-sm" style="color:#fff; background:#000;"><b>State: </b>{{$state->state_name}}</div>
                
                
            <?php
            $mvk_districts=DB::table('mvks')->select('district_id','district_name')->where('state_id','=',$state->state_id)->groupby('district_id')->get();
            ?>
                
            @foreach($mvk_districts as $district)
               
             <div class="well well-sm well-primary"><b>District: </b>{{$district->district_name}}</div>
            <?php
            $mvk_mandals=DB::table('mvks')->select('mandal_id','mandal_name')->where('district_id','=',$district->district_id)->groupby('mandal_id')->get();
            ?>

            @foreach($mvk_mandals as $mandal)
             <div class="well well-sm well-success"><b>Mandal: </b>{{$mandal->mandal_name}}</div>
           
            <?php
            $mvks_list=DB::table('mvks')->where('mandal_id','=',$mandal->mandal_id)->get()
            ?>
            <div class="example-wrap">
              
               
                <div class="example table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                       
                        <th>MVK Name</th>
                        <th>panchayat names</th>
                        <th></th>
                      
                      </tr>
                    </thead>
                    <tbody>
            @foreach($mvks_list as $mvk)

             <tr>
                        
                        <td>{{$mvk->name}}</td>
                          
                        <td>
                          <?php
                              $panchayat_names=explode('+',$mvk->panchayat_names);
                          ?>
                         
                          @foreach($panchayat_names as $panchayat_name)

                          <span class="btn ">{{rtrim(rtrim($panchayat_name,'('),'(1')}}</span>

                          @endforeach

                        </td>
                        <td class="row-options">
                                   
                        <!-- option -menu button -->
                           <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                            <div class="btn-group" style="width:72px;"role="group">
                            <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a href="{{URL::to('locations/add_mvk/'.$mvk->id)}}"><i class="icon wb-pencil" aria-hidden="true"></a></i></button>
                            <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a href="{{URL::to('locations/delete_mvk/'.$mvk->id)}}">X</a></button>


                          </div>
                        </div>
                 


                      </th>
                     
              </tr>
             
                                   
            @endforeach
              </tbody>
                  </table>
                </div>
              </div>
            @endforeach
            @endforeach
               
            @endforeach
            

    
      <!-- End Panel Table Tools -->





@endsection


@section('body_bottom')

{!!  Html::script('plugins/datatables/jquery.dataTables.js')	!!}
{!!  Html::script('plugins/datatables/buttons.colVis.min.js')	!!}
{!!  Html::script('plugins/js-pdf/jspdf.min.js')	!!}


{!!  Html::script('plugins/d3/d3.min.js')	!!}
{!!  Html::script('plugins/c3/c3.min.js')	!!}

 
@endsection