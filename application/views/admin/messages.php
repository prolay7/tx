<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

	<?php $this->load->view('admin/includes/vwSidebar-left'); ?>

	<div class="main-content">
		<div class="main-content-inner">
	
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				<ul class="breadcrumb">
					<li><i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a></li>
					<li><a href="#">Messages</a></li>		
				</ul>
			</div>

			<div class="page-content">
			    <?php $this->load->view('admin/includes/vwSidebar-settings'); ?>
				<div class="page-header">
					<h1>Messages</h1>
				</div>

				<div class = "row">
					<div class = "col-md-6">

						<div id = "site-wide-notification">
							
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
							  Send Site Wide Notification
							</button>

							<form method = "post" action = "<?php echo base_url(); ?>messages/sitewidenotification">
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog" role="document">
								    	<div class="modal-content">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        		<h4 class="modal-title" id="myModalLabel">Site Wide Notification</h4>
								      		</div>
								      		<div class="modal-body">

								      			<label>Message</label>
								      			<textarea class = "form-control" id = "notificationcontent" name = "notificationcontent"></textarea>

								      		</div>
								      		<div class="modal-footer">
								        		<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancel</button>
								        		<button type="submit" class="btn btn-primary btn-xs">Send</button>
								      		</div>
								    	</div>
								  	</div>
								</div>
							</form>

						</div>

					</div>
					<div class = "col-md-6">
						<div class = "pull-right" style = "padding: 10px 0;">
							<form class="form-inline" method = "post" action = "<?php echo base_url(); ?>admin/messages">
								<div class="form-group">
							    	<input type="text" class="form-control" id = "search_keywords" name = "search_keywords" placeholder = "Entery Keywords">
							  	</div>
							  	<button type="submit" class="btn btn-primary btn-xs">Go</button>
							</form>
						</div>
					</div>
				</div>

				<table class = "table table-bordered table-stripped">
					<thead>
						<tr>
							<th>Date</th>
							<th>From</th>
							<th>Job Post</th>
							<th>Message</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        if(count($messages)){
                        foreach ($messages as $rowMessage){ ?>
						<tr>
							<td style = "width:150px;"><?php echo date('F d, Y', strtotime($rowMessage->dateTime)); ?></td>
							<td><?php echo $rowMessage->first_name." ".$rowMessage->last_name; ?></td>
							<td><?php echo $rowMessage->jobname; ?></td>
							<td><?php echo $rowMessage->text; ?></td>
							<td><a href = "<?php echo base_url(); ?>chat-box/?bid_id=<?php echo $rowMessage->bid_id; ?>&job_id=<?php echo $rowMessage->job_id; ?>&trans_id=<?php echo $rowMessage->translatorID; ?>&type=admin&ciadminId=<?php  echo $this->session->userdata('admin_id'); ?>" target = "_blank" class = "btn btn-primary btn-xs">Reply by Chat</a></td>
						</tr>
						<?php }
                        }else{ ?>
                            <tr><td colspan="5" style="color: #ff0000;font-weight: bold" class="text-center">No unread messages</td></tr>
                       <?php }
                        ?>
					</tbody>
				</table>

				<div style = "padding: 20px 0;" class = "pull-right">
					<?php echo $pages; ?>
				</div>

			</div>

		</div>
	</div>
</div>