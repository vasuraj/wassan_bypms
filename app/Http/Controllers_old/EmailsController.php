<?php namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App;
use PDF;


class EmailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ngos.create');
	}


	public function send(Request $request,$email_address=null,$message=null)
	{

		// $data=array('text'=>'data from BSI app');
		// Mail::send('emails.welcome', $data, function ($message) use ($data) {
		// 	$message->subject('Test email from BSI app');
		//     // $message->from('vishnu27990@gmail.com', 'vishnu');

		//     $message->to('vishnu27990@gmail.com', 'vishnu');
		// });

			$backup = Mail::getSwiftMailer();
			$user_data=array();
			$transport = Mail::getSwiftMailer()->getTransport();

			Mail::alwaysFrom(Config::get('mail.from.address'), Config::get('mail.from.name'));

			$transport->setUsername(Config::get('mail.username'));

			$transport->setPassword(Config::get('mail.password'));

			 Mail::send('emails.welcome',$user_data, function($message) 
			 {
			   $message->to('vishnu27990p@gmail.com','vishnu')->subject('Verify your Email ID and secure your account now!');
			 });

			Mail::setSwiftMailer($backup);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		print_r($_POST);
		
	
		

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
		
		

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		

	}


}
