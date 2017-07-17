<style>
  ul.list-inline li {
    display: inline !important;
    border-right: 1px solid #ccc;
    padding: 0 5px;
    font-size: 14px;
  }
  .nomargintop { margin-top: 0 !important; }

  #pagination .pagination { margin: 0 !important; }

  .newly-job-awarded-wrapper {
      color: red;
      font-weight: bold;
      font-size: 12px;
      cursor: pointer;
  }

    div.panel {
        border-color: rgb(50, 50, 50);
        border-radius: 5px;
        border-style: outset inset inset outset;
        border-width: 1px;
        margin: 5px 0 0 !important;
    }

    div.panel:hover {
        background-color: #cad2df !important;
        -webkit-box-shadow: inset 0 0 30px 15px #c6cfdd;
        -moz-box-shadow: inset 0 0 30px 15px #c6cfdd;
        box-shadow: inset 0 0 30px 15px #c6cfdd;
        -webkit-transition: 500ms linear 0s;
        -moz-transition: 500ms linear 0s;
        -o-transition: 500ms linear 0s;
        transition: 500ms linear 0s;
    }

</style>

<?php
  $this->load->view('vwHeader');
  $user_name=$this->session->userdata('user_name');
  $sql=" SELECT * FROM `translator` where `user_name`='$user_name'";
  $val=$this->db->query($sql);
  $fetch=$val->row();
  $name=$fetch->first_name.'&nbsp;'.$fetch->last_name;
  $email=$fetch->email_address;
  $address=$fetch->location;
  $paypal_id=$fetch->paypal_id;
  $image=$fetch->images;
  $language=$fetch->language;
  $languages=explode(",",$language);
  array_shift($languages);
  array_pop($languages);
?>

<div id="title">
  <h1 class="inner">Dashboard<span id="jobs-counter"></span>
    <ul class="breadcrumb-inner">
      <li><a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
      <li> <a href="#">Dashboard</a></li>
    </ul>
  </h1>
</div>

<div class="inner">
  <div class="content-inner">

    <div class="content-center">
      <div class=" field-container odd box-1 hide">

          <?php if ($this->session->userdata('message_error')) { ?>
          <div class="alert alert-block alert-danger" id="message-error">
              <p><?php echo $this->session->userdata('message_error') ?></p>
          </div>
          <?php } ?>

        <div id = "job-list" style = "padding: 20px;">

          <div id = "filter" style = "padding: 5px 7px;">

            <h4><strong>Search Filter</strong></h4>
            <hr>
            <table style = "width: 100%;">
              <tr>
                <!--
                <td style = "width: 100px; padding-right: 10px;">
                  <input style = "height: 35px; padding: 5px;" type="text" id = "bidDateFrom" name = "bidDateFrom" placeholder = "From Date">
                </td>
                <td style = "width: 100px; padding-right: 10px;">
                  <input style = "height: 35px; padding: 5px;" type="text" id = "bidDateTo" name = "bidDateTo" placeholder = "To Date">
                </td>
                -->
                <?php echo form_open('translator/dashboard/', $attributes); ?>
                <td style = "width: 180px;">
                  <select class = "form-control" id = "jobStatus" name = "jobStatus">
                    <option value = "0">Job Status: All</option>
                    <option value = "1">Job Status: Working</option>
                    <option value = "2">Job Status: Completed</option>
                  </select>
                </td>
                <td style = "width: 100px; padding-left: 10px;">
                  <input id = "search_string" name = "search_string" type = "text" placeholder = "Search..." style = "height: 35px; padding: 10px;">
                </td>
                <td style = "width: 180px;">
                  <?php $data_submit= array('name' => 'mysubmit', 'class' => 'btn-primary btn-sm nomargintop', 'value' => 'Go'); ?>
                  <?php echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;'; ?>
                </td>
                <?php echo form_close(); ?>
                <td>
                <button class="btn btn-info btn-reset btn-md" onClick="reload()" >Reset Filter</button>
                </td>
              </tr>
            </table>
            <hr>

          </div>


          <div class = "joblist">

            <div id = "pagination" class = "pull-right" style = "margin-bottom: 10px;">
              <?php echo $pages; ?>
            </div>
            <div style = "clear: both;"></div>

            <?php $x=0; ?>
            <?php foreach ($myJobs as $rowJobs) { ?>
            <?php $color = ($x % 2 == 0) ? "#fff" : "#e9edf1"; ?>
			  <?php //if(!empty($rowJobs->name)) { ?>
              <div class="panel panel-default" style="background-color: <?php echo $color; ?>">
                <div class="panel-body" style="padding: 2px;">

                  <h3>
                      <a href = "<?php echo base_url()?>chat-box/?bid_id=<?php echo $rowJobs->bidjobid; ?>&job_id=<?php echo $rowJobs->jobpostid; ?>&trans_id=<?php echo $this->session->userdata('translator_id'); ?>&type=<?php echo "user"; ?>" target="_blank"><?php if(empty($rowJobs->name)) { echo 'Job Manually Entered';  } else { echo $rowJobs->name;  } ?> / <span style="font-size:14px;"><?php echo $rowJobs->lineNumberCode ?></span></a>
                      <?php if ($rowJobs->show_notification ) { ?>
                      <span class="newly-job-awarded-wrapper toggle-close-notification" data-id="<?php echo $rowJobs->bidjobid ?>">Newly Awarded Job!</span>
                      <?php } ?>

                      <?php if ($rowJobs->admin_notif) { ?>
                      <span class="newly-job-awarded-wrapper toggle-close-notification" style="display: block;" data-id="<?php echo $rowJobs->bidjobid ?>">*** This job needs to be rated for you to get paid</span>
                      <?php } ?>
                  </h3>
                  <!--<hr>-->
                  <ul class = "list-inline">
                  <li><a href = "<?php echo base_url()?>chat-box/?bid_id=<?php echo $rowJobs->bidjobid; ?>&job_id=<?php echo $rowJobs->jobpostid; ?>&trans_id=<?php echo $this->session->userdata('translator_id'); ?>&type=<?php echo "user"; ?>" target = "_blank"><i class="fa fa-envelope"></i></a></li>
                  <li>Bid Price: $<?php echo $rowJobs->bidjobprice; ?></li>
                  <li>Date Awarded :
                      <?php
                        $awardDate = date('F d, Y', strtotime($rowJobs->award_date));
                        echo $awardDate;
                      ?>
                  </li>
                  <li>Job Status:
                      <?php

                        switch($rowJobs->bidjobstage){
                          case 3: echo "Completed";
                            break;
                          default: echo "Working";
                            break;
                        }

                      ?>
                  </li>
                  <?php if ($rowJobs->bidjobstage == 3 and $rowJobs->complete_date != '0000-00-00 00:00:00'){ ?>
                  <li>Completion Date:
                    <?php
                      $completionDate = date('F d, Y', strtotime($rowJobs->complete_date));
                      echo $completionDate;
                    ?>
                  </li>
                  <?php } ?>
                </ul>


                </div>
              </div>
			<?php //} ?>
            <?php $x++; ?>
            <?php } ?>

            <div id = "pagination" class = "pull-right" style = "margin-top: 10px;">
              <?php echo $pages; ?>
            </div>
            <div style = "clear: both;"></div>

          </div>

        </div>

      </div>
    </div>

    <div class="content-right">
      <?php $this->load->view('translator/includes/vwSidebar-left'); ?>
    </div>

  </div>
</div>
<div class="clear"></div>

<!-- InPage Scripts -->
<script type="text/javascript">

  $(function() {
      $( "#bidDateFrom" ).datepicker().on('changeDate',function(e) {

      });

      $( "#bidDateTo" ).datepicker().on('changeDate',function(e) {

      });

      $(document).on('click', '.toggle-close-notification', function (e) {
          $(this).hide(1000);
          $.ajax({
              url: "<?php echo base_url() ?>translator/close_award_notification",
              type: 'post',
              data: { bidjob_id: $(this).data('id') },
              success: function (response) {
                  $(this).remove();
              }
          });
      });

      if ($('#message-error').is(':visible')) {
          setTimeout(function () { $('#message-error').hide() }, 5000);
      }


  });

  function reload(){

        $.ajax({
            type: "POST",
            url: "<?=(base_url());?>translator/clearFilters",
        });

    window.location.href="<?php echo base_url().'translator/dashboard'?>";

  }

</script>

<?php $this->load->view('vwFooter'); ?>
<?php $this->load->view('vwFooterLower'); ?>
