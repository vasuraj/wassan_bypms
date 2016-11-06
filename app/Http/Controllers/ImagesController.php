<?php namespace App\Http\Controllers;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Flash;
use URL;
use Request;
use Input;
use Storage;
use File;
use Response;
use Image;
use Entrust;


class ImagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
	{
		//$this->middleware('guest');
		$this->middleware('auth', ['only' => 'logged']);
	}


	public function index()
	{
	echo "Images controller index working!!!";
	

	}

	public function get_image($filename)
	{
	
	$path = storage_path('uploads/img/original/'). $filename;

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
	//echo $type;
   	//return $response;
   	return Image::make($path)->response('jpg');

	}

	public function get_image_cropped($filename)
	{
	
	$path = storage_path('uploads/img/cropped') . '/' . $filename;

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
	//echo $type;
   	//return $response;
   	return Image::make($path)->response('jpg');

	}

	public function get_image_thumb($filename)
	{
	
	$path = storage_path('uploads/img/cropped/').$filename;

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
	//echo $type;
   	//return $response;
   	return Image::make($path)->response('jpg');

	}


	public function get_image_field_incharge($ngo_id)
	{

		$field_incharge_image=DB::table('ngos')->select('field_incharge_image')->where('id','=',$ngo_id)->first();

		return $field_incharge_image->field_incharge_image;

	}

	public function get_image_ngo_head($ngo_id)
	{

		$HON_image=DB::table('ngos')->select('HON_image')->where('id','=',$ngo_id)->first();

		return $HON_image->HON_image;

	}



	public function upload_profile_pic()
	{
		return view('images.upload_profile_pic');
	}

	public function profile_pic_store()
	{	
		$data=array();
		
		if(Entrust::hasRole('ngo_field_incharge'))
		{
			$data=array();
			$data['field_incharge_image']=$_POST['profile_pic'];
			DB::table($_POST['table_name'])->where('id','=',$_POST['id'])->where($_POST['email_field_title'],'=',Auth::user()->email)->update($data);
		}
		elseif(Entrust::hasRole('ngo_head'))
		{
			$data=array();
			$data['HON_image']=$_POST['profile_pic'];
			DB::table($_POST['table_name'])->where('id','=',$_POST['id'])->where($_POST['email_field_title'],'=',Auth::user()->email)->update($data);
		}

		print_r($_POST);
		print_r($data);
		return 'profile pic updated successfully';
	}



	public function image_save_to_file(Request $request, $category_name=null)
	{
		
		if (Request::ajax())
		{

			$image = Input::file('img');
				
			$imagePath = storage_path('uploads/img/original');
		
			

			

			$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
			
			$extension = $image->guessClientExtension();

			
			//Check write Access to Directory

			if(!is_writable($imagePath)){
				$response = Array(
					"status" => 'error',
					"message" => 'Can`t upload File; no write Access at '.$imagePath
				);
				print json_encode($response);
				return;
			}
			
			if ( in_array($extension, $allowedExts))
			  {
			  if ($_FILES["img"]["error"] > 0)
				{
					 $response = array(
						"status" => 'error',
						"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
					);			
				}
			  else
				{
					
			      //$filename = $image->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				$filename =$category_name.'_img_'.date('d_m_Y_h_i_s_A').'.'.$extension;
				
				 $image->move($imagePath,$filename);
		  		 list($width, $height) = getimagesize( $imagePath.'/'.$filename );

				  $response = array(
					"status" => 'success',
					"url" => URL::to('image/get_image').'/'.$filename,
					"width" => $width,
					"height" => $height
				  );


				  
				}
			  }
			else
			  {
			   $response = array(
					"status" => 'error',
					"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
				);
			  }
			

			print json_encode($response);
		}
	}


//  image crop 

	public function image_crop_to_file(Request $request)
	{
		
	$filename=str_replace(URL::to('image/get_image/'),'',$_POST['imgUrl']);
	$imgUrl = storage_path('uploads/img/original/').$filename;
	$extension=substr(strrchr($filename,'.'),1);

	// original sizes
	$imgInitW = $_POST['imgInitW'];
	$imgInitH = $_POST['imgInitH'];
	// resized sizes
	$imgW = $_POST['imgW'];
	$imgH = $_POST['imgH'];
	// offsets
	$imgY1 = $_POST['imgY1'];
	$imgX1 = $_POST['imgX1'];
	// crop box
	$cropW = $_POST['cropW'];
	$cropH = $_POST['cropH'];
	// rotation angle
	$angle = $_POST['rotation'];

	$jpeg_quality = 100;

//$output_filename = storage_path('uploads')."/croppedImg_".rand().date('d_m_Y_h_i_s_A');
//echo $output_filename;
$output_filename = storage_path('uploads/img/cropped/').str_replace('.'.$extension,'',$filename);



$what = getimagesize($imgUrl);

//$what['mime']=$mime = Image::make(storage_path('uploads').'/'.'Lighthouse.jpg')->mime();

switch(strtolower($what['mime']))
{
    case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		error_log("jpg");
		$type = '.jpeg';
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported'.print_r($_POST).$mime);
}


//Check write Access to Directory

if(!is_writable(dirname($output_filename))){
	$response = Array(
	    "status" => 'error',
	    "message" => 'Can`t write cropped File'
    );	
}else{

    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage,$source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $output_filename.$type, $jpeg_quality);

	// ----------------------------------------

	


	$outputFilename=str_replace(storage_path('uploads/'),'',$output_filename.$type);
	$outputUrl=URL::to('image/get_image/cropped/').str_replace('img/cropped', '', $outputFilename);

	// create instance
	$img = Image::make(storage_path('uploads').'/'.$outputFilename);

	// resize the image to a width of 300 and constrain aspect ratio (auto height)
	$img->resize(40, null, function ($constraint) {
	    $constraint->aspectRatio();
	});
	
	$img->save(storage_path('uploads/img/cropped/').str_replace('img/cropped', '', $outputFilename));


	
	$response = Array(
	    "status" => 'success',
	    "url" => str_replace('localhost/','',str_replace('//', '/',$outputUrl))
	    );
	}
	print json_encode($response);
	}





}
