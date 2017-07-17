<?php $this->load->view('admin/includes/vwHeader'); ?>

<link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/bootstrap-colorpicker.min.css" />
<script src="<?php echo base_url();?>/assets/dist/js/bootstrap-colorpicker.min.js"></script>

<div id="main-container" class="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	<?php	$this->load->view('admin/includes/vwSidebar-left'); ?>
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
					<li class="active">Wrokflow List</li>
				</ul>
			</div>
			<div class="page-content">
				<div class="page-header">
					<h1>Workflow <small><i class="ace-icon fa fa-angle-double-right"></i>View Workflow List</small></h1>
					
				</div>
				<div class="row">
					<div class="design-form" style="width:100%">
                            <?php

                            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                            //save the columns names in a array that we will use as filter
                          
                            $job = $this->uri->segment(3);
                            $current_year=date('Y');
                            $current_month=date('m');
                            $auto_selected_month=!empty($search_string_selected)?explode('-',$search_string_selected)[1]:$current_month;
                            $auto_selected_year=!empty($search_string_selected)?explode('-',$search_string_selected)[0]:$current_year;

                            echo form_open('admin/workflow/' . $job, $attributes);
                            echo form_label('Search:', 'search_string');
                            echo '&nbsp;';
                            echo form_dropdown('months', $months, $auto_selected_month, 'class="span2 invisible2"');
                            $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                            echo form_dropdown('years', $years, $auto_selected_year, 'class="span1 invisible2"','id="years"');
                            echo '&nbsp;';
                            echo form_label('Search By:', 'search_by');
                            $datai = array(
                                           'name'        => 'search_by',
										   'placeholder' => 'Enter Job Title, Line Number',
                                           'value'          =>$search_string_selected2,
                                           'style'       => 'width: 450px;height: 30px;'
                                                 );
							echo form_input($datai);
							echo '&nbsp;';
                            echo form_label('Per-page:', 'per_page');
                            echo form_dropdown('per_page', $per_page_data, $per_page_selected, 'class="span1 invisible2"');
                            echo '&nbsp;';
                            $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info btn-sm', 'value' => 'Search');
                            echo form_submit($data_submit);
                         	?>
                         		<input type="button" class="btn btn-info btn-sm" onclick="window.location.href='<?php echo base_url().'admin_workflow/reset';?>'" value="Reset">
                         	<?php
                            echo form_close();

                            ?>
                            
                        </div>

                     

				</div>
				<div class="clearfix"></div>
				<div class="panel panel-default">
					<div class="panel-heading">Workflow List
					<a class="btn btn-primary pull-right btn-xs" style="margin-top: -4px;" data-toggle="modal" data-target="#myModal3"  data-backdrop="static" data-keyboard="false">Edit Stage</a>
					<a class="btn btn-primary pull-right btn-xs" style="margin-top: -4px;" data-toggle="modal" data-target="#myModal"  data-backdrop="static" data-keyboard="false">Add Stage</a>
					<div class="panel-body" id="workflow_list">


					<form method="post">
					<div id="constrainer">
    				<div class="scrolltable" id="editabletable">
	
						
						<!--?php echo $this->workflow_model->last_stage_column('H11464')[0]->wid;?-->

						<?php
							$show_hide_stages=$this->workflow_model->get_show_hide();
							$wstages=$this->workflow_model->get_distinct_column();
							$counted_stage=count($wstages);
        					$_width=(($show_hide_stages[0]->show_hide==2) && $counted_stage<=4)?'300px;':'200px;';
							
						?>
							<table class="table table-striped table-bordered sticky_column" id="table_id" style="width:auto !important;">
								<thead>
								
									<th style = "text-align: center;width:70px;min-width:70px;">Line No

										<div class="sort">
	                                        <?php
	                                        $sort_type = $this->session->userdata('sort_type');
	                                        if(isset($sort_type) == false || $sort_type == ''){
	                                            $sort_type = 'ASC';
	                                            $this->session->set_userdata('sort_type',$sort_type);
	                                        }
	                                        ?>
	                                        <a href="javascript:void(0);" <?php echo (isset($order) && $order == 'ASC')?'style="color:#337ab7!important"':''; ?> onclick="sort('ASC')" class="sort-a "></a>
	                                        <a href="javascript:void(0);" <?php echo (isset($order) && $order == 'DESC')?'style="color:#337ab7!important"':''; ?> onclick="sort('DESC')" class="sort-d"></a>
	                                    </div>
									</th>
									<th style="width: <?php echo $_width;?>min-width:<?php echo $_width;?>">Job

									<?php
										if(($show_hide_stages[0]->show_hide==2)){
											?>
												<button type="button" class="btn btn-success pull-right btn-xs" style="margin: -4px 5px 0 5px; padding:0 2px; " id="show"><i class="fa fa-eye"></i></button>
											<?php	
										} else if(($show_hide_stages[0]->show_hide==1)){
											?>
												<button type="button" class="btn btn-warning pull-right btn-xs" style="margin: -4px 5px 0 5px; padding:0 2px; " id="hide"><i class="fa fa-eye-slash"></i></button>
											<?php	
										}
									?>
									
									</th>
									<th style = " text-align: center; white-space: nowrap;width:150px;min-width:150px;" class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>">Date Recieved</th>
									<th style = " text-align: center; white-space: nowrap;width:150px;min-width:150px;" class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>">Due Date</th>
									<th style = "text-align: center;width:150px;min-width:150px;" class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>">Translator Name</th>
									<th style = "text-align: center;width:150px;min-width:150px;" class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>">Language From</th>
									<th style = "text-align: center;width:150px;min-width:150px;" class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>">Language To</th>
									<div id="stages_head">
									<?php
									$exclude_head=array('LINE_NO','TRANS_JOB','DATE_RECIEVED','DATE_DUE','TRANS_NAME','LANGUAGE_FROM','LANGUAGE_TO');
									
									$counted_wstages=count($this->workflow_model->get_distinct_column());
									if(!empty($wstages)){
										
										foreach ($wstages as $key => $value) {
											//if(!in_array($value->stage_column,$exclude_head)){
												$cname=$this->workflow_model->get_stage_name($value->stage_column);
												$background=($cname[0]->stage_color!='')?$cname[0]->stage_color:'#ffffff';
												$textcolor=(!empty($cname) && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000' )?'#ffffff':'#000000';
												?>
												<th style = "width: 150px;min-width:150px; white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>" onclick="change_stage_data(<?php echo $cname[0]->wid;?>);"><?php echo $cname[0]->stage_name;?></th>
												<?php
											//}
										}
									}

									?>
									</div>
								</thead>
								</table>
								<div class="body">
            					<table id="header-fixed">
								<tbody>
									<?php
										if(!empty($jobs)){
											$count2=($limit_end!=0)?$limit_end+1:1;
											foreach ($jobs as $key => $value) {
												$lang=explode('/',$value->language);
												$language_from=$this->workflow_model->getlanguages(['id'=>$lang[0]]);
	                       						$language_to=$this->workflow_model->getlanguages(['id'=>$lang[1]]);
	                       						$bidjob=$this->workflow_model->getbidjobs(['job_id'=>$value->id]);
	                       						
												$translator=$this->workflow_model->gettransalator(['id'=>$bidjob[0]->trans_id]);
												

												?>
													<tr align="center">
														<td class="" style="width: 70px;min-width:70px;"><?php echo $value->lineNumber;?></td>
														<td class="" style="width: <?php echo $_width;?>min-width:<?php echo $_width;?>"><?php echo $value->name;?>
															
															<a href="javascript:void(0);" class="popup pull-right"  data-trigger="click" data-id="<?php echo $value->id;?>" data-line="<?php echo $value->lineNumber;?>" data-container="body">Notes</a>
														</td>
														<td class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>" style="width: 150px;min-width:150px;"><?php echo date('m-d-Y',strtotime($value->created));?></td>
														<td  class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>" style="width:150px;min-width:150px;white-space: nowrap;"><?php echo $value->dueDate;?></td>
														<td class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>" style="width: 150px;min-width:150px;"><?php echo ucwords($translator[0]->first_name.' '.$translator[0]->last_name);?></td>
														<td class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>" style="width: 150px;min-width:150px;"><?php echo $language_from[0]->name;?></td>
														<td class="<?php echo ($show_hide_stages[0]->show_hide==2)?'hidecol':'';?>" style="width: 150px;min-width:150px;"><?php echo $language_to[0]->name;?></td>
														<div id="stages_td">
														<?php

														if(!empty($wstages)){

															$c=8;
															foreach ($wstages as $key => $value2) {
																//if(!in_array($value2->stage_column,$exclude_head)){

																	$cname=$this->workflow_model->get_stage_name($value2->stage_column);
																	//print_r($cname[0]->wid);
																	$celldata=$this->workflow_model->get_cell_data($value->id,$value2->stage_column,$value2->stage_column.$count2.$value->id);
																	//print_r($cname);
																	//$cell_background=(!empty($celldata) && $celldata[0]->stage_data!=2)?$celldata[0]->stage_cell_color:$cname[0]->stage_color;
																	$cell_background=(!empty($celldata) && $celldata[0]->stage_data==1)?'#ffffff':$cname[0]->stage_color;
																	//$textcolor=(!empty($celldata) && $celldata[0]->stage_color!='#ffffff')?$celldata[0]->stage_text_color:((!empty($celldata) && $celldata[0]->stage_color=='#ffffff')?'#000000':'#ffffff');

																

																	//$textcolor=(!empty($cname) && $cname[0]->stage_cell_color!='#ffffff' && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000' )?'#ffffff':'#000000';

																	//$textcolor=(!empty($cname) && $cname[0]->stage_cell_color!='#ffffff' && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000' && $cname[0]->change_stage_color==1)?'#ffffff':((!empty($cname) && $cname[0]->stage_cell_color!='#ffffff' && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000' && $cname[0]->change_stage_color==2)?'#000000':'#000000');
																	if($celldata[0]->stage_data==''){
							                                            if($cname[0]->change_stage_color==2){
							                                                $textcolor='#000000';
							                                            }else if($cname[0]->change_stage_color==1){
							                                                $textcolor=(!empty($cname) && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000')?'#ffffff':'#000000';
							                                            }
							                                        }else if($celldata[0]->stage_data!='' && $celldata[0]->stage_data==1){
							                                            $textcolor='#000000';
							                                        }else if($celldata[0]->stage_data!='' && $celldata[0]->stage_data!=1){
							                                            if($cname[0]->change_stage_color==2){
							                                                $textcolor='#000000';
							                                            }else if($cname[0]->change_stage_color==1){
							                                                $textcolor=(!empty($cname) && $cname[0]->stage_color=='#000000'|| $cname[0]->stage_color=='#0000FF' || $cname[0]->stage_color=='#FF0000')?'#ffffff':'#000000';
							                                            }
							                                        }
																									



							                                        $attributes=$this->workflow_model->get_stage_attributes($cname[0]->wid);
							                                       // print_r($attributes);
																	if(!empty($celldata) && $celldata[0]->stage_data!=''){
																		$stagedata=($celldata[0]->stage_data==2)?'1':'2';
																		
																		//echo $textcolor;
																		?>
																		<td style = "width:150px;min-width:150px; white-space: nowrap;text-align: center;background:<?php echo $cell_background;?>;">
																		<select class="form-control selector" style="font-size: 10px;font-weight: 600; height: 24px;padding: 2px 5px;background:<?php echo $cell_background;?>;color:<?php echo $textcolor;?>" data-id="<?php echo $cname[0]->wid;?>" data-key="<?php echo $cname[0]->stage_column;?>" data-cell="<?php echo $value2->stage_column.$count2.$value->id;?>" data-dataid="<?php echo $value->id;?>" data-stageorder="<?php echo $cname[0]->stage_order;?>" data-stagecolor="<?php echo $cname[0]->stage_color;?>"	data-stagename="<?php echo $cname[0]->stage_name;?>" data-stagetextcolor="<?php echo $cname[0]->stage_text_color;?>">
																			<option value="2" <?php echo ($celldata[0]->stage_data==2)?'selected="selected"':'';?>>No</option>
																			<option value="1" <?php echo ($celldata[0]->stage_data==1)?'selected="selected"':'';?>>Yes</option>
																			<?php
																				if($attributes){
																					foreach ($attributes as $attribute) {

																						?>
																						<option value="<?php echo $attribute->attr_value;?>" <?php echo ($celldata[0]->stage_data==$attribute->attr_value)?'selected="selected"':'';?>><?php echo $attribute->attr_name;?></option>
																						<?php
																					}
																				}

																			?>
																		</select>
																		</td>


																		<?php
																	} else{
																		?>
																		<td style = "width:150px;min-width:150px; white-space: nowrap;text-align: center;background:<?php echo $cell_background;?>;">
																			<select class="form-control selector" style="font-size: 10px;font-weight: 600; height: 24px;padding: 2px 5px;background:<?php echo $cell_background;?>;color:<?php echo $textcolor;?>"  data-id="<?php echo $cname[0]->wid;?>" data-key="<?php echo $cname[0]->stage_column;?>" data-cell="<?php echo $value2->stage_column.$count2.$value->id;?>" data-dataid="<?php echo $value->id;?>" data-stageorder="<?php echo $cname[0]->stage_order;?>" data-stagecolor="<?php echo $cname[0]->stage_color;?>"	data-stagename="<?php echo $cname[0]->stage_name;?>" data-stagetextcolor="<?php echo $cname[0]->stage_text_color;?>">
																				<option value="2">No</option>
																				<option value="1">Yes</option>
																				<?php
																				if($attributes){
																					foreach ($attributes as $attribute) {
																						
																						?>
																						<option value="<?php echo $attribute->attr_value;?>" <?php echo ($celldata[0]->stage_data==$attribute->attr_value)?'selected="selected"':'';?>><?php echo $attribute->attr_name;?></option>
																						<?php
																					}
																				}

																				?>
																			</select>
																		</td>
																		<?php
																	}
																//}
															$c++;
															}
														}

														?>
														</div>
												
													</tr>
												<?php
												$count2++;
											}
										}
										else{
											?>
												<td colspan="<?php echo ($counted_wstages+7);?>" align="center">No Records Available</td>
											<?php
										}
									?>
								</tbody>
							</table>
							</div>
						
					</div></div></form>
					</div>
					 <?php echo ($this->pagination->create_links())?'<div class="pagination">' . $this->pagination->create_links() . '</div>':''; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Stage Settings</h3>
		</div>
		<form method="post" id="stageform">
			<div class="modal-body">
					<div id="msg"></div>
	              <div class="form-group">
	                <label for="exampleInputEmail1">Stage Name</label>
	                <input type="text" class="form-control" placeholder="Enter name" name="stage_name" id="stage_name">
	              </div>
	              <div class="form-group">
	              	<label for="exampleInputEmail1">Stage / Stage Column Color</label>
	              	<select class="form-control" name="stage_color" id="stage_color">
	              		<option value="#000000">Black</option>
	              		<option value="#0000FF">Blue</option>
	              		<option value="#00FF00">Green</option>
	              		<option value="#FF00FF">Purple</option>
	              		<option value="#FF0000">Red</option>
	              		<option value="#FFFF00">Yellow</option>
	              	</select>
	              </div>
	              <!--div class="form-group">
	              	<label for="exampleInputEmail1">Stage / Stage Column Color</label>
	                <div id="cp11" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_color" id="stage_color"/>
	                  <span class="input-group-addon"><i id="stage_color_span"></i></span>
	              	</div>
	              </div>
	              <div class="form-group">
	              	<label for="exampleInputEmail1">Stage Text Color</label>
	                <div id="cp12" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_text_color" id="stage_text_color"/>
	                  <span class="input-group-addon"><i id="stage_text_color_span"></i></span>
	              	</div>
	              </div-->		
			</div>
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"  role="button">Close</button>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" id="saveImage" class="btn btn-success btn-hover-green btn-sm" data-action="save" role="button">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
  </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Stage Settings</h3>
		</div>
		<form method="post" id="stageform2">
			<div class="modal-body"  id="mcontent">
					<div id="msg2"></div>

					<input type="hidden" name="column_id" id="column_id2">
	              <div class="form-group">
	                 <h6><strong>Stage Name</strong><!--button style="margin-top: -8px;display:none;" class="btn btn-danger btn-xs pull-right tooltip-error" type="button" id="btndel" onclick="delete_stage();" data-rel="tooltip" data-placement="left" title="" data-original-title="Delete Stage"><i class="fa fa-trash"></i></button--></h6>
	                <input type="text" class="form-control" placeholder="Enter name" name="stage_name" id="stage_name2">
	              </div>
	              <div class="form-group">
	              	<label for="exampleInputEmail1">Stage / Stage Column Color</label>
	                <div id="cp13" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_color" id="stage_color2"/>
	                  <span class="input-group-addon"><i id="stage_color_span2"></i></span>
	              	</div>
	              </div>
	              <div class="form-group">
	              	<label for="exampleInputEmail1">Stage Text Color</label>
	                <div id="cp14" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_text_color" id="stage_text_color2"/>
	                  <span class="input-group-addon"><i id="stage_text_color_span2"></i></span>
	              	</div>
	              </div>
	              <div class="form-group" id="stagelist" style="display:none;">
	              <!--input type="hidden" id="reorderd" name="reorderd">
	              <input type="hidden" id="reorderd2" name="stage_order"-->  
	              	<h6><strong>Stage List Order</strong><small class="pull-right">Drag to change order</small></h6>
	              	<ul id="SortMe" class="Nodot">
	              	
					</ul>
					<!--style type="text/css">
						.Nodot{ padding-left: 0; margin-left: 0;border: 1px solid #eee; padding: 5px; max-height:150px;overflow: auto;}
						.Nodot li{ padding: 2px 8px; font-size: 12px; font-weight: 600; }
						.Nodot li:nth-child(even){
							background-color: #eee;
						}
					</style-->
	              </div>
	             	
			</div>
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"  role="button">Close</button>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" id="saveImage2" class="btn btn-success btn-hover-green btn-sm" data-action="save" role="button">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Stage Settings</h3>
		</div>
		<form method="post" id="stageform3">
		<input type="hidden" name="column_id" id="column_id3">
			<div class="modal-body">
					<div id="msg3"></div>
					<div class="form-group" id="stagelist">
			            <input type="hidden" id="reorderd" name="reorderd">
			            <input type="hidden" id="reorderd2" name="stage_order">  
			            <h6><strong>Stage List Order</strong><small class="pull-right">Drag to change order</small></h6>
		              	<ul id="SortMe3" class="Nodot">
		              	
						</ul>
		            </div>
		            <div class="form-group" id="stagelist23" style="display:none;">
		            	 <h6><strong>Stage Attributes</strong></h6>
		              		<ul id="stage_attributes" class="attr-listing">
		              			
							</ul>
		            </div>
		        <div id="divform" style="display:none;">
		         <div class="row">
	              <div class="form-group col-sm-6">
	                <label for="exampleInputEmail1">Stage Name</label>
	                <input type="text" class="form-control" placeholder="Enter name" name="stage_name" id="stage_name3">
	              </div>
	              <div class="form-group col-sm-6">
	              	<label for="exampleInputEmail1">Stage / Stage Column Color</label>
	              	<select class="form-control" name="stage_color" id="stage_color3">
	              		<option value="#000000">Black</option>
	              		<option value="#0000FF">Blue</option>
	              		<option value="#00FF00">Green</option>
	              		<option value="#FF00FF">Purple</option>
	              		<option value="#FF0000">Red</option>
	              		<option value="#FFFF00">Yellow</option>
	              	</select>
	              </div>
	              </div>
	              <div class="row">
	              <div class="form-group col-sm-6">
	              	<label for="exampleInputEmail1">Change Stage color</label>
	              	<select class="form-control" name="stage_text_color3" id="stage_text_color4">
	              		<option value="1">Yes</option>
	              		<option value="2">No</option>
	              	</select>
	              </div>
	              <div class="form-group col-sm-6">
	              	<label for="exampleInputEmail1">Add attribute to Yes / No Dropdown</label>
	              	<input type="text" class="form-control" placeholder="Enter attribute" name="attr_name" id="attr_name">
	              	<input type="hidden" name="attr_id" id="attr_id">
	              	<button type="button" class="btn btn-success btn-sm" id="save_attr" onclick="add_stage_attribute();">Save</button>
					<button type="button" class="btn btn-success btn-sm" id="update_attr" onclick="update_stage_attribute();" style="display:none;">Save</button>
	              
	              	 
	              	 <!--span class="help-msg">Leave blank if don't want to add attribute</span-->
	              </div>
	              </div>
	            </div>
	              

	              		
			</div>
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"  role="button">Close</button>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" id="saveImage" class="btn btn-success btn-hover-green btn-sm" data-action="save" role="button" style="display:none;">Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
  </div>
</div>


<!--Popover-->

<div id="myForm" class="hide">
    <form action="" id="popForm" method="get">
        <div>
        	<input type="hidden" name="wid" id="wid">
            <label for="about">Notes:</label>
            <textarea rows="3" name="notes" id="notes" class="form-control input-md"></textarea><br>
            <button type="button" class="btn btn-primary btn-sm" id="btnsave"> Save</button>
        </div>
    </form>
</div>
<div id="result"></div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
//$(".sticky_column").stick_in_parent();


$(document).on("click", ".popover .close" , function(){
    $(this).parents(".popover").popover('hide');
});
$(document).ready(function(){
	$('.popup').popover({
       
        placement: 'right',
        title: function () { return '<strong>Notes for Line no-'+$(this).attr('data-line')+'</strong><i class="fa fa-times pull-right close"></i>'; },
        html:true,
        content:  $('#myForm').html(),
       /* trigger: 'focus',*/
        container: '#table_id'
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#wid').val($(this).attr('data-id'));
      $.ajax({
      	type:'GET',
      	url:'<?php echo base_url().'admin_workflow/load_saved_notes/';?>'+$(this).attr('data-id'),
      	data:{},
      	success:function(data){
      		json=$.parseJSON(data);
      		if(json.hasOwnProperty('notes')){
      			//alert(json.notes);
      			$('#notes').text(json.notes);
      		}
      	}
      });
      $('#btnsave').click(function(){
	      $.ajax({
	      	type:'POST',
	      	url:'<?php echo base_url().'admin_workflow/save_notes';?>',
	      	data:$('#popForm').serialize(),
	      	beforeSend:function(){
	      		$('#btnsave').append(' <span class="fa fa-spinner"></span>');
	      		$('#btnsave').prop('disabled',true);
	      	},
	      	success:function(data){
	      		console.log($('#popForm').serialize());
	      		json=$.parseJSON(data);
	      		if(json.hasOwnProperty('success')){
	      			 $('#btnsave').html(json.success);
	      			setTimeout(function(){
	      				$('#btnsave').html('Save');
	      				$('.popup').popover('hide');
	      			},2000);
	      			 $('#btnsave').prop('disabled',false);
	      		}else if(json.hasOwnProperty('error')){
	      			 $('#btnsave').html(json.error);
	      			setTimeout(function(){
	      				 $('#btnsave').html('Save');
	      				 $('.popup').popover('hide');
	      			},2000);
	      			$(this).prop('disabled',false);
	      		}
	      	}
	      });
	       
      })
  });
});

//17-05-17
	$(document).on('change', '.selector', function (e) { 
		var wid=$(this).attr('data-id');
		var key=$(this).attr('data-key');
		var cell=$(this).attr('data-cell');
		var data_id=$(this).attr('data-dataid');
		var stage_order=$(this).attr('data-stageorder');
		var stage_data=$(this).val();
		var stage_color=$(this).attr('data-stagecolor');
		var stage_text_color=$(this).attr('data-stagetextcolor');
		var stage_name=$(this).attr('data-stagename');
		var reorderd=$('#reorderd').val();
		//console.log(stage_text_color);

		console.log('wid='+wid+'key='+key+'cell='+cell+'data_id='+data_id+'stage_order='+stage_order+'stage_data='+stage_data+'stage_color='+stage_color+'stage_name='+stage_name);

	 
	  $.ajax({
			type:'POST',
			url:'<?php echo base_url().'admin_workflow/update_stage_cell';?>',
			data:{wid:wid,key:key,cell:cell,data_id:data_id,stage_order:stage_order,stage_data:stage_data,stage_color:stage_color,stage_name:stage_name,reorderd:reorderd,stage_order:stage_order,stage_text_color:stage_text_color},
			success:function(data){
				json=$.parseJSON(data);
				if(json.hasOwnProperty('success')){
					//alert(json.success);
					//window.location.href='<?php echo base_url().'admin/workflow';?>';
					$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages/'.$this->uri->segment(3);?>');
				}else if(json.hasOwnProperty('error')){
					alert(json.error);
				}
			}
		});
	});


		$(document).on('click','#show',function(e){
			$(this).hide();
			$('#hide').show();
			$('.hidecol').show();
			$.ajax({
				type:"GET",
				url:'<?php echo base_url().'admin_workflow/show_hide_stages/1';?>',
				data:{},
				success:function(data){
					//window.location.href='<?php echo base_url().'admin/workflow';?>';
					$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
				}
			});
		});

		$(document).on('click','#hide',function(e){
			$(this).hide();
			$('#show').show();
			$('.hidecol').hide();
			$.ajax({
				type:"GET",
				url:'<?php echo base_url().'admin_workflow/show_hide_stages/2';?>',
				data:{},
				success:function(data){
					//window.location.href='<?php echo base_url().'admin/workflow';?>';
					$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
				}
			});
			
		});







	$(document).ready(function(){

		

		$('.hidecol').hide();
		//$('#hide').hide();

	load_stage();


	//selector



function change_stage_cell_data(wid,key,cell,data_id,stage_order,stage_data,stage_color,stage_name,reorderd){
	var s=stage_data;
	//alert(s);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url().'admin_workflow/update_stage_cell';?>',
		data:{wid:wid,key:key,cell:cell,data_id:data_id,stage_order:stage_order,stage_data:s,stage_color:stage_color,stage_name:stage_name,reorderd:reorderd,stage_order:stage_order},
		success:function(data){
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				//alert(json.success);
				window.location.href='<?php echo base_url().'admin/workflow';?>';
				//$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}

	$("#myModal").on("hidden.bs.modal", function () {
		  $("#stageform").trigger('reset');
	});
	/*$('#myModal3').on('shown.bs.modal', function() {
	   load_stage();
	});*/
		$('#cp11').colorpicker();
		$('#cp12').colorpicker();
		$('#cp13').colorpicker();
		$('#cp14').colorpicker();

	});

	function change_stage_id(id){
		$('#myModal3').find('#column_id3').val(id);
		$.ajax({
			type:'GET',
			url:'<?php echo base_url().'admin_workflow/get_stage_data/';?>'+id,
			data:{},
			success:function(data){
				console.log(data);
				json=$.parseJSON(data);
				if(json.hasOwnProperty('success')){
					$('#myModal3').find('#column_id3').val(id);
					$('#myModal3').find('#stage_name3').val(json.stage_name);
					$('#myModal3').find('#stage_color3').val(json.stage_color);
					$('#myModal3').find('#stage_text_color3').val(json.stage_text_color);
					$('#myModal3').find('#stage_text_color4').val(json.change_stage_color);
					$('#myModal3').find('#stage_color_span3').css('background',json.stage_color);
					$('#myModal3').find('#stage_text_color_span3').css('background',json.stage_text_color);
					$('#myModal3').find('#divform').css('display','block');
					$('#myModal3').find('#saveImage').css('display','block');
					//$('#btndel').css('display','block');
					$('#stagelist').css('display','block');
				}else if(json.hasOwnProperty('error')){
					alert(json.error);
				}
			}
		});
	}
	function load_stage(){
		$('#myModal2').find('#SortMe').load('<?php echo base_url().'admin_workflow/loadstages' ?>');
		$('#myModal3').find('#SortMe3').load('<?php echo base_url().'admin_workflow/loadstages' ?>');
	}

	function load_stage_attributes(id){
		/*$('#myModal3').find('#stage_attributes').load('<?php echo base_url().'admin_workflow/load_stage_attributes/' ?>'+id);
		$('#myModal3').find('#stagelist23').css('display','block');*/

		$.ajax({
			type:'GET',
			url:'<?php echo base_url().'admin_workflow/load_stage_attributes/' ?>'+id,
			data:{},
			success:function(data){
				if(data!=''){
					$('#myModal3').find('#stage_attributes').html(data);
					$('#myModal3').find('#stagelist23').css('display','block');
				}else {
					$('#myModal3').find('#stagelist23').css('display','none');
				}
			}
		});
	}


	function add_stage_attribute(){
		var stage_id=$('#myModal3').find('#column_id3').val();
		var attr_name=$('#myModal3').find('#attr_name').val();
		if(attr_name!=''){
			$.ajax({
				type:'POST',
				url:'<?php echo base_url().'admin_workflow/add_new_stage_attribute';?>',
				data:{stage_id:stage_id,attr_name:attr_name},
				beforeSend:function(){

				},
				success:function(data){
					json=$.parseJSON(data);
					if(json.hasOwnProperty('success')){
						$('#myModal3').find('#msg3').html('<div class="alert alert-success">'+json.success+'</div>');
					setTimeout(function(){$('#myModal3').find('#msg3').html('');load_stage_attributes(stage_id);$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');$('#myModal3').find('#stagelist23').css('display','block');$('#myModal3').find('#attr_name').val('');},2000);	

					}else if(json.hasOwnProperty('error')){
						$('#myModal3').find('#msg3').html('<div class="alert alert-danger">'+json.error+'</div>');
					 	setTimeout(function(){$('#myModal3').find('#msg3').html('');$('#myModal3').find('#stagelist23').css('display','block');},2000);
					}
				}
			});

		}else{
			alert('Please enter attribute');
			$('#myModal3').find('#attr_name').focus();
		}
			
	}

	function edit_stage_attribute(id,name){
		$('#myModal3').find('#attr_id').val(id);
		$('#myModal3').find('#attr_name').val(name);
		$('#myModal3').find('#save_attr').css('display','none');
		$('#myModal3').find('#update_attr').css('display','block');
	}

	function update_stage_attribute(id){
		var stage_id=$('#myModal3').find('#column_id3').val();
		var attr_id=$('#myModal3').find('#attr_id').val();
		var attr_name=$('#myModal3').find('#attr_name').val();
		if(attr_name!='' && attr_id!=''){
			$.ajax({
				type:'POST',
				url:'<?php echo base_url().'admin_workflow/update_stage_attribute';?>',
				data:{attr_id:attr_id,attr_name:attr_name},
				beforeSend:function(){

				},
				success:function(data){
					json=$.parseJSON(data);
					if(json.hasOwnProperty('success')){
						$('#myModal3').find('#msg3').html('<div class="alert alert-success">'+json.success+'</div>');
					setTimeout(function(){$('#myModal3').find('#msg3').html('');load_stage_attributes(stage_id);$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');$('#myModal3').find('#stagelist23').css('display','block');$('#myModal3').find('#attr_name').val('');},2000);
						$('#myModal3').find('#save_attr').css('display','block');
						$('#myModal3').find('#update_attr').css('display','none');
						$('#myModal3').find('#attr_id').val('');	

					}else if(json.hasOwnProperty('error')){
						$('#myModal3').find('#msg3').html('<div class="alert alert-danger">'+json.error+'</div>');
					 	setTimeout(function(){$('#myModal3').find('#msg3').html('');$('#myModal3').find('#stagelist23').css('display','block');},2000);
					 	$('#myModal3').find('#attr_id').val('');
					 	$('#myModal3').find('#save_attr').css('display','block');
						$('#myModal3').find('#update_attr').css('display','none');
					}
				}
			});

		}else if(attr_name=='' && attr_id!=''){
			alert('Please enter attribute');
			$('#myModal3').find('#attr_name').focus();
		}else if(attr_name!='' && attr_id==''){
			alert('Please select an attribute');
		}else if(attr_name=='' && attr_id==''){
			alert('Please select an attribute');
		}
			
	}

	function delete_stage_attribute(id,stage_id){
		var attr_id=$('#myModal3').find('#attr_id').val();
		var attr_name=$('#myModal3').find('#attr_name').val();
		$.ajax({
			type:'GET',
			url:'<?php echo base_url().'admin_workflow/delete_stage_attribute/' ?>'+id+'/'+stage_id,
			success:function(data){
				json=$.parseJSON(data);
				if(json.hasOwnProperty('success')){
					$('#myModal3').find('#msg3').html('<div class="alert alert-success">'+json.success+'</div>');
					setTimeout(function(){$('#myModal3').find('#msg3').html('');load_stage_attributes($('#myModal3').find('#column_id3').val());$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');$('#myModal3').find('#stagelist23').css('display','block');},2000);
					if(attr_name!='' && attr_id!=''){
						$('#myModal3').find('#attr_id').val('');
						$('#myModal3').find('#attr_name').val('');
						$('#myModal3').find('#save_attr').css('display','block');
						$('#myModal3').find('#update_attr').css('display','none');
					}
				}else if(json.hasOwnProperty('error')){
					 $('#myModal3').find('#msg3').html('<div class="alert alert-danger">'+json.error+'</div>');
					 setTimeout(function(){$('#myModal3').find('#msg3').html('');$('#myModal3').find('#stagelist23').css('display','block');},2000);
				}
			}
		});
	}





//11-05-17
$('#stageform').validate({
	rules:{
		stage_name:{
			required:true
		}
	},
	messages:{
		stage_name:{
			required:'Please enter stage name'
		}
	},
	submitHandler:function(form){
		$.ajax({
			type:'POST',
			url:'<?php echo base_url().'admin_workflow/add_stage';?>',
			data:$('#stageform').serialize(),
			beforeSend:function(){
				$('#saveImage').append(' <span class="fa fa-spinner"></span>');
				$('#saveImage').prop('disabled',true);
			},
			success:function(data){
				console.log(data);
				json=$.parseJSON(data);
                if(json.hasOwnProperty('success')){                  
                  $('#msg').html('<div class="alert alert-success">'+json.success+'</div>');
                  $('#saveImage span.fa').remove();
				  $('#saveImage').prop('disabled',false);

				  setTimeout(function(){
				  	$('#msg').html('');
				  	//window.location.href='<?php echo base_url().'admin/workflow';?>';
				  	$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
					$('#stageform').trigger('reset');
					$('#myModal').find('#stage_color_span').css('background','#00AABB');
					$('#myModal').find('#stage_text_color_span').css('background','#00AABB');
					load_stage();
				  },1000);
                } else if(json.hasOwnProperty('error')){
                    //alert(json.error);
                      $('#msg').html('<div class="alert alert-error">'+json.error+'</div>');
	                  $('#saveImage span.fa').remove();
					  $('#saveImage').prop('disabled',false);
					  setTimeout(function(){
					  	$('#msg').html('');
					  },2000);
                }
			}
		});
	}
});

$('#stageform3').validate({
	rules:{
		stage_name:{
			required:true
		}
	},
	messages:{
		stage_name:{
			required:'Please select stage name'
		}
	},
	submitHandler:function(form){
		$.ajax({
			type:'POST',
			url:'<?php echo base_url().'admin_workflow/add_stage';?>',
			data:$('#stageform3').serialize(),
			beforeSend:function(){
				$('#myModal3').find('#saveImage2').append(' <span class="fa fa-spinner"></span>');
				$('#myModal3').find('#saveImage2').prop('disabled',true);
			},
			success:function(data){
				console.log(data);
				json=$.parseJSON(data);
                if(json.hasOwnProperty('success')){
                  
                  $('#myModal3').find('#msg3').html('<div class="alert alert-success">'+json.success+'</div>');
                  $('#myModal3').find('#saveImage2 span.fa').remove();
				  $('#myModal3').find('#saveImage2').prop('disabled',false);
				  setTimeout(function(){
				  	$('#myModal3').find('#msg3').html('');
				  	//window.location.href='<?php echo base_url().'admin/workflow';?>';
				  	$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
				  	load_stage();
				  	$('#stageform3').trigger('reset');
				  	$('#divform').css('display','none');
				  	$('#myModal3').find('#saveImage').css('display','none');
				  //	$('#myModal2').find('#stage_color_span2').css('background','#00AABB');
					//$('#myModal2').find('#stage_text_color_span2').css('background','#00AABB');
				  },1000);
                } else if(json.hasOwnProperty('error')){
                    //alert(json.error);
                      $('#myModal3').find('#msg3').html('<div class="alert alert-error">'+json.error+'</div>');
	                  $('#myModal3').find('#saveImage2 span.fa').remove();
					  $('#myModal3').find('#saveImage2').prop('disabled',false);
					  $('#divform').css('display','none');
				  	  $('#myModal3').find('#saveImage').css('display','none');
					  setTimeout(function(){
					  	$('#myModal3').find('#msg3').html('');
					  },2000);
                }
			}
		});
	}
});




function change_stage_data(id){
	$.ajax({
		type:'GET',
		url:'<?php echo base_url().'admin_workflow/get_stage_data/';?>'+id,
		data:{},
		success:function(data){
			//console.log(data);
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				$('#myModal2').find('#column_id2').val(id);
				$('#myModal2').find('#stage_name2').val(json.stage_name);
				$('#myModal2').find('#stage_color2').val(json.stage_color);
				$('#myModal2').find('#stage_color_span2').css('background',json.stage_color);
				$('#myModal2').find('#stage_text_color_span2').css('background',json.stage_text_color);
				$('#btndel').css('display','block');
				$('#stagelist').css('display','block');
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}

function delete_stage(id){
	//id=$('#myModal2').find('#column_id2').val();
	$.ajax({
		type:'GET',
		url:'<?php echo base_url().'admin_workflow/delete_stage/';?>'+id,
		data:{},
		beforeSend:function(){
			$('#myModal3').find('#msg3').html('<div class="alert alert-info"> Removing Stage....<span class="fa fa-spinner"></span></div>');
		},
		success:function(data){
			console.log(data);
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				 $('#myModal3').find('#msg3').html('<div class="alert alert-success">'+json.success+'</div>');
				 setTimeout(function(){
				 	$('#myModal3').find('#msg3').html('');
				 	//window.location.href='<?php echo base_url().'admin/workflow';?>';
				 		$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
				 		load_stage();
				 		/*if(parseInt(json.stages)==0){
				 			$('#mcontent').html('Add some stages.');
				 			$('#saveImage2').hide();
				 		}*/
				 },1000);
				
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}



$(document).ready(function(){
	$('#myModal').on('hidden.bs.modal', function () {
	  	$('#myModal').find('#column_id').val();
		$('#myModal').find('#stage_name').val();
		$('#myModal').find('#stage_color').val('#00AABB');
	});
});


$(document).ready(function () {

     var Items = $("#SortMe3 li");

     $('#SortMe3').sortable({
         disabled: false,
         axis: 'y',
         forceHelperSize: true,
         update: function (event, ui) {
         	 
         	  	var selectedLanguage = new Array();
         	  	var selectedLanguage2 = new Array();
				$('ul#SortMe3 li').each(function() {
					selectedLanguage.push($(this).attr("id"));
					selectedLanguage2.push($(this).attr("data-srtid"));		
				});	
				console.log(selectedLanguage2);
             var Newpos = ui.item.index();
             $('#reorderd').val(selectedLanguage2);
             $('#reorderd2').val(selectedLanguage);
             $.ajax({
             	type:'POST',
             	url:'<?php echo base_url().'admin_workflow/change_order';?>',
             	data:$('#stageform3').serialize(),
             	success:function(data){
             		console.log(data);
             		$("#editabletable").load('<?php echo base_url().'admin_workflow/load_stages';?>');
				 	load_stage();
             	}
             });
            // alert("You moved item to position " + Newpos);

         }
     }).disableSelection();
 });
//11-05-17
</script>
 <style>
    .sort{width: 100%;height: 15px;}
    .sort-a{position: relative;margin-left: -10px;margin-top: -21px; color:#333}
    .sort-a:before{ content: "\f0d8"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    .sort-d{ position: relative; margin-left: -10px;margin-top: -13px; color: #333}
    .sort-d:before{ content: "\f0d7"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    
	.ListItem:Hover {  cursor: pointer;}

	.Nodot{ padding-left: 0; margin-left: 0;border: 1px solid #eee; padding: 5px; max-height:150px;overflow: auto;list-style: none;}
	.Nodot li{ padding: 2px 8px; font-size: 12px; font-weight: 600; position: relative; cursor: move; }
	.Nodot li:nth-child(even){background-color: #eee;}

	.attr-listing{ padding-left: 0; margin-left: 0;border: 1px solid #eee; padding: 5px; max-height:150px;overflow: auto;list-style: none;}
	.attr-listing li{ padding: 2px 8px; font-size: 12px; font-weight: 600; position: relative; cursor: move; }
	.attr-listing li:nth-child(even){background-color: #eee;}
	.attr-listing li:nth-child(odd){background-color: #ddd;}

	.help-msg{color: #F44336; font-size: 12px; text-transform: capitalize;margin-left: 5px;}
	.help-msg:before{ content: '*'; font-size: 14px; font-weight: 600;position: relative; top: 3px;  left: -5px; }

	span.input-group-addon{ cursor: pointer; }
	.modal-backdrop{ height: 100% !important; position: fixed; }

#constrainer::-webkit-scrollbar-track{	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);background-color: #ccc;}
#constrainer::-webkit-scrollbar{width: 5px; height:5px;background-color: #ccc;}
#constrainer::-webkit-scrollbar-thumb{background-color: #438eb9;}
.body::-webkit-scrollbar-track{	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);background-color: #ccc;}
.body::-webkit-scrollbar{width: 5px; height:5px;background-color: #ccc;}
.body::-webkit-scrollbar-thumb{background-color: #438eb9;}
.scrolltable::-webkit-scrollbar-track{	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);background-color: #ccc;}
.scrolltable::-webkit-scrollbar{width: 5px; height:5px;background-color: #ccc;}
.scrolltable::-webkit-scrollbar-thumb{background-color: #438eb9;}

.scrolltable {
            overflow-x: scroll;
            height: 100%;
            display: flex;
            display: -webkit-flex;
            flex-direction: column;
            -webkit-flex-direction: column;
        }
        .scrolltable > .header {
        }
        .scrolltable > .body {
            /*noinspection CssInvalidPropertyValue*/
            width: -webkit-fit-content;
            overflow-y: scroll;
            flex: 1;
            -webkit-flex: 1;
        }
        /*th, td {
            min-width: 150px;
        }*/
        /* an outside constraint to react against */
        #constrainer {
            width: 100%;
            height: 700px;
        }
        #constrainer2 {
            width: 400px;
            overflow-x: scroll;
        }
        #constrainer2 table {
            overflow-y: scroll;
        }
        #constrainer2 tbody {
            overflow-x: scroll;
            display: block;
            height: 200px;
        }
        #constrainer2 thead {
            display: table-row;
        }
        /* only styling below here */
        #constrainer, #constrainer2 {
            border: 1px solid lightgrey;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid gray;
        }
        th {
            background-color: lightgrey;
            border-width: 1px;
        }
        td {
            border-width: 1px;
        }
        tr:first-child td {
            border-top-width: 0;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }

        #table_id { margin-bottom: 0px; }


        .popover-content {
		  height: 180px;  
		  width: 300px;  
		}

		.popover-content textarea {
		   border: 1px solid #ddd;   
		   margin: 0px; 
		   width: 90%;
		   height: 100%;
		   padding: 0px;  
		   box-shadow: none;
		}

		.popover-footer {
		  margin: 0;
		  padding: 8px 14px;
		  font-size: 14px;
		  font-weight: 400;
		  line-height: 18px;
		  background-color: #F7F7F7;
		  border-bottom: 1px solid #EBEBEB;
		  border-radius: 5px 5px 0 0;
		}

		.input-group-addon.success {
    color: rgb(255, 255, 255);
    background-color: rgb(92, 184, 92);
    border-color: rgb(76, 174, 76);
}

		
</style>


<?php $this->load->view('admin/includes/vwFooter'); ?>