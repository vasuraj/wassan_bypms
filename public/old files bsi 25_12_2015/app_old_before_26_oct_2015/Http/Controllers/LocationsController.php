<?php namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;


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
            foreach($districts as $district)
            {
                $districts_html.="<option value='$district->id'>$district->name</option>";
            }


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


            foreach($mandals as $mandal)
            {
                $mandals_html.="<option value='$mandal->id'>$mandal->name</option>";
            }

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

}
