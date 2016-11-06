<?php namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use URL;
use App\Http\Controllers\Controller;
use stdClass;


use Illuminate\Http\Request;

class LocationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    public function selectLocation($module=null)
    {   
        if(!isset($post_data))
        {
            $post_data='';
        }
        $post_data.=serialize($_POST);
        
        return view('locations.locationDropdowns',compact('post_data','module'));
        
    }




    public function get_states()
    {

        $states = DB::table('states')->orderby('name')->get();

        return $states;

    }

    public function get_states_json()
    {

        $states = DB::table('states')->orderby('name')->get();

        return response()->json($states);

    }

    public function get_state($state_id=null)
    {
        $state=DB::table('states')->where('id','=',$state_id)->first();
        return $state;
    }


    public function get_state_json($state_id=null)
    {
        $state=DB::table('states')->where('id','=',$state_id)->first();
        return response()->json($state);
    }






    public function get_districts($state_id=null)
    {

        if($state_id!=null){

            $districts = DB::table('districts')->where('state_id','=',$state_id)->orderby('name')->get();
        }
        else
        {
            $districts = DB::table('districts')->orderby('name')->get();
        }


        return $districts;

    }


    public function get_districts_json($state_id=null)
    {

        if($state_id!=null){

            $districts = DB::table('districts')->where('state_id','=',$state_id)->orderby('name')->get();
        }
        else
        {
            $districts = DB::table('districts')->orderby('name')->get();
        }


        return response()->json($districts);

    }


    public function get_districts_dropdown($state_id=null)
    {
        $districts_html='';
        if($state_id!=null){

            $districts = DB::table('districts')->where('state_id','=',$state_id)->orderby('name')->get();


           $districts_html.='<label class="control-label" for="district">District</label>';

          $districts_html.=' <select class="form-control form-group" name="district" id="district"> ';

                foreach($districts as $district)
                {
                    $districts_html.=" <option data-id='$district->id' value='$district->name'>$district->name</option> ";
                }
           $districts_html.=' </select> ';

        }
        else
        {

            $districts = DB::table('districts')->orderby('name')->get();
        }


        return $districts_html;

    }


     public function get_villages_dropdown($mandal_id=null)
    {
        $villages_html='';
        if($mandal_id!=null){

            $villages = DB::table('villages')->where('mandal_id','=',$mandal_id)->orderby('name')->get();


           $villages_html.='<label class="control-label" for="village">village</label>';

          $villages_html.=' <select  class="form-control form-group" name="village" id="village"> ';

                foreach($villages as $village)
                {
                    $villages_html.=" <option data-id='$village->id' value='$village->name'>$village->name</option> ";
                }
           $villages_html.=' </select> ';

        }
        else
        {

            $villages = DB::table('villages')->orderby('name')->get();
        }


        return $villages_html;

    }

    public function get_select_villages_dropdown($mandal_id=null)
    {
        $villages_html='';
        if($mandal_id!=null){

            $villages = DB::table('villages')->where('mandal_id','=',$mandal_id)->orderby('name')->get();


           $villages_html.='<label class="control-label" for="village">village</label>';

          $villages_html.=' <select  class="form-control form-group" name="village" id="village"> ';
            $villages_html.="<option data-id='0' value='all'>All</option>";

                foreach($villages as $village)
                {
                    $villages_html.=" <option data-id='$village->id' value='$village->name'>$village->name</option> ";
                }
           $villages_html.=' </select> ';

        }
        else
        {

            $villages = DB::table('villages')->orderby('name')->get();
        }


        return $villages_html;

    }


    public function get_district($district_id=1)
    {
        $district=DB::table('districts')->where('id','=',$district_id)->first();
        return $district;
    }


    public function get_district_json($district_id=1)
    {
        $district=DB::table('districts')->where('id','=',$district_id)->first();
        return response()->json($district);
    }






    public function get_mandals($district_id=null)
    {

        if($district_id!=null){

            $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();
        }
        else
        {
            $mandals = DB::table('mandals')->orderby('name')->get();
        }


        return $mandals;

    }



    public function get_mandals_json($district_id=null)
    {

        if($district_id!=null){

            $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();
        }
        else
        {
            $mandals = DB::table('mandals')->orderby('name')->get();
        }


        return response()->json($mandals);

    }
    public function get_mandals_dropdown($district_id=null)
    {
        $mandals_html='';
        if($district_id!=null){

            $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();

            $mandals_html.='<label class="control-label" for="mandal">mandal</label>';

            $mandals_html.='<select class="form-control form-group" name="mandal" id="mandal">';
       

            foreach($mandals as $mandal)
            {
                $mandals_html.="<option data-id='$mandal->id' value='$mandal->name'>$mandal->name</option>";
            }
            $mandals_html.='</select>';

        }
        else
        {
            $mandals = DB::table('mandals')->orderby('name')->get();
        }


        return $mandals_html;

    }
    public function get_select_mandals_dropdown($district_id=null)
    {

        $mandals_html='';
   
                if($district_id!=null){

                    $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();

                    $mandals_html.='<label class="control-label" for="mandal">mandal</label>';

                    $mandals_html.='<select class="form-control form-group" name="mandal" id="mandal">';
                    $mandals_html.="<option data-id='0' value='all'>All</option>";

                    foreach($mandals as $mandal)
                    {
                        $mandals_html.="<option data-id='$mandal->id' value='$mandal->name'>$mandal->name</option>";
                    }
                    $mandals_html.='</select>';

                }
                else
                    {
                        $mandals = DB::table('mandals')->orderby('name')->get();
                    }


        return $mandals_html;

    }

       public function locationDropdownMandal($district_id=null,$div_id=null)
    {

        $mandals_html='';
   
                if($district_id!=null){

                    $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();

                    $mandals_html.="<form id='mandal_$div_id-form'>";
                    $mandals_html.="<label class='control-label' for='mandal_$div_id'>Mandal</label><br>";

                    $mandals_html.="<select style='width:100%;' class'form-control form-group' name='mandal_$div_id' id='mandal_$div_id'>";
                    $mandals_html.="<option data-id='0' value='all'>All</option>";

                    foreach($mandals as $mandal)
                    {
                        $mandals_html.="<option data-id='$mandal->id' value='$mandal->name'>$mandal->name</option>";
                    }
                    $mandals_html.='</select>';
                    $mandals_html.='</form>';

                }
                else
                    {
                        $mandals = DB::table('mandals')->orderby('name')->get();
                    }


        return $mandals_html;

    }



      public function locationDropdownVillage($mandal_id=null,$div_id=null)
    {

        $villages_html='';
   
                if($mandal_id!=null){

                    $villages = DB::table('villages')->where('mandal_id','=',$mandal_id)->orderby('name')->get();

                    $villages_html.="<form id='village_$div_id-form'>";
                    $villages_html.="<label class='control-label' for='village_$div_id'>village</label><br>";

                    $villages_html.="<select style='width:100%;' class'form-control form-group' name='village_$div_id' id='village_$div_id'>";
                    $villages_html.="<option data-id='0' value='all'>All</option>";

                    foreach($villages as $village)
                    {
                        $villages_html.="<option data-id='$village->id' value='$village->name'>$village->name</option>";
                    }
                    $villages_html.='</select>';
                    $villages_html.='</form>';

                }
                else
                    {
                        $villages = DB::table('villages')->orderby('name')->get();
                    }


        return $villages_html;

    }

    public function get_mandal($mandal_id=1)
    {
        $mandal=DB::table('mandals')->where('id','=',$mandal_id)->first();
        return $mandal;
    }



    public function get_mandal_json($mandal_id=1)
    {
        $mandal=DB::table('mandals')->where('id','=',$mandal_id)->first();
        return response()->json($mandal);
    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function locationDropdown($div_id=null)
    {
      

         $states=get_states();
         $final_state='';

         $districts=get_districts(1);
         $final_district='';

         $mandals=get_mandals(1,1);
         $final_mandal='';

         $villages=get_villages(1);
         $final_village='';



    $dropdown_html='';
    
    $dropdown_html.= "<script>
        
    var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain+'/';
    console.log('route_address is: '+route_address);
   

    </script>";

    $dropdown_html.= "<div id='state_".$div_id."_area'>
    <form id='$div_id-form' action='''>
    <label class='control-label' for='state_$div_id'>State</label>
    
    <select class='form-control form-group ' name='state_$div_id' id='state_$div_id'>";
    foreach ($states as $state)
    {
    $dropdown_html.= "<option value='$state->name'  data-id='$state->id' ";

    if(isset($user))
    {
        if($state->name===$user->state)
        {
           $dropdown_html.= "selected";
        }   
    } 

   // $state->name

    $dropdown_html.=" >$state->name</option>";

    }

    $dropdown_html.="</select></form></div>";


     $dropdown_html.="<div id='district_".$div_id."_area'>

        <label class='control-label' for='district_$div_id'>District</label>
    
        <select class='form-control form-group' name='district_$div_id' id='district_$div_id'>

        <option value='all' data-id='0'  >All</option>";

    foreach ($districts as $district)
    {
    $dropdown_html.= "<option value='$district->name'  data-id='$district->id' ";

    if(isset($user))
    {
        if($district->name===$user->district)
        {
            $dropdown_html.= "selected";
        }   
    } 

   // $district->name

    $dropdown_html.=">$district->name</option>";

    }

$dropdown_html.="</select></div>";
$user=new stdClass();

$user->mandal='';
$user->village='';
// if (isset($user))
if(true)
{
$dropdown_html.="<script>
    $(function(){

        var selected_district_id=$( '#district_$div_id option:selected' ).attr('data-id');
        var selected_district_name=$( '#district_$div_id option:selected' ).text().trim();
        $( '#mandal_".$div_id."_area' ).html('<img class=\"loader\"   src=\"'+base_url+sub_domain+'/images/horizontal_loader.gif\" alt=\"\" />');

        $( '#village_".$div_id."_area' ).html('<img class=\"loader\"   src=\"'+base_url+sub_domain+'/images/horizontal_loader.gif\" alt=\"\" />');



         var mandals_list=route_address+'locations/locationdropdownmandal/'+selected_district_id+'/'+'$div_id';
        
         $.get(mandals_list, function( data ) {
             console.log('query on:'+mandals_list);
            $( '#mandal_".$div_id."_area' ).html(data);
         
            $('#mandal_$div_id > option[value=\"$user->mandal\"]').attr('selected', 'selected');


                    var selected_mandal_id=$( '#mandal_$div_id option:selected' ).attr('data-id');
                    var selected_mandal_name=$( '#mandal_$div_id option:selected' ).text().trim();
                    console.log(' selected mandal is '+selected_mandal_name);

                var villages_list=route_address+'locations/locationdropdownvillage/'+selected_mandal_id+'/'+'$div_id';
        
                    console.log('query on: '+villages_list);
                    $.get(villages_list, function( data ) {
                        $('#village_".$div_id."_area' ).html(data);
                        $('select#village_$div_id > option[value=\"$user->village\"]').attr('selected', 'selected');
                        console.log('user village is :$user->village');
                    });

         });
    });
</script>";
}

$dropdown_html.="<div id='mandal_".$div_id."_area'>
<label class='control-label' for='mandal_$div_id'>mandal</label>

<select class='form-control form-group' name='mandal_$div_id' id='mandal_$div_id'>

<option value='all' data-id='0'  >All</option>



</select>

</div>





<div id='village_".$div_id."_area'>
<label class='control-label' for='village_$div_id'>village</label>

<select class='form-control form-group' name='village_$div_id' id='village_$div_id'>

<option value='all' data-id='0'  >All</option>


</select>

</div>";


$dropdown_html.= "<script>";

$dropdown_html.="$(function() {";

$dropdown_html.="var base_url = window.location.origin;

    var sub_domain='/bsi';

    var route_address=base_url+sub_domain+'/';
    console.log(route_address);

    var selected_state_id=$( '#state_$div_id option:selected' ).attr('data-id');
    var selected_state_name=$( '#state_$div_id option:selected' ).text().trim();
    console.log('state selected is '+selected_state_name);

    $( '#state_$div_id' ).change();
    $( '#district_$div_id' ).change();";
//--------------------------
//on change district
//---------------------------

$dropdown_html.="$(document).on('change','select#district_$div_id',function(){
$( '#mandal_".$div_id."_area' ).html('<img class=\"loader\"   src=\"'+base_url+sub_domain+'/images/horizontal_loader.gif\" alt=\"\" />');

$( '#village_".$div_id."_area' ).html('<img class=\"loader\"   src=\"'+base_url+sub_domain+'/images/horizontal_loader.gif\" alt=\"\" />');


    var selected_district_id=$('#district_$div_id option:selected' ).attr('data-id');
    var selected_district_name=$( '#district_$div_id option:selected' ).text().trim();
    console.log(' selected district$div_id is '+selected_district_name);
   
    var mandals_list=route_address+'locations/locationdropdownmandal/'+selected_district_id+'/'+'$div_id';
    console.log('query on: '+mandals_list);
    $.get(mandals_list, function( data ) {
    //alert(data);
    $( '#mandal_".$div_id."_area' ).html(data);


    var selected_mandal_id=$( '#mandal_$div_id option:selected' ).attr('data-id');
 
    var selected_mandal_name=$( '#mandal_$div_id option:selected' ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);

    var villages_list=route_address+'locations/locationdropdownvillage/'+selected_mandal_id+'/'+'$div_id';
        
    console.log('query on: '+villages_list);
    $.get(villages_list, function( data ) {
    $( '#village_".$div_id."_area' ).html(data);
    var selected_village_name=$( '#village_$div_id option:selected' ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);


    });
});
   

});";

//--------------------------
//on change mandal
//---------------------------

$dropdown_html.="$(document).on('change','select#mandal_$div_id',function(){

$( '#village_".$div_id."_area' ).html('<img class=\"loader\"   src=\"'+base_url+sub_domain+'/images/horizontal_loader.gif\" alt=\"\" />');



    var selected_mandal_id=$( '#mandal_$div_id option:selected' ).attr('data-id');
 
    var selected_mandal_name=$( '#mandal_$div_id option:selected' ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);

    var villages_list=route_address+'locations/locationdropdownvillage/'+selected_mandal_id+'/'+'$div_id';
        
    console.log('query on: '+villages_list);
    $.get(villages_list, function( data ) {
    $( '#village_".$div_id."_area' ).html(data);
    var selected_village_name=$( '#village_$div_id option:selected' ).text().trim();
    console.log(' selected mandal is '+selected_mandal_name);


    });

   

});";

$dropdown_html.= "});";
$dropdown_html.= "</script>";




return $dropdown_html;


    }

}
