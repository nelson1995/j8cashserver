<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('template-assets/images/logo.jpg') }}" type="image/jpg" />

    <title>{{'J8Cash'}}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('template-assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('template-assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('template-assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('template-assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('template-assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('template-assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('template-assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Datatables -->

    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link href="{{ asset('template-assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template-assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{ asset('template-assets/build/css/custom.min.css') }}" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="{{ asset('template-assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>

    <!-- custom select option css -->
    <link href="{{ asset('template-assets/build/css/customselectoption.css') }}" rel="stylesheet">
    
    <!-- bootstrap select option -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- select2 for dropdown dialog -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- sweet alert -->
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css"/>

    <!-- charts css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />

</head>
<body class="nav-md">
    
<div class="container body">
    <div class="main_container">
        @section('leftsidebar')
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('home') }}" class="site_title"><span>{{'J8Cash'}}</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ $user->profilePicture() === "" ? asset('template-assets/images/img.jpg'):$user->profilePicture() }}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>{{'Welcome,'}}</span>
                            <h2>{{ $user->name }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{' Home '}}</a></li>
                                <li><a href="{{ route('airtime') }}"><i class="fa fa-mobile"></i>{{' Airtime '}}</a></li>
                                <li><a href="{{ route('deposits') }}"><i class="fa fa-money"></i>{{' Deposits '}}</a></li>
                                <li><a href="{{ route('withdraws') }}"><i class="fa fa-money"></i> {{'Withdraws'}} </a></li>
                                <li><a href="{{ route('transfers') }}"><i class="fa fa-money"></i>{{' Transfers '}}</a></li>
                                <li><a href="{{ route('exchange_rates') }}"><i class="fa fa-dollar"></i>{{'Exchange rates'}}</a></li>
                                <li><a><i class="fa fa-cog"></i>{{'Settings'}}<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a><i class="fa fa-users"></i>{{'User management'}}<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="{{ route('users') }}"><i class="fa fa-users"></i>{{' Users '}}</a></li>
                                                <li><a href="{{ route('agents') }}"><i class="fa fa-users"></i>{{'Agents'}}</a></li>
                                                <li><a><i class="fa fa-cogs"></i>{{'Roles/Permissions'}}<span class="fa fa-chevron-down"></span></a>
                                                    <ul class="nav child_menu">
                                                        <li><a href="{{ route('roles') }}"><i class="fa fa-tasks"></i>{{'Roles'}}</a></li>
                                                        <li><a href="{{ route('permissions') }}"><i class="fa fa-tasks"></i>{{'Permissions'}}</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>
    @endsection

    @section('topnavigation')
            <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $user->profilePicture() === "" ? asset('template-assets/images/img.jpg') : $user->profilePicture() }}" alt="">{{$user->name }}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"  href="{{ route('user') }}">{{ 'Profile' }}</a>
                                <a class="dropdown-item"  href="javascript:;">Help</a>
                                <a class="dropdown-item"  href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                        </li>

                        <li role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="{{ asset('template-assets/images/img.jpg') }}" alt="Profile Image" /></span>
                                        <span>
                                          <span>User</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">new user has created an account...</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="text-center">
                                        <a class="dropdown-item">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    @endsection
<!-- /top navigation -->
