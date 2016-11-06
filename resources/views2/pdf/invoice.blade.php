


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>


<style>

body,html
{
	font-family: Georgia, "Times New Roman", Serif;
}
.content
{
	
	margin-top: 100px;
	width:100%;
}

.footer
{
	
	position: absolute;
	bottom: -100px;
	text-align: center;

}

.footer img
{
width:130%;
margin-left: -150px;

}
.footer span
{
text-align: center;
position: relative;
background:#fff;
color:#555;
border-radius:3px;
padding:3px 10px;
top: -50px;
font-size: 10px;
}

.header
{
	position: absolute;
	top: -80px;
}
.header img
{
width:130%;
margin-left: -50px;
}

.light_text
{
	color:#aaa;
}

.col-md-3
{
	width:20%;
	margin:1%;
}

.col-md-11
{
	width:78%;
	margin: 1%;
}
table td
{
	vertical-align: top;
	
}

div.profile_img
{
	height:100px;
	border-radius: 3px;
	border:8px solid #fff;
	box-shadow: 0px 1px 1px #aaa;
	margin-left: -10px;
	margin-top: -5px;
	overflow: hidden;

}

div.profile_img img
{
	width:80px;


}

hr
{
	color:#ddd;
}

.main_office_address
{
	font-size: 10px;
	margin-bottom: 5px;
}
#Location_details
{
	width:300px;
	float:left;

}

#address
{
	float:right;
	width:400px;
}

#address img
{
	display: block;
width:80px;
}

#address span
{
	display: block;

}

</style>
</head>
<body>

<?php


if(isset($logo_image) && $logo_image!='')
{


$exploded_array=explode('/', $logo_image);

$file_name=$exploded_array[5];


$logo_image_url=public_path('uploads/cropped/').$file_name;


}


if(isset($HON_image) && $HON_image!='')
{


$exploded_array=explode('/', $HON_image);

$file_name=$exploded_array[5];


$HON_image_url=public_path('uploads/cropped/').$file_name;
}


if(isset($field_incharge_image) && $field_incharge_image!='')
{

$exploded_array=explode('/', $field_incharge_image);

$file_name=$exploded_array[5];


$field_incharge_image_url=public_path('uploads/cropped/').$file_name;


}



 


?>
<div class="header">
	<img src="{{public_path().'/'.'bsi-header-small.jpg'}}" alt="">

</div>
<div class="content">

<div class="Ngo_title"> <h3 style="margin:auto; text-align:center; margin-bottom:20px;">{{$name}}</h3></div>

	<table>
		<tr>
			<td>
				
				<div id="Location_details" >
				<table>

					<tr>
						<td>State</td>
						<td>: @if($state!='') {{ strtolower($state)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
				
					<tr>
						<td>District</td>
						<td>: @if($district!='') {{ strtolower($district)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
					<tr>
						<td>Mandal/block</td>
						<td>: @if($mandal!='') {{ strtolower($mandal)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
					<tr>
						<td>Panchayat</td>
						<td>: @if($panchayat!='' && $panchayat!='blank') {{ strtolower($panchayat)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>: @if($village!='') {{ strtolower($village)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
					<tr>
						<td>Habitation</td>
						<td>: @if($habitation!='') {{ strtolower($habitation)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
					</tr>
				</table>
			</div>

			</td>
			<td>
				
				<div id="address">	

				<table>
					<tr>
								
							<td><span>
								{{$full_address}}

								</span>
							</td>

						<td>
						@if(isset($logo_image_url) && $logo_image_url!='')
							<img  class="profile_img"  src="{{$logo_image_url}}" alt="">
						@else
							<div style="height:90px; width:80px; border:1px solid #ddd; text-align:center; padding-top:30px;">Image not available</div>	
						@endif
						</td>
					</tr>
				</table>
								
						
							
				</div>

			</td>
		</tr>
	</table>




<hr>
<div class='person_details row'>
	
<b>Head of the NGO</b>

<table>
	<tr>
		<td>
			<div class="profile_img" >
			@if(isset($HON_image) && $HON_image!='')
				<img  class="profile_img"  src="{{$HON_image_url}}" alt="">
			@else
				<div style="height:90px; width:80px; border:1px solid #ddd; text-align:center; padding-top:30px;">Image not available</div>	
			@endif
			</div>
				
		</td>
		<td>
			
			<table>

		<tr>
			<td>Name</td>
			<td>: @if($HON!='') {{ strtolower($HON)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
	
		<tr>
			<td>Gender</td>
			<td>: @if($gender_HON!='') {{ strtolower($gender_HON)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td>: @if($contact_number_HON!='') {{ strtolower($contact_number_HON)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td>: @if($email_HON!='') {{ strtolower($email_HON)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
	
		</table>



		</td>
	</tr>
</table>
	
			
	
</div>

<hr>

<div class='person_details row'>
	
<b>Data entry operator</b>

<table>
	<tr>
		<td>
			<div class="profile_img" >

			@if(isset($field_incharge_image) && $field_incharge_image!='')
				<img  src="{{$field_incharge_image_url}}" alt="">
			@else
				<div style="height:90px; width:80px; border:1px solid #ddd; text-align:center; padding-top:30px;">Image not available</div>	
			@endif
			</div>
		</td>
		<td>
			
			<table>

		<tr>
			<td>Name</td>
			<td>: @if($field_incharge!='') {{ strtolower($field_incharge)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
	
		<tr>
			<td>Gender</td>
			<td>: @if($gender_field_incharge!='') {{ strtolower($gender_field_incharge)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td>: @if($contact_number_incharge!='') {{ strtolower($contact_number_incharge)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td>: @if($email_incharge!='') {{ strtolower($email_incharge)}} @else <span class="light_text"> Not Mentioned </span> @endif</td>
		</tr>
	
		</table>



		</td>
	</tr>
</table>
	
			
	
</div>


</div>
<hr>
<div id="description">	


		{!! $about !!}

</div>

<div class="footer">
<div class="main_office_address">CMSS Secretariat
12-13-452, Street No. 1, Tarnaka
Secunderabad - 500 017
Tel. No. +91 (040) 27015295 / 96</div>
	<img src="{{public_path().'/'.'bsi-footer-small3.jpg'}}" alt="">


</div>
	
</body>
</html>


