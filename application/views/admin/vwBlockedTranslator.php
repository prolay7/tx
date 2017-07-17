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
                        <a href="#">Blocked Translator</a>
                    </li>
                    <li class="active"> List</li>
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
                        Blocked Translator
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            View List
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
                            Results for "Blocked Translator List"
                        </div>

                        <style type="text/css">
                            .invisible2 {
                                display: none !important;
                            }
                        </style>
                        <div class="design-form">
                            <?php

                            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                            //save the columns names in a array that we will use as filter
                            $options_category = array();
                            foreach ($translator as $array) {
                                foreach ($array as $key => $value) {
                                    $options_category[$key] = $key;
                                }
                                break;
                            }
                            $job = $this->uri->segment(2);

                            echo form_open('admin_blocked_translators/' . $job, $attributes);
                            $lansql = "select * from `languages`  ORDER BY `name`";
                            $lanquery = mysql_query($lansql);

                            ?>
                            <?php //echo form_label('Language:', 'search_select'); ?>
                            <!--<select id="search-select" class="select validate[required]" name="language">                                   <option value=""> Select Language </option>
                                    <?php while ($lanfetch = mysql_fetch_array($lanquery)) { ?>
                                    <option value="<?php echo $lanfetch['id']; ?>" <?php if ($lanfetch['id'] == $language_selected) {
                                echo 'selected';
                            } ?>><?php echo $lanfetch['name']; ?>
                                    </option>
                                    <?php } ?>
                                    </select>-->

                            <?php
                            echo form_label('Search:', 'search_string');
                            echo form_input('search_string', $search_string_selected, 'style="width: 190px;
                                    height: 26px;"');
                            echo '&nbsp;';
                            echo form_dropdown('order', $options_category, $order, 'class="span2 invisible2"');
                            $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1                                  invisible2"');
                            $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info btn-sm', 'value' => 'Search');
                            echo form_submit($data_submit);
                            echo '&nbsp;';
                            echo form_close();

                            ?>
                        </div>
                        <div class="design-reset"><a
                                    href="<?php echo base_url() . 'admin_blockedtranslators/resettranslator'; ?>"
                                    class="btn btn-info btn-reser btn-sm yellow">Reset</a></div>
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <?php if ($this->uri->segment(2) != "") {
                            $sql = "select * from jobpost where id='" . $job . "'";
                            $val = $this->db->query($sql);
                            $fetchjob = $val->row();

                            $job_language = $fetchjob->language;
                            $inIds = "'" . str_replace("/", "','", $job_language) . "'";
                            $sql_lan = "SELECT name FROM `languages` WHERE `id` IN(" . $inIds . ")";
                            //echo $sql_lan;
                            $val_lan = $this->db->query($sql_lan);
                            $lang = $val_lan->result_array();
                            $lang2 = $lang[0]['name'] . ' to ' . $lang[1]['name'];


                            ?>
                            <div class="table-header">
                                JOB NAME : <?php echo $fetchjob->name; ?>
                                <span style="float:right; padding-right:10px;">TRANSLATE : <?php echo $lang2; ?> </span>


                            </div>
                        <?php } ?>
                        <?php

                        $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                        echo form_open('admin_invite/send1/' . $this->uri->segment(2), $attributes); ?>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>

                            <tr>

                                <th class="center">Name</th>
                                <th class="center">Email Address</th>
                                <th class="center">Location</th>
                                <th class="center">Language</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count = 1;

                            // echo'<pre>'; print_r($translator);   die;
                            foreach ($translator as $key => $row) {
                                if($search_string_selected !=false) {
                                    $sql_lan = "SELECT `id` FROM `languages` WHERE `name` LIKE '%" . $search_string_selected . "%'";
                                    $val_lan_id = $this->db->query($sql_lan);
                                    if($val_lan_id->num_rows() > 0){
                                    $lang_id = $val_lan_id->result()[0]->id;
                                        $preg = preg_match_all('/[^\w\s ]' . $lang_id . '[^\w\s]/', $row['language'],$match);
//                                var_dump($preg);exit();
                                    }else{
                                        $preg = true;
                                    }
                                }else{
                                    $preg = true;
                                }
                                if ($preg != false) {
                                    $num = $count++;
                                    //echo $num;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if ($this->uri->segment(2) != "") { ?><!--input class="checkbox1"
                                                                                               type="checkbox"
                                                                                               name="check[]"
                                                                                               value=" <?php echo $row['id']; ?>"
                                                                                               id="chk<?php echo $num; ?>" --><?php } ?><?php echo $row['first_name']; ?>
                                            &nbsp; <?php echo $row['last_name']; ?></td>
                                        <!--<td><?php echo $row['first_name']; ?> &nbsp; <?php echo $row['last_name']; ?> </td>-->
                                        <td><?php echo $row['email_address']; ?></td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php
                                            $language = $row['language'];
                                            $languages = explode(",", $language);
                                            array_shift($languages);
                                            array_pop($languages);
                                            foreach ($languages as $key => $value) {
                                                //echo $key.' => '.$value;
                                                $inIds = "'" . str_replace("/", "','", $value) . "'";
                                                $sql_lan = "SELECT name FROM `languages` WHERE `id` IN(" . $inIds . ")";
                                                $val_lan = $this->db->query($sql_lan);
                                                $lang = $val_lan->result();
                                                //echo "<pre>"; print_r($lang);die;
                                                foreach ($lang as $lan) {
                                                    echo $lan->name;
                                                    echo ' ';
                                                }
                                                echo ', ';
                                            }
                                            ?>
                                        </td>
                                     
                                    </tr>

                                    <?php
                                }
                            }
                            ?>


                            </tbody>
                        </table>
                        </form>
                        <?php echo ($this->pagination->create_links())?'<div class="pagination">' . $this->pagination->create_links() . '</div>':''; ?>


                    </div>
                    <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
</div><!-- /.main-container -->


<?php
$this->load->view('admin/includes/vwFooter');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css" type="text/css"
      media="screen"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
    $(document).ready(function () {//alert("hello");
        //$(".fancybox").fancybox();
        $(".various").fancybox({
            maxWidth: 800,
            maxHeight: 600,
            fitToView: false,
            width: '70%',
            height: '70%',
            autoSize: false,
            closeClick: false,
            openEffect: 'none',
            closeEffect: 'none'
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#selecctall').click(function (event) {  //on click
            if (this.checked) { // check select status
                $('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            } else {
                $('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });

    });
</script>

<script type="text/javascript">
    function thisistest(id, job) {

        del = confirm("Are you sure to delete permanently?");
        if (del != true) {
            return false;
        }
        else {
            window.location.href = "<?php echo base_url(); ?>admin_translators/delete/" + job + "/" + id;
        }
    }
</script>

<script type="text/javascript">
    function thisisdelete(id) {//alert("hello");

        del = confirm("Are you sure to delete permanently?");
        if (del != true) {
            return false;
        }
        else {
            window.location.href = "<?php echo base_url(); ?>admin_translators/deletetranslator/" + id;
        }
    }
</script>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<!--<script type="text/javascript">
$(document).on('click','a#myexample',function() {
    val = $(this).attr('data-id'); // this should now contain 'yourvalue'

    $.post('invitemodal.php', { param: val }, function(data) {
        // you could check the contents of data here, or perhaps write it for debug purposes
    });
});
</script>-->


