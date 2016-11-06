<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload profile pic</title>
	{!! 	Html::style('plugins/croppic/croppic.css')	!!}

	<style>

#profile_pic
{ 
 min-width:150px;
 min-height:120px; 
 max-width:150px; 
 position: relative; 
 border:1px solid #ccc;
 margin:auto;
}

body
{
	text-align: center;
	min-height: 200px;
	overflow: hidden;
}
@keyframes button-loading {
  20% {
    color: transparent;
    transform: scale(1, 1);
  }
  40% {
    border-color: #5585ff;
    background-color: transparent;
    transform: scale(1, 1);
  }
  60% {
    transform: scale(0.7, 1.1);
    
    width: 2.5rem;
    text-indent: -0.6125rem;
    color: transparent;
    border-color: #5585ff;
    background-color: #5585ff;
  }
  80% {
    transform: scale(1, 1);
  }
  100% {
   
    width: 2.5rem;
    background-color: #5585ff;
    border-color: #5585ff;
    color: transparent;
  }
}
@keyframes button-dot-intro {
  0% {
    opacity: 0;
  }
  60% {
    opacity: 1;
    transform: scale(1, 1);
  }
  100% {
    transform: scale(0.75, 0.75);
  }
}
@keyframes button-dot-pulse {
  0% {
    opacity: 1;
    transform: scale(0.75, 0.75);
  }
  15% {
    transform: scale(0.85, 0.85);
  }
  45% {
    transform: scale(0.75, 0.75);
  }
  55% {
    transform: scale(0.95, 0.95);
  }
  85% {
    transform: scale(0.75, 0.75);
  }
  100% {
    opacity: 1;
    transform: scale(0.75, 0.75);
  }
}
@keyframes button-ready {
  0% {
    
    width: 2.5rem;
  }
  10% {
    background-color: #5585ff;
    border-color: #5585ff;
  }
  70% {
    margin: 0;
    width: 7.25rem;
    background-color: #fff;
    transform: scale(1.1, 1.1);
  }
  100% {
    margin: 0;
    width: 7rem;
    border-color: #8cce1e;
    background-color: #fff;
  }
}
@keyframes button-dot-outro {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(1, 1);
  }
}
@keyframes button-ready-label {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}


button {
  position: relative;
  overflow: hidden;
  width: 7rem;
  color: #5585ff;
  border: 2px solid #5585ff;
  background-color: transparent;
  cursor: pointer;
  line-height: 2;
  margin: 10px 0px;
  padding: 0;
  border-radius: 1.5rem;
  font-size: 1.125rem;
  text-transform: lowercase;
  outline: none;
  transition: transform .125s;
}
button:active {
  transform: scale(0.9, 0.9);
}
button:before, button:after {
  position: absolute;
  opacity: 0;
  border-radius: 50%;
  background-color: #fff;
  top: 50%;
  left: 50%;
  margin-top: -1.125rem;
  margin-left: -1.125rem;
  width: 2.25rem;
  height: 2.25rem;
  content: '';
  z-index: 1;
}
button.loading {
  animation: button-loading .5s forwards;
}
button.loading:before {
  opacity: 1;
  animation: button-dot-intro .5s forwards;
}
button.loading:after {
  opacity: 0;
  animation: button-dot-pulse 1.5s infinite .5s;
}
button.ready {
  text-indent: 0;
  color: transparent;
  background-color: #5585ff;
  animation: button-ready .333s forwards;
}
button.ready:before {
  position: absolute;
  left: 0;
  right: 0;
  top: auto;
  margin: 0;
  width: auto;
  height: auto;
  border-radius: 0;
  background-color: transparent;
  color: #8cce1e;
  content: 'done';
  opacity: 0;
  z-index: 2;
  animation: button-ready-label .5s forwards .275s;
}
button.ready:after {
  opacity: 1;
  animation: button-dot-outro .333s;
}



	</style>
</head>
<body>
	


<div  id="profile_pic" ></div>

<button type="submit" id="upload">upload</button>




 {!! Html::script('plugins/jquery/jquery.js') !!}
 {!! Html::script('plugins/croppic/croppic.min.js')	!!}

  <script>

document.querySelector('button').addEventListener('click', function clickHandler(e) {

  this.removeEventListener('click', clickHandler, false);

  e.preventDefault();
  var self = this;
  setTimeout(function() {
    self.className = 'loading';
  }, 125);

  setTimeout(function() {
    self.className = 'ready';
  }, 4300);

}, false);




$(function(){





	var profile_pic_upload_option = {
				uploadUrl:"{{URL::to('image/img_save_to_file')}}",
				cropUrl:"{{URL::to('image/img_crop_to_file')}}",
				modal:true,

				uploadData:{
				"_token":'{{{ csrf_token() }}}'
			},
				cropData:{
				"_token":'{{{ csrf_token() }}}'
				
			},
			
			doubleZoomControls:true,
				//loaderHtml:'<img class="loader" src="loader.png" >',
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){profile_pic=$('div#profile_pic img.croppedImg').attr('src') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}

var cropContainerModal3 = new Croppic('profile_pic', profile_pic_upload_option);

var route_address="{{URL::to('/')}}";

var url=route_address+"/image/profile_pic_store";

$('#upload').click(function(){
//alert('{{csrf_token()}}');
var csrf_token='{{csrf_token()}}';
	$.ajax({
	        type: "POST",
	        url: url,
	        data: {
	        
	        '_token':csrf_token,
	      
	       	'profile_pic':profile_pic,
	        'table_name':'{{Auth::user()->linked_table}}',
	        'id':'{{Auth::user()->linked_id}}',
	        'email_field_title':'{{Auth::user()->linked_with_property}}'
	        
	      
	    	},
	        cache: false,
	        success: function(data){
	           console.log(data);
	           
	        }
	    });


});
		
	
	});

 
 </script>

</body>

</html>