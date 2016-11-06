<?php



function unique_random_string($length = null, $table = null, $field_name = null, $extra_id_array = null)
{
    
    
    $key = '';
    
    $keys = array_merge(range(0, 9), range('a', 'z'));
    
    for ($i = 0; $i < $length; $i++)
    {
        $key .= $keys[array_rand($keys)];
    }
    
    
    
    //------- select all the id from table and store in array
    if (empty($extra_id_array))
    {
        
        $all_id = DB::table($table)->select($field_name)->orderby('name')->get();
        
        //print_r($all_id);
        //---------- store all the key in id_array
        foreach ($all_id as $id)
        {
            $extra_id_array[] = $id->$field_name;
        }
    }
    
    
    if ($key != '')
    {
        if (!in_array($key, $extra_id_array))
        {
            // // echo '<br>------###
            //    #######  returned_key: '.$key.'##########------<br>';
            $extra_id_array[] = $key;
            return $key;
        }
        else
        {
            // // echo "<br>-------matching again----------<br>";
            // // echo "<br>-------".$length;
            // // echo"<br>-------". $table;
            // // echo "<br>-------".$field_name;
            return unique_random_string($length, $table, $field_name, $extra_id_array);
        }
        
        
    }
    
    
    
}


function random_string($length = null)
{
    $key = '';
    
    $keys = array_merge(range(0, 9), range('a', 'z'));
    
    for ($i = 0; $i < $length; $i++)
    {
        $key .= $keys[array_rand($keys)];
    }
    
    return $key;
    
    
}



function parse_mandal()
{
    
    $state_counter    = 0;
    $district_counter = 0;
    $states_info      = DB::table('locations')->orderby('name')->where(array(
        'district_id' => '0',
        'mandal_id' => '0',
        'village_id'=>'0'
    ))->get();
    
    foreach ($states_info as $state_info)
    {
        $state_counter++;
        // echo '<div style="background:#000; color:#fff;">';
        // echo '[' . $state_info->id . '] ';
        // echo $state_info->name . '<br>';
        
        // insert states in 'states' DB
        $states=array();
        $states['country_id']='91';
        $states['name']=$state_info->name;
        DB::table('states')->insert($states);
        

        // select all district belongs to current select state
        $districts_info = DB::table('locations')->where('district_id', '!=', '0')->where(array(
            'state_id' => $state_info->state_id,
            'mandal_id' => '0',
        'village_id'=>'0'
        ))->orderby('name')->get();
        

        // loop over each district 
        foreach ($districts_info as $district_info)
        {
            $district_counter++;
            // echo '<div style="background:#18c; color:#fff;">';
            // echo '[' . $district_info->id . '] ';
            // echo $district_info->name . '<br>';
            
                $district=array();
                $district['state_id']=$state_counter;
                $district['name']=$district_info->name;
                DB::table('districts')->insert($district);
                

            $mandal_counter = 0;
           
           //  select all mandal from current select district

            $mandals_info = DB::table('locations')->where('city_id', '!=', '0')->where(array(
                'state_id' => $state_info->state_id,
                'district_id' => $district_info->district_id
            ))->orderby('name')->get();
            
          
        // loop over each mandal from current selected district
            foreach ($mandals_info as $mandal_info)
            {
                $mandal_counter++;
                // echo "<div style='background:red;'> $district_counter </div>";
                
            // insert mandal data in database 
                $mandal=array();
                $mandal['district_id']=$district_counter;
                $mandal['name']=$mandal_info->name;                
                DB::table('mandals')->insert($mandal);
                

                // echo '<div style="background:#1fc; color:#158;">';
                // echo '[' . $mandal_info->id . '] ';
                // echo $mandal_info->name . '<br>';
                
                // echo "</div>";
                
            }
            // echo "Total mandal=$mandal_counter";
            
            // echo "</div>";
            
        }
        // echo "Total district=$district_counter";
        // echo "</div>";
        
    }
    // echo "Total state=$state_counter";
    
}




function parse_village()
{

    
    $state_counter    = 0;
    $district_counter = 0;
     $mandal_counter = 0;
           
    $states_info      = DB::table('villagelocations')->orderby('name')->where('state_id', '!=', '0')->where(array(
        'district_id' => '0',
        'mandal_id' => '0',
        'village_id'=>'0'
    ))->get();
    
    foreach ($states_info as $state_info)
    {
        $state_counter++;
        // echo '<div style="background:#000; color:#fff;">';
        // echo '[' . $state_info->id . '] ';
        // echo 'in '.$state_info->name . '<br>';
        
        // insert states in 'states' DB
        $states=array();
        $states['country_id']='91';
        $states['name']=$state_info->name;
        DB::table('states')->insert($states);
        

        // select all district belongs to current select state
        $districts_info = DB::table('villagelocations')->where('district_id', '!=', '0')->where(array(
            'state_id' => $state_info->state_id,
            'mandal_id' => '0',
            'village_id'=>'0'
        ))->orderby('name')->get();
        

        // loop over each district 
        foreach ($districts_info as $district_info)
        {
            $district_counter++;
            // echo '<div style="background:#18c; color:#fff;">';
            // echo '[' . $district_info->id . '] ';
            // echo 'in '.$district_info->name . '<br>';
            
                $district=array();
                $district['state_id']=$state_counter;
                $district['name']=$district_info->name;
                DB::table('districts')->insert($district);
                

           
           //  select all mandal from current select district

            $mandals_info = DB::table('villagelocations')->where('mandal_id', '!=', '0')->where(array(
                'state_id' => $state_info->state_id,
                'district_id' => $district_info->district_id,
                'village_id'=>'0'
            ))->orderby('name')->get();
            
          
        // loop over each mandal from current selected district
            foreach ($mandals_info as $mandal_info)
            {
                $mandal_counter++;
                // // echo "<div style='background:#058;'> $district_counter </div>";
                
            // insert mandal data in database 
                $mandal=array();
                $mandal['district_id']=$district_counter;
                $mandal['name']=$mandal_info->name;                
                DB::table('mandals')->insert($mandal);
                
     
                // echo '<div style="background:#1fc; color:#158;">';
                // echo 'in [' . $mandal_info->id . '] ';
                // echo $mandal_info->name . '<br>';
                
                // echo "</div>";



           
        // village code starts here
            $village_counter = 0;
           
           //  select all mandal from current select district

            $villages_info = DB::table('villagelocations')->where('village_id', '!=', '0')->where(array(
                'state_id' => $state_info->state_id,
                'district_id' => $district_info->district_id,
                'mandal_id'=>$mandal_info->mandal_id
            ))->orderby('name')->get();
            
          
        // loop over each mandal from current selected district
            foreach ($villages_info as $village_info)
            {
                $village_counter++;
                // // echo "<div style='background:orange;'> $village_counter </div>";
                
            // insert village data in database 
                $village=array();
                $village['mandal_id']=$mandal_counter;
                $village['panchayat_id']=0;
                $village['name']=$village_info->name;                
                DB::table('villages')->insert($village);
                

                // echo '<div style="background:ornage; color:#158;">';
                // echo '[' . $village_info->id . '] ';
                // echo $village_info->name . '<br>';
                
                // echo "</div>";
                
            }

            // village code ends here

                
            }
            // echo "Total mandal=$mandal_counter";
            
            // echo "</div>";
            
        }
        // echo "Total district=$district_counter";
        // echo "</div>";
        
    }
    // echo "Total state=$state_counter";
    
}

function get_states()
{
    
    $states = DB::table('states')->orderby('name')->get();
    
	return $states;
    
}

function get_states_json()
{
    
    $states = DB::table('states')->orderby('name')->get();
    
    return response()->json($states);
    
}

function get_state($state_id=null)
{
    $state=DB::table('states')->where('id','=',$state_id)->first();
    return $state;
}


function get_state_json($state_id=null)
{
	$state=DB::table('states')->where('id','=',$state_id)->first();
	return response()->json($state);
}






function get_districts($state_id=null)
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


function get_districts_json($state_id=null)
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

function get_district($district_id=1)
{
	$district=DB::table('districts')->where('id','=',$district_id)->first();
	return $district;
}


function get_district_json($district_id=1)
{
    $district=DB::table('districts')->where('id','=',$district_id)->first();
    return response()->json($district);
}






function get_mandals($district_id=null)
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


function get_villages($mandal_id=null)
{
    
    if($mandal_id!=null){

        $villages = DB::table('villages')->where('mandal_id','=',$mandal_id)->orderby('name')->get();
    }
    else
    {
        $villages = DB::table('villages')->orderby('name')->get();
    }
    
    
    return $villages;
    
}

function get_mandals_json($district_id=null)
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


function get_mandal($mandal_id=1)
{
	$mandal=DB::table('mandals')->where('id','=',$mandal_id)->orderby('name')->first();
	return $mandal;
}



function get_mandal_json($mandal_id=1)
{
    $mandal=DB::table('mandals')->where('id','=',$mandal_id)->orderby('name')->first();
    return response()->json($mandal);
}

function set_state()
{
    $data= array();
    $data['state']="ANDHRA PRADESH";
    DB::table('farmers')->where('state','')->update($data);
}


function set_district()
{
    $data= array();
    $data['district']="Mahbubnagar";
    
    DB::table('farmers')->where('mandal','BOMRASPET')->update($data);
}

function set_mandal()
{
    $data= array();
    $data['mandal']="Bomraspet";
    
    DB::table('farmers')->where('mandal','BOMRASPET')->update($data);
}

function set_village()
{

    // ** add Ramankuntathanda in doualthabad
    // ** add Gundlapally,Malreddipally,Chintagattuthanda in kosgi
    // ** add HAMSANPALLY,Sagaramthanda,Lagcherla,Mahantipur thanda in bombraspet
    $data= array();
    $data['village']="Hamsanpally";
    
    DB::table('farmers')->where('village','HAMSANPALLY')->update($data);
}


?>