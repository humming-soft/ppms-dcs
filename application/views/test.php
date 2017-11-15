<!DOCTYPE html>
<html lang="en">
<!-- START Head -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

    <title>
        SPIN
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
    </style>
    <!--END Loader-->

    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootsrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootsrap-theme.min.css" rel="stylesheet">

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

</head>
<!-- END Head -->


<body class="loading">

    <div id="initial-loader">
        <div>
            <div class="initial-loader-top">
                <img class="initial-loader-logo" src="<?php echo base_url(); ?>assets/images/spin-logo-inverted.png"
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
                    <a class="current navbar-brand" href="http://spin.webkom.co/index.html">
                        <img alt="Spin Logo Inverted" class="h-20"
                        src="<?php echo base_url(); ?>assets/images/spin-logo-inverted-%402X.png">
                    </a>
                    <button class="action-right-sidebar-toggle navbar-toggle collapsed" data-target="#navdbar" data-toggle="collapse"
                    type="button">
                    <i class="fa fa-fw fa-align-right text-white"></i>
                </button>
                <button class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                    <i class="fa fa-fw fa-user text-white"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <!-- START Left Side Navbar -->
                <ul class="nav navbar-nav navbar-left clearfix yamm">
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
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                            <i class="fa fa-lg fa-fw fa-bell hidden-xs"></i>
                            <span class="hidden-sm hidden-md hidden-lg">
                                Notifications <span class="badge badge-primary m-l-1">10</span>
                            </span>
                            <span class="label label-primary label-pill label-with-icon hidden-xs">10</span>
                            <span class="fa fa-fw fa-angle-down hidden-lg hidden-md hidden-sm"></span>
                        </a>
                        <!-- END Icon Notification with Badge (10)-->

                        <!-- START Notification Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-right p-t-0 b-t-0 p-b-0 b-b-0 b-a-0">
                            <li>
                                <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
                                    <ul class="list-group m-b-0 b-b-0">
                                        <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                                            <small class="text-uppercase">
                                                <strong>Notifications</strong>
                                            </small>
                                            <a role="button" href="http://spin.webkom.co/apps/settings-edit.html"
                                            class="btn m-t-0 btn-xs btn-default pull-right">
                                            <i class="fa fa-fw fa-gear"></i>
                                        </a>
                                    </li>

                                    <!-- START Scroll Inside Panel -->
                                    <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                                        <div class="scroll-300 custom-scrollbar">
                                            <a href="http://spin.webkom.co/pages/timeline.html"
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
                                        <a href="http://spin.webkom.co/pages/timeline.html" class="list-group-item b-r-0 b-l-0">
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
                                        <a href="http://spin.webkom.co/pages/timeline.html" class="list-group-item b-r-0 b-l-0">
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
                                        <a href="http://spin.webkom.co/pages/timeline.html" class="list-group-item b-r-0 b-l-0">
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
                                    href="http://spin.webkom.co/pages/timeline.html">
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
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-lg fa-fw fa-envelope hidden-xs"></i>
                <span class="hidden-sm hidden-md hidden-lg">Messages <span class="badge badge-info m-l-1">3</span></span>
                <span class="label label-info label-pill label-with-icon hidden-xs">3</span>
                <span class="fa fa-fw fa-angle-down hidden-lg hidden-md hidden-sm"></span>
            </a>

            <!-- START Messages Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-right p-t-0 b-t-0 p-b-0 b-b-0 b-a-0">
                <li>
                    <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
                        <ul class="list-group m-b-0">
                            <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                                <small class="text-uppercase">
                                    <strong>Messages</strong>
                                </small>
                                <a role="button" href="http://spin.webkom.co/apps/new-email.html"
                                class="btn m-t-0 btn-xs btn-default pull-right">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>

                        <!-- START Scroll Inside Panel -->
                        <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                            <div class="scroll-200 custom-scrollbar">

                                <a href="http://spin.webkom.co/apps/email-details.html"
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

                            <a href="http://spin.webkom.co/apps/email-details.html" class="list-group-item b-r-0 b-l-0">
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

                            <a href="http://spin.webkom.co/apps/email-details.html" class="list-group-item b-r-0 b-l-0">
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

                            <a href="http://spin.webkom.co/apps/email-details.html" class="list-group-item b-r-0 b-l-0">
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

                            <a href="http://spin.webkom.co/apps/email-details.html" class="list-group-item b-r-0 b-l-0">
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

                            <a href="http://spin.webkom.co/apps/email-details.html" class="list-group-item b-r-0 b-l-0">
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
                        href="http://spin.webkom.co/apps/inbox.html">
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
        <span class="m-r-1">Derrick Cormier</span>

        <div class="avatar avatar-image avatar-sm avatar-inline">
            <img alt="User" src="<?php echo base_url(); ?>assets/uifaces/faces/twitter/afusinatto/128.jpg">
        </div>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="http://spin.webkom.co/pages/login.html">Sign Out</a>
        </li>
    </ul>
</li>
</ul>
<!-- END Right Side Navbar -->
</div>

</div>
</div>
<!-- END Navbar -->

<!-- START Sidebars -->
<aside class="navbar-default sidebar">
    <div class="sidebar-overlay-head">
        <img src="<?php echo base_url(); ?>assets/images/spin-logo-inverted.png" alt="Logo">
        <a href="javascript:void(0)" class="sidebar-switch action-sidebar-close">
            <i class="fa fa-times"></i>
        </a>
    </div>
    <div class="sidebar-logo">
        <img class="logo-default" src="<?php echo base_url(); ?>assets/images/spin-logo-big-inverse-%402X.png"
        alt="Logo"
        width="53">
        <img class="logo-slim" src=".<?php echo base_url(); ?>assets/images/spin-logo-slim.png" alt="Logo">
    </div>

    <div class="sidebar-content">
        <div class="p-y-3 avatar-container">
            <img src="<?php echo base_url(); ?>assets/images/avatars/spin-avatar-woman.png" width="50" alt="Avatar"
            class="spin-avatar img-circle">

            <div class="text-center">
                <h6 class="m-b-0">Michelle Baez</h6>
                <small class="text-muted">Help Desk</small>
                <p class="m-t-1 m-b-2">
                    <span id="sidebar-avatar-chart">5,3,2,-1,-3,-2,2,3,5,2</span>
                </p>
            </div>
        </div>

        <!-- START Tree Sidebar Common -->
        <ul class="side-menu">

            <li class="Dashboards">
                <a href="#" title="Dashboards">
                    <i class="fa fa-home fa-lg fa-fw"></i><span class="nav-label">Start</span><i class="fa arrow"></i>
                </a>
                <ul>
                    <li class="">
                        <a href="overview.html">
                            <span class="nav-label">Overview</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="projects.html">
                            <span class="nav-label">Projects</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END Tree Sidebar Common  -->
    </div>
</aside>
<!-- END Sidebars -->
</nav>

<div class="content">
    <!-- START Sub-Navbar with Header only-->
    <div class="sub-navbar sub-navbar__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header m-t-0">
                        <h3 class="m-t-0">Projects</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header only-->

    <!-- START Sub-Navbar with Header and Breadcrumbs-->
    <div class="sub-navbar sub-navbar__header-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 sub-navbar-column">
                    <div class="sub-navbar-header">
                        <h3>Projects</h3>
                    </div>
                    <ol class="breadcrumb navbar-text navbar-right no-bg">
                        <li class="current-parent">
                            <a class="current-parent" href="http://spin.webkom.co/index.html">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Start
                            </a>
                        </li>
                        <li class="active">Projects</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->


    <div class="container">
        <!-- START EDIT CONTENT -->

        <div class="row">
            <div class="col-lg-12 m-t-2">

                <p class="m-b-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum ratione, optio earum
                    at, consequuntur,
                    ullam nobis dicta ab sunt adipisci excepturi sed. Eaque maiores itaque, architecto ea eos, at
                    repellat explicabo
                    neque aliquid. Architecto, qui quaerat accusantium autem rem.</p>

                    <!-- START ROW -->
                    <div class="row">
                        <!-- Add Content Here -->
                    </div>
                    <!-- END ROW -->

                </div>
            </div>

            <!-- END EDIT CONTENT -->
        </div>

    </div>
    <!-- START Footer -->
    <footer>
        <div class="container-fluid">
            <p class="text-gray-dark">
                <strong class="m-r-1">Data Entry </strong>
                <span class="text-gray-dark">&#xA9; 2016 - 2020. Made by
                    <i class="fa fa-fw fa-heart text-danger"></i> Hummingsoft, MY</span>
                </p>
            </div>
        </footer>
        <!-- END Footer -->

    </div>
    <script>
    // Hide loader
    (function () {
        var bodyElement = document.querySelector('body');
        bodyElement.classList.add('loading');

        document.addEventListener('readystatechange', function () {
            if (document.readyState === 'complete') {
                var bodyElement = document.querySelector('body');
                var loaderElement = document.querySelector('#initial-loader');

                bodyElement.classList.add('loaded');
                setTimeout(function () {
                    bodyElement.removeChild(loaderElement);
                    bodyElement.classList.remove('loading', 'loaded');
                }, 200);
            }
        });
    })();
</script>


<!-- Bower Libraries Scripts -->
<script src="<?php echo base_url(); ?>assets/vendor/js/lib.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/app.min.8c5687ed.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/plugins-init.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/switchery-settings.js"></script>
</body>
</html>
