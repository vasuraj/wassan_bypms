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
            // echo '<br>------###
            //    #######  returned_key: '.$key.'##########------<br>';
            $extra_id_array[] = $key;
            return $key;
        }
        else
        {
            // echo "<br>-------matching again----------<br>";
            // echo "<br>-------".$length;
            // echo"<br>-------". $table;
            // echo "<br>-------".$field_name;
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
    $states_info      = DB::table('city_list')->orderby('name')->where(array(
        'district_id' => '0',
        'city_id' => '0'
    ))->get();
    
    foreach ($states_info as $state_info)
    {
        $state_counter++;
        echo '<div style="background:#000; color:#fff;">';
        echo '[' . $state_info->id . '] ';
        echo $state_info->name . '<br>';
        
        
        // $states=array();
        // $states['name']=$state_info->name;
        
        // DB::table('states')->insert($states);
        
        $districts_info = DB::table('city_list')->where('district_id', '!=', '0')->where(array(
            'state_id' => $state_info->state_id,
            'city_id' => '0'
        ))->orderby('name')->get();
        
        foreach ($districts_info as $district_info)
        {
            $district_counter++;
            
            
            
            echo '<div style="background:#18c; color:#fff;">';
            echo '[' . $district_info->id . '] ';
            echo $district_info->name . '<br>';
            $mandal_counter = 0;
            
            $mandals_info = DB::table('city_list')->where('city_id', '!=', '0')->where(array(
                'state_id' => $state_info->state_id,
                'district_id' => $district_info->district_id
            ))->orderby('name')->get();
            
            foreach ($mandals_info as $mandal_info)
            {
                $mandal_counter++;
                echo "<div style='background:red;'> $district_counter </div>";
                // 	$states=array();
                // $states['district_id']=$district_counter;
                // $states['name']=$mandal_info->name;                
                // DB::table('mandals')->insert($states);
                echo '<div style="background:#1fc; color:#158;">';
                echo '[' . $mandal_info->id . '] ';
                echo $mandal_info->name . '<br>';
                
                echo "</div>";
                
            }
            echo "Total mandal=$mandal_counter";
            
            echo "</div>";
            
        }
        echo "Total district=$district_counter";
        echo "</div>";
        
    }
    echo "Total state=$state_counter";
    
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






?>