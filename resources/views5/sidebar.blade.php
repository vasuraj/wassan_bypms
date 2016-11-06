 <div class="site-menubar">
    <div class="site-menubar-body">
      <div>

          <ul class="site-menu">

<!---------------------------------------------------------------------------------------------------
    admin login details 
-->
           @if(Entrust::hasRole('admin')) <li class="user-details-sidebar">Admin</li> @endif


          
<!---------------------------------------------------------------------------------------------------
    ngo head login details 
-->
           @if(Entrust::hasRole('ngo_head'))
           
           @if(Session::has('user_details'))
           <li class="user-details-sidebar" >
          
           <?php
                 $user_details=session('user_details');
              
              
                  
            ?>

            <a href="{{URL::to('image/upload_profile_pic')}}" class="fancybox_profile_pic fancybox.iframe"><img class='profile_img' src='{{URL::to('/')}}/portraits/5.jpg' /></a>
            


            <script>
            $(function(){


                  $.ajax({
                    type: "GET",
                    url:'{{url::to("image/get_image_ngo_head/$user_details->id")}}',
                    cache: false,
                    success: function(returned_url){
                     
                     var profile_pic=returned_url.replace('cropped','thumb');
                     if(profile_pic!='')
                     {
                     $('img.profile_img').attr('src',profile_pic);
                   }


                  }



                  });


            });


            </script>


                <div>Head of the NGO</div>
                <a class="fancybox fancybox.iframe" href="{{URL::to('ngo/change_password')}}">{{$user_details->HON}}</a>

           </li> 
           @else
            session veriable is not set {{Auth::user()->email}}
             <script>
           $(function(){
            var url=route_address+"auth/logout";
            window.location = url;

           });

            </script>
            
            @endif
           @endif


<!---------------------------------------------------------------------------------------------------
 ngo field incharge login details
-->

           @if(Entrust::hasRole('ngo_field_incharge'))

           @if(Session::has('user_details'))
           <li class="user-details-sidebar" >
         
           <?php

              if(!isset($image_url_thumb))
              {
                  $user_details=session('user_details');

              }     
            
            ?>

         
            <a href="{{URL::to('image/upload_profile_pic')}}" class="fancybox_profile_pic fancybox.iframe"><img class='profile_img' src="{{URL::to('/')}}/portraits/5.jpg" /></a>

               <script>
            $(function(){


                  $.ajax({
                    type: "GET",
                    @if(Auth::user()->linked_with_property=='email_HON')
                    url:'{{url::to("image/get_image_ngo_head/$user_details->id")}}',
                    @elseif(Auth::user()->linked_with_property=='email_incharge')
                    url:'{{url::to("image/get_image_field_incharge/$user_details->id")}}',
                    @endif
                    cache: false,
                    success: function(returned_url){
                     
                     var profile_pic=returned_url.replace('cropped','thumb');
                    if(profile_pic!='')
                     {
                     $('img.profile_img').attr('src',profile_pic);
                   }


                  }



                  });


            });


            </script>

            
                <div>Field Incharge</div>
                <a class="fancybox fancybox.iframe" href="{{URL::to('ngo/change_password')}}">{{$user_details->field_incharge}}</a>
                
                

           </li> 
           @endif
            @elseif(Entrust::hasRole('admin'))

            @else

            @endif


@if(Entrust::hasRole('admin'))

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)" data-slug="dashboard">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
                <div class="site-menu-badge">
                  <span class="badge badge-success">2</span>
                </div>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="#" data-slug="dashboard-v1">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">APPI</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#" data-slug="dashboard-v2">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">CLIC</span>
                  </a>
                </li>
              </ul>
            </li>
        
        <!-- Admin menu starts here -->

            <li class="site-menu-item has-sub active">
              <a href="javascript:void(0)" data-slug="layout">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">Administrator</span>
                <span class="site-menu-arrow"></span>
              </a>
             
                  <ul class="site-menu-sub">
                    
                       <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('dashboard')}}" data-slug="page-error-403">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                      </a>
                    </li>

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('permissions')}}" data-slug="page-error-404">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Manage permissions</span>
                      </a>
                    </li>

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('roles')}}" data-slug="page-error-404">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Manage Role</span>
                      </a>
                    </li>

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('role_permission')}}" data-slug="page-error-400">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Assign Permissions to role</span>
                      </a>
                    </li>
               
                
                  
                  <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('users')}}" data-slug="page-error-404">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Manage users</span>
                      </a>
                    </li>
                    
                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('locations/add_mvk')}}" data-slug="page-error-404">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Add MVK For CMSS</span>
                      </a>
                    </li>

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('locations/view_mvk')}}" data-slug="page-error-404">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">view MVK</span>
                      </a>
                    </li>
                 
                                   

                  </ul>

               

            </li>
     @endif      
          <!-- Admin menu ends here -->
            <!-- CMSS menu starts here -->

            <li class="site-menu-item has-sub active">
              <a href="javascript:void(0)" data-slug="layout">
                <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                <span class="site-menu-title">CMSS</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                  <li class="site-menu-item has-sub">
                  <a href="javascript:void(0)" data-slug="">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">Farmers</span>
                    <span class="site-menu-arrow"></span>
                  </a>
                  <ul class="site-menu-sub">
                    
                   

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('farmer/create')}}" data-slug="page-error-400">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Create</span>
                      </a>
                    </li>
               
                    <li class="site-menu-item has-sub ">
                    <a href="javascript:void(0)" data-slug="layout">
                     
                      <span class="site-menu-title third_level_menu"  >Farmer's Reports</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                      <ul class="site-menu-sub">
                
                      <li class="site-menu-item ">
                      <a href="{{URL::to('farmer/selective')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">Farmers list</span>
                        </a>
                      </li>
                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('farmer')}}" data-slug="page-error-403">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Farmer Graph</span>
                      </a>
                    </li>
                      </ul>
                    </li>
                  </ul>
                </li>
               
            <!-- Ngo menu -->
           @if(Entrust::hasRole('admin'))
                  <li class="site-menu-item has-sub">
                  <a href="javascript:void(0)" data-slug="">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">NGOs</span>
                    <span class="site-menu-arrow"></span>
                  </a>
                  <ul class="site-menu-sub">
           <!--          
                     <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo')}}" data-slug="view-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">View</span>
                      </a>
                    </li> -->

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo/create')}}" data-slug="create-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Create</span>
                      </a>
                    </li>
 
                <!--     <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo/addfarmers')}}" form-database="ngo_farmer_link" data-slug="Add-farmer-to-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Add Farmers</span>
                      </a>
                    </li>
                            -->          
                   <li class="site-menu-item has-sub ">
                    <a href="javascript:void(0)" data-slug="layout">
                     
                      <span class="site-menu-title third_level_menu">Ngo's Reports</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                      <ul class="site-menu-sub">
                      <li class="site-menu-item ">
                      <a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location" href="{{URL::to('ngo/selective')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">view Ngos</span>
                     
                      </a>
                      </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              
              @endif

              <li class="site-menu-item has-sub">
                  <a href="javascript:void(0)" data-slug="">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">Seed Management</span>
                    <span class="site-menu-arrow"></span>
                  </a>
                  <ul class="site-menu-sub">
                    
                  

                <li class="site-menu-item has-sub ">
                    <a href="javascript:void(0)" data-slug="layout">
                     
                      <span class="site-menu-title third_level_menu"  >Enter Data</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                      <ul class="site-menu-sub">
                
                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('seed_management/seed_purchaser')}}" data-slug="view-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Actual seed purchaser</span>
                      </a>
                    </li>

                     <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('seed_management/rouging')}}" data-slug="view-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Rouging Details</span>
                      </a>
                    </li>
                  
                  
                      </ul>
                    </li>


                         <li class="site-menu-item has-sub ">
                    <a href="javascript:void(0)" data-slug="layout">
                     
                      <span class="site-menu-title third_level_menu"  >Get Reports</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                      <ul class="site-menu-sub">
                
                      <li class="site-menu-item ">
                      <a href="{{URL::to('seed_management/report/seed_purchased')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">Seed Purchased list</span>
                        </a>
                      </li>

                       <li class="site-menu-item ">
                      <a href="{{URL::to('seed_management/report/rouging')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">Roughing list</span>
                        </a>
                      </li>
                  
                      </ul>
                    </li>

                  </ul>
                </li>

              <!-- NGO menu ends here -->
              </ul>

            </li>
           
          <!-- CMSS menu ends here -->



          </ul>

 
        </div>
      </div>
    </div>

    <div class="site-menubar-footer">
      <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="Settings">
        <span class="icon wb-settings" aria-hidden="true"></span>
      </a>
      <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
        <span class="icon wb-eye-close" aria-hidden="true"></span>
      </a>
      <a href="{{ url('/auth/logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
        <span class="icon wb-power" aria-hidden="true"></span>
      </a>
    </div>
  </div>