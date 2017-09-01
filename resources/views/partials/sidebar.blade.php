<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active"><a href="{{ url('home')}}"> <i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
            @if (Auth::user()->can('transaction-manager'))
            <li><a href="{{ url('transaction') }}"><i class='fa fa-gear'></i> <span>Quản lý giao dịch</span></a></li>
            @endif
            @if (Auth::user()->can('ads-manager'))
            <li><a href="{{ url('userads') }}"><i class='fa fa-gear'></i> <span>Quản lý quảng cáo</span></a></li>
            @endif
           <!--
            @if (Auth::user()->can('deposit-manager'))
            <li><a href="{{ url('deposits') }}"><i class='fa fa-gear'></i> <span>Quản lý lưu trữ</span></a></li>
            @endif -->
            @if (Auth::user()->can('user-manager'))
            <li><a href="{{ url('user/member') }}"><i class='fa fa-gear'></i> <span>Quản lý thành viên</span></a></li>
            @endif
            @if (Auth::user()->can('order-manager'))
            <li><a href="{{ url('mgbetting') }}"><i class='fa fa-gear'></i> <span>Quản lý Betting</span></a></li>
            @endif
            <!--
            @if (Auth::user()->can('report-manager'))
            <li><a href="{{ url('roses') }}"><i class='fa fa-gear'></i> <span>Thống kê nhận thưởng</span></a></li>
            <li><a href="{{ url('member/order/finish') }}"><i class='fa fa-gear'></i> <span>Báo cáo doanh số cháy</span></a></li>
            @endif
            -->
        </ul>
        <ul class="sidebar-menu">
            <li class="header">CMS</li>
            <li><a href="{{ url('cms') }}"><i class='fa fa-pencil-square-o'></i> <span>Quản lý cms</span></a></li>
            
        </ul>
        <ul class="sidebar-menu">
            <li class="header">SYSTEM</li>
            @if (Auth::user()->can('config-manager'))
            <li><a href="{{ url('configsys') }}"><i class='fa fa-gear'></i> <span>Quản lý cấu hình</span></a></li>
            @endif
            @if (Auth::user()->can('log-manager'))
            <li><a href="{{ url('log') }}"><i class='fa fa-gear'></i> <span>Quản lý Log</span></a></li>
            @endif
            <!--
            @if (Auth::user()->can('faq-manager'))
            <li><a href="{{ url('faq') }}"><i class='fa fa-user'></i> <span>Quản lý hỏi đáp</span></a></li>
            @endif
            @if (Auth::user()->can('role-manager'))
            <li><a href="{{ url('role') }}"><i class='fa fa-user'></i> <span>Quản lý phân quyền</span></a></li>
            @endif
            -->


        </ul>
        <ul class="sidebar-menu">
            <li class="header">USE</li>
            <li>
             <a href="{{ url('/auth/logout') }}" >
                <i class='fa fa-plane'></i> <span>Thoát</span></a>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
