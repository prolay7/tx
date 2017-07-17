<?php $this->load->view('vwHeader'); ?>

<div id="content">

  	<div id="title">
    	<h1 class="inner title-2">My Profile
    		<small>
        		<i class="ace-icon fa fa-angle-double-right"></i>
      			Proposals 
    		</small>
      	<ul class="breadcrumb-inner">
        	<li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
        	<li> <a href="#">private job</a></li>
      	</ul>
   		</h1>
  	</div>

	<div class="inner"> 
    	<div class="content-inner">
    		<div class="content-center">

    		<table class = "table table-bordered table-stripped">
	    		<tr>
	    			<th>Job Name</th>
	    			<th>Hiring Status</th>
	    			<th>Did You Bid Yet?</th>
	    			<th>Job Posted</th>
	    		</tr>
	    		<?php foreach ($invitations as $rowInvite){ ?>
	    		<tr>
	    			<td><?php //cho $rowInvite->name ; ?></td>
	    			<td><?php echo $rowInvite->description ; ?></td>
	    			<td></td>
	    			<td><?php echo $rowInvite->created ; ?></td>
	    		<?php } ?>
    		</table>

    		</div>
    		<div class="content-right">
    			<?php $this->load->view('translator/includes/vwSidebar-left'); ?>
    		</div>
    		<div style = "clear: both;"></div>
    	</div>
    </div>

</div>

<?php $this->load->view('vwFooter'); ?>
<?php $this->load->view('vwFooterLower'); ?>