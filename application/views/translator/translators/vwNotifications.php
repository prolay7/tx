<?php $this->load->view('vwHeader'); ?>

<div id="content">
 	<div id="title">
    	<h1 class="inner title-2"> My Profile
    		<small>
        		<i class="ace-icon fa fa-angle-double-right"></i>
        		Notifications 
    		</small>
      	<ul class="breadcrumb-inner">
        	<li><a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
      		<li><a href="">Notifications</a></li>
      	</ul>
    	</h1>
  	</div>
  	<div class="inner"> 
    	<!-- Content Inner -->
    	<div class="content-inner"> 

    		<div class="content-center">

				<div class=" field-container odd box-1 hide" style = "padding: 15px;">

					<div class = "pull-right" style = "padding: 10px 0;"><?php echo $pages; ?></div>
	    			<div style = "clear: both;"></div>
	    			
	    			<table class = "table table-bordered table-striped" style = "width: 100%;">
	    				<tr>
	    					<th style = "text-align: left;"><strong>Date</strong></th>
	    					<th style = "text-align: left;"><strong>Message</strong></th>
	    				</tr>
	    				<?php foreach ($notifications as $rowNotice){ ?>
	    				<tr>
	    					<td>
	    						<?php
	    							$createdDate = date('F d, Y', strtotime($rowNotice->created));
	    							echo $createdDate;
	    						?>
	    					</td>
	    					<td><?php echo $rowNotice->message; ?></td>
	    				</tr>
	    				<?php } ?>
	    			</table>
	    			<div class = "pull-right"><?php echo $pages; ?></div>
	    			<div style = "clear: both;"></div>
    			</div>

    		</div>
		    <div class="content-right">
		      <?php $this->load->view('translator/includes/vwSidebar-left'); ?>
		    </div>

    	</div>
  	</div>
</div>

<div class="clear"></div>

<?php $this->load->view('vwFooter'); ?>
<?php $this->load->view('vwFooterLower'); ?>