
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


 $panchayats=get_panchayats(1564);
 if(isset($user))
 $final_panchayat=$user->panchayat;
 else
 $final_panchayat='';


 $villages=get_villages(8771);
 if(isset($user))
 $final_village=$user->village;
 else
 $final_village='';


 $habitations=get_habitations(39238);
 if(isset($user))
 $final_habitation=$user->habitation;
 else
 $final_habitation='';





?>



<div id="state_area" class="col-md-3">
 <label class="control-label" for="state">State</label>

<select class="form-control form-group " name="state" id='state'>



 @foreach ($states as $state)


 <option value='{{$state->name}}'  data-id="{{$state->id}}"  @if(isset($user)) @if($user->state===$state->name)   selected @endif  @endif >

 {{	$state->name}}

 </option>



@endforeach


</select>
</div>


<div id="district_area" class="col-md-3">

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




<div id="ngo_area" class="col-md-3">

<label class="control-label" for="ngo">NGO</label>

<select class="form-control form-group" name="ngo" id="ngo">

 <option value='' data-id='none'   @if(isset($user))  @if($user->ngo==='') selected @endif  @endif  >
	Do Not Mention
 </option>


</select>
</div>








@if(isset($user))
<script>
	$(function(){

		 var selected_district_id=$( "#district option:selected" ).attr('data-id');
         var selected_district_name=$( "#district option:selected" ).text().trim();

         console.log(' selected district is '+selected_district_name);

         console.log('selected District------- :'+selected_district_name);
			$( "#mandal_area" ).html('<img class="loader" style="height:8px;  border-radius: 100px;  margin-bottom: 20px;"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');
			$( "#village_area" ).html('<img class="loader" style="height:8px;  border-radius: 100px;  margin-bottom: 20px;"  src="'+base_url+sub_domain+'/public/images/horizontal_loader.gif" alt="" />');

         var mandals_list=route_address+'locations/get_mandals_dropdown/'+selected_district_id;
         console.log('query on:'+mandals_list);
         $.get(mandals_list, function( data ) {
             $( "#mandal_area" ).html(data);
         
			$('#mandal > option[value="{{$user->mandal}}"]').attr("selected", "selected");

					var selected_mandal_id=$( "#mandal option:selected" ).attr('data-id');
		 		    var selected_mandal_name=$( "#mandal option:selected" ).text().trim();
				    console.log(' selected mandal is '+selected_mandal_name);

				    var villages_list=route_address+'locations/get_villages_dropdown/'+selected_mandal_id;
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

<div id="mandal_area" class="col-md-3">
<label class="control-label" for="mandal">Mandal</label>

<select class="form-control form-group" name="mandal" id="mandal">


 <option value='' data-id='none'  @if(isset($user))  @if($user->mandal==='')   selected @endif  @endif >
	Do Not Mention
 </option>


 @foreach ($mandals as $mandal)

 <option value='{{$mandal->name}}'  data-id="{{$mandal->id}}" @if(isset($user)) @if($user->mandal===$mandal->name)   selected @endif  @endif >

 {{	$mandal->name}}

 </option>



@endforeach


</select>

</div>



<div id="panchayat_area" class="col-md-3">
<label class="control-label" for="panchayat">Panchayat</label>

<select class="form-control form-group" name="panchayat" id="panchayat">



 <option value='' data-id='none'  @if(isset($user))  @if($user->panchayat==='')   selected @endif  @endif >
	Do Not Mention
 </option>



 @foreach ($panchayats as $panchayat)


 <option value='{{$panchayat->name}}'  data-id="{{$panchayat->id}}" @if(isset($user)) @if($user->panchayat===$panchayat->name)   selected @endif  @endif >

 {{	$panchayat->name}}

 </option>



@endforeach


</select>

</div>



<div id="bypms_cluster_area" class="col-md-3">
<label class="control-label" for="bypms_cluster_id">Cluster</label>

<select class="form-control form-group" name="bypms_cluster_id" id="bypms_cluster_id">



 <option value='' data-id='none'  @if(isset($user))  @if($user->bypms_cluster==='')   selected @endif  @endif >
	Do Not Mention
 </option>




</select>

</div>





<div id="village_area" class="col-md-3">
<label class="control-label" for="village">Village</label>

<select class="form-control form-group" name="village" id="village">


 <option value='' data-id='none'  @if(isset($user))  @if($user->village==='')   selected @endif  @endif >
	Do Not Mention
 </option>



 @foreach ($villages as $village)


 <option value='{{$village->name}}'  data-id="{{$village->id}}"  @if(isset($user))  @if($user->village===$village->name)   selected @endif  @endif >

 {{	$village->name}}

 </option>



@endforeach


</select>

</div>







<div id="habitation_area" class="col-md-3">
<label class="control-label" for="habitation">Habitation</label>

<select class="form-control form-group" name="habitation" id="habitation">


 <option value='' data-id='none'  @if(isset($user))  @if($user->habitation==='')   selected @endif  @endif >
	Do Not Mention
 </option>



 @foreach ($habitations as $habitation)


 <option value='{{$habitation->name}}'  data-id="{{$habitation->id}}"  @if(isset($user))  @if($user->habitation===$habitation->name)   selected @endif  @endif >

 {{	$habitation->name}}

 </option>



@endforeach


</select>

</div>

