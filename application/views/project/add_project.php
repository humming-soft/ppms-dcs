<script src="<?php echo base_url(); ?>assets/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/sweetalert.css">
<div class="content">
    <!-- START Sub-Navbar with Header only-->
    <div class="sub-navbar sub-navbar__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header m-t-0">
                        <h3 class="m-t-0">Forms</h3>
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
                        <!-- <h3>Forms</h3> -->
                    </div>
                    <ol class="breadcrumb navbar-text navbar-right no-bg">
                        <li class="current-parent">
                            <a class="current-parent" href="../index.html">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Project
                            </a>
                        </li>
                        <li class="active">Add New Project</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->


    <div class="container">
        <?php if($this->session->flashdata('success')){ $success = $this->session->flashdata('success');?>
            <script type="text/javascript">
                swal({
                    title: 'Success!',
                    text:  '<?php echo $success; ?>',
                    type:   'success',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>
        <?php } ;?>
        <?php  if($this->session->flashdata('error')){$error = $this->session->flashdata('error');?>
            <script type="text/javascript">
                swal({
                    title: 'Sorry!',
                    text:  '<?php echo $error; ?>',
                    type:   'error',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>
        <?php } ;?>
        <div class="row">
            <div class="col-lg-12">
                <!-- START Basic Elements -->
                <h4 class="m-t-3">Add New Project</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-horizontal">
                            <?php echo form_open('project/add_new_project' , array('id' => 'validations'));?>
                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Project Name<span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="project_name" name="strProjectName">
                                    <?php echo form_error('strProjectName'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Description<span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="strProjectDesc" name="strProjectDesc">
                                    <?php echo form_error('strProjectDesc'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Cotractor name<span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="strContractName" name="strContractName">
                                    <?php echo form_error('strProjectDesc'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="project_name" class="col-sm-3 control-label">Total Project Value<span class="text-danger">*</span> </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="strPjtValue" name="strPjtValue">
                                    <?php echo form_error('strProjectDesc'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <select name="strMessureId" class="form-control" id="strMessureId">
                                        <option value="MYR" selected="selected">MYR</option>
                                        <option value="INR" selected="selected">INR</option>
                                        <option value="USD" selected="selected">USD</option>
                                        <option value="SGD" selected="selected">SGD</option>
                                    </select>
                                    <?php echo form_error('intRegionId'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">From<span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="from_datepicker" name="dateFrom">
                                    <?php echo form_error('dateFrom'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="to_datepicker" class="col-sm-3 control-label">To<span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="to_datepicker" name="dateTo">
                                    <?php echo form_error('dateTo'); ?>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Parking <span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="intParking" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="intParking" value="0"> No
                                    </label>
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Depot <span class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="intDepot" value="1">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="intDepot" value="0">No
                                    </label>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="insert" class="col-sm-3 control-label"></label>
                                <div class="col-sm-2">
                                    <button type="submit"  id="buttonSubmit" class="btn btn-block m-b-2 btn-primary" name="insert" id="insert">Save</button>
                                </div>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-2"></div>
                </div>
                <!-- END Basic Elements -->
            </div>
        </div>

        <!-- END EDIT CONTENT -->
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>
<script>
    $("#projectMaster").addClass("active open");
    $("#subProject").addClass("active open");
</script>
<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetes allowed");
        $("#validations").validate({
            rules: {
                strProjectName: {
                    minlength: 2,
                    required: true
                },
                strProjectDesc: {
                    minlength: 2,
                    required: true
                },
                dateFrom:{
                    required: true
                },
                dateTo:{
                    required: true
                }
            },
            messages: {
                strProjectName: {
                    required: "Project Name required"
                },
                strProjectDesc: {
                    required: "Project Description is required"
                },
                dateFrom: {
                    required: "Project Start Date is Required  required"
                },
                dateTo: {
                    required: "Project End Date is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
                jQuery(element.parent()).addClass('has-error m-b-1'); // to show error on element also
            }
        });
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