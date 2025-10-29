 <aside class="left-sidebar sidebar-dark" id="left-sidebar">
     <div id="sidebar" class="sidebar sidebar-with-footer">
         <!-- Aplication Brand -->
         <div class="app-brand">
             <a href="{{ route('admin.dashboard') }}">
                 <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Mono">
             </a>
         </div>
         <!-- begin sidebar scrollbar -->
         <div class="sidebar-left" data-simplebar style="height: 100%;">
             <!-- sidebar menu -->
             <ul class="nav sidebar-inner" id="sidebar-menu">

                 <li class="active">
                     <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}">
                         <i class="mdi mdi-briefcase-account-outline"></i>
                         <span class="nav-text">Dashboard</span>
                     </a>
                 </li>

                 <li class="section-title">
                     Pages
                 </li>

                 <li class="has-sub">
                     <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#users"
                         aria-expanded="false" aria-controls="users">
                         <i class="mdi mdi-image-filter-none"></i>
                         <span class="nav-text">Users</span> <b class="caret"></b>
                     </a>
                     <ul class="collapse" id="users" data-parent="#sidebar-menu">
                         <div class="sub-menu">

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('all.users') }}">
                                     <span class="nav-text">User List</span>
                                 </a>
                             </li>

                         </div>
                     </ul>
                 </li>

                  <li class="has-sub">
                     <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#wallet"
                         aria-expanded="false" aria-controls="users">
                         <i class="mdi mdi-file-multiple"></i>
                         <span class="nav-text">Data Management</span> <b class="caret"></b>
                     </a>
                     <ul class="collapse" id="wallet" data-parent="#sidebar-menu">
                         <div class="sub-menu">

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('professions') }}">
                                     <span class="nav-text">Profession</span>

                                 </a>
                             </li>

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('age') }}">
                                     <span class="nav-text">Age</span>

                                 </a>
                             </li>

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('plan') }}">
                                     <span class="nav-text">Plan</span>

                                 </a>
                             </li>

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('income') }}">
                                     <span class="nav-text">Income range</span>

                                 </a>
                             </li>

                             <li>
                                 <a class="sidenav-item-link" href="{{ route('payment_mode') }}">
                                     <span class="nav-text">Payment Mode</span>

                                 </a>
                             </li>

                         </div>
                     </ul>
                 </li>

             </ul>

         </div>

         <div class="sidebar-footer">
             <div class="sidebar-footer-content">
                 <ul class="d-flex">
                     <li>
                         <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i
                                 class="mdi mdi-settings"></i></a>
                     </li>
                     <li>
                         <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                 class="mdi mdi-chat-processing"></i></a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </aside>
