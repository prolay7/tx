<?php $this->load->view('admin/includes/vwHeader'); ?>

<?php
	$stages=$this->workflownew_model->getStages();
	$show_hide_stages=$this->workflownew_model->get_show_hide();
		
?>

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
						<a class="btn btn-primary pull-right btn-xs" style="margin-top: -4px;" data-toggle="modal" data-target="#myModal2">Edit Stage</a>
						<a class="btn btn-primary pull-right btn-xs" style="margin-top: -4px;" data-toggle="modal" data-target="#myModal">Add Stage</a>
					</div>

					<div class="panel-body" id="workflow_list">
						<form method="post">
							<div id="constrainer">
								<div class="scrolltable" id="editabletable">

									<table class="table table-striped table-bordered" id="table_id">
											<thead>
												<?php
													if($stages){
														$count=1;
														foreach($stages as $stage){
															$background=($stage->stage_color!='')?$stage->stage_color:'#ffffff';
															$textcolor=(!empty($cname) && $stage->stage_color=='#000000'|| $stage->stage_color=='#0000FF' || $stage->stage_color=='#FF0000' )?'#ffffff':'#000000';
															$stage_width=($count==1)?'width:70px;min-width:70px;':(($count==2)?'width:200px;min-width:200px;':'width:150px;min-width:150px;');
																?>

															<th style = "<?php echo $stage_width;?> white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo $stage->stage_name;?></th>
															<?php
															$count++;
														}
													}
												?>
											</thead>
									</table>

									<div class="body">
										
										<table>
											<tbody>
												<?php
													if($jobs && $stages){
														

														foreach($jobs as $job){
															$background='#ffffff';//($stage->stage_color!='')?$stage->stage_color:'#ffffff';
															$textcolor='#000000';//(!empty($cname) && $stage->stage_color=='#000000'|| $stage->stage_color=='#0000FF' || $stage->stage_color=='#FF0000' )?'#ffffff':'#000000';
															$lang=explode('/',$job->language);
															$language_from=$this->workflownew_model->getlanguages(['id'=>$lang[0]]);
	                       									$language_to=$this->workflownew_model->getlanguages(['id'=>$lang[1]]);
	                       									$bidjob=$this->workflownew_model->getbidjobs(['job_id'=>$job->id]);

	                       									$translator=$this->workflownew_model->gettransalator(['id'=>$bidjob[0]->trans_id]);

																?>

															<tr align="center">
															<?php
															$count=1;
																foreach($stages as $stage){
																	$width=($count==1)?'width:70px;min-width:70px;':(($count==2)?'width:200px;min-width:200px;':'width:150px;min-width:150px;');
																	

																		if($stage->stage_column=='language_from'){
																			?>
																				<td style = "<?php echo $width;?> white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo $language_from[0]->name;?>
																				</td>
																			<?php
																		} else if($stage->stage_column=='language'){
																			?>
																				<td style = "<?php echo $width;?> white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo $language_to[0]->name;?>
																				</td>
																			<?php
																		} else if($stage->stage_column=='transName'){
																			?>
																				<td style = "<?php echo $width;?> white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo ucwords($translator[0]->first_name.' '.$translator[0]->last_name);?>
																				</td>
																			<?php
																		} else  if($stage->stage_column!='language_from' && $stage->stage_column!='language' && $stage->stage_column!='transName'){

																			?>
																				<td style = "<?php echo $width;?> white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo $job->{$stage->stage_column};?>
																				</td>

																			<?php

																		}
																	?>

																	<?php
																	$count++;
																}
															?>
																
															</tr>
															<?php
															
														}
													}
												?>
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
						</form>
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



<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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

<style>
    .sort{width: 100%;height: 15px;}
    .sort-a{position: relative;margin-left: -10px;margin-top: -21px; color:#333}
    .sort-a:before{ content: "\f0d8"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    .sort-d{ position: relative; margin-left: -10px;margin-top: -13px; color: #333}
    .sort-d:before{ content: "\f0d7"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    .Nodot {
    list-style: none;
}
.Nodot li{ position: relative; cursor: move; }
.ListItem:Hover {
    cursor: pointer;
}



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
            width: -webkit-fit-content;
            overflow-y: scroll;
            flex: 1;
            -webkit-flex: 1;
        }
        #constrainer {
            width: 100%;
            height: 400px;
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
</style>

<?php $this->load->view('admin/includes/vwFooter'); ?>