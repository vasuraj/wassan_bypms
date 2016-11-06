@extends('app')

@section('content')
<div class="panel" >
 
<?php 

// insert into selected database with selected id
print_r($_POST);
if(isset($_POST['selected_id']) && Session::has('form_database'))
{
  
  $form_database=Session::get('form_database');
  $_POST['selected_id'];
  
}

// code ends here
?>
<h3 class="panel-title">Select Location</h3>
<div class="panel-body">


{!! Form::open(array('method'=>'POST','url'=>$module.'/'.'select'.$module)) !!}


@include('code_snip.location_dropdown')
{!! Form::submit('select this location',array('class'=>'btn btn-primary')) !!}
{!! Form::close() !!}
</div>
</div>
@endsection

@section('body_bottom')
{!! Html::script("js/select_location_dropdown.js") !!}
<script>
	$(function(){

		$('#district').prepend($('<option>', {
		    value:'all',
		    'data-id':0,
		    text: 'All'
		}));

		$('#district > option[value="all"]').attr("selected", "selected");
		$('#district').trigger('change');

	});
</script>
@endsection