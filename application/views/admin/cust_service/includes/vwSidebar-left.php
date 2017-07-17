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
                    <li class="">
                        <a href="<?php echo base_url(); ?>cs_admin/csAddForApprovalJobs">
                            <i class="menu-icon fa fa-list-alt"></i>
                            <span class="menu-text" style="font-size: 11px;"> Add For Approval Jobs </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>cs_admin/csListForApprovalJobs">
                            <i class="menu-icon fa fa-list-alt"></i>
                            <span class="menu-text" style="font-size: 11px;"> List For Approval Jobs </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url().'cs_adminworkflow/workflow';?>" target="_blank">
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
                </ul>

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



    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.custom.js"></script>
    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-ui.js"></script>
    <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

  
</div>
