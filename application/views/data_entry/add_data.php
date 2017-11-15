<div class="content">
<!-- START Sub-Navbar with Header only-->
<div class="sub-navbar sub-navbar__header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header m-t-0">
                    <h3 class="m-t-0">Project</h3>
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
                    <h3>Project</h3>
                </div>
                <ol class="breadcrumb navbar-text navbar-right no-bg">
                    <li class="current-parent">
                        <a class="current-parent" href="../index.html">
                            <i class="fa fa-fw fa-home"></i>
                        </a>
                    </li>
                    <li class="active">
                        Add Project
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- END Sub-Navbar with Header and Breadcrumbs-->


<div class="container">
<!-- START EDIT CONTENT -->

<div class="row">
<div class="col-lg-12">
<!-- START Basic Elements -->
<h4 class="m-t-3 text-uppercase">Add New Project</h4>
<div class="row">
    <div class="col-lg-6">
        <?php echo form_open_multipart('dataentry/parse_data', array('id' => 'dataform','class'=>'form-horizontal'));?>
            <!--<div class="form-group">
                <label for="project_name" class="col-sm-3 control-label">Project Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="project_name">
                </div>
            </div>-->
            <div class="form-group">
                <label for="file_upload" class="col-sm-3 control-label">File input</label>
                <div class="col-sm-9">
                <input type="file" name="userfile" id="userfile">
                </div>
            </div>
            <!--<div class="form-group">
                <label for="to_datepicker" class="col-sm-3 control-label">To</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="daterange-singe-date-picker" id="to_datepicker">
                </div>
            </div>-->
            <input class="btn btn-primary" type="submit" name ="submit" value="Submit" id="uploader">
            <!--<button type="button" class="btn btn-primary">Submit</button>-->
        <?php echo form_close() ?>
    </div>
    <div class="col-md-4 col-md-offset-2"></div>
</div>
</div>
</div>

<!-- END EDIT CONTENT -->
</div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>

<script>
    $(document).ready(function() {
    });
    $('#from_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $('#to_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>
<!--<script>
    // Hide loader
    (function() {
        var bodyElement = document.querySelector('body');
        bodyElement.classList.add('loading');

        document.addEventListener('readystatechange', function() {
            if(document.readyState === 'complete') {
                var bodyElement = document.querySelector('body');
                var loaderElement = document.querySelector('#initial-loader');

                bodyElement.classList.add('loaded');
                setTimeout(function() {
                    bodyElement.removeChild(loaderElement);
                    bodyElement.classList.remove('loading', 'loaded');
                }, 200);
            }
        });
    })();
</script>-->