 <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-category">General</li>
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


                  </ul>
               

            </li>
           
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
                      <a class="animsition-link" href="{{URL::to('farmer')}}" data-slug="page-error-403">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">View</span>
                      </a>
                    </li>

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
                      <a href="{{URL::to('farmer/all')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">All</span>
                     
                      </a>
                      </li>

                      <li class="site-menu-item ">
                      <a href="{{URL::to('farmer/selective')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">Selective Farmers</span>
                      </a>
                      </li>
                      </ul>
                    </li>
                  </ul>
                </li>
               
            <!-- Ngo menu -->
           
                  <li class="site-menu-item has-sub">
                  <a href="javascript:void(0)" data-slug="">
                    <i class="site-menu-icon " aria-hidden="true"></i>
                    <span class="site-menu-title">NGOs</span>
                    <span class="site-menu-arrow"></span>
                  </a>
                  <ul class="site-menu-sub">
                    
                     <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo')}}" data-slug="view-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">View</span>
                      </a>
                    </li>

                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo/create')}}" data-slug="create-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Create</span>
                      </a>
                    </li>
 
                    <li class="site-menu-item">
                      <a class="animsition-link" href="{{URL::to('ngo/addfarmers')}}" form-database="ngo_farmer_link" data-slug="Add-farmer-to-ngo">
                        <i class="site-menu-icon " aria-hidden="true"></i>
                        <span class="site-menu-title">Add Farmers</span>
                      </a>
                    </li>
                                     
                   <li class="site-menu-item has-sub ">
                    <a href="javascript:void(0)" data-slug="layout">
                     
                      <span class="site-menu-title third_level_menu">Ngo's Reports</span>
                      <span class="site-menu-arrow"></span>
                    </a>
                      <ul class="site-menu-sub">
                      <li class="site-menu-item ">
                      <a  data-placement="top" data-toggle="tooltip" data-original-title="Selected Ngo filter by location" href="{{URL::to('ngo/selective')}}" data-slug="">
                        <i class="site-menu-icon "></i>
                        <span class="site-menu-title">Selective Ngos</span>
                     
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