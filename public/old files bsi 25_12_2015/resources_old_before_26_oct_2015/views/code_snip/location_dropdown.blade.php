
<?php

 $states=get_states();
 $final_state='';

 $districts=get_districts(25);
 $final_district='';

 $mandals=get_mandals(25,1);
 $final_mandal='';

?>




<select class="form-control form-group " name="state" id='state'>



 @foreach ($states as $state)


 <option value='{{$state->id}}'   @if($state->name==$final_state)   selected @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>



<select class="form-control form-group" name="district" id='district'>



 @foreach ($districts as $district)


 <option value='{{$district->id}}'   @if($district->name==$final_district)   selected @endif >

 {{	$district->name}}

 </option>



@endforeach


</select>




<select class="form-control form-group" name="mandal" id='mandal'>



 @foreach ($mandals as $mandal)


 <option value='{{$mandal->id}}'   @if($mandal->name==$final_mandal)   selected @endif >

 {{	$mandal->name}}

 </option>



@endforeach


</select>






