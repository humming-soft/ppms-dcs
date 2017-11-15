<html>
<head>
	<title>Tester</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <p>Individual form controls automatically receive some global styling. All textual input, textarea, and select elements with <kbd>.form-control</kbd> are set to width: 100%; by default. Wrap labels and controls in <kbd>.form-group</kbd> for optimum spacing.</p>

            <!-- START Basic Elements -->
            <h4 class="m-t-3">Basic Elements</h4>
            <p class="m-b-2 m-t-0">Individual form controls automatically receive some global styling.</p>
            <p class="text-muted text-uppercase"><small><strong>Examples</strong></small></p>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-horizontal">
                      <?php echo form_open('test/form4_submit' , array('id' => 'form4'));?>
                      <div class="form-group">
                        <label for="name1" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name ="name">
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile1" class="col-sm-3 control-label">Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  id="mobile" name ="mobile">
                            <?php echo form_error('mobile'); ?>					
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email1" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  id="email" name ="email">
                            <?php echo form_error('email'); ?>					
                        </div>
                    </div>			
                    <div class="form-group">
                     <label for="insert" class="col-sm-3 control-label"></label>			
                     <div class="col-sm-2">
                       <button type="submit" class="btn btn-block m-b-2 btn-primary" name="insert" id="insert">Insert</button>
                   </div>
               </div>
               <?php echo form_close();?>			
           </div>
       </div>
       <div class="col-md-4 col-md-offset-2"></div>
   </div>
   <!-- END Basic Elements -->
   <!-- start: Javascript for validation-->
   <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/jquery/jquery.validate.js"></script>
   <script src="<?php echo base_url(); ?>assets/jquery/additional-methods.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/Validations/image_upload.js"></script>	
   <!-- end: Javascript for validation-->
   <script type="text/javascript">
     
    $(document).ready(function() {

        jQuery.validator.addMethod("fullname", function (value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters"); 	
        $("#form4").validate({
            rules: {
               name: {
                fullname: true,
                minlength: 2,
                required: true
            },
            mobile:{			
                required: true,
                number: true
            },
            email:{			
                required: true,
                email: true
            }				
        },
        messages: {
         name: {
            required: "Name required",
            alphanumeric: true				
        },
        mobile: {
            required: "Mobile required"
        },
        email: {
            required: "Email required"
        }			
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
        error.appendTo(element.parent());
    }

});
    });

</script>
</body>
</html>