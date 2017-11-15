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
                        <h3>Forms</h3>
                    </div>
                    <ol class="breadcrumb navbar-text navbar-right no-bg">
                        <li class="current-parent">
                            <a class="current-parent" href="../index.html">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Forms
                            </a>
                        </li>
                        <li class="active">Forms</li>
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
                <p>Individual form controls automatically receive some global styling. All textual input, textarea, and select elements with <kbd>.form-control</kbd> are set to width: 100%; by default. Wrap labels and controls in <kbd>.form-group</kbd> for optimum spacing.</p>

                <!-- START Basic Elements -->
                <h4 class="m-t-3">Basic Elements</h4>
                <p class="m-b-2 m-t-0">Individual form controls automatically receive some global styling.</p>
                <p class="text-muted text-uppercase"><small><strong>Examples</strong></small></p>
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Normal Input</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Help Text</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control">
                                    <span id="helpBlock" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Placeholder</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="Placeholder...">
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Disabled Input</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="Disabled Input Here..." disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Textarea</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Static Control</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">email@example.com</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-md-offset-2"></div>
                </div>
                <!-- END Basic Elements -->
            </div>
        </div>

        <!-- END EDIT CONTENT -->
    </div>
</div>
<script>
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
</script>