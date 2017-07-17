<div id="sidebar" class="sidebar                  responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>
    <?php
    $admin_id = $this->session->userdata('admin_id');
    $sql = "select `admin_type` from `admin` where `id`='$admin_id'";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
        $fetch = $query->row();

        $admin_type = $fetch->admin_type;
    } else {
        $admin_type = 0;
    }
    ?>
    <ul class="nav nav-list">
        <li class="active">
            <a href="<?php echo base_url(); ?>admin/">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="<?php echo base_url(); ?>admin/sitesettings">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Site Settings </span>
            </a>

            <b class="arrow"></b>
        </li>

        <!--                    <li class="">-->
        <!--						<a href="#" class="dropdown-toggle">-->
        <!--							<i class="menu-icon fa fa-list-alt"></i>-->
        <!--							<span class="menu-text">-->
        <!--							Main Banner-->
        <!--							</span>-->
        <!---->
        <!--							<b class="arrow fa fa-angle-down"></b>-->
        <!--						</a>-->
        <!---->
        <!--						<b class="arrow"></b>-->
        <!---->
        <!--						<ul class="submenu">-->
        <!--                        	<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/mainbanner/add">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--									Add Main Banner-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--							<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/mainbannerlist">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--								 Main Banner List-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--						</ul>-->
        <!--					</li>-->
        <!--					-->
        <!--					-->
        <!---->
        <!--                    <li class="">-->
        <!--						<a href="#" class="dropdown-toggle">-->
        <!--							<i class="menu-icon fa fa-list-alt"></i>-->
        <!--							<span class="menu-text">-->
        <!--							Banner-->
        <!--							</span>-->
        <!---->
        <!--							<b class="arrow fa fa-angle-down"></b>-->
        <!--						</a>-->
        <!---->
        <!--						<b class="arrow"></b>-->
        <!---->
        <!--						<ul class="submenu">-->
        <!--                        	<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/addbanner">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--									Add Banner-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--							<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/banner">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--								Banners List-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--						</ul>-->
        <!--					</li>-->
        <!---->
        <!--                    <li class="">-->
        <!--						<a href="#" class="dropdown-toggle">-->
        <!--							<i class="menu-icon fa fa-list-alt"></i>-->
        <!--							<span class="menu-text">-->
        <!--							Testimonials-->
        <!--							</span>-->
        <!---->
        <!--							<b class="arrow fa fa-angle-down"></b>-->
        <!--						</a>-->
        <!---->
        <!--						<b class="arrow"></b>-->
        <!---->
        <!--						<ul class="submenu">-->
        <!--                        	<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/testimonial/add">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--									Add Testimonial-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--							<li class="">-->
        <!--								<a href="--><?php //echo base_url(); ?><!--admin/testimoniallist">-->
        <!--									<i class="menu-icon fa fa-caret-right"></i>-->
        <!--								 Testimonials List-->
        <!--								</a>-->
        <!---->
        <!--								<b class="arrow"></b>-->
        <!--							</li>-->
        <!---->
        <!--						</ul>-->
        <!--					</li>-->

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">
							Admin
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <?php if (!in_array($admin_type, array(4))) { ?>
                    <li class="">
                        <a href="<?php echo base_url(); ?>admin/addadmin">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Admin
                        </a>

                        <b class="arrow"></b>
                    </li>
                <?php } ?>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin/adminlist">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Admin List
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="">
            <a href="<?php echo base_url(); ?>admin/workflow" target="_blank">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">Workflow</span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="<?php echo base_url(); ?>admin/compliants">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">Compliants</span>

                <span style="font-size: 10px;color:  #fff;font-weight: bold;  border:1px solid #F74747; border-radius: 100px;padding:0% 3%;background-color:#F74747" id="compliants"><?php 
                        $query="SELECT COUNT(*) as counted FROM workflow_compliants";
                        $result=$this->db->query($query);
                       echo $result->result()[0]->counted;


                ?></span>
            </a>

            <b class="arrow"></b>
        </li>
        

        <li class="">
            <a href="<?php echo base_url(); ?>admin/cms">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">CMS Pages</span>
            </a>

            <b class="arrow"></b>
        </li>


        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">
							Translators
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <?php if (!in_array($admin_type, array(4))) { ?>
                    <li class="">
                        <a href="<?php echo base_url(); ?>translator/add_translator">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Add Translator
                        </a>

                        <b class="arrow"></b>
                    </li>
                <?php } ?>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_translators/0/">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Translator List
                    </a>

                    <b class="arrow"></b>
                </li>
                <li>
                    <a href="<?php echo base_url().'admin_blocked_translators/0/';?>">
                         <i class="menu-icon fa fa-caret-right"></i>
                        Blocked Translator
                    </a>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>




        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">
							Jobs
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url(); ?>admin/pendingjobpost">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <?php
                        $this->db->select('*');
                        $this->db->from('jobpost');
                        $this->db->where("jobpost.id NOT IN (SELECT job_id FROM proofread_jobs)");

                        $this->db->where("approval_status", 0);

                        $query = $this->db->get();
                        $pendingCount = $query->num_rows();
                        ?>
                        Pending Approval
                        <span style="font-size: 10px;color:  #fff;font-weight: bold;  border:1px solid #F74747; border-radius: 100px;padding:0% 3%;background-color:#F74747"><?php echo $pendingCount; ?></span>
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin/jobpost/add">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Job
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin/joblist">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Job List
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin/hiringjob">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <span class="menu-text">Hiring Jobs</span>
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>dashboard/index">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <?php
                        $sql = "SELECT * FROM (`bidjob`) WHERE `stage` = 1 AND `awarded` = 1 AND `bidjob`.`job_id` NOT IN (SELECT job_id FROM proofread_jobs) GROUP BY `bidjob`.`id`";
                        $query = $this->db->query($sql);
                        $doneWorkCount = $query->num_rows();
                        ?>
                        <span class="menu-text">Working Jobs-(Awarded)</span>
                        <span style="font-size: 10px;color:  #fff;font-weight: bold;  border:1px solid #F74747; border-radius: 100px;padding:0% 3%;background-color:#F74747"><?php echo $doneWorkCount; ?></span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?php echo base_url(); ?>admin/awardjob">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <span class="menu-text">Completed Jobs</span>
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">
							Review
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/joblist">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <?php
                        $this->db->select('*, proofread_jobs.id as pf_id');
                        $this->db->from('jobpost');
                        $this->db->join('proofread_jobs', 'proofread_jobs.job_id = jobpost.id');
                        $this->db->where("review_stage", 0);
                        $this->db->where("proofread_required IN (-1, 0, 1)");
                        $this->db->where('approval_status', 0);
                        $this->db->group_by('jobpost.id');
                        $this->db->order_by("jobpost.created", "desc");
                        $query = $this->db->get();
                        $pendingCount = $query->num_rows();
                        ?>
                        Review Pending
                        <span style="font-size: 10px;color:  #fff;font-weight: bold;  border:1px solid #F74747; border-radius: 100px;padding:0% 3%;background-color:#F74747"><?php echo $pendingCount; ?></span>
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/add">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Review Job
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/review/joblist">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Review Job List
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/hiring">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Review Hiring
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/working">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <?php
                        $this->db->select('j.*, b.id as bid_id, b.*');
                        $this->db->from('jobpost as j');
                        $this->db->join('proofread_jobs as prj', 'prj.job_id = j.id');
                        $this->db->join('bidjob as b', 'b.job_id = j.id');
                        $this->db->where('prj.review_stage', 2);
                        $this->db->where('(b.is_done != 1 OR b.is_rated != 1)');
                        $this->db->where(array(
                            'b.awarded' => 1,
                            'j.approval_status' => 1
                        ));
                        $query = $this->db->get();
                        $doneWorkCount = $query->num_rows();
                        ?>
                        <span class="menu-text">Review Working</span>
                        <span style="font-size: 10px;color:  #fff;font-weight: bold;  border:1px solid #F74747; border-radius: 100px;padding:0% 3%;background-color:#F74747"><?php echo $doneWorkCount; ?></span>
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>admin_review/completed">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <span class="menu-text">Review Completed</span>
                    </a>
            </ul>
        </li>

        <li class="">
            <a href="<?php echo base_url(); ?>admin/invoice">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">Invoice</span>
            </a>

            <b class="arrow"></b>
        </li>
        </li>

        <?php
        if (in_array($admin_type, array('1', '5'))) {
            ?>
            <li class="">
                <a href="<?php echo base_url(); ?>admin/profit">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text">Finance Page</span>
                </a>
                <b class="arrow"></b>
            </li>
        <?php } ?>

        <li class="">
            <a href="<?php echo base_url(); ?>admin/messages">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">Messages</span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="javascript: void(0)" ; id="ace-support-btn"
               style="background-color: #e59729 !important; color: #000000;">
                <i class="menu-icon fa fa-life-ring"></i>
                <span class="menu-text" style="font-size: 12px">Report Technical Issue</span>
            </a>

            <b class="arrow"></b>
        </li>
        <!-- <li class="">
						<a href="<?php echo base_url(); ?>admin/messages">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text">Messages</span>
						</a>

						<b class="arrow"></b>
					</li>-->

    </ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
           data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>


    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>

    <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/jquery-ui.css"/>

    <style>
        .ui-dialog {
            z-index: 1000000000;
            top: 0;
            left: 0;
            margin: auto;
            position: fixed;
            max-width: 100%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .ui-dialog .ui-dialog-content {
            flex: 1;
        }
    </style>
    <div id="dialog-support" title="Report Technical Issue" style="display:none;">
        <form id="support-form">
            <div class="row" style="padding: 5px">
                <div class="col-md-3">Subject</div>
                <div class="col-md-9"><input type="text" id="subject" name="subject" style="width: 100%;height: 32px"
                                             required></div>
            </div>

            <div class="row" style="padding: 5px">
                <div class="col-md-3">Page</div>
                <div class="col-md-9"><input type="text" name="page" style="width: 100%;height: 32px"></div>
            </div>

            <div class="row" style="padding: 5px">
                <div class="col-md-3">URL</div>
                <div class="col-md-9"><input type="text" name="url" style="width: 100%;height: 32px"></div>
            </div>

            <div class="row" style="padding: 5px">
                <div class="col-md-12">Error Details</div>
                <div class="col-md-12"><textarea id="error-details" name="details" style="width: 100%; height: 130px;"
                                                 required></textarea></div>
            </div>
        </form>

        <div id="dialog-support-message" title="Report Technical Issue" style="display:none;">
            <div class="message-wrapper" style="padding: 10px; font-size: 15px;"></div>
        </div>
    </div>

    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.custom.js"></script>
    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.js"></script>
    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#ace-support-btn', function (e) {
                $('#dialog-support').dialog({
                    resizable: false,
                    height: "auto",
                    width: 600,
                    modal: false,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(".ui-dialog-titlebar-close").hide();
                    },
                    buttons: {
                        'Report': function () {

                            if ($('#subject').val() == '' || $('#error-details').val() == '') {
                                $('#dialog-support-message').dialog({
                                    resizable: false,
                                    height: "auto",
                                    width: 600,
                                    modal: false,
                                    closeOnEscape: false,
                                    open: function (event, ui) {
                                        $(".ui-dialog-titlebar-close").hide();
                                    },
                                    buttons: {
                                        'Okay': function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });

                                $('.message-wrapper').html('Subject and error details should have a value');
                            } else {
                                $(this).dialog('close');

                                $.ajax({
                                    url: "<?php echo base_url('admin/techissue') ?>",
                                    type: 'post',
                                    data: $('#support-form').serialize(),
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response.success) {
                                            $('#dialog-support-message').dialog({
                                                resizable: false,
                                                height: "auto",
                                                width: 600,
                                                modal: false,
                                                closeOnEscape: false,
                                                open: function (event, ui) {
                                                    $(".ui-dialog-titlebar-close").hide();
                                                },
                                                buttons: {
                                                    'Okay': function () {
                                                        $(this).dialog('close');
                                                    }
                                                }
                                            });

                                            $('.message-wrapper').html(response.message);
                                        }
                                    }

                                });
                            }

                        },
                        'Close': function () {
                            $(this).dialog('close');
                        }
                    }
                });
            });
        });
    </script>
</div>
