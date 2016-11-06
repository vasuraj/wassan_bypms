
<?php

 $states=get_states();
 if(isset($user))
 $final_state=$user->state;
 else
 $final_state='';

 $districts=get_districts(7);
 if(isset($user))
 $final_district=$user->district;
 else
 $final_district='';


 $mandals=get_mandals(42);
 if(isset($user))
 $final_mandal=$user->mandal;
 else
 $final_mandal='';






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


 <option value='{{$state->name}}'  data-id="{{$state->id}}"  @if(isset($user)) @if($user->state===$state->name)   selected @endif  @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>
</div>


<div id="district_area">

 <label class="control-label" for="district">District</label>

<select class="form-control form-group" name="district" id="district">

 <option value='' data-id='none'   @if(isset($user))  @if($user->district==='') selected @endif  @endif  >
	Do Not Mention
 </option>

 @foreach ($districts as $district)

 <option value='{{$district->name}}' data-id="{{$district->id}}"   @if(isset($user))  @if($user->district===$district->name)   selected @endif  @endif >

 {{	$district->name}}

 </option>



@endforeach


</select>
</div>


<div id="mandal_area">
<label class="control-label" for="mandal">Mandal</label>

<select class="form-control form-group" name="mandal" id="mandal">


 <option value='' data-id='none'  @if(isset($user))  @if($user->mandal==='')   selected @endif  @endif >
	Do Not Mention
 </option>


</select>

</div>


