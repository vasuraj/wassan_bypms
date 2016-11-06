<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Login | BSI</title>

  <link rel="apple-touch-icon" href="../../images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../../images/favicon.ico">

  <!-- Stylesheets -->
  {!! Html::style('css/bootstrap.min.css') !!}
  {!! Html::style('css/bootstrap-extend.min.css') !!}
  {!! Html::style('css/site.min.css') !!}

  <!-- Page -->
  {!! Html::style('css/pages/login.css') !!}

  <!-- Fonts -->
  {!! Html::style('fonts/web-icons/web-icons.min.css') !!}
  {!! Html::style('fonts/brand-icons/brand-icons.min.css') !!}
  {!! Html::style('plugins/asnotification/pnotify.custom.min.css') !!}
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    <script src="../../vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="../../vendor/media-match/media.match.min.js"></script>
    <script src="../../vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  {!! Html::script('plugins/modernizr/modernizr.js') !!}


</head>
<body class="page-login layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <div class="brand">
        <img style="max-width:100px;" class="brand-img" src="{{ asset('images/logo.png') }}" alt="...">
        <h2 class="brand-text">Business Service & Information </h2>
      </div>
      <p>Sign into your BSI account</p>


<!-- 
================================
> form error shoud show here 
================================
-->
<?php

$error_list='';

?>

@if (count($errors) > 0)
    
      @foreach ($errors->all() as $error)
         
              <?php
              $error_list=$error_list. '<br>'. $error;
              ?>

      @endforeach
       
@endif


<!--
================================
 form error section ends here 
================================
 -->
      

<!--
================================
 > form starts from here  
=================================
-->


{!! Form::open(array('url'=>'password/email', 'method'=>'post', 'class'=>'demo')) !!}



    {!! Form::hidden('_token',csrf_token())   !!}

    {!! Form::text('email', old('email'), array('class'=>'form-control form-group ', 'placeholder'=>'Email Address'))  !!}



    {!! Form::submit('Send Password Reset Link', array('class'=>'form-control btn btn-success')) !!}

 

     
{!! Form::close() !!}
     


<!--
==================================
 form ends here 
==================================
-->


      <!-- <p>Still no account? Please go to <a href="register.html">Register</a></p> -->
      <p>Apply for a new account <a href="register.html">Here</a></p>

      <footer class="page-copyright">
        <p>WEBSITE BY <b style="font-size:16px;"><a href="">vishnu prabhkar rajoria</a></b></p>
        <p>© 2015. All RIGHT RESERVED.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
    </div>
  </div>
  <!-- End Page -->


  <!-- Core  -->
  {!! Html::script('plugins/jquery/jquery.js') !!}
  {!! Html::script('plugins/asnotification/pnotify.custom.min.js') !!}
 
<script>

    $(function(){
      @if(!empty($error_list))
        new PNotify({
            title: 'email is not registered. ',
            type:'error',
            text:'{!! HTML::decode($error_list) !!}',
            desktop: {
              desktop: true
            },
            animation:'show',
            shadow:true,
            opacity:1
          
      
        });
      @endif
    });

</script>
</body>

</html>