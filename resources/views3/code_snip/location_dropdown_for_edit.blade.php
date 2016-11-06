
<?php

 if(isset($user))
 $final_state=$user->state;
 else
 $final_state='';

 if(isset($user))
 $final_district=$user->district;
 else
 $final_district='';

 if(isset($user))
 $final_mandal=$user->mandal;
 else
 $final_mandal='';

 if(isset($user))
 $final_panchayat=$user->panchayat;
 else
 $final_panchayat='';

 if(isset($user))
 $final_village=$user->village;
 else
 $final_village='';

 if(isset($user))
 $final_habitation=$user->habitation;
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


 <option value='{{$state->name}}'  <?php if(isset($user)){ if($state->name===$user->state){$selected_state_id=$state->id;}}?>data-id="{{$state->id}}"  @if(isset($user)) @if($state->name===$user->state)   selected @endif  @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>
</div>


<?php
 $districts=get_districts($selected_state_id);

?>

<div id="district_area">
 <label class="control-label" for="district">District</label>

<select class="form-control form-group" name="district" id="district">

 <option value='' <?php if(isset($user)){ if($user->district==''){$selected_district_id='';}} ?>  data-id='none'  @if(isset($user))  @if($user->district==='') selected @endif  @endif  >
	Do Not Mention
 </option>


 @foreach ($districts as $district)


 <option value='{{$district->name}}'  <?php if(isset($user)){ if($district->name===$user->district){$selected_district_id=$district->id;}}?> data-id="{{$district->id}}"   @if(isset($user))  @if($district->name==$user->district)   selected @endif  @endif >

 {{	$district->name}}

 </option>



@endforeach


</select>
</div>
@if(isset($user))

@endif


<?php

 if($selected_district_id!='')
 $mandals=get_mandals($selected_district_id);

?>
<div id="mandal_area">
<label class="control-label" for="mandal">mandal</label>

<select class="form-control form-group" name="mandal" id="mandal">

 <option value='' data-id='none'  <?php if(isset($user)){ if($user->mandal==''){$selected_mandal_id=''; }} ?>     @if(isset($user))  @if($user->mandal==='')   selected @endif  @endif >
	Do Not Mention
 </option>


 @foreach ($mandals as $mandal)

 <option value='{{$mandal->name}}'  <?php if(isset($user)){ if($mandal->name===$user->mandal){$selected_mandal_id=$mandal->id;}}?>   data-id="{{$mandal->id}}" @if(isset($user)) @if($user->mandal===$mandal->name)   selected @endif  @endif >

 {{	$mandal->name}}

 </option>



@endforeach
</select>

</div>

<?php
// echo "selected mandal id is $selected_mandal_id and users panchayat is $user->panchayat";
if($selected_mandal_id!='')
 $panchayats=get_panchayats($selected_mandal_id);

?>



<div id="panchayat_area">
<label class="control-label" for="panchayat">Panchayat</label>

<select class="form-control form-group" name="panchayat" id="panchayat">



 <option value="" data-id='none' <?php if(isset($user)){ if($user->panchayat===''){$selected_panchayat_id='';}} ?>   @if(isset($user))  @if($user->panchayat==='')   selected @endif  @endif >
	Do Not Mention
 </option>


@if(isset($panchayats))
 @foreach ($panchayats as $panchayat)


 <option value='{{$panchayat->name}}'  data-id="{{$panchayat->id}}" <?php if(isset($user)){ if($user->panchayat===$panchayat->name){$selected_panchayat_id=$panchayat->id;}} ?>  @if(isset($user)) @if($user->panchayat===$panchayat->name)   selected @endif  @endif >

 {{	$panchayat->name}}

 </option>



@endforeach
@endif

</select>

</div>



<?php
// echo "selected panchayat id is $selected_panchayat_id and users village is $user->village";
if($selected_panchayat_id!='')
 $villages=get_villages($selected_panchayat_id);


?>



<div id="village_area">
<label class="control-label" for="village">village</label>

<select class="form-control form-group" name="village" id="village">



 <option value='' data-id='none' <?php if(isset($user)){ if($user->village===''){$selected_village_id='';}} ?>    @if(isset($user))  @if($user->village==='')   selected @endif  @endif >
	Do Not Mention
 </option>

@if(isset($villages))

 @foreach ($villages as $village)


 <option value='{{$village->name}}'  <?php if(isset($user)){ if($village->name==$user->village){$selected_village_id=$village->id;}}?>  data-id="{{$village->id}}" @if(isset($user)) @if($user->village===$village->name)   selected @endif  @endif >

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



<div id="habitation_area">
<label class="control-label" for="habitation">habitation</label>

<select class="form-control form-group" name="habitation" id="habitation">



 <option value='' data-id='none' <?php if(isset($user)){ if($user->habitation==''){$selected_habitation_id='';}} ?>    @if(isset($user))  @if($user->habitation==='')   selected @endif  @endif >
	Do Not Mention
 </option>

@if(isset($habitations))

 @foreach ($habitations as $habitation)


 <option value='{{$habitation->name}}'  <?php if(isset($user)){ if($habitation->name===$user->habitation){$selected_habitation_id=$habitation->id;}}?>  data-id="{{$habitation->id}}" @if(isset($user)) @if($user->habitation===$habitation->name)   selected @endif  @endif >

 {{	$habitation->name}}

 </option>



@endforeach
@endif

</select>

</div>


