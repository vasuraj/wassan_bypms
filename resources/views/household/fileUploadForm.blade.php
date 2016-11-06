@extends('app')

@section('content')
    <div class="col-md-12" style="height:auto;">
    <!-- Panel Wizard Form -->
    <div class="panel" id="wizard-form">
        <div class="panel-heading">
            <h3 class="panel-title">
            Migrate Household Data 
            <div class="panel-title-small"></div>
            </h3>
         </div>
    <div class="panel-body">
        {!! Form::open(['url'=>'household/migrateExcelData', 'method'=>'POST', 'files'=>true ]) !!}

        <?php

            $ngos_dropdown=array();

        ?>

        @foreach($ngos_list as $ngo)

            <?php
            $ngos_dropdown[$ngo->id]=$ngo->name;
            ?>

        @endforeach

            <?php
            $ngos_dropdown['by_admin']='Admin';
            ?>


        <!-- add csrf token -->

        {{ csrf_field() }}



        
        <div class="col-md-10">
        <lable class="control-label">Excel file received from</lable>
        {{Form::select('selected_ngo',$ngos_dropdown,null, ['class'=>'form-control'])}}
        </div>

          @include('code_snip.location_dropdown_with_bypms_cluster')
      
        <div class="col-md-10">
        <label class="control-label" for="excelFile">Choose an excel file</label>
        {{ Form::file('excelFile',['class'=>'form-control'])}}
        </div>
      
        <div class="col-md-2">

        {{ Form::submit('Upload',['class'=>'btn btn-primary','style'=>'margin-top:30px; float:right;'])}}
        
        </div>
       



        {!! Form::close() !!}

    </div>

   
       

         @if(Session::has('fixed_status'))
          <div class="alert alert-danger" role="alert">

          <div style="height:200px; overflow:auto;">

         {!!Session::get('fixed_status')!!}
         </div>
          
          </div>

         @endif

   

</div>

</div>

@endsection
@section('body_bottom')


  {!! Html::script("js/location_dropdown_v1_with_bypms_cluster.js") !!}

@endsection