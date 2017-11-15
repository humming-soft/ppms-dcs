<!-- START Footer -->
<footer>
    <div class="container-fluid">
        <p class="text-gray-dark">
            <strong class="m-r-1">Data Capture System </strong>
            <span class="text-gray-dark">&#xA9; 2016 - 2020. Powered by
             Hummworks, MY</span>
         </p>
     </div>
 </footer>
 <!-- END Footer -->

</div>

<!-- Bower Libraries Scripts -->
<script src="<?php echo base_url(); ?>assets/vendor/js/lib.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/app.min.8c5687ed.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/switchery-settings.js"></script>

<!-- start: Javascript for validation-->
<!--<script src="<?php /*echo base_url(); */?>assets/jquery/jquery.validate.js"></script>
<script src="<?php /*echo base_url(); */?>assets/jquery/additional-methods.min.js"></script>-->
<!-- end: Javascript for validation

<!-- Fileupload Scripts -->
<script src="<?php echo base_url(); ?>assets/plugins/jqueryfiler/js/jquery.filer.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqueryfiler/js/custom.js" type="text/javascript"></script>
<!--<script src="<?php /*echo base_url(); */?>assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
    // Hide loader
    $( document ).ready(function() {
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
    });
</script>
</body>
</html>