
<?php

 $states=get_states();
 $final_state='';

 $districts=get_districts(1);
 $final_district='';

 $mandals=get_mandals(1,1);
 $final_mandal='';

 $villages=get_villages(1);
 $final_village='';


?>

<script>
	
	var base_url = window.location.origin;

    var sub_domain='/bsi_role';

    var route_address=base_url+sub_domain+'/public/';
    console.log(route_address);


</script>

<div id="state_area">
 <label class="control-label" for="state">State</label>

<select class="form-control form-group " name="state" id='state'>



 @foreach ($states as $state)


 <option value='{{$state->name}}'  data-id="{{$state->id}}"  @if(isset($user)) @if($state->name===$user->state)   selected @endif  @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>
</div>


<div id="district_area">
 <label class="control-label" for="district">District</label>

<select class="form-control form-group" name="district" id="district">

<option value='all' data-id="0"  >All</option>

 @foreach ($districts as $district)


 <option value='{{$district->name}}' data-id="{{$district->id}}"   @if(isset($user))  @if($district->name==$user->district)   selected @endif  @endif >

 {{	$district->name}}

 </option>



@endforeach


</select>
</div>
@if(isset($user))
<script>
	$(function(){

		var selected_district_id=$( "#district option:selected" ).attr('data-id');
        var selected_district_name=$( "#district option:selected" ).text().trim();
         console.log('selected District------- :'+selected_district_name);

		$( "#mandal_area" ).html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');
		$( "#village_area" ).html('<img class="loader"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');

         var mandals_list=route_address+'locations/get_select_mandals_dropdown/'+selected_district_id;
         console.log('query on:'+mandals_list);
         $.get(mandals_list, function( data ) {
            $( "#mandal_area" ).html(data);
         
			$('#mandal > option[value="{{$user->mandal}}"]').attr("selected", "selected");


					var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');
		 		    var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
				    console.log(' selected mandal is '+selected_mandal_name);

				    var villages_list=route_address+'locations/get_select_villages_dropdown/'+selected_mandal_id;
				    console.log('query on: '+villages_list);
				    $.get(villages_list, function( data ) {
				        $("#village_area" ).html(data);
				        $('select#village > option[value="{{$user->village}}"]').attr("selected", "selected");
				        console.log('user village is :{{$user->village}}');
				    });

         });
	});
</script>
@endif

<div id="mandal_area">
<label class="control-label" for="mandal">mandal</label>

<select class="form-control form-group" name="mandal" id="mandal">

<option value='all' data-id="0"  >All</option>



</select>

</div>





<div id="village_area">
<label class="control-label" for="village">village</label>

<select class="form-control form-group" name="village" id="village">

<option value='all' data-id="0"  >All</option>


</select>

</div>





