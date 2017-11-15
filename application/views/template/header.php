<!DOCTYPE html>
<html lang="en">
<!-- START Head -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

    <title>
        PPMS
    </title>

    <!--START Loader -->
    <style>
        #initial-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
            background: #212121;
            position: fixed;
            z-index: 10000;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            transition: opacity .2s ease-out
        }

        #initial-loader .initial-loader-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 200px;
            border-bottom: 1px solid #2d2d2d;
            padding-bottom: 5px
        }

        #initial-loader .initial-loader-top > * {
            display: block;
            flex-shrink: 0;
            flex-grow: 0
        }

        #initial-loader .initial-loader-bottom {
            padding-top: 10px;
            color: #5C5C5C;
            font-family: -apple-system, "Helvetica Neue", Helvetica, "Segoe UI", Arial, sans-serif;
            font-size: 12px
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg)
            }
        }

        #initial-loader .loader g {
            transform-origin: 50% 50%;
            animation: spin .5s linear infinite
        }

        body.loading {
            overflow: hidden !important
        }

        body.loaded #initial-loader {
            opacity: 0
        }
        .error{
            color:#c12e2a;
        }
    </style>	
    <!--END Loader-->

    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Bower Libraries Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/lib.min.css">
    <!-- SCSS Output -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/app.min.179ab97f.css">

    <!-- START Favicon -->
    <link rel="apple-touch-icon" sizes="57x57"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
    href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
    href="<?php echo base_url(); ?>assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
    href="<?php echo base_url(); ?>assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
    href="<?php echo base_url(); ?>assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
    href="<?php echo base_url(); ?>assets/images/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- END Favicon -->

    <!-- File Upload Style : START-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqueryfiler/css/googlefonts.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqueryfiler/css/jquery.filer.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqueryfiler/css/jquery.filer-dragdropbox-theme.css" type="text/css" />
    <!-- File Upload Style : END-->	
    <!-- Toastr Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
    <!-- JQuery-->
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
</head>
<!-- END Head -->

<body class="loading">

    <div id="initial-loader">
        <div>
            <div class="initial-loader-top">
               <img class="initial-loader-logo" style="width: 150px" src="<?php echo base_url(); ?>assets/images/logos/spin-logo-inverted-1.png"
                alt="Loader">

                <div class="loader loader--style1">
                            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px"
                                 viewbox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                    <g>
                        <path fill="#2d2d2d"
                              d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                        <path fill="#2c97de"
                              d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0C22.32,8.481,24.301,9.057,26.013,10.047z"/>

                    </g>
                </svg>
            </div>
        </div>
        <div class="initial-loader-bottom">
            Loading. Please Wait. <i class="fa fa-cricle" style="opacity: 0"></i>
        </div>
    </div>
</div>

<div class="main-wrap">
    <nav class="navigation">
        <!-- START Navbar -->
        <div class="navbar-inverse navbar navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="current navbar-brand" href="#">
                        <img alt="" style="height:30px" src="<?php echo base_url(); ?>assets/images/logos/spin-logo-inverted-1.png">
                    </a>
                    <button class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                        <i class="fa fa-fw fa-user text-white"></i>
                    </button>
                    <button class="action-sidebar-open navbar-toggle collapsed" type="button">
                        <i class="fa fa-fw fa-bars text-white"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar">
                    <!-- START Left Side Navbar -->
                    <ul class="nav navbar-nav navbar-left clearfix yamm">
                        <!-- START Switch Sidebar ON/OFF -->
                        <li id="sidebar-switch" class="hidden-xs">
                            <a class="action-toggle-sidebar-slim" data-placement="bottom" data-toggle="tooltip" href="#" title="Slim sidebar on/off">
                                <i class="fa fa-lg fa-bars fa-fw"></i>
                            </a>
                        </li>
                        <!-- END Switch Sidebar ON/OFF -->
                        <!-- START Menu Only Visible on Navbar -->
                        <li id="top-menu-switch" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <i class="fa fa-fw fa-caret-down"></i></a>
                        </li>
                        <!-- END Menu Only Visible on Navbar -->
                    </ul>

                    <!-- START Right Side Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <li role="separator" class="divider hidden-lg hidden-md hidden-sm"></li>
                        <li class="dropdown-header hidden-lg hidden-md hidden-sm text-gray-lighter text-uppercase">
                            <strong>Your Profile</strong>
                        </li>

                        <!-- START Notification -->
                        <li class="dropdown">

                            <!-- START Icon Notification with Badge (10)-->
                            <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                <i class="fa fa-lg fa-fw fa-bell hidden-xs"></i>
                                <span class="hidden-sm hidden-md hidden-lg">
                                    Notifications <span class="badge badge-primary m-l-1">10</span>
                                </span>
                                <span class="label label-primary label-pill label-with-icon hidden-xs">10</span>
                                <span class="fa fa-fw fa-angle-down hidden-lg hidden-md hidden-sm"></span>
                            </a>-->
                            <!-- END Icon Notification with Badge (10)-->

                            <!-- START Notification Dropdown Menu -->
                            <ul class="dropdown-menu dropdown-menu-right p-t-0 b-t-0 p-b-0 b-b-0 b-a-0">
                                <li>
                                    <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
                                        <ul class="list-group m-b-0 b-b-0">
                                           <!-- <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                                                <small class="text-uppercase">
                                                    <strong>Notifications</strong>
                                                </small>
                                                <a role="button" href="#"
                                                class="btn m-t-0 btn-xs btn-default pull-right">
                                                <i class="fa fa-fw fa-gear"></i>
                                            </a>
                                        </li>
-->
                                        <!-- START Scroll Inside Panel -->
                                        <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                                            <div class="scroll-300 custom-scrollbar">
                                                <a href="#"
                                                class="list-group-item b-r-0 b-t-0 b-l-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <span class="fa-stack fa-lg">
                                                            <i class="fa fa-circle-thin fa-stack-2x text-danger"></i>
                                                            <i class="fa fa-close fa-stack-1x fa-fw text-danger"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="m-t-0">
                                                            <span>If we connect the bandwidth, we can get to the SQL system through the auxiliary AGP feed!</span>
                                                        </h5>

                                                        <p class="text-nowrap small m-b-0">
                                                            <span>09-Mar-2013, 05:41</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item b-r-0 b-l-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <span class="fa-stack fa-lg">
                                                            <i class="fa fa-circle-thin fa-stack-2x text-primary"></i>
                                                            <i class="fa fa-info fa-stack-1x text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="m-t-0">
                                                            <span>We need to override the optical COM monitor!</span>
                                                        </h5>

                                                        <p class="text-nowrap small m-b-0">
                                                            <span>09-Nov-2014, 07:23</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item b-r-0 b-l-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <span class="fa-stack fa-lg">
                                                            <i class="fa fa-circle-thin fa-stack-2x text-success"></i>
                                                            <i class="fa fa-check fa-stack-1x text-success"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="m-t-0">
                                                            <span>I&apos;ll transmit the virtual IB hard drive, that should monitor the XML driver!</span>
                                                        </h5>

                                                        <p class="text-nowrap small m-b-0">
                                                            <span>06-Oct-2012, 12:32</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item b-r-0 b-l-0">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <span class="fa-stack fa-lg">
                                                            <i class="fa fa-circle-thin fa-stack-2x text-warning"></i>
                                                            <i class="fa fa-exclamation fa-stack-1x fa-fw text-warning"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="m-t-0">
                                                            <span>If we quantify the bandwidth, we can get to the XSS port through the wireless CSS system!</span>
                                                        </h5>

                                                        <p class="text-nowrap small m-b-0">
                                                            <span>19-Aug-2016, 09:18</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>

                                    <!-- END Scroll Inside Panel -->
                                    <li class="list-group-item b-a-0 p-x-0 p-y-0 r-a-0 b-b-0">
                                        <a class="list-group-item text-center b-r-0 b-b-0 b-l-0 b-r-b-r-0 b-r-b-l-0"
                                        href="#">
                                        See All Notifications <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </li>
                </ul>
                <!-- END Notification Dropdown Menu -->

            </li>
            <!-- END Notification -->

            <li class="dropdown">
                <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                    <i class="fa fa-lg fa-fw fa-envelope hidden-xs"></i>
                    <span class="hidden-sm hidden-md hidden-lg">Messages <span class="badge badge-info m-l-1">3</span></span>
                    <span class="label label-info label-pill label-with-icon hidden-xs">3</span>
                    <span class="fa fa-fw fa-angle-down hidden-lg hidden-md hidden-sm"></span>
                </a>-->

                <!-- START Messages Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-right p-t-0 b-t-0 p-b-0 b-b-0 b-a-0">
                    <li>
                        <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
                            <ul class="list-group m-b-0">
                                <!--<li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                                    <small class="text-uppercase">
                                        <strong>Messages</strong>
                                    </small>
                                    <a role="button" href="#"
                                    class="btn m-t-0 btn-xs btn-default pull-right">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>-->

                            <!-- START Scroll Inside Panel -->
                            <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                                <div class="scroll-200 custom-scrollbar">

                                    <a href="#"
                                    class="list-group-item b-r-0 b-t-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/jomarmen/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-danger b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Marshall McDermott</span>
                                                <small><span>02:36</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Cumque eos quaerat nihil molestiae sapiente.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="list-group-item b-r-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/mrxloka/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-warning b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Merritt Powlowski</span>
                                                <small><span>04:47</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Nesciunt et consequatur aut.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="list-group-item b-r-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/soyjavi/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-success b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Reba Price</span>
                                                <small><span>07:58</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Quam delectus ut sed soluta ut tempora doloribus est.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="list-group-item b-r-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/ajaxy_ru/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-danger b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Harold Kling</span>
                                                <small><span>09:28</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Quasi recusandae et nam earum qui assumenda rerum aliquid quod.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="list-group-item b-r-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/netonet_il/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-warning b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Antonette Borer</span>
                                                <small><span>12:31</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Suscipit qui nemo reiciendis sed architecto explicabo.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="list-group-item b-r-0 b-l-0">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="avatar">
                                                <img class="media-object img-circle"
                                                src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/homka/128.jpg"
                                                alt="Avatar">
                                                <i class="avatar-status avatar-status-bottom bg-success b-gray-darker"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-auto">
                                            <h5 class="m-b-0 m-t-0">
                                                <span>Derrick Muller</span>
                                                <small><span>07:39</span></small>
                                            </h5>
                                            <p class="m-t-0 m-b-0">
                                                <span>Rerum optio consequatur ex fuga et aut vitae ipsa commodi.</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </li>
                        <!-- END Scroll Inside Panel -->

                        <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                            <a class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0"
                            href="#">
                            See All Messages <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <!-- END Messages Dropdown Menu -->

</li>

<li class="dropdown">
    <a class="dropdown-toggle user-dropdown" data-toggle="dropdown" href="#" role="button">
        <span class="m-r-1" style="color: #eeeeee" > <?php echo  $_SESSION['fullname'] ?></span>

        <div class="avatar avatar-image avatar-sm avatar-inline">
            <img  alt="User" src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/person.jpg">
        </div>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="<?php echo base_url('login/logout') ?>">Sign Out</a>
        </li>
    </ul>
</li>
</ul>
<!-- END Right Side Navbar -->
</div>

</div>
</div>
<!-- END Navbar -->