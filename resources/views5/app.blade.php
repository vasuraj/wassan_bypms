<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <meta name="_token" content="{{ csrf_token() }}"/>

  <title>[WASSAN]| Watershed Support Services and Activities Network</title>

  <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{asset('images/favicon.ico') }}" >

  <!-- Stylesheets -->
  {!! Html::style('css/bootstrap.min.css') !!}
  {!! Html::style('css/bootstrap-extend.css') !!}
  
  {!! Html::style('plugins/animsition/animsition.css') !!}
  {!! Html::style('plugins/asscrollable/asScrollable.css') !!}
  {!! Html::style('plugins/switchery/switchery.css') !!}
  {!! Html::style('plugins/intro-js/introjs.css') !!}
  {!! Html::style('plugins/slidepanel/slidePanel.css') !!}
  {!! Html::style('plugins/flag-icon-css/flag-icon.css') !!}


  <!-- Fonts -->
  {!! Html::style('fonts/web-icons/web-icons.min.css') !!}
  {!! Html::style('fonts/brand-icons/brand-icons.min.css') !!}


  {!! Html::style('plugins/tour/css/hopscotch.min.css') !!}
  {!! Html::style('plugins/confirmation/css/jquery-confirm.css') !!}
  {!! Html::style('plugins/fancybox/jquery.fancybox.css')  !!}
  {!! Html::style('css/site.min.css') !!}

 {!! Html::script('plugins/jquery/jquery.js') !!}
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    {!! Html::script('plugins/html5shiv/html5shiv.min.js') !!}
    <![endif]-->

  <!--[if lt IE 10]>
    {!! Html::script('plugins/media-match/media.match.min.js') !!}
    {!! Html::script('plugins/respond/respond.min.js') !!}
    <![endif]-->

  <!-- Scripts -->
  {!! Html::script('plugins/modernizr/modernizr.js') !!}
  {!! Html::script('plugins/breakpoints/breakpoints.js') !!}

@yield('head')

  <script>
    Breakpoints();
  </script>

  <style>

  .overlay{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.8);
    z-index: 5;
  }

  .overlay-relative{
    position: relative;
    z-index: 7;
  }

  .helper{
    position: absolute;
    top: 0;
    left: 0;
    padding: 5px;
    background: #FFF;
    border-radius: 4px;
    z-index: 6;
 }
 .confirm_highlight
 {
 background:#000;
 color:#fff;
 border-radius:3px;
 padding:3px 10px;
 }


  </style>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  @include('nav')
 
 @include('sidebar')

  <!-- Page -->
  <div class="page">
    <div class="page-content">

     @yield('content')

    </div>
  </div>
  <!-- End Page -->


  <!-- Footer -->
@include('footer')

  <!-- Core  -->
 
  {!! Html::script('plugins/bootstrap/bootstrap.js') !!}
  {!! Html::script('plugins/animsition/jquery.animsition.js') !!}
  {!! Html::script('plugins/asscroll/jquery-asScroll.js') !!}
  {!! Html::script('plugins/mousewheel/jquery.mousewheel.js') !!}
  {!! Html::script('plugins/asscrollable/jquery.asScrollable.all.js') !!}
  {!! Html::script('plugins/ashoverscroll/jquery-asHoverScroll.js') !!}

  <!-- Plugins -->
  {!! Html::script('plugins/switchery/switchery.min.js') !!}
  {!! Html::script('plugins/intro-js/intro.js') !!}
  {!! Html::script('plugins/screenfull/screenfull.js') !!}
  {!! Html::script('plugins/slidepanel/jquery-slidePanel.js') !!}


  <!-- Scripts -->
    {!! Html::script('js/core.js') !!}
    {!! Html::script('js/site.js') !!}

  {!! Html::script('js/sections/menu.js') !!}
  {!! Html::script('js/sections/menubar.js') !!}
  {!! Html::script('js/sections/sidebar.js') !!}

  {!! Html::script('js/configs/config-colors.js') !!}
  {!! Html::script('js/configs/config-tour.js') !!}

  {!! Html::script('js/components/asscrollable.js') !!}
  {!! Html::script('js/components/animsition.js') !!}
  {!! Html::script('js/components/slidepanel.js') !!}
  {!! Html::script('js/components/switchery.js') !!}

  {!! Html::script('plugins/tour/js/hopscotch.min.js') !!}
  {!! Html::script('plugins/confirmation/js/jquery-confirm.js') !!}
  {!! Html::script('plugins/jquery_print/jQuery.print.js') !!}
  {!!  Html::script('plugins/fancybox/jquery.fancybox.js') !!}


@yield('body_bottom')

  <script>
    var base_url = window.location.origin;

    var sub_domain='/cmss';

    var route_address=base_url+sub_domain+'/';
  

  (function(document, window, $) {

  $(".fancybox").fancybox({
         
           
              resize:true,
     
            closeClick  : false,
             openEffect  : 'elastic',
         closeEffect : 'elastic',
        });
    

    $(".fancybox_profile_pic").fancybox({
         
      
            
          
      
           closeClick  : false,
           openEffect  : 'elastic',
           closeEffect : 'elastic',
           helpers     : { 
              overlay : {closeClick: false}
           },
          afterClose : function() 
          {



                  @if(Entrust::hasRole('ngo_field_incharge'))

                  @if(Session::has('user_details'))
                
                  var user_id='{{Auth::user()->linked_id}}';

            
                  $.ajax({
                    type: "GET",
                    url:"{{url::to('image/get_image_field_incharge/')}}"+'/'+user_id,
                    cache: false,
                    success: function(returned_url){
                     
                     var profile_pic=returned_url.replace('cropped','thumb');
                     $('img.profile_img').attr('src',profile_pic);

                  }
                  });

                  @else
                    alert("couldn't find user detials");
                  @endif
                  @endif


          }
        }); 

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 


      'use strict';

      var Site = window.Site;
      $(document).ready(function() {

        Site.run();


//-----------------------
//        tour code
//-----------------------

// Define the tour!
var tour = {
id: "hello-hopscotch",
showPrevButton:true,
xOffset:200,
      steps: [
      @yield('tour')
        {
          title: "left-side options toggle",
          content: "show/hide left side bar",
          target: "site-navbar-collapse",
          width:250,
          placement: "bottom"
        },
        {
          title: "My content",
          content: "Here is where I put my content.",
          target:"toggleFullscreen",
          placement: "bottom"
        },

      ]
    };

    // Start the tour!
    $('#start_tour').click(function(){
    hopscotch.startTour(tour);
    });




//------------------------
// tour code endes here
//-------------------------

// on page load

@yield('jscode')
 $('.btn-edit').click(function(e){
         e.preventDefault();
         var url = $(this).attr('href');
         var url_text = $(this).parent().parent().parent().children().eq(1).text();
         console.log(url_text);

         $.confirm({
          theme: 'supervan',
             title: 'Confirm!',
             content: 'Do you really want to Delete:  <span class="confirm_highlight">'+ url_text +'</span> permission!',

             confirm: function () {

             console.log(url);
             window.location.href = url;
            },


             cancel: function () {
                 //alert('Canceled!')
             }


         });
     });

      });


    $('.page-content col-md-12').bind('resize',function(){

      console.log('resized');

    });


    })(document, window, jQuery);
  </script>

  <script type="text/javascript">
  $.ajaxSetup({
     headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });

 
</script>
</body>
</html>