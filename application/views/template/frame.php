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
        <img class="logo-slim" src="<?php echo base_url(); ?>assets/images/spin-logo-slim.png" alt="Logo">
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

            <!--<li class="Dashboards">
                <a href="#" title="Dashboards">
                    <i class="fa fa-check-square-o fa-fw fa-lg"></i><span class="nav-label">Master</span><i class="fa arrow"></i>
                </a>
                <ul>
                    <li class="">
                        <a href="<?php /*echo base_url('common/form1') */?>">
                            <span class="nav-label">User</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?php /*echo base_url('common/form2') */?>">
                            <span class="nav-label">Role</span>
                        </a>
                    </li>
                </ul>
            </li>-->

            <li class="Dashboards active open">

                    <?php if($_SESSION['usergroup']==2) {
                        ?>
                        <a href="#" title="Dashboards" id="projectMaster">
                            <i class="fa fa-check-square-o fa-fw fa-lg"></i><span class="nav-label">DATA MANAGEMENT</span><i class="fa arrow"></i>
                        </a>
                    <ul>
                        <li class="active open" id="dataEntry">
                            <a href="<?php echo base_url('dataentry/list_dataentry') ?>">
                                <span class="nav-label">Data Entry</span>
                            </a>
                        </li>
                    </ul>
                    <?php
                    }if($_SESSION['usergroup']==1){ ?>
                        <a href="#" title="Dashboards" id="projectMaster">
                            <i class="fa fa-check-square-o fa-fw fa-lg"></i><span class="nav-label">SETTINGS</span><i class="fa arrow"></i>
                        </a>
                        <ul>
                            <li class="" id="subProject">
                                <a href="<?php echo base_url('project/list_project') ?>">
                                    <span class="nav-label">Project</span>
                                </a>
                            </li>
                            <li class="" id="subJournal">
                                <a href="<?php echo base_url('journal/list_journals') ?>">
                                    <span class="nav-label">Journals</span>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }if($_SESSION['usergroup']==3){?>
                        <a href="#" title="Dashboards" id="projectMaster">
                            <i class="fa fa-check-square-o fa-fw fa-lg"></i><span class="nav-label">ADMINISTRATION</span><i class="fa arrow"></i>
                        </a>
                        <ul>
                            <li class="" id="subProject">
                                <a href="<?php echo base_url('project/list_project') ?>">
                                    <span class="nav-label">Project</span>
                                </a>
                            </li>
                            <li class="" id="subJournal">
                                <a href="<?php echo base_url('journal/list_journals') ?>">
                                    <span class="nav-label">Journals</span>
                                </a>
                            </li>
                            <li class="" id="synchronice">
                                <a href="<?php echo base_url('syncronice/synchdb') ?>">
                                    <span class="nav-label">SYNCHRONICE</span>
                                </a>
                            </li>
                            <li class="" id="dataEntry">
                                <a href="<?php echo base_url('dataentry/list_dataentry') ?>">
                                    <span class="nav-label">Data Entry</span>
                                </a>
                            </li>

                        </ul>
                   <?php }
                    ?>
                <!--  <li class="" id="stations">
                        <a href="<?php /*echo base_url('project/list_stations') */?>">
                            <span class="nav-label">Stations</span>
                        </a>
                    </li>-->

            </li>
        </ul>
        <!-- END Tree Sidebar Common  -->
    </div>
</aside>
<!-- END Sidebars -->
</nav>