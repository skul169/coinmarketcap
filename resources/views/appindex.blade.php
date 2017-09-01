<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

    @include('partialsindex.htmlheader')

  <body class="skin-green sidebar-mini">
        <div class="wrapper">
            <div id="page-container">
                @include('partialsindex.mainheader')

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">

                    @include('partialsindex.contentheader')

                    <!-- Main content -->
                    <div class="container">
                        <section class="content">
                            <!-- Your Page Content Here -->
                            @yield('main-content')
                        </section><!-- /.content -->
                    </div>
                </div><!-- /.content-wrapper -->

                @include('partialsindex.controlsidebar')

                @include('partialsindex.footer')
            </div> 
        </div><!-- ./wrapper -->

        @include('partialsindex.scripts')

        @yield('inpage-script')
    </body>
</html>