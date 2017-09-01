<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{!! HTML::image('uploads/images/avatar/'.$logo, 'User Image', array('width' => '50px')) !!}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!! HTML::image('uploads/images/avatar/'.$logo, 'User Image', array('width' => '100px')) !!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications Menu -->

                
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        @if (Auth::user()->avatar == '')
                        {!! HTML::image('img/avatar.png', 'User Image', array('class' => 'user-image')) !!}
                        @else
                        {!! HTML::image('uploads/images/avatar/'.Auth::user()->avatar, 'User Image', array('class' => 'user-image')) !!}
                        @endif
                        <span>{{ Auth::user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <a href="{{ url('/member/profile/changeprofile') }}">
                                @if (Auth::user()->avatar == '')
                                {!! HTML::image('img/avatar.png', 'User Image', array('class' => 'img-circle')) !!}
                                @else
                                {!! HTML::image('uploads/images/avatar/'.Auth::user()->avatar, 'User Image', array('class' => 'img-circle')) !!}
                                @endif
                            </a>
                            <p>
                                {{ Auth::user()->username }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/member/profile/changeprofile') }}" class="btn btn-default btn-flat">Profile</a>

                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </nav>
</header>