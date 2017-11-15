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
                        <h3>Image Upload</h3>
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
                        <li class="active">Image Upload</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Sub-Navbar with Header and Breadcrumbs-->
              <div class="container">
                <div class="row">
                  <div class="table-responsive_a">
                  <div class="col-lg-12">                     
                     <!-- Example 1 -->
                     <?php echo "<font color='red'>$error</font>";?>
                     <?php echo "<font color='green'>$success</font>";?>
                     <?php echo form_open_multipart('common/doupload', array('id' => 'imageform'));?>
                     <input type="file" name="userFiles[]" id="filer_input" data-jfiler-extensions="jpg,png" multiple="multiple">
                      <?php echo form_error('files[]'); ?>
                     <input class="btn btn-primary pull-center" type="submit" name ="fileSubmit" value="Submit" id="uploader">
                     <?php echo form_close() ?>
                     <!-- end of Example 1 -->
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <script>
            document.getElementById("projectMaster").className="active open";
            document.getElementById("imageupload").className="active open";
          </script>
          <script type="text/javascript">

            $(document).ready(function() {    
              $("#imageform").validate({
                rules: {
                 'userFiles[]': {
                  required: true
                }               
              },
              errorElement: "span",
              errorPlacement: function(error, element) {
                error.appendTo(element.parent());
              jQuery(element.parent()).addClass('has-error m-b-1'); // to show error on element also        
            }

          });
            });

          </script>