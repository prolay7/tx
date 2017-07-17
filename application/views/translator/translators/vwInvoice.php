<?php $this->load->view('vwHeader'); ?>

<div id="content">

  <div id="title">
    <h1 class="inner title-2">My Profile
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        Invoice
      </small>
      <ul class="breadcrumb-inner">
        <li><a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        <li><a href="<?php echo base_url()?>translator/invoice">Invoice</a></li>
      </ul>
    </h1>
  </div>

  <div class="inner">
    <div class="content-inner">

      <div class="content-center">
        <div class="clear"></div>
        <div class="clear"></div>
        <div class="page-top-nav-bar jobpage-nav" style = "height: 0; margin-bottom: 0;"></div>
        <div class="clear"></div>

        <div id="job-content-fields">
          <div id="list" class="view_mode">
            <div class="field-container odd box-1" style = "padding: 10px;">

              <h3 style = "margin-bottom: 10px;">Total amount owed to you: $<?php echo number_format($receivable, 2, '.', ','); ?></h3>

              <div style = "margin: 30px 0;">

<button class="btn btn-info btn-reset btn-md pull-right" onClick="reload()" >Reset Filter</button>

                <h5 style = "border-bottom: 1px solid #000; margin-bottom: 10px; padding-bottom: 10px;">Search Filters</h5>
                <?php echo form_open('translator/invoice/', $attributes); ?>
                <table style = "width: 100%;">
                  <tr>
                    <td style = "width: 100px; padding-right: 10px;">

                      <input style = "width: 100px;" class = "form-control" type="text" id = "invoiceDateFrom" name = "invoiceDateFrom" placeholder = "From Date">

                    </td>
                    <td style = "width: 100px; padding-right: 10px;">

                      <input style = "width: 100px;" class = "form-control" type="text" id = "invoiceDateTo" name = "invoiceDateTo" placeholder = "To Date">

                    </td>
                    <td style = "width: 180px;">

                      <select name="payment_status" class="validate[required] form-control">
                        <option value=""> Select Payment Status </option>
                        <option value="1" <?php if($payment_status_selected=='1'){echo 'selected';} ?> >Paid</option>
                        <option value="0" <?php if($payment_status_selected=='0'){echo 'selected';} ?> >Unpaid</option>
                      </select>

                    </td>
                    <td style = "padding: 5px 10px;">

                      <input  style = "padding: 5px;" name = "search_string" id = "search_string" placeholder = "Search Key" type = "text">

                    </td>
                    <td>
                      <?php $data_submit= array('name' => 'mysubmit', 'class' => 'btn-primary btn-sm', 'value' => 'Go'); ?>
                      <?php echo '&nbsp;&nbsp;'.form_submit($data_submit).'&nbsp;&nbsp;'; ?>
                    </td>
                  </tr>
                </table>

                <?php echo form_close(); ?>

                <hr>
              </div>
                <style>
                    .sort{width: 100%;height: 15px;text-align: right;}
                    .sort-a{text-align: right; position: absolute;margin-left: -10px;margin-top: -21px; color:#d3d3d3}
                    .sort-a:before{ content: "\f0d8"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
                    .sort-d{text-align: right; position: absolute;margin-left: -10px;margin-top: -13px; color: #d3d3d3}
                    .sort-d:before{ content: "\f0d7"; position: absolute; font-family: FontAwesome; margin-right: -20px; }

                </style>
              <table class="table">
                <tr>
                  <th>Job Title</th>
                  <th>Invoice No</th>
                  <th>Payout Date
                      <div class="sort">
                          <?php
                          $sort_type = $this->session->userdata('order_direction');
                          if(isset($sort_type) == false || $sort_type == ''){
                              $sort_type = 'DESC';
                              $this->session->set_userdata('order_direction',$sort_type);
                          }
                          ?>
                          <a href="javascript:void(0);" <?php echo (isset($sort_type) && $sort_type == 'ASC')?'style="color:#337ab7!important"':''; ?> onclick="sort('ASC')" class="sort-a "></a>
                          <a href="javascript:void(0);" <?php echo (isset($sort_type) && $sort_type == 'DESC')?'style="color:#337ab7!important"':''; ?> onclick="sort('DESC')" class="sort-d"></a>
                      </div>
                  </th>
                  <th>Price</th>
                  <th>Payment Status</th>
                </tr>
              <?php foreach ($invoice as $rowInvoice){ ?>
                <tr>
                  <td style = "text-transform: capitalize;"><?php echo $rowInvoice->name; ?> <?php echo $rowInvoice->lineNumberCode;?></td>
                  <td><?php echo $rowInvoice->invoice_id; ?></td>
                  <td>
                  
                    <?php

                      $bidInfo = $this->front_invoice_model->getBidInfo($rowInvoice->bid_id);
                      $completeionDate = date('m-d-Y', strtotime('+31 days', strtotime($bidInfo->complete_date)));
 //$completeionDate = date('m-d-Y', strtotime($bidInfo->complete_date));
                      echo $completeionDate;


                   ?>
                  </td>
                  <td>$<?php echo number_format($rowInvoice->bidjobprice, 2, '.', ','); ?></td>
                  <td>
                    <?php

                        switch($rowInvoice->payment){
                          case 0: echo "Open";
                            break;
                          case 1: echo "Paid";
                            break;
                          default: echo "Unpaid";
                            exit;
                        }

                        $paymentDate = date('F d, Y', strtotime($rowInvoice->payment_date));

                        if ($rowInvoice->payment == "1"){
                          echo "<p><small>".$paymentDate."<small></p>";
                        }

                    ?>
                  </td>
                </tr>
              <?php } ?>
              </table>
              <?php echo $pages; ?>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div class="content-right">
 		    <?php $this->load->view('translator/includes/vwSidebar-left');?>
      </div>

      <div class="clear"></div>
    </div>
  </div>

</div>

<!-- InPage Scripts -->
<script>

  $(function() {
      $( "#invoiceDateFrom" ).datepicker().on('changeDate',function(e) {

    });

      $( "#invoiceDateTo" ).datepicker().on('changeDate',function(e) {

    });

  });

  function reload(){

        $.ajax({
            type: "POST",
            url: "<?=(base_url());?>front_invoice/clearFilters",
        });

    window.location.href="<?php echo base_url().'translator/invoice'?>";

  }

  function sort(data) {
      if(data != ''){
          $.ajax({
              type:"POST",
              url:"<?php echo base_url().'front_invoice/sort' ?>",
              data:{sort_type: data},
              success:function (data) {
                  window.location.reload();
              }
          });
      }
  }

</script>

<?php $this->load->view('vwFooter'); ?>
<?php $this->load->view('vwFooterLower'); ?>
