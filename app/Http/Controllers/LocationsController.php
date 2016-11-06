<?php namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use URL;
use App\Http\Controllers\Controller;
use stdClass;
use Redirect;
use Session;


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


public function add_village($village_id=null)
{
    if($village_id==null)
    {
        return view('locations/add_village');
    }
    else
    {
        $data['village']=DB::table('villages')->where('id','=',$village_id)->first();
        return view('locations/edit_village',$data);
    }

}


    public function store_village($mandal_id=null, $panchayat_id=null)
    {
        if($_POST['mandal_id']!=null && $_POST['panchayat_id']!=null)
        {
            $data=array();
            $data['mandal_id']=$_POST['mandal_id'];
            $data['panchayat_id']=$_POST['panchayat_id'];
            $data['name']=$_POST['village_name'];
            $saved_record=DB::table('villages')->insertGetId($data);

            if($saved_record){
                return "village saved successfully";
            }

        }else{
            return "village couldn't be added to database";
        }


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

//  state code


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



// district code


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
    
        $districts_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

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

// mandal code


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
            
            $mandals_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

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






    public function get_ngos_dropdown($district=null)
    {
        $ngos_html='';
        if($district!=null){

            $ngos = DB::table('ngos')->where('district','=',$district)->orderby('name')->get();

            $ngos_html.='<label class="control-label" for="ngo">ngo</label>';

            $ngos_html.='<select class="form-control form-group" name="ngo" id="ngo">';
            
            $ngos_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

            foreach($ngos as $ngo)
            {
                $ngos_html.="<option data-id='$ngo->id' value='$ngo->name'>$ngo->name</option>";
            }
            $ngos_html.='</select>';

        }
        else
        {
            $ngos = DB::table('ngos')->orderby('name')->get();
        }


        return $ngos_html;

    }



    public function get_select_mandals_dropdown($district_id=null)
    {

        $mandals_html='';
   
                if($district_id!=null){

                    $mandals = DB::table('mandals')->where('district_id','=',$district_id)->orderby('name')->get();

                    $mandals_html.='<label class="control-label" for="mandal">mandal</label>';

                    $mandals_html.='<select class="form-control form-group" name="mandal" id="mandal">';
                    $mandals_html.="<option value='' data-id='none'>    Do Not Mention </option>";




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


    // mvk code

    public function get_mvks($district_id=null)
    {

        if($district_id!=null){

            $mvks = DB::table('mvks')->where('district_id','=',$district_id)->orderby('name')->get();
        }
        else
        {
            $mvks = DB::table('mvks')->orderby('name')->get();
        }


        return $mvks;

    }


    public function get_mvks_dropdown($mandal_id=null)
    {
        $mvks_html='';
        if($mandal_id!=null){

            $mvks = DB::table('mvks')->where('mandal_id','=',$mandal_id)->orderby('name')->get();

            $mvks_html.='<label class="control-label" for="mvk">mvk</label>';

            $mvks_html.='<select class="form-control form-group" name="mvk" id="mvk">';
            
            $mvks_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

            foreach($mvks as $mvk)
            {
                $mvks_html.="<option data-id='$mvk->id' value='$mvk->name'>$mvk->name</option>";
            }
            $mvks_html.='</select>';

        }
        else
        {
            $mvks = DB::table('mvks')->orderby('name')->get();
        }


        return $mvks_html;

    }

// panchayat code

     public function get_panchayats_dropdown($mandal_id=null)
    {
        $panchayats_html='';
        if($mandal_id!=null){

            $panchayats = DB::table('panchayats')->where('mandal_id','=',$mandal_id)->orderby('name')->get();


           $panchayats_html.='<label class="control-label" for="panchayat">panchayat</label>';

          $panchayats_html.=' <select  class="form-control form-group" name="panchayat" id="panchayat"> ';
           $panchayats_html.=" <option data-id='none' value='' >Do Not Mention</option> ";

                foreach($panchayats as $panchayat)
                {
                    $panchayats_html.=" <option data-id='$panchayat->id' value='$panchayat->name'>$panchayat->name</option> ";
                }
           $panchayats_html.=' </select> ';

        }
        else
        {

            $panchayats = DB::table('panchayats')->orderby('name')->get();
        }


        return $panchayats_html;

    }


      public function get_mvk_panchayats_dropdown($mvk_id=null)
    {
        $panchayats_html='';
        if($mvk_id!=null){

            $mvk = DB::table('mvks')->select('panchayat_ids','panchayat_names')->where('id','=',$mvk_id)->first();

            



           $panchayats_html.='<label class="control-label" for="panchayat">panchayat</label>';

           $panchayats_html.=' <select  class="form-control form-group" name="panchayat" id="panchayat"> ';
           $panchayats_html.=" <option data-id='none' value='' >Do Not Mention</option> ";

            if( $mvk!=null || !empty($mvk))
            {
            $panchayat_ids=explode('+',$mvk->panchayat_ids);
            $panchayat_names=explode('+',$mvk->panchayat_names);
                for($i=0;$i<count($panchayat_ids); $i++)
                {
                        $panchayats_html.=" <option data-id='$panchayat_ids[$i]' value='$panchayat_names[$i]'>$panchayat_names[$i]</option> ";
                }
            }
           $panchayats_html.=' </select> ';

        }
        else
        {

            $panchayats = DB::table('panchayats')->orderby('name')->get();
        }


        return $panchayats_html;

    }



// village code

    public function get_villages_dropdown($panchayat_id=null)
    {
        $villages_html='';
        if($panchayat_id!=null){
        
        if($panchayat_id!='' && $panchayat_id!='none' && $panchayat_id!='undefined' )
        {
            $villages = DB::table('villages')->where('panchayat_id','=',$panchayat_id)->orderby('name')->get();
        }

        $villages_html.='<label class="control-label" for="village">village</label>';
       

        $villages_html.=' <select  class="form-control form-group" name="village" id="village"> ';
        
        $villages_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

        if($panchayat_id!='' && $panchayat_id!='none' && $panchayat_id!='undefined'  )
        {
               foreach($villages as $village)
                {
                    $villages_html.=" <option data-id='$village->id' value='$village->name'>$village->name</option> ";
                }
        }
           $villages_html.=' </select> ';

        }
      

        return $villages_html;

    }

    public function get_select_villages_dropdown($panchayat_id=null)
    {
        $villages_html='';
        if($panchayat_id!=null){

        
        $villages = DB::table('villages')->where('panchayat_id','=',$panchayat_id)->orderby('name')->get();


           $villages_html.='<label class="control-label" for="village">village</label>';

          $villages_html.=' <select  class="form-control form-group" name="village" id="village"> ';
        $villages_html.="<option value='' data-id='none'>    Do Not Mention </option>";

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


      public function locationDropdownVillage($mandal_id=null,$div_id=null)
    {

        $villages_html='';
   
                if($mandal_id!=null){

                    if($mandal_id!='none' && $mandal_id!='undefined')
                    {
                    $villages = DB::table('villages')->where('mandal_id','=',$mandal_id)->orderby('name')->get();
                    }

                    $villages_html.="<form id='village_$div_id-form'>";
                    $villages_html.="<label class='control-label' for='village_$div_id'>village</label><br>";

                    $villages_html.="<select style='width:100%;' class'form-control form-group' name='village_$div_id' id='village_$div_id'>";
                    $villages_html.="<option data-id='0' value='all'>All</option>";
                         if($mandal_id!='none')
                        {
                            foreach($villages as $village)
                            {
                                $villages_html.="<option data-id='$village->id' value='$village->name'>$village->name</option>";
                            }
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


    public function get_village_multiselct($panchayat_id=null)
    {
        $villages_list=array();
        $villages_list_html='';

        if($panchayat_id!=null)
        {
                $villages_list=DB::table('villages')->select('id','name')->where('panchayat_id',$panchayat_id)->get();
                

                foreach ($villages_list as $village) 
                {

                 $villages_list_html.="<option data-content=\"$village->name\" value='$village->id'>$village->name</option>";

                }

            
            return $villages_list_html;  
            }else{
            return "<script>alert('nothing to return');</script>"; 
        }

         
                    

    }



  

// habitation code


     public function get_habitations_dropdown($village_id=null)
    {
        $habitations_html='';
        if($village_id!=null){

            $habitations = DB::table('habitations')->where('village_id','=',$village_id)->orderby('name')->get();


           $habitations_html.='<label class="control-label" for="habitation">habitation</label>';

          $habitations_html.=' <select  class="form-control form-group" name="habitation" id="habitation"> ';
          $habitations_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

                foreach($habitations as $habitation)
                {
                    $habitations_html.=" <option data-id='$habitation->id' value='$habitation->name'>$habitation->name</option> ";
                }
           $habitations_html.=' </select> ';

        }
        else
        {

            $habitations = DB::table('habitations')->orderby('name')->get();
        }


        return $habitations_html;

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


public function reset_location($session_variable)
{

   Session::pull($session_variable);
    return Redirect::back();
}



    public function get_panchayt_multiselct($mandal_id=null)
    {
        $panchayats_list=array();
        
        if($mandal_id!=null)
        {
            $panchayats_list=DB::table('panchayats')->select('id','name')->where('mandal_id',$mandal_id)->get();
            $panchayats_list_html='';

            foreach ($panchayats_list as $panchayat) {
            
             $panchayats_list_html.="<option data-content=\"$panchayat->name\" value='$panchayat->id'>$panchayat->name</option>";

        }

        
        return $panchayats_list_html;  
        }
        else
        {
            return "<script>alert('nothing to return');</script>"; 
        }

         
                    

    }


public function add_mvk($mvk_id=null)
{
    if($mvk_id==null)
    {
        return view('locations/add_mvk');
    }
    else
    {
        $data['mvk']=DB::table('mvks')->where('id','=',$mvk_id)->first();
        return view('locations/edit_mvk',$data);
    }

}





    public function store_mvk($mvk_id=null)
    {
        if($mvk_id==null)
        {


        $mvk_data=array();
        $mvk_data['state_id']=$_POST['state_id'];
        $mvk_data['state_name']=$_POST['state_name'];

        $mvk_data['district_id']=$_POST['district_id'];
        $mvk_data['district_name']=$_POST['district_name'];

        $mvk_data['mandal_id']=$_POST['mandal_id'];
        $mvk_data['mandal_name']=$_POST['mandal_name'];
        $mvk_data['panchayat_ids']=implode('+',$_POST['selected_panchayat_ids']);

        $mvk_data['name']=$_POST['name'];
        $mvk_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();

        $mvk_data['panchayat_names']='';
        foreach ($_POST['selected_panchayat_ids'] as $panchayat_id) {

            $panchayat_name=DB::table('panchayats')->select('name')->where('id','=',$panchayat_id)->first();
            $mvk_data['panchayat_names'].='+'.$panchayat_name->name;
        }

        $mvk_data['panchayat_names']=ltrim($mvk_data['panchayat_names'],'+');
       
       $mvk_insert_id=DB::table('mvks')->insertGetId($mvk_data);

        return "sucessfully added MVK with name ".$mvk_data['name']." with ID: ".$mvk_insert_id; 
    }

        else
        {
            $mvk_data=array();
            $mvk_data['panchayat_ids']=implode('+',$_POST['selected_panchayat_ids']);

            $mvk_data['name']=$_POST['name'];
            $mvk_data['updated_at']=\Carbon\Carbon::now()->toDateTimeString();

            $mvk_data['panchayat_names']='';
            foreach ($_POST['selected_panchayat_ids'] as $panchayat_id) {

                $panchayat_name=DB::table('panchayats')->select('name')->where('id','=',$panchayat_id)->first();
                $mvk_data['panchayat_names'].='+'.$panchayat_name->name;
            }

            $mvk_data['panchayat_names']=ltrim($mvk_data['panchayat_names'],'+');
           
            DB::table('mvks')->where('id','=',$mvk_id)->update($mvk_data);

            return "sucessfully added MVK with name ".$mvk_data['name']." with ID: ".$mvk_id; 
        }
   

    }
    
    // public function view_mvk($mvk_id=null)
    // {

    //     $data=array();
    //     if($mvk_id!=null)
    //     {
    //         $data['mvks']=DB::table('mvks')->where('id','=',$mvk_id)->get();
    //     }
    //     else
    //     {
    //         $data['mvks']=DB::table('mvks')->get();
    //     }
    //  return view('locations.getmvks',$data);
    // }

    public function view_mvk($mvk_id=null)
    {

        $data=array();
        if($mvk_id!=null)
        {
            $data['mvks']=DB::table('mvks')->where('id','=',$mvk_id)->get();
        }
        else
        {
            $mvk_id_array=array();
            $mvk_ids=DB::table('mvks')->select('id')->get();
            foreach ($mvk_ids as $mvk_id) {
                $mvk_id_array[]=$mvk_id->id;
            }

            $mvks=array();
           // print_r($mvk_id_array);

            $mvk_states=DB::table('mvks')->select('state_id','state_name')->groupby('state_id')->get();

      
           

            $data['mvk_states']=$mvk_states;

        }
     return view('locations.view_mvk',$data);
    }

    public function delete_mvk($mvk_id=null)
    {
        if($mvk_id!=null)
        {
            DB::table('mvks')->where('id','=',$mvk_id)->delete();
        }

        return Redirect::back();
    }






    /*
    * Here is the code for adding bypms Cluster
    *
    */

        public function add_bypms_cluster($bypms_cluster_id=null)
        {
            if($bypms_cluster_id==null)
            {
                return view('locations/add_bypms_cluster');
            }
            else
            {

                $data['bypms_cluster']=DB::table('bypms_clusters')->where('id','=',$bypms_cluster_id)->first();
                return view('locations/edit_bypms_cluster',$data);

            }

        }

           public function get_bypms_clusters_dropdown($panchayat_id=null)
            {
                $bypms_clusters_html='';
                if($panchayat_id!=null){
                
                if($panchayat_id!='' && $panchayat_id!='none' && $panchayat_id!='undefined' )
                {
                    $bypms_clusters = DB::table('bypms_clusters')->where('panchayat_id','=',$panchayat_id)->orderby('name')->get();
                }

                $bypms_clusters_html.='<label class="control-label" for="bypms_cluster">bypms_cluster</label>';
               

                $bypms_clusters_html.=' <select  class="form-control form-group" name="bypms_cluster_id" id="bypms_cluster"> ';
                
                $bypms_clusters_html.=" <option data-id='none' value=''>Do Not Mention</option> ";

                if($panchayat_id!='' && $panchayat_id!='none' && $panchayat_id!='undefined'  )
                {
                       foreach($bypms_clusters as $bypms_cluster)
                        {
                            $bypms_clusters_html.=" <option data-id='$bypms_cluster->id' value='$bypms_cluster->id'>$bypms_cluster->name</option> ";
                        }
                }
                   $bypms_clusters_html.=' </select> ';

                }
              

                return $bypms_clusters_html;

            }





            public function store_bypms_cluster($bypms_cluster_id=null)
            {
                if($bypms_cluster_id==null)
                {


                    $bypms_cluster_data=array();
                    $bypms_cluster_data['state_id']=$_POST['state_id'];
                    $bypms_cluster_data['state_name']=$_POST['state_name'];

                    $bypms_cluster_data['district_id']=$_POST['district_id'];
                    $bypms_cluster_data['district_name']=$_POST['district_name'];

                    $bypms_cluster_data['mandal_id']=$_POST['mandal_id'];
                    $bypms_cluster_data['mandal_name']=$_POST['mandal_name'];

                    $bypms_cluster_data['panchayat_id']=$_POST['panchayat_id'];
                    $bypms_cluster_data['panchayat_name']=$_POST['panchayat_name'];

                    $bypms_cluster_data['village_ids']=implode('+',$_POST['selected_village_ids']);

                    $bypms_cluster_data['name']=$_POST['name'];
                    $bypms_cluster_data['created_at']=\Carbon\Carbon::now()->toDateTimeString();

                    $bypms_cluster_data['village_names']='';
                    foreach ($_POST['selected_village_ids'] as $village_id) {

                        $village_name=DB::table('villages')->select('name')->where('id','=',$village_id)->first();
                        $bypms_cluster_data['village_names'].='+'.$village_name->name;
                    }

                    $bypms_cluster_data['village_names']=ltrim($bypms_cluster_data['village_names'],'+');
                   
                   $bypms_cluster_insert_id=DB::table('bypms_clusters')->insertGetId($bypms_cluster_data);

                    return "sucessfully added bypms_cluster with name ".$bypms_cluster_data['name']." with ID: ".$bypms_cluster_insert_id; 
                }else{
                    
                    $bypms_cluster_data=array();
                    $bypms_cluster_data['village_ids']=implode('+',$_POST['selected_village_ids']);

                    $bypms_cluster_data['name']=$_POST['name'];
                    $bypms_cluster_data['updated_at']=\Carbon\Carbon::now()->toDateTimeString();

                    $bypms_cluster_data['village_names']='';
                    foreach ($_POST['selected_village_ids'] as $village_id) {

                        $village_name=DB::table('villages')->select('name')->where('id','=',$village_id)->first();
                        $bypms_cluster_data['village_names'].='+'.$village_name->name;
                    }

                    $bypms_cluster_data['village_names']=ltrim($bypms_cluster_data['village_names'],'+');
                   
                    DB::table('bypms_clusters')->where('id','=',$bypms_cluster_id)->update($bypms_cluster_data);

                    return "sucessfully added bypms_cluster with name ".$bypms_cluster_data['name']." with ID: ".$bypms_cluster_id; 
                }
           

            }


            public function view_bypms_clusters($bypms_cluster_id=null)
            {

                $data=array();
                if($bypms_cluster_id!=null)
                {
                    $data['bypms_clusters']=DB::table('bypms_clusters')->where('id','=',$bypms_cluster_id)->get();
                }
                else
                {
                    $bypms_cluster_id_array=array();
                    $bypms_cluster_ids=DB::table('bypms_clusters')->select('id')->get();
                    foreach ($bypms_cluster_ids as $bypms_cluster_id) {
                        $bypms_cluster_id_array[]=$bypms_cluster_id->id;
                    }

                    $bypms_clusters=array();
                   // print_r($bypms_cluster_id_array);

                    $bypms_cluster_states=DB::table('bypms_clusters')->select('state_id','state_name')->groupby('state_id')->get();

              
                   

                    $data['bypms_cluster_states']=$bypms_cluster_states;

                }
             return view('locations.view_bypms_clusters',$data);
            }



            public function delete_bypms_cluster($bypms_cluster_id=null)
            {
                if($bypms_cluster_id!=null)
                {
                    DB::table('bypms_clusters')->where('id','=',$bypms_cluster_id)->delete();
                }

                return Redirect::back();
            }


}
