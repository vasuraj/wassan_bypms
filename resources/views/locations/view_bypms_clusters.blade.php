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
          <h3 class="panel-title">bypms_clusterS 
                  
	<!-- table-menu button -->
                  <div class="btn-group table-menu">
                    <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown" aria-expanded="true">
                    <li class="icon wb-menu " ></li>
                      <span class="caret"></span>
                    </button><div class="dropdown-backdrop"></div>
                    <ul class="dropdown-menu dropdown-menu-right animate" aria-labelledby="exampleAnimationDropdown1" role="menu">
                      <li role="presentation"><a href="{{URL::to('locations/add_bypms_cluster')}}" role="menuitem">Add bypms_cluster</a></li>
                     
                    </ul>
                  </div>
                  
         </h3>
        </header>

        
    
     
            @foreach($bypms_cluster_states as $state)
             


               <div class="well well-sm" style="color:#fff; background:#000;"><b>State: </b>{{$state->state_name}}</div>
                
                
            <?php
            $bypms_cluster_districts=DB::table('bypms_clusters')->select('district_id','district_name')->where('state_id','=',$state->state_id)->groupby('district_id')->get();
            ?>
                
            @foreach($bypms_cluster_districts as $district)
               
             <div class="well well-sm well-primary"><b>District: </b>{{$district->district_name}}</div>
            <?php
            $bypms_cluster_mandals=DB::table('bypms_clusters')->select('mandal_id','mandal_name')->where('district_id','=',$district->district_id)->groupby('mandal_id')->get();
            ?>

            @foreach($bypms_cluster_mandals as $mandal)
             <div class="well well-sm well-success"><b>Mandal: </b>{{$mandal->mandal_name}}</div>
            <?php
            $bypms_cluster_panchayats=DB::table('bypms_clusters')->select('panchayat_id','panchayat_name')->where('mandal_id','=',$mandal->mandal_id)->groupby('panchayat_id')->get();
            ?>

            @foreach($bypms_cluster_panchayats as $panchayat)
             <div class="well well-sm well-success" style="background:gray; color:#000;"><b>Panchayat: </b>{{$panchayat->panchayat_name}}</div>
            <?php
            $bypms_clusters_list=DB::table('bypms_clusters')->where('panchayat_id','=',$panchayat->panchayat_id)->get()
            ?>


            <div class="example-wrap">
              
               
                <div class="example table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                       
                        <th>bypms_cluster Name</th>
                        <th>village names</th>
                        <th></th>
                      
                      </tr>
                    </thead>
                    <tbody>
            @foreach($bypms_clusters_list as $bypms_cluster)

             <tr>
                        
                        <td>{{$bypms_cluster->name}}</td>
                          
                        <td>
                          <?php
                              $village_names=explode('+',$bypms_cluster->village_names);
                          ?>
                         
                          @foreach($village_names as $village_name)

                          <span class="btn ">{{rtrim(rtrim($village_name,'('),'(1')}}</span>

                          @endforeach

                        </td>
                        <td class="row-options">
                                   
                        <!-- option -menu button -->
                           <div class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar">
                            <div class="btn-group" style="width:72px;"role="group">
                            <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a href="{{URL::to('locations/add_bypms_cluster/'.$bypms_cluster->id)}}"><i class="icon wb-pencil" aria-hidden="true"></a></i></button>
                            <button type="button" class="btn  btn-default" style="width:30px; padding:5px 7px; "><a href="{{URL::to('locations/delete_bypms_cluster/'.$bypms_cluster->id)}}">X</a></button>


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