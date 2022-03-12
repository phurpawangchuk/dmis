        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- <li class="nav-devider"></li> -->
                        <!-- @can('admin_panel_access') -->
                        <!-- dashboard-->
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin')) is_active @endif" href="{{ route('admin.home') }}" aria-expanded="false">
                                <i class="mr-3 fas fa-tachometer-alt fa-fw" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        @endcan -->

                        @canany(['users_access','roles_access','permissions_access'])
                            <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark selected" href="javascript:void(0)" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account" aria-hidden="true"></i>
                                        <span class="hide-menu">Users Management</span>
                                    </a>
                                <ul aria-expanded="false" class="collapse first-level
                                    @if(request()->is('admin/users') || request()->is('admin/users/*')) in @endif
                                    @if(request()->is('admin/roles') || request()->is('admin/roles/*')) in @endif
                                    @if(request()->is('admin/permissions') || request()->is('admin/permissions/*')) in @endif
                                ">
                                @can('users_access')
                                    <li class="sidebar-item">
                                            <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/users') || request()->is('admin/users/*')) is_active @endif" href="{{ route('admin.users.index') }}" aria-expanded="false">
                                                <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                                <span class="hide-menu">Users</span>
                                            </a>
                                        </li>
                                @endcan

                                @can('roles_access')
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/roles') || request()->is('admin/roles/*')) is_active @endif" href="{{ route('admin.roles.index') }}" aria-expanded="false">
                                            <i class="mr-3 mdi mdi-star" aria-hidden="false"></i>
                                            <span class="hide-menu">Roles</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('permissions_access')
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/permissions') || request()->is('admin/permissions/*')) is_active @endif" href="{{ route('admin.permissions.index') }}" aria-expanded="false">
                                            <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                            <span class="hide-menu">Permissions</span>
                                        </a>
                                    </li>
                                @endcan
                                </ul>
                            </li>
                        @endcanany

                        @can('posts_access')
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark selected" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mr-3 mdi mdi-account" aria-hidden="true"></i>
                                    <span class="hide-menu">Post Management</span>
                                </a>

                                <ul aria-expanded="false" class="collapse first-level">
                                    @can('post_create')
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/posts') || request()->is('admin/posts/*')) is_active @endif" href="{{ route('admin.posts.index') }}" aria-expanded="false">
                                            <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                            <span class="hide-menu">Posts</span>
                                        </a>

       
                                    </li>
                                    @endcan
                                    @can('post_verify')
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/verify') || request()->is('admin/verify/*')) is_active @endif" href="{{ route('admin.posts.verify') }}" aria-expanded="false">
                                            <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                            <span class="hide-menu">Verify</span>
                                        </a>
                                    </li>
                                    @endcan

                                    @can('post_approve')
                                    <li class="sidebar-item">
                                        <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/approve') || request()->is('admin/approve/*')) is_active @endif" href="{{ route('admin.posts.approve') }}" aria-expanded="false">
                                            <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                            <span class="hide-menu">Approve</span>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        
                        @can('tasks_access')
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark selected" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mr-3 mdi mdi-account" aria-hidden="true"></i>
                                    <span class="hide-menu">Task Management</span>
                                </a>

                                <ul aria-expanded="false" class="collapse first-level">
                                    @can('posts_access')
                                        <li class="sidebar-item">
                                            <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/posts') || request()->is('admin/posts/*')) is_active @endif" href="{{ route('admin.posts.index') }}" aria-expanded="false">
                                                <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                                <span class="hide-menu">Task</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- <li class="sidebar-item selected"> <a class="sidebar-link has-arrow waves-effect waves-dark active" href="javascript:void(0)" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><span class="hide-menu">Dashboard <span class="badge badge-pill badge-success">5</span></span></a>
                            <ul aria-expanded="false" class="collapse first-level in">
                                <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Modern Dashboard  </span></a></li>
                                <li class="sidebar-item active"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Awesome Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index3.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Classy Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index4.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Analytical Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index5.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Minimal Dashboard </span></a></li>
                            </ul>
                        </li>  -->

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
