<!-- start: Javascript for validation-->
<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/js/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/date-range-picker-settings.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/sweetalert.css">
<div class="content">
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
                                Journal Data Entry
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <table id="datatables-example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th  style="font-weight: 600; color: #2c97de">No</th>
                        <th  style="font-weight: 600; color: #2c97de">Project Name</th>
                        <th  style="font-weight: 600; color: #2c97de">Journal Name</th>
                        <th  style="font-weight: 600; color: #2c97de">Excel Format</th>
                        <th  style="font-weight: 600;color: #2c97de">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sno=1;
                    foreach ($journal as $journal):?>
                        <tr>
                            <td class="text-white"><?php echo $sno; ?></td>
                            <td class="text-white"><?php echo $journal['pjct_name']; ?></td>
                            <td class="text-white"><?php echo $journal['journal_name']; ?></td>
                            <td class="text-white" align="center"> <a href="" data-toggle="modal" <?php if($journal['journal_type_id']==1){?> data-target="#myModalFile" class="modalFile" <?php } else if($journal['journal_type_id']==2) { ?> data-target="#myModalImage" class="modalImage" <?php } else { ?>  data-target="#myModalDataManual" class="modalMaual" <?php } ?> data-journalId="<?php echo $journal['journal_master_id']; ?>" data-pjctName="<?php echo $journal['pjct_name']; ?>" data-journalName="<?php echo $journal['journal_name']; ?>" data-journalType="<?php echo $journal['journal_type_name']; ?>" data-category="<?php echo $journal['journal_category_id']; ?>"  data-cost="<?php echo $journal['pjt_cost']; ?>"   data-meas="<?php echo $journal['pjt_cost_mes']; ?>"><?php if($journal['journal_type_id']==1){?> <span class="glyphicon glyphicon-file" data-toggle="tooltip" data-placement="top" title="File Format">&nbsp;</span><?php }  ?></a><?php if($journal['journal_type_id']==3) {?> Data Entry <?php } ?>   </td>
                            <td class="text-center v-a-m">
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" data-toggle="modal" <?php if($journal['journal_type_id']==1){?> data-target="#myModalData" class="modalData" <?php } else if($journal['journal_type_id']==2) { ?> data-target="#myModalImage" class="modalImage" <?php } else { ?>  data-target="#myModalDataManual" class="modalMaual" <?php } ?> data-journalId="<?php echo $journal['journal_master_id']; ?>" data-pjctName="<?php echo $journal['pjct_name']; ?>" data-journalName="<?php echo $journal['journal_name']; ?>" data-journalType="<?php echo $journal['journal_type_name']; ?>" data-category="<?php echo $journal['journal_category_id']; ?>"  data-cost="<?php echo $journal['pjt_cost']; ?>"   data-meas="<?php echo $journal['pjt_cost_mes']; ?>"><?php if($journal['journal_type_id']==1){?> <span class="glyphicon glyphicon-upload" data-toggle="tooltip" data-placement="top" title="Upload">&nbsp;</span><?php } if($journal['journal_type_id']==3) {?> Update <?php } ?></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $sno=$sno+1;
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open_multipart('dataentry/doupload' , array('id' => 'validations'));?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">File Format </h4>
            </div>
            <div class="modal-body">
                <input type="hidden"  name="ur" id="ur" value=" <?php echo base_url(); ?>">

                <div class="row ">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-3">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strJournalNameFile" name="strJournalNameFile"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Format</label>
                                <div class="col-sm-3">
                                    <label for="strJournalName" class="control-label" style="color: white">  Excel / CSV</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6 col-md-4">
                                    <div class="thumbnail no-bg b-a-2 b-gray-dark">
                                        <img id="priview"  name ="priview" alt="100%x200" data-holder-rendered="true">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open_multipart('dataentry/doupload' , array('id' => 'validations'));?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image Journal Entry </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <input type="hidden"  name="journalimage" id="journalimage">

                                <label for="mobile1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strImgPjctname" name="strImgPjctname"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strImgJournalName" name="strImgJournalName"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">Data Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="image_datepicker" name="datadateImage">
                                    <?php echo form_error('dateFrom'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Upload Image</label>
                                <div class="col-sm-9" >
                                    <input type="file" name="userfile[]" class="form-control" id="filer_input" data-jfiler-extensions="jpg,png" multiple="multiple">
                                    <?php echo form_error('userfile[]'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary btn-sm"  name ="fileSubmit" value="Submit" id="uploader" />
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Journal Data Entry </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <?php echo form_open_multipart('dataentry/parse_data', array('id' => 'dataform','class'=>'form-horizontal'));?>
                            <div class="form-group">
                                <input type="hidden"  name="journalid" id="journalid">
                                <input type="hidden"  name="categoryId" id="categoryId">
                                <label for="mobile1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strPjctname" name="strPjctname"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strJournalName" name="strJournalName"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">Data Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="data_date" name="datadate">
                                    <?php echo form_error('datadate'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="col-sm-3 control-label">File input</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" id="exampleInputFile">
                                    <?php echo form_error('mobile'); ?>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <input class="btn btn-primary btn-sm" type="submit" name ="submit" value="Submit" id="uploader">
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalDataManual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Journal Data Entry </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-horizontal">
                            <?php echo form_open_multipart('dataentry/parse_data_manual', array('id' => 'dataform1','class'=>'form-horizontal'));?>
                            <div class="form-group">
                                <input type="hidden"  name="journalid1" id="journalid1">
                                <input type="hidden"  name="categoryId1" id="categoryId1">
                                <label for="mobile1" class="col-sm-3 control-label">Project Name</label>
                                <div class="col-sm-9">
                                    <label for="strPjctname" class="control-label" style="color: white" id="strPjctname1" name="strPjctname1"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile1" class="col-sm-3 control-label">Journal Name</label>
                                <div class="col-sm-9">
                                    <label for="strJournalName" class="control-label" style="color: white" id="strJournalName1" name="strJournalName1"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="from_datepicker" class="col-sm-3 control-label">Data Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  id="data_date1" name="datadate1">
                                    <?php echo form_error('datadate'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="col-sm-3 control-label">Total Cost</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  id="total" name="total" readonly="true">
                                    <?php echo form_error('total'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <select name="strMessureId" class="form-control" id="strMessureId" readonly="true">
                                        <option value="MYR" selected="selected">MYR</option>
                                        <option value="INR" selected="selected">INR</option>
                                        <option value="USD" selected="selected">USD</option>
                                        <option value="SGD" selected="selected">SGD</option>
                                    </select>
                                    <?php echo form_error('intRegionId'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="col-sm-3 control-label">Earned</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  id="earned" name="earned" >
                                    <?php echo form_error('earned'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <select name="strMessureIdearned" class="form-control" id="strMessureIdearned" readonly="true">
                                        <option value="MYR" selected="selected">MYR</option>
                                        <option value="INR" selected="selected">INR</option>
                                        <option value="USD" selected="selected">USD</option>
                                        <option value="SGD" selected="selected">SGD</option>
                                    </select>
                                    <?php echo form_error('intRegionId'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="col-sm-3 control-label">Balance</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  id="balance" name="balance" readonly="true">
                                    <?php echo form_error('balance'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <select name="strMessureIdbalance" class="form-control" id="strMessureIdbalance" readonly="true">
                                        <option value="MYR" selected="selected">MYR</option>
                                        <option value="INR" selected="selected">INR</option>
                                        <option value="USD" selected="selected">USD</option>
                                        <option value="SGD" selected="selected">SGD</option>
                                    </select>
                                    <?php echo form_error('intRegionId'); ?>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 col-md-offset-2"></div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <input class="btn btn-primary btn-sm" type="submit" name ="submit" value="Submit" id="uploader">
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
    $("#dataEntry").addClass("active open");
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#earned').on('input',function(e){
            var total=$('#total').val( );
            var earned=$('#earned').val( );
            var balance=total - earned;
            $('#balance').val(balance);
        });
    });



</script>
<script>

        $(".modalData").click(function(){
            var projectName = $(this).attr("data-pjctName");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
            var category = $(this).attr("data-category");
            $('#journalid').val( journalId );
            $('#strPjctname').text(projectName) ;
            $('#strJournalName').text( journalName );
            $('#categoryId').val( category );
        });
        $(".modalMaual").click(function(){
            var projectName = $(this).attr("data-pjctName");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
            var category = $(this).attr("data-category");
            var cost= $(this).attr("data-cost");
            var meas=$(this).attr("data-meas");
            $('#journalid1').val( journalId );
            $('#total').val( cost );
            $('#strPjctname1').text(projectName) ;
            $('#strJournalName1').text( journalName );
            $('#categoryId1').val( category );
            $('#strMessureId').val( meas );
            $('#strMessureIdearned').val( meas );
            $('#strMessureIdbalance').val( meas );




        });
        $(".modalFile").click(function(){
            var journalName = $(this).attr("data-journalName");
            var category = $(this).attr("data-category");
            $('#strJournalNameFile').text( journalName );
            var val = $('#ur').val();
            if(category == 6){
                var urlim= val+"/assets/images/upcoming.png";
            }
            if(category == 7){
                var urlim= val+"/assets/images/Latetask.png";
            }
            if(category == 9){
                var urlim= val+"/assets/images/issue.png";
            }
            if(category == 10){
                var urlim= val+"/assets/images/s-curves.png";
            }
            if(category == 11){
                var urlim= val+"/assets/images/wbs.png";
            }
            $('#priview').attr("src",urlim);
        });

        $(".modalImage").click(function(){
            var projectName = $(this).attr("data-pjctName");
            var journalId = $(this).attr("data-journalId");
            var journalName = $(this).attr("data-journalName");
            $('#journalimage').val( journalId );
            $('#strImgPjctname').text(projectName) ;
            $('#strImgJournalName').text( journalName );
        });
        $('#data_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        $('#data_date1').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        $('#image_datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
</script>
<script type="text/javascript">

    $(document).ready(function() {
        $("#dataform1").validate({
            rules: {
                total: {
                    minlength: 1,
                    number:true,
                    required: true
                },
                balance:{
                    minlength: 1,
                    number:true,
                    required: true
                }
            },
            messages: {
                total: {
                    required: "Total required",
                },
                balance: {
                    required: "Balance required",
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
