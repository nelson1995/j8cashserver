<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/libs/css/style.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="/assets/vendor/vector-map/jqvmap.css">
    <link rel="stylesheet" href="/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.bundle.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/css/datatables.min.css">
    <title> {{session('title')}} | J8Cash Admin</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="/dashboard" style="text-transform: inherit;">AfroPay</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        
                
                        <li class="nav-item nav-user">
                          <h5 class="mb-0 mr-2 text-default nav-user-name">Ben Rapha</h5>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            
                            <li class="nav-item" style="margin-top: 10px;">
                                <a class="nav-link @if(Request::is('dashboard')) active  @endif" href="/dashboard"><i class="fas fa-fw fa-chart-pie"></i>Dashboard </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link @if(Request::is('deposits') || Request::is('deposits/new')) active  @endif" href="/deposits"><i class="fa fa-fw fa-money-bill-alt"></i>Deposits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::is('transfers') || Request::is('transfers/new')) active  @endif" href="/transfers"><i class="fa fa-fw fa-rocket"></i>Transfers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::is('withdraws') || Request::is('withdraws/new')) active  @endif" href="/withdraws"><i class="fas fa-fw  fa-arrow-alt-circle-up"></i>Withdraws</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link @if(Request::is('users')) active  @endif" href="/users"><i class="fas fa-users"></i>Users</a>
                            </li>
                           <!--  <li class="nav-item">
                                <a class="nav-link @if(Request::is('settings')) active  @endif" href="/settings"><i class="far fa-sun"></i>Settings</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link"  href=""
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fas fa-fw fa-power-off"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                           
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
          <!--   <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2020 AfroPay. All rights reserved.
                        </div>
                        
                    </div>
                </div>
            </div> -->
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 js-->
    <!-- bootstrap bundle js-->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js-->
    <script src="/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- chartjs js-->
    <script src="/assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="/assets/vendor/charts/charts-bundle/chartjs.js"></script>
   
    <!-- main js-->
    <script src="/assets/libs/js/main-js.js"></script>
    <!-- jvactormap js-->
    <script src="/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- sparkline js-->
    <script src="/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <script src="/assets/vendor/charts/sparkline/spark-js.js"></script>
     <!-- dashboard sales js-->
    <script src="/assets/libs/js/dashboard-sales.js"></script>
    <script src="/js/datatables.bundle.js" type="text/javascript"></script>

</body>
 
</html>