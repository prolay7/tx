<?php
$this->load->view('admin/includes/vwHeader');
?>


<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <!-- #section:basics/sidebar -->
    <?php
    $this->load->view('admin/includes/vwSidebar-left');
    ?>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <div class="main-content-inner">
            <!-- #section:basics/content.breadcrumbs -->
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Admin</a>
                    </li>
                    <li class="active">Admin List</li>
                </ul><!-- /.breadcrumb -->

                <!-- #section:basics/content.searchbox -->
                <!--<div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div>--><!-- /.nav-search -->

                <!-- /section:basics/content.searchbox -->
            </div>

            <!-- /section:basics/content.breadcrumbs -->
            <div class="page-content">
                <!-- #section:settings.box -->
                <?php
                $this->load->view('admin/includes/vwSidebar-settings');
                ?>
                <!-- /.ace-settings-container -->

                <!-- /section:settings.box -->
                <div class="page-header">
                    <h1>
                        Admin
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Admin List
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <?php if ($this->session->flashdata('msg') != "") { ?>
                    <div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <p> <?php echo $this->session->flashdata('msg'); ?> </p>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('wmsg') != "") { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <p> <?php echo $this->session->flashdata('wmsg'); ?> </p>
                    </div>
                <?php } ?>


                <div class="row">
                    <div class="col-xs-12">

                        <div>
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Results for "Admin List"
                        </div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="center">Name</th>
                                <th class="center">User Name</th>
                                <th class="center">Email Address</th>
                                <th class="center">User Type</th>
                                <th class="center">Status</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                            foreach ($results as $row) {

                                ?>
                                <tr>
                                    <td><?php echo $row->first_name . '&nbsp;' . $row->last_name; ?></td>
                                    <td><?php echo $row->user_name; ?></td>
                                    <td><?php echo $row->email_addres; ?></td>
                                    <td>
                                        <?php if ($row->admin_type == '1') {
                                            echo "Super Admin";
                                        } ?>

                                        <?php if ($row->admin_type == '2') {
                                            echo "Sub Admin";
                                        } ?>

                                        <?php if ($row->admin_type == '3') {
                                            echo "Customer Service";
                                        } ?>

                                        <?php if ($row->admin_type == '4') {
                                            echo "Project Coordinator";
                                        } ?>

                                        <?php if ($row->admin_type == '5') {
                                            echo "Project Manager";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($row->id == '1') { ?>

                                            <button style="cursor:default"
                                                    type="button" class="btn btn-success " aria-haspopup="true"
                                                    aria-expanded="false"> Active
                                            </button>

                                        <?php } else { ?>

                                            <?php if ($row->status == '0') { ?><a
                                                href="<?php echo ($admin_type!= 4)?base_url().'admin/update/'.$row->id:'javascript:void(0);'; ?>" >
                                                    <button type="button" class="btn btn-danger" aria-haspopup="true"
                                                            aria-expanded="false">Inactive
                                                    </button></a><?php } ?>


                                            <?php if ($row->status == '1') { ?><a
                                                href="<?php echo ($admin_type!= 4)?base_url().'admin/cupdate/'.$row->id:'javascript:void(0);'; ?>" >
                                                    <button type="button" class="btn btn-success " aria-haspopup="true"
                                                            aria-expanded="false">Active
                                                    </button></a><?php } ?>
                                        <?php } ?>


                                    </td>
                                    <td>
                                        <?php
                                        if ($admin_type == 5 && $row->id != '1') { ?>
                                            <a class="green"
                                               href="<?php echo base_url(); ?>admin/edit/<?php echo $row->id; ?>">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                                            &nbsp;<?php } elseif (!in_array($admin_type,array(4,5))) { ?>
                                            <a class="green"
                                               href="<?php echo base_url(); ?>admin/edit/<?php echo $row->id; ?>">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i> </a>
                                        <?php } ?>

                                        <?php if ($row->id != '1' && !in_array($admin_type,array(4,5))) { ?>


                                            <a class="orange" href="#" onclick="alert(<?php echo $row->id; ?>)">
                                                <i class="ace-icon fa fa-trash bigger-130"></i> </a>

                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                    <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
</div><!-- /.main-container -->

<script type="text/javascript">
    function alert(id) {
        del = confirm("Are you sure to delete permanently?");
        if (del != true) {
            return false;
        }
        else {
            window.location.href = "<?php echo base_url(); ?>admin/delete/" + id;
        }
    }
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
