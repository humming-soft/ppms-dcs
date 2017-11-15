<!-- start: Javascript for validation-->
<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/sweetalert.css">
<!-- end: Javascript for validation-->
<div class="content">
    <!-- START Sub-Navbar with Header only-->
    <div class="sub-navbar sub-navbar__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header m-t-0">
                        <h3 class="m-t-0">DataTables</h3>
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
                <div class="col-lg-12">
                    <div class="col-md-8 sub-navbar-column">
                        <div class="sub-navbar-header">
                            <h3>Journal</h3>
                        </div>
                        <ol class="breadcrumb navbar-text navbar-right no-bg">
                            <li class="current-parent">
                                <a class="current-parent" href="<?php echo base_url(); ?>index-2.html">
                                    <i class="fa fa-fw fa-home"></i>
                                </a>
                            </li>
                            <li class="active">
                                List Journal
                            </li>
                            <!--<li class="active">DataTables</li>-->
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-primary pull-right" style="margin-top: 20px;" href="<?php echo base_url();?>journal/add_journal">
                            Add Journal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sub-Navbar with Header and Breadcrumbs-->


    <div class="container">
        <!-- START EDIT CONTENT -->
        <?php if($this->session->flashdata('success')){ 
            $success = $this->session->flashdata('success');
            ?>
            <!--<div class="alert no-bg b-l-success b-l-3 b-t-gray b-r-gray b-b-gray" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <strong class="text-white">Suscess!</strong> <span class="text-gray-lighter"><?php echo $this->session->flashdata('success'); ?>.</span>
            </div>-->
            <script type="text/javascript">
                swal({
                    title: 'Success!',
                    text: '<?php echo $success; ?>',
                    type: 'success',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>
            <?php } ;?>
            <?php  if($this->session->flashdata('error')){
                $error = $this->session->flashdata('error');
                ?>
            <!--<div class="alert no-bg b-l-warning b-l-3 b-t-gray b-r-gray b-b-gray" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#xD7;</span></button>
                <strong class="text-white">Faild!</strong> <span class="text-gray-lighter"><?php echo $this->session->flashdata('error'); ?>.</span>
            </div> -->
            <script type="text/javascript">
                swal({
                    title: 'Error!',
                    text: '<?php echo $error; ?>',
                    type: 'error',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            </script>
            <?php } ;?>
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatables-example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th  style="font-weight: 600; color: #2c97de">No</th>
                                <th  style="font-weight: 600; color: #2c97de">Project Name</th>
                                <th  style="font-weight: 600; color: #2c97de">Journal Name</th>
                                <th  style="font-weight: 600; color: #2c97de">Type</th>
                                <th  style="font-weight: 600; color: #2c97de">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sno=1;
                            foreach ($journal as $journal):?>
                            <tr>
                                <td class="text-white"><?php echo $sno; ?></td>
                                <td class="text-white"><?php echo $journal['pjct_name']; ?></td>
                                <td class="text-white"><?php echo $journal['journal_name']; ?></td>
                                <td class="text-white"><?php echo $journal['journal_type_name']; ?></td>
                                <td class="text-center v-a-m">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="" data-toggle="modal" data-target="#myModal1" class="modaledit" data-journalId="<?php echo $journal['journal_master_id']; ?>" data-status="<?php echo $journal['journal_status']; ?>"  data-category="<?php echo $journal['journal_category_id'];?>" data-projectId="<?php echo $journal['pjct_master_id']; ?>" data-journalName="<?php echo $journal['journal_name'] ?>" data-typeId="<?php echo $journal['journal_type_id']; ?>" ><span class="glyphicon glyphicon-edit">&nbsp;</span></a>
                                        <a href="javascript:;" id="showtoaster" class="modaldelete" data-journalId="<?php echo $journal['journal_master_id']; ?>" data-status="<?php echo $journal['journal_status']; ?>" data-journalName="<?php echo $journal['journal_name'] ?>"  ><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $sno=$sno+1;
                            endforeach; ?>
                        </tbody>
                    </table>
                    <!-- END Zero Configuration -->
                </div>
            </div>
            <!-- END EDIT CONTENT -->
        </div>

    </div>

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit The Journal Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-horizontal">
                                <?php echo form_open('journal/update_journal' , array('id' => 'validations'));?>
                                <div class="form-group">
                                    <label for="name1" class="col-sm-3 control-label">Project Name</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="journalId" name ="journalId">
                                        <select name="intPjtId" class="form-control" id="intPjtId"  >
                                            <option value="-1">Select Project</option>
                                            <?php
                                            foreach ($records as $rec):?>
                                            <option value="<?php echo $rec->pjct_master_id; ?>"><?php echo $rec->pjct_name; ?> </option>
                                        <?php  endforeach;?>
                                    </select>
                                    <?php echo form_error('name'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="strJournal" name ="strJournal">
                                    <?php echo form_error('mobile'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name1" class="col-sm-3 control-label">Journal Type</label>
                                <div class="col-sm-9">
                                    <select name="intJournalType" class="form-control" id="intJournalType">
                                        <option value="-1">Select Journal Type</option>
                                        <?php
                                        foreach ($journalType as $journaType):?>
                                        <option value="<?php echo $journaType->journal_type_id; ?>"><?php echo $journaType->journal_type_name; ?> </option>
                                    <?php  endforeach;?>
                                </select>
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="selectshow">
                            <label for="name1" class="col-sm-3 control-label">Journal Category</label>
                            <div class="col-sm-9">
                                <select name="intCatId" class="form-control" id="intCatId">
                                    <option value="-1">Select Journal Category</option>
                                    <?php
                                    foreach ($category as $category):?>
                                    <option value="<?php echo $category->journal_category_id; ?>"><?php echo $category->journal_category_name; ?> </option>
                                <?php  endforeach;?>
                            </select>
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2"></div>

                <!-- END Basic Elements -->
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary btn-sm" value="Save Changes" />
    </div>
    <?php echo form_close();?>
</div>
</div>
</div>

<script>
    $("#datatables-example").DataTable();
    $('div.dataTables_filter input').attr('placeholder', 'Enter the text here');
</script>
<script>
    $("#projectMaster").addClass("active open");
    $("#subJournal").addClass("active open");
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
        $(".modaledit").click(function(){
            $('#intCatId').val( $(this).attr("data-category") );
            if($(this).attr("data-category")==-1){
                $('#selectshow').hide();
            }else{
                $('#selectshow').show();
            }
            if($(this).attr("data-status")==1){
                $('#intPjtId').attr('disabled',true);
                $('#intJournalType').attr('disabled',true);
                $('#intCatId').attr('disabled',true);
            }else{
                $('#intPjtId').attr('disabled',false);
                $('#intJournalType').attr('disabled',false);
                $('#intCatId').attr('disabled',false);
            }
            $('#intPjtId').val( $(this).attr("data-projectId") );
            $('#strJournal').val( $(this).attr("data-journalName") );
            $('#intJournalType').val( $(this).attr("data-typeId") );
            $('#journalId').val( $(this).attr("data-journalId") );
        });

    });
    $( "#intJournalType" ).change(function() {
        var val=$('#intJournalType').val( );
        if(val==1){
            $('#selectshow').show();
        }else{
            $('#selectshow').hide();
            $('#intCatId').val(-1);
        }
    });
    $('#from_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $('#to_datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
    $(".modaldelete").click(function(){
        var id = $(this).attr("data-journalId");
        var str1 = "Journal ";
        var jname = $(this).attr("data-journalName");
        var str3 = " is safe :)";
        var res = str1.concat(jname,str3); 
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            allowEscapeKey: false,
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            closeOnCancel: false 
        },
        function(isConfirm) {
            if (isConfirm) {
                $.post( "<?php echo base_url(); ?>journal/delete_journal",{id:id}, function( data ) {
                    location.reload();
                });
            } else {
                swal({
                    title: 'Error!',
                    text: res,
                    type: 'error',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
            }
        }
        );
    });
   /* $(".modaldelete").click(function(){
        var id = $(this).attr("data-journalId");
        swal({
                title: "Are you sure?",
                text: "to delete the journal!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url:"<?php echo site_url('ajxjournal/delete_journal'); ?>",
                        dataType: 'json',
                        data: {userid: id},
                        async: false,
                        dataType: "json",
                        success: function (data) {
                            if (data.status == "success") {
                                swal("Deleted!", "Journal" +"'"+ data.journal +"'"+ " deleted.", "success");
                                window.location = data.url;
                            }
                        },
                        failure: function () {
                            console.log(' Ajax Failure');
                        },
                        complete: function () {
                            console.log("com");
                        }
                    });
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        });*/
    </script>
