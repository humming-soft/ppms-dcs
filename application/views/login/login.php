<!DOCTYPE html>
<html lang="en">
<!-- START Head -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

    <title>
        DCS | Login
    </title>

    <!--START Loader -->
    <style>
        #initial-loader{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;width:100%;background:#212121;position:fixed;z-index:10000;top:0;left:0;bottom:0;right:0;transition:opacity .2s ease-out}#initial-loader .initial-loader-top{display:flex;align-items:center;justify-content:space-between;width:200px;border-bottom:1px solid #2d2d2d;padding-bottom:5px}#initial-loader .initial-loader-top > *{display:block;flex-shrink:0;flex-grow:0}#initial-loader .initial-loader-bottom{padding-top:10px;color:#5C5C5C;font-family:-apple-system,"Helvetica Neue",Helvetica,"Segoe UI",Arial,sans-serif;font-size:12px}@keyframes spin{100%{transform:rotate(360deg)}}#initial-loader .loader g{transform-origin:50% 50%;animation:spin .5s linear infinite}body.loading {overflow: hidden !important} body.loaded #initial-loader{opacity:0}
    </style>
    <!--END Loader-->
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- SCSS Output -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheets/app.min.179ab97f.css">

    <!-- Bower Libraries Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/lib.min.css">
    <!-- START Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- END Favicon -->
    <!-- start: Javascript for validation-->
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.validate.js"></script>
    <!-- end: Javascript for validation-->
    <style>
        .error{
            color:#c12e2a;
        }
    </style>
</head>
<!-- END Head -->

<body class="sidebar-disabled navbar-disabled footer-disabled loading">

    <div class="main-wrap">

        <div class="content">
            <div class="container-fluid">
              <a class="btn  m-t-2 m-b-1" href="javascript: void(0)"></a>
              <div class="row1">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default b-a-2 no-bg b-gray-dark">
                        <div class="panel-heading text-center">
                            <a href="<?php echo base_url('login/logout')?>"> <img class="h-21" src="<?php echo base_url(); ?>assets/images/logos/spin-logo-inverted-1.png" alt="Logo" class="m-t-3 m-b-3 h-20"></a>
                        </div>
                        <div class="panel-body">
                            <p class="text-center m-b-3 ">HUMWORKS data entry site, Sign in to your account.</p>
                            <?php echo form_open('login/login' , array('id' => 'loginform'));?>
                            <div class="form-group">
                                <label for="username"></label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter a Username..." onMouseOver="checking();">
                                <?php echo form_error('username'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password"></label>
                                <input type="password" class="form-control password" id="password" name="password" placeholder="Your Password..." onMouseOver="checking();">
                                <?php echo form_error('password'); ?>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember Password?
                                </label>
                            </div>
                            <button type="submit" class="btn btn-block m-b-2 btn-primary">
                                Login <i class="icon-circle-arrow-right"></i>
                            </button>
                            <div id="val_msg" class="error"><?php if (!empty($msg)) { echo $msg;}?></div>
                            <?php echo form_close();?>
                        </div>
                        <div class="panel-footer b-a-0 b-r-a-0"></div>
                    </div>
                    <p class="text-gray-light text-center"><strong>Data Capture System </strong> <span class="text-gray-light">&#xA9; 2016 - 2020. Powered by Hummworks, MY</span></p>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Method 1 : START -->

<script type="text/javascript">
	
    $(document).ready(function() {
       $("#loginform").validate({
        rules: {
            username: {
             minlength: 2,
             required: true
         },
         password:{
            minlength: 6,
            maxlength: 15,			
            required: true
        }
    },
    messages: {
       username: {
        required: "Name required",
    },
    password: {
        required: "Password required",
    }			
},
highlight: function(element) {
    $(element).parent('div').addClass('has-error m-b-1');
},
unhighlight: function(element) {
    $(element).parent('div').removeClass('has-error m-b-1');
}
});
   });

</script>

<!-- Method 1 : END -->

<!-- Method 2 : START-->

<!-- <script type="text/javascript">
    $(document).ready(function(){
        Login.init(); //  caling a custom js inside assets/validations
    });

</script> -->

<!-- Method 2 : END-->

<script type="text/javascript">
    function checking(){
        var uname = $('#username').val();
        var password = $('#password').val();
        if (uname!=null || password!=""){
            $("div#val_msg").remove();
        }
    }
</script>

<script src="<?php echo base_url(); ?>assets/Validations/Custom_login.js"></script>
</body>

</html>
