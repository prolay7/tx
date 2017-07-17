<?php $this->load->view('admin/includes/vwHeader'); ?>

<div id="main-container" class="main-container">
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
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="#">Home</a>
					</li>
					<li class="active">Compliant List</li>
				</ul>
			</div>
			<div class="page-content">
				<div class="page-header">
					<h1>Compliants <small><i class="ace-icon fa fa-angle-double-right"></i>View Compliants List</small></h1>
				</div>
				<div class="row">

					<div class="design-form" style="width:100%">
						<?php
							$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

							$compliant = $this->uri->segment(3);
							$current_year=date('Y');
                            $current_month=date('m');
                            $auto_selected_month=!empty($search_string_selected)?explode('-',$search_string_selected)[1]:$current_month;
                            $auto_selected_year=!empty($search_string_selected)?explode('-',$search_string_selected)[0]:$current_year;

                            echo form_open('admin/compliants/' . $compliant, $attributes);
                            echo form_label('Search:', 'search_string');
                            echo '&nbsp;';
                            echo form_dropdown('months', $months, $auto_selected_month, 'class="span2 invisible2"');
                            $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                            echo form_dropdown('years', $years, $auto_selected_year, 'class="span1 invisible2"','id="years"');
                            echo '&nbsp;';
                            echo form_label('Search By:', 'search_by');
                            $datai = array(
                                           'name'        => 'search_by',
										   'placeholder' => 'Enter Job Title, Line Number,Compliant,Comments',
                                           'value'          =>$search_string_selected2,
                                           'style'       => 'width: 450px;height: 30px;'
                                                 );
                            echo form_input($datai);
							echo '&nbsp;';
							echo form_label('Marked As:', 'marked_as');
                            echo form_dropdown('marked_as', $marked_as_data, $marked_as_selected, 'class="span1 invisible2"');
                            echo '&nbsp;';
							echo form_label('Per-page:', 'per_page');
                            echo form_dropdown('per_page', $per_page_data, $per_page_selected, 'class="span1 invisible2"');
                            echo '&nbsp;';
                            $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info btn-sm', 'value' => 'Search');
                            echo form_submit($data_submit);
							?>
                         		<input type="button" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo base_url().'admin_compliants/reset';?>'" value="Reset">
                         	<?php
                            echo form_close();
                            ?>
					</div>

				</div>

				<div class="clearfix"></div>

				<div class="panel panel-primary">
					<div class="panel-heading panel-inverse">
						Compliants List

						<?php

						$m=$this->compliant_model->get_comaplaint_recent();
						print_r($m[0]->max_id);

						?>
					</div>
					<div class="panel-body" id="compliants_list">
						<form>
							<table id="compliants-table" class="table table-striped table-bordered table-hover">
									 <thead>
			                            <tr>
			                                <th class="center">Line No</th>
			                                <th class="center">Job Name</th>
			                                <th class="center">Complains</th>
			                                <th class="center">Additional Comments</th>
			                                <th class="center">Marked As</th>
			                                <th class="center">Translators</th>
			                                <th class="center">Complain Registered by</th>
			                                <th class="center">Complian Launched on</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	<?php
			                        	
			                        	if(!empty($compliants) || $compliants!=NULL){
			                        		$d=comma_separated_to_array($this->compliant_model->getalltranslators()[0]->trans);
			                        		$counted=array_count_values($d);

			                        		foreach ($compliants as $key => $compliant) {
			                        			$marked_as=($compliant->marked_as==1)?'<span class="btn btn-primary btn-xs" style="cursor:default">Marked as Edit</span>':'<span class="btn btn-danger btn-xs" style="cursor:default">Marked as Error</span>';

			                        			$translator_ids=comma_separated_to_array($compliant->translators);

			                        			$user=$this->compliant_model->getuser($compliant->user_id);

			                        			
			                        			?>
			                        				<tr>
			                        					<td class="center"><?php echo $compliant->line_no;?></td>
			                        					<td class="center"><?php echo $compliant->job_name;?></td>
			                        					<td class="center"><?php echo $compliant->compliant;?></td>
			                        					<td class="center"><?php echo $compliant->answer;?></td>
			                        					<td class="center"><?php echo $marked_as;?></td>
			                        					<td class="center">
			                        						<ul class="translator_lists">
			                        						<?php
		                        							foreach ($translator_ids as $key => $translator) {
		                        								$translator_data=$this->compliant_model->gettransalator($translator);
		                        								$ratings=$this->compliant_model->getratings($compliant->job_id,$translator);
		                        								$rating=($ratings[0]->rating!='' || $ratings[0]->rating!=NULL)?$ratings[0]->rating:0;
		                        								if($counted[$translator]>1 && $counted[$translator]<=3){
		                        									echo '<li><span class="bg-orange rate-value rate-value'.$translator.'">'.$rating.'</span><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_rating" data-transid="'.$translator.'" data-transname="'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'" data-jobid="'.$compliant->job_id.'" data-ratings="'.$rating.'" class="text-orange trans" id="trans'.$compliant->job_id.'">'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'</a></li>';
		                        								
		                        								}else if($counted[$translator]>3){
		                        									echo '<li><span class="bg-red rate-value rate-value'.$translator.'">'.$rating.'</span><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_rating" data-transid="'.$translator.'" data-transname="'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'"  data-jobid="'.$compliant->job_id.'" data-ratings="'.$rating.'" class="text-red trans" id="trans'.$compliant->job_id.'">'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'</a></li>';
		                        								}else{
		                        									echo '<li><span class="bg-green rate-value rate-value'.$translator.'">'.$rating.'</span><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_rating" data-transid="'.$translator.'" data-transname="'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'"  data-jobid="'.$compliant->job_id.'" data-ratings="'.$rating.'" class="text-green trans" id="trans'.$compliant->job_id.'">'.ucwords($translator_data[0]->first_name.' '.$translator_data[0]->last_name).'</a></li>';
		                        								}
		                        											                        								
		                        							}

			                        						?>
			                        						</ul>
			                        					</td>
			                        					<td class="center"><?php echo ucwords($user[0]->first_name.' '.$user[0]->last_name);?></td>
			                        					<td class="center"><?php echo date('m-d-Y',strtotime($compliant->date_added));?></td>
			                        				</tr>

			                        			<?php
			                        		}
			                        	}else{
			                        		?>
			                        		<tr><td colspan="8" class="center">No Complian registered yet</td></tr>
			                        		<?php
			                        	}

			                        	?>
			                        </tbody>

							</table>
						</form>
					</div>
				</div>
					<?php echo ($this->pagination->create_links())?'<div class="pagination">' . $this->pagination->create_links() . '</div>':''; ?>
			</div>
		</div>
	</div>

</div>



<!-- Modal -->
<div class="modal fade" id="myModal_rating" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Edit Ratings</h3>
		</div>

		<form method="post" enctype="multipart/form-data" id="stageform23">
			<input type="hidden" id="line_no" name="line_no">
			<input type="hidden" name="selectedfiles" id="selectedfiles">

			<div class="modal-body">
					<div id="msgs"></div>
	              <div class="form-group">
	                <label for="exampleInputEmail1">Translator</label>
	                <input type="text" class="form-control" id="translator_name" disabled="disabled">
	                <input type="hidden" class="form-control" id="translator_id" name="translator_id">
	                <input type="hidden" class="form-control" id="job_id" name="job_id">
	                <input type="hidden" class="form-control" id="ratings" name="ratings">
	              </div>

	              <div class="form-group">
	              	<div class="control-group">
	              	<div class="row text-center">
	              		<h5 class="rating-title">Rating</h5>
						<div class="radio col-sm-1 col-sm-offset-1">
							<label style=" margin-top: -15px;">
								<input name="form-field-radio" type="radio" class="ace" value="1" id="ace1">
								<span class="lbl">1</span>
							</label>
						</div>

						<?php
						for($i=2;$i<=10;$i++) {
							?>
								<div class="radio col-sm-1">
									<label>
										<input name="form-field-radio" type="radio" class="ace" value="<?php echo $i;?>" id="ace<?php echo $i;?>">
										<span class="lbl"><?php echo $i;?></span>
									</label>
								</div>
							<?php
						}

						?>
						</div>
					</div>
	              </div>
	            
			
			</div>
			<div class="modal-footer">
				<!--div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"  role="button">Close</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" id="saveImage23" class="btn btn-success btn-hover-green btn-sm" data-action="save" role="button">Save</button>
					</div>
				</div-->
			</div>
		</form>
	</div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','.trans',function(e){
	
				$('#myModal_rating').find('#translator_name').val($(this).attr('data-transname'));
				$('#myModal_rating').find('#translator_id').val($(this).attr('data-transid'));
				$('#myModal_rating').find('#job_id').val($(this).attr('data-jobid'));
				$('#myModal_rating').find('#ratings').val($(this).attr('data-ratings'));
				r=$(this).attr('data-ratings');
				if(r!='' || r!=null){
					$('#ace'+r).prop('checked',true);
				}	
		});

		$("#myModal_rating").on("hidden.bs.modal", function () {
		    $('input[type="radio"][name="form-field-radio"]').prop('checked',false);
		});

		$('.ace').on('click',function(){
			t=$('#translator_id').val();
			j=$('#job_id').val();
			r=$(this).val();

			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."admin/rate";?>',
				data:'job_id='+j+'&translator_id='+t+'&ratings='+r,
				success:function(data){
					var json=$.parseJSON(data);
					if(json.hasOwnProperty('success')){
						$('.rate-value'+t).html(r);
						$('#trans'+j).attr('data-ratings',''+r+'');
					}else{

					}
				}
			});
		});
	});
</script>

<style type="text/css">
	.panel-inverse{
		background-color: #000;
		color: #fff;
	}
	.text-green, .text-green:hover, .text-green:active, .text-green:focus{ color: #009688; }
	.text-orange, .text-orange:hover, .text-orange:active, .text-orange:focus{color: #FF9800;}
	.text-red, .text-red:hover, .text-red:active, .text-red:focus{color: #F44336;}
	.bg-orange{ background: #FF9800 }
	.bg-red{ background:#F44336 }
	.bg-green{ background: #009688 }
	.rate-value{ width: 18px; height: 18px; color: #fff; text-align: center; margin-right: 5px; display: inline-block; vertical-align: bottom; }
	.radio .lbl{ font-weight: 600 !important; }
	.rating-title{border-bottom: 2px solid #ddd; padding-bottom: 5px; padding-left: 15px; font-weight: 600; text-transform: uppercase; margin-bottom: 20px;}
	.translator_lists{ list-style: none; padding-left: 0; text-align: left; width: 100%; margin: 0; }
	.translator_lists li{ margin-bottom: 3px; }
</style>

<?php $this->load->view('admin/includes/vwFooter'); ?>