<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

<style>
	
body,html
{
	min-height:400px;
}
.container
{
	margin:auto;
	width:90%;
}

.profile_pic
{
	width:120px;
	border-radius: 3px;
	
}

*, *:before, *:after {
  box-sizing: border-box;
}

html {
  overflow-y: scroll;
}

body {
  background: #c1bdba;
  font-family: 'Titillium Web', sans-serif;
}

a {
  text-decoration: none;
  color: #1ab188;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
a:hover {
  color: #179b77;
}

.form {
  background: rgba(19, 35, 47, 0.9);
  padding: 40px;
  max-width: 600px;
  margin: 40px auto;
  border-radius: 4px;
  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
}

.tab-group {
  list-style: none;
  padding: 0;
  margin: 0 0 40px 0;
}
.tab-group:after {
  content: "";
  display: table;
  clear: both;
}
.tab-group li a {
  display: block;
  text-decoration: none;
  padding: 15px;
  background: rgba(160, 179, 176, 0.25);
  color: #a0b3b0;
  font-size: 20px;
  float: left;
  width: 50%;
  text-align: center;
  cursor: pointer;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
.tab-group li a:hover {
  background: #179b77;
  color: #ffffff;
}
.tab-group .active a {
  background: #1ab188;
  color: #ffffff;
}

.tab-content > div:last-child {
  display: none;
}

h1 {
  text-align: center;
  color: #ffffff;
  font-weight: 300;
  margin: 0 0 40px;
  float:right;
}

label {
  position: absolute;
  -webkit-transform: translateY(6px);
          transform: translateY(6px);
  left: 13px;
  color: rgba(255, 255, 255, 0.5);
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
  -webkit-backface-visibility: hidden;
  pointer-events: none;
  font-size: 22px;
}
label .req {
  margin: 2px;
  color: #1ab188;
}

label.active {
  -webkit-transform: translateY(50px);
          transform: translateY(50px);
  left: 2px;
  font-size: 14px;
}
label.active .req {
  opacity: 0;
}

label.highlight {
  color: #ffffff;
}

 input, textarea {
  font-size: 22px;
  display: block;
  width: 100%;
  height: 100%;
  padding: 5px 10px;
  background: none;
  background-image: none;
  border: 1px solid #a0b3b0;
  color: #ffffff;
  border-radius: 0;
  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
  transition: border-color .25s ease, box-shadow .25s ease;
}
input:focus, textarea:focus {
  outline: 0;
  border-color: #1ab188;
}

textarea {
  border: 2px solid #a0b3b0;
  resize: vertical;
}

.field-wrap {
  position: relative;
  margin-bottom: 40px;
}

.top-row:after {
  content: "";
  display: table;
  clear: both;
}
.top-row > div {
  float: left;
  width: 48%;
  margin-right: 4%;
}
.top-row > div:last-child {
  margin: 0;
}

.button {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: #1ab188;
  color: #ffffff;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  -webkit-appearance: none;
}
.button:hover, .button:focus {
  background: #179b77;
}

.button-block {
  display: block;
  width: 100%;
}

.forgot {
  margin-top: -20px;
  text-align: right;
}

table tr td
{
width:100%;
min-width:50%;
 font-size: 16px;
 
  height: 100%;
  padding: 5px 10px;
  background: none;
  background-image: none;
 border-bottom: 1px solid #444;
  color: #ffffff;
  border-radius: 0;
  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
  transition: border-color .25s ease, box-shadow .25s ease;

}

</style>

</head>
<body>

<div class="container">

<div class="form">

  <ul class="tab-group">
    <li class="tab active"><a href="#signup">Profile Details</a></li>
    <li class="tab"><a href="#login">Change Password</a></li>
  </ul>

  <div class="tab-content">
    <div id="signup">


     @if(isset($user_specific->HON))

     @if(isset($user_specific->HON_image) && $user_specific->HON_image!='')
      <img class="profile_pic" src="{{$user_specific->HON_image}}" alt="">
     @else
      <img class="profile_pic" style="border-radius:100px;" src="http://localhost/cmss/portraits/5.jpg" alt="">
     @endif

      <h1>{{$user_specific->HON}}</h1>

    
	
	<table>

	<tr>
		<td>Ngo </td>
		<td> {{$user_specific->name}}</td>
	</tr>
	<tr>
		<td>Address</td>
		<td> {{$user_specific->full_address}}</td>
	</tr>
	
	<tr>
		<td>Gender</td>
		<td> {{$user_specific->gender_HON}}</td>
	</tr>
	<tr>
		<td>Contact Number</td>
		<td> {{$user_specific->contact_number_HON}}</td>
	</tr>
	<tr>
		<td>Email Address</td>
		<td> {{$user_specific->email_HON}}</td>
	</tr>
	<tr>
		<td>last Password Chnaged On</td>
		<td>
		@if(trim($user_specific->password_changed_on)==='0000-00-00 00:00:00')
		Never
		@else
		{{$user_specific->password_changed_on}}
		@endif



		</td>
	</tr>
	
</table>

    </div>

    <div id="login">
      

      <form action="/" method="post">

        <div class="field-wrap">
      
          <input type="password" name="old_password" id="old_password" placeholder="Type Old Password Here" required autocomplete="off" />
        </div>

        <div class="field-wrap">
        
          <input type="password" name="new_password" id="new_password" placeholder="Type New Password Here"  required autocomplete="off" />
        </div>

          <div class="field-wrap">
        
          <input type="password" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm New Password"  required autocomplete="off" />
        </div>

        <p class="forgot"><a href="#">Forgot Password?</a></p>

        <button class="button button-block " id="change_password" />Change</button>

      </form>

    </div>

  </div>
  <!-- tab-content -->

</div>
<!-- /form -->
	

	
@endif





<!--  for field incharge -->

     @if(isset($user_specific->field_incharge))

     @if(isset($user_specific->field_incharge_image) && $user_specific->field_incharge_image!='')
      <img class="profile_pic" src="{{$user_specific->field_incharge_image}}" alt="">
     @else
      <img class="profile_pic" style="border-radius:100px;" src="http://localhost/cmss/portraits/5.jpg" alt="">
     @endif

      <h1>{{$user_specific->field_incharge}}</h1>

    
  
  <table>

  <tr>
    <td>Ngo </td>
    <td> {{$user_specific->name}}</td>
  </tr>
  <tr>
    <td>Address</td>
    <td> {{$user_specific->full_address}}</td>
  </tr>
  
  <tr>
    <td>Gender</td>
    <td> {{$user_specific->gender_field_incharge}}</td>
  </tr>
  <tr>
    <td>Contact Number</td>
    <td> {{$user_specific->contact_number_incharge}}</td>
  </tr>
  <tr>
    <td>Email Address</td>
    <td> {{$user_specific->email_incharge}}</td>
  </tr>
  <tr>
    <td>last Password Chnaged On</td>
    <td>
    @if(trim($user_specific->incharge_password_changed_on)==='0000-00-00 00:00:00')
    Never
    @else
    {{$user_specific->incharge_password_changed_on}}
    @endif



    </td>
  </tr>
  
</table>

    </div>

    <div id="login">
      

      <form action="/" method="post">

        <div class="field-wrap">
      
          <input type="password" name="old_password" id="old_password" placeholder="Type Old Password Here" required autocomplete="off" />
        </div>

        <div class="field-wrap">
        
          <input type="password" name="new_password" id="new_password" placeholder="Type New Password Here"  required autocomplete="off" />
        </div>

          <div class="field-wrap">
        
          <input type="password" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm New Password"  required autocomplete="off" />
        </div>

        <p class="forgot"><a href="#">Forgot Password?</a></p>

        <button class="button button-block " id="change_password" />Change</button>

      </form>

    </div>

  </div>
  <!-- tab-content -->

</div>
<!-- /form -->
  

  
@endif









</div>
	


 {!! Html::script('plugins/jquery/jquery.js') !!}
<script>
	
$(function(){

		$('.tab a').on('click', function (e) {
		  
		  e.preventDefault();
		  
		  $(this).parent().addClass('active');
		  $(this).parent().siblings().removeClass('active');
		  
		  target = $(this).attr('href');

		  $('.tab-content > div').not(target).hide();
		  
		  $(target).fadeIn(600);
		  
		});


	$('button#change_password').click(function(e){

      e.preventDefault();
              
        
      var url="{{URL::to('ngo/store_password')}}";
       //alert(url);
        		// ajasx request starts here
            $.ajax({

        			type:'POST',
     			
        			URL:url,
     		          
        			data:{
        				'_token':'{{csrf_token()}}',
        				@if(Auth::user()->linked_with_property==='email_HON')
        				'password_field_name':'current_password_HON',
        				@elseif(Auth::user()->linked_with_property==='email_incharge')
        				'password_field_name':'current_password_incharge',
        				@endif
        				'row_id':'{{Auth::user()->linked_id}}',
        				'table_name':'{{Auth::user()->linked_table}}',
        				'old_password':$('#old_password').val(),
        				'new_password':$('#new_password').val(),
        				'new_password_confirm':$('#new_password_confirm').val(),

        			},
        			cache:false,
        			success:function(data)
        			{
        				console.log(data);
        			}

        		});
            // ajax request ends here



	});
		


});




</script>

</body>
</html>