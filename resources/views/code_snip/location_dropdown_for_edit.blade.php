
<?php

 if(isset($ngo))
 $final_state=$ngo->state;
 else
 $final_state='';

 if(isset($ngo))
 $final_district=$ngo->district;
 else
 $final_district='';

 if(isset($ngo))
 $final_mandal=$ngo->mandal;
 else
 $final_mandal='';

 if(isset($ngo))
 $final_panchayat=$ngo->panchayat;
 else
 $final_panchayat='';

 if(isset($ngo))
 $final_village=$ngo->village;
 else
 $final_village='';

 if(isset($ngo))
 $final_habitation=$ngo->habitation;
 else
 $final_habitation='';

$selected_state_id='';
$selected_district_id='';
$selected_mandal_id='';
$selected_panchayat_id='';
$selected_village_id='';
$selected_habitation_id='';



$states=get_states();

	// echo "final state is:".$final_state." <br>";
	// echo "final district is:".$final_district." <br>";
	// echo "final mandal is:".$final_mandal." <br>";
	// echo "final panchayat is:".$final_panchayat." <br>";
	// echo "final village is:".$final_village." <br>";
	// echo "final habitation is:".$final_habitation." <br>";


?>



<div id="state_area" class="col-md-3">
 <label class="control-label" for="state">State</label>

<select class="form-control form-group " name="state" id='state'>



 @foreach ($states as $state)


 <option value='{{$state->name}}'  <?php if(isset($ngo)){ if($state->name===$ngo->state){$selected_state_id=$state->id;}}?>data-id="{{$state->id}}"  @if(isset($ngo)) @if($state->name===$ngo->state)   selected @endif  @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>
</div>


<?php
 $districts=get_districts($selected_state_id);

?>

<div id="district_area" class="col-md-3">
 <label class="control-label" for="district">District</label>

<select class="form-control form-group" name="district" id="district">

 <option value='' <?php if(isset($ngo)){ if($ngo->district==''){$selected_district_id='';}} ?>  data-id='none'  @if(isset($ngo))  @if($ngo->district==='') selected @endif  @endif  >
	Do Not Mention
 </option>


 @foreach ($districts as $district)


 <option value='{{$district->name}}'  <?php if(isset($ngo)){ if($district->name===$ngo->district){$selected_district_id=$district->id;}}?> data-id="{{$district->id}}"   @if(isset($ngo))  @if($district->name==$ngo->district)   selected @endif  @endif >

 {{	$district->name}}

 </option>



@endforeach


</select>
</div>
@if(isset($ngo))

@endif




<?php

 if($selected_district_id!='')
 
 $mandals=get_mandals($selected_district_id);

?>
<div id="mandal_area" class="col-md-3">
<label class="control-label" for="mandal">mandal</label>

<select class="form-control form-group" name="mandal" id="mandal">

 <option value='' data-id='none'  <?php if(isset($ngo)){ if($ngo->mandal==''){$selected_mandal_id=''; }} ?>     @if(isset($ngo))  @if($ngo->mandal==='')   selected @endif  @endif >
	Do Not Mention
 </option>


 @foreach ($mandals as $mandal)

 <option value='{{$mandal->name}}'  <?php if(isset($ngo)){ if($mandal->name===$ngo->mandal){$selected_mandal_id=$mandal->id;}}?>   data-id="{{$mandal->id}}" @if(isset($ngo)) @if($ngo->mandal===$mandal->name)   selected @endif  @endif >

 {{	$mandal->name}}

 </option>



@endforeach
</select>

</div>

<?php
// echo "selected mandal id is $selected_mandal_id and users panchayat is $ngo->panchayat";
if($selected_mandal_id!='')
 $panchayats=get_panchayats($selected_mandal_id);

?>



<div id="panchayat_area" class="col-md-3">
<label class="control-label" for="panchayat">Panchayat</label>

<select class="form-control form-group" name="panchayat" id="panchayat">



 <option value="" data-id='none' <?php if(isset($ngo)){ if($ngo->panchayat===''){$selected_panchayat_id='';}} ?>   @if(isset($ngo))  @if($ngo->panchayat==='')   selected @endif  @endif >
	Do Not Mention
 </option>


@if(isset($panchayats))
 @foreach ($panchayats as $panchayat)


 <option value='{{$panchayat->name}}'  data-id="{{$panchayat->id}}" <?php if(isset($ngo)){ if($ngo->panchayat===$panchayat->name){$selected_panchayat_id=$panchayat->id;}} ?>  @if(isset($ngo)) @if($ngo->panchayat===$panchayat->name)   selected @endif  @endif >

 {{	$panchayat->name}}

 </option>



@endforeach
@endif

</select>

</div>



<?php
// echo "selected panchayat id is $selected_panchayat_id and users village is $ngo->village";
if($selected_panchayat_id!='')
 $villages=get_villages($selected_panchayat_id);


?>



<div id="village_area" class="col-md-3">
<label class="control-label" for="village">village</label>

<select class="form-control form-group" name="village" id="village">



 <option value='' data-id='none' <?php if(isset($ngo)){ if($ngo->village===''){$selected_village_id='';}} ?>    @if(isset($ngo))  @if($ngo->village==='')   selected @endif  @endif >
	Do Not Mention
 </option>

@if(isset($villages))

 @foreach ($villages as $village)


 <option value='{{$village->name}}'  <?php if(isset($ngo)){ if($village->name==$ngo->village){$selected_village_id=$village->id;}}?>  data-id="{{$village->id}}" @if(isset($ngo)) @if($ngo->village===$village->name)   selected @endif  @endif >

 {{	$village->name}}

 </option>



@endforeach
@endif

</select>

</div>




<?php
// echo "selected village id is $selected_village_id";
if($selected_village_id!='')
 $habitations=get_habitations($selected_village_id);


?>



<div id="habitation_area" class="col-md-3">
<label class="control-label" for="habitation">habitation</label>

<select class="form-control form-group" name="habitation" id="habitation">



 <option value='' data-id='none' <?php if(isset($ngo)){ if($ngo->habitation==''){$selected_habitation_id='';}} ?>    @if(isset($ngo))  @if($ngo->habitation==='')   selected @endif  @endif >
	Do Not Mention
 </option>

@if(isset($habitations))

 @foreach ($habitations as $habitation)


 <option value='{{$habitation->name}}'  <?php if(isset($ngo)){ if($habitation->name===$ngo->habitation){$selected_habitation_id=$habitation->id;}}?>  data-id="{{$habitation->id}}" @if(isset($ngo)) @if($ngo->habitation===$habitation->name)   selected @endif  @endif >

 {{	$habitation->name}}

 </option>



@endforeach
@endif

</select>

</div>


