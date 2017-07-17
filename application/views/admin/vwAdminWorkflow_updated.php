<?php $this->load->view('admin/includes/vwHeader'); ?>

<?php $wstages=$this->workflow_model->get_distinct_column();?>

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

						<a class="btn btn-success pull-right btn-xs" style="margin-top: -4px;" data-toggle="modal" data-target="#myModal">Add Stage</a>
						<a class="btn btn-primary pull-right btn-xs" style="margin: -4px 5px 0 5px; ">Show/Hide Date Recieved Stage</a>
					</div>
					<div class="panel-body" id="workflow_list">

					<div class="table-responsive" style="font-size: 10px; font-weight: 600;">	
						<form method="post">
						<!--?php echo $this->workflow_model->last_stage_column('H11464')[0]->wid;?-->
							<table class="table table-striped table-bordered" id="editabletable">
								<thead>
									<th style = "text-align: center;">Line No

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
									<th style = "text-align: center;">Job

									</th>
									<th style = " text-align: center; white-space: nowrap;" class="dr_hide">Date Recieved</th>
									<th style = " text-align: center; white-space: nowrap;">Due Date</th>
									<!--<th style = "width: 100px; text-align: center;">Time test</th>-->
									<th style = "text-align: center;">Translator Name</th>
									<th style = "text-align: center;">Language From</th>
									<th style = "text-align: center;">Language To</th>
									<?php
									
									$counted_wstages=count($this->workflow_model->get_distinct_column());
									if(!empty($wstages)){
										foreach ($wstages as $key => $value) {
											$cname=$this->workflow_model->get_stage_name($value->stage_column);
											$background=($cname[0]->stage_color!='')?$cname[0]->stage_color:'#ffffff';
											$textcolor=($cname[0]->stage_text_color!='')?$cname[0]->stage_text_color:'#ffffff';
											?>
												<th style = "min-width:100px !important; white-space: nowrap;text-align: center;background:<?php echo $background;?>;color:<?php echo $textcolor;?>" data-toggle="modal" data-target="#myModal" onclick="change_stage_data(<?php echo $cname[0]->wid;?>);"><?php echo $cname[0]->stage_name;?></th>
											<?php
										}
									}

									?>

									
									<!--th style = "text-align: center; width: 100px;">Payment</th>
									<th style = "text-align: center; width: 100px;">Send to TM</th-->
								
									<!--th style = "text-align: center; width: 100px;">Date Paid</th>
									<th style = "text-align: center; width: 300px;">Payment</th>
									<th style = "text-align: center;">Operations</th-->
								</thead>
								<tbody>
									<?php
										if(!empty($jobs)){
											$count2=($limit_end!=0)?$limit_end+1:1;
											foreach ($jobs as $key => $value) {
												$lang=explode('/',$value->language);
												$textcolor=($cname[0]->stage_text_color!='')?$cname[0]->stage_text_color:'#ffffff';
												//print_r($lang);
												//
												$language_from=$this->workflow_model->getlanguages(['id'=>$lang[0]]);
	                       						$language_to=$this->workflow_model->getlanguages(['id'=>$lang[1]]);
	                       						$bidjob=$this->workflow_model->getbidjobs(['job_id'=>$value->id]);
	                       						
												$translator=$this->workflow_model->gettransalator(['id'=>$bidjob[0]->trans_id]);

												?>
													<tr align="center">
														<td><?php echo $value->lineNumber;?></td>
														<td><?php echo $value->name;?></td>
														<td class="dr_hide"><?php echo date('m-d-Y',strtotime($value->created));?></td>
														<td style="white-space: nowrap;"><?php echo $value->dueDate;?></td>
														<td><?php echo ucwords($translator[0]->first_name.' '.$translator[0]->last_name);?></td>
														<td><?php echo $language_from[0]->name;?></td>
														<td><?php echo $language_to[0]->name;?></td>
														<?php

														if(!empty($wstages)){

															$c=8;
															foreach ($wstages as $key => $value2) {
																$cname=$this->workflow_model->get_stage_name($value2->stage_column);
																$celldata=$this->workflow_model->get_cell_data($value->id,getNameFromNumber($c,1),getNameFromNumber($c,1).$count2.$value->id);
																//print_r($cname);
																$cell_background=!empty($celldata)?$celldata[0]->stage_cell_color:$cname[0]->stage_color;
																if(!empty($celldata) && $celldata[0]->stage_data!=''){
																	?>
																	<td style = "min-width:100px !important; white-space: nowrap;text-align: center;background:<?php echo $cell_background;?>;">
																	<!--input type="text" id="cell<?php echo $value2->wid.getNameFromNumber($c,1).$count2;?>" value="<?php echo $cname[0]->stage_cell_color;?>"-->
																	<select class="form-control" style="font-size: 10px;font-weight: 600; height: 24px;padding: 2px 5px;background:<?php echo $cell_background;?>;color:<?php echo $textcolor;?>" onchange="change_stage_cell_data('<?php echo $cname[0]->wid;?>','<?php echo $cname[0]->stage_column;?>','<?php echo getNameFromNumber($c,1).$count2.$value->id;?>','<?php echo $value->id;?>','<?php echo $cname[0]->stage_order;?>',$(this).val(),'<?php echo $cname[0]->stage_color;?>','<?php echo $cname[0]->stage_name;?>')">
																		<option value="2" <?php echo ($celldata[0]->stage_data==2)?'selected="selected"':'';?>>No</option>
																		<option value="1" <?php echo ($celldata[0]->stage_data==1)?'selected="selected"':'';?>>Yes</option>
																	</select>
																	</td>
																	<?php
																} else{
																	?>
																	<td style = "min-width:100px !important; white-space: nowrap;text-align: center;background:<?php echo $cell_background;?>;">
																	<!--input type="text" id="cell<?php echo $value2->wid.getNameFromNumber($c,1).$count2;?>" value="<?php echo $cname[0]->stage_cell_color;?>"-->
																		<select class="form-control" style="font-size: 10px;font-weight: 600; height: 24px;padding: 2px 5px;background:<?php echo $cell_background;?>;color:<?php echo $textcolor;?>" onchange="change_stage_cell_data('<?php echo $cname[0]->wid;?>','<?php echo $cname[0]->stage_column;?>','<?php echo getNameFromNumber($c,1).$count2.$value->id;?>','<?php echo $value->id;?>','<?php echo $cname[0]->stage_order;?>',$(this).val(),'<?php echo $cname[0]->stage_color;?>','<?php echo $cname[0]->stage_name;?>')">
																			<option value="2">No</option>
																			<option value="1">Yes</option>
																		</select>
																	</td>
																	<?php
																}
																
															$c++;
															}
														}

														?>
												
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
						</form>
					</div>
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
			<button type="button" class="close" data-dismiss="modal" onclick="clean()"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Stage Settings</h3>
		</div>
		<form method="post" id="stageform">
			<div class="modal-body">
					<div id="msg"></div>

					<input type="hidden" name="column_id" id="column_id">
	              <div class="form-group">
	                <h6><strong>Stage Name</strong><button style="margin-top: -8px;display:none;" class="btn btn-danger btn-xs pull-right tooltip-error" type="button" id="btndel" onclick="delete_stage();" data-rel="tooltip" data-placement="left" title="" data-original-title="Delete Stage"><i class="fa fa-trash"></i></button></h6>
	                
	                <input type="text" class="form-control" placeholder="Enter name" name="stage_name" id="stage_name">
	              </div>
	              <div class="form-group">
	              	<h6><strong>Stage / Stage Column Color</strong></h6>
	                <div id="cp11" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_color" id="stage_color"/>
	                  <span class="input-group-addon"><i id="stage_color_span"></i></span>
	              	</div>
	              </div>
	              <div class="form-group">
	              	<h6><strong>Stage Text Color</strong></h6>
	                <div id="cp12" class="input-group colorpicker-component">
	                  <input type="text" value="#00AABB" class="form-control" name="stage_text_color" id="stage_text_color"/>
	                  <span class="input-group-addon"><i id="stage_text_color_span"></i></span>
	              	</div>
	              </div>
	              <!--div class="form-group">
	              	<label for="exampleInputEmail1">Cell color if YES</label>
	                <div id="cp12" class="input-group colorpicker-component">
	                  <input type="text" value="#ffffff" class="form-control"/>
	                  <span class="input-group-addon"><i></i></span>
	              	</div>
	              </div>
	              <div class="form-group">
	              	<label for="exampleInputEmail1">Cell color if NO</label>
	                <div id="cp13" class="input-group colorpicker-component">
	                  <input type="text" value="##4ef688" class="form-control"/>
	                  <span class="input-group-addon"><i></i></span>
	              	</div>
	              </div-->
	              <div class="form-group" id="stagelist" style="display:none;">
	              	<h6><strong>Stage List Order</strong><small class="pull-right">Drag to change order</small></h6>
	              	<ul id="SortMe" class="Nodot">
	              	<?php

	              		foreach($wstages as $value){
	              			$cname=$this->workflow_model->get_stage_name($value->stage_column);
	              			$background=($cname[0]->stage_color!='')?$cname[0]->stage_color:'#ffffff';
											$textcolor=($cname[0]->stage_text_color!='')?$cname[0]->stage_text_color:'#ffffff';
	              			?>
	              				<li class="<?php echo $cname[0]->wid;?>" style = "background:<?php echo $background;?>;color:<?php echo $textcolor;?>"><?php echo $cname[0]->stage_name;?></li>
	              			<?php
	              		}
	              	?>
					</ul>
					<style type="text/css">
						.Nodot{ padding-left: 0; margin-left: 0;border: 1px solid #eee; padding: 5px; max-height:150px;overflow: auto;}
						.Nodot li{ padding: 2px 8px; font-size: 12px; font-weight: 600; }
						.Nodot li:nth-child(even){
							background-color: #eee;
						}
					</style>
	              </div>
	              <!--div class="form-group" style="display:none;" id="delb">
	              	<button class="btn btn-danger" type="button" id="btndel" onclick="delete_stage();">Delete this Stage</button>
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$('[data-rel=tooltip]').tooltip();

	
		//$('#colorpicker1').colorpicker();
		//$('.colorpicker').last().css('z-index', 2000);
		//$("#years optgroup").remove();
		$('#cp11').colorpicker();
		$('#cp12').colorpicker();
		$('#cp13').colorpicker();

	});


function init()
{
    var tables = document.getElementsByClassName("table");
    var i;
    for (i = 0; i < tables.length; i++)
    {
        makeTableEditable(tables[i]);
    }
}

function makeTableEditable(table)
{
    var rows = table.rows;
    var r;
    for (r = 0; r < rows.length; r++)
    {
        var cols = rows[r].cells;
        var c;
        for (c = 0; c < cols.length; c++)
        {
            var cell = cols[c];
            var listener = makeEditListener(table, r, c);
            cell.addEventListener("input", listener, false);
        }
    }
}

function makeEditListener(table, row, col)
{
    return function(event)
    {
        var cell = getCellElement(table, row, col);
        var text = cell.innerHTML.replace(/<br>$/, '');
        var items = split(text);

        if (items.length === 1)
        {
            // Text is a single element, so do nothing.
            // Without this each keypress resets the focus.
            return;
        }

        var i;
        var r = row;
        var c = col;
        for (i = 0; i < items.length && r < table.rows.length; i++)
        {
            cell = getCellElement(table, r, c);
            cell.innerHTML = items[i]; // doesn't escape HTML

            c++;
            if (c === table.rows[r].cells.length)
            {
                r++;
                c = 0;
            }
        }
        cell.focus();
    };
}

function getCellElement(table, row, col)
{
    // assume each cell contains a div with the text
    return table.rows[row].cells[col].firstChild;
}

function split(str)
{
    // use comma and whitespace as delimiters
    return str.split(/,|\s|<br>/);
}

 function sort(data) {
       // alert(data);
        if(data != ''){
            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'admin_workflow/sort' ?>",
                data:{sort_type: data},
                success:function (data) {
                    //console.log(data);
                    window.location.reload();
                }
            });
        }
    }

window.onload = init;


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
				json=$.parseJSON(data);
                if(json.hasOwnProperty('success')){
                  
                  $('#msg').html('<div class="alert alert-success">'+json.success+'</div>');
                  $('#saveImage span.fa').remove();
				  $('#saveImage').prop('disabled',false);
				  setTimeout(function(){
				  	$('#msg').html('');
				  	window.location.href='<?php echo base_url().'admin/workflow';?>';
				  },2000);
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

function change_stage_cell_data(wid,key,cell,data_id,stage_order,stage_data,stage_color,stage_name){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url().'admin_workflow/update_stage_cell';?>',
		data:{wid:wid,key:key,cell:cell,data_id:data_id,stage_order:stage_order,stage_data:stage_data,stage_color:stage_color,stage_name:stage_name},
		success:function(data){
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				alert(json.success);
				window.location.href='<?php echo base_url().'admin/workflow';?>';
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}


function change_stage_data(id){
	$.ajax({
		type:'GET',
		url:'<?php echo base_url().'admin_workflow/get_stage_data/';?>'+id,
		data:{},
		success:function(data){
			console.log(data);
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				$('#myModal').find('#column_id').val(id);
				$('#myModal').find('#stage_name').val(json.stage_name);
				$('#myModal').find('#stage_color').val(json.stage_color);
				$('#myModal').find('#stage_text_color').val(json.stage_text_color);
				$('#myModal').find('#stage_color_span').css('background',json.stage_color);
				$('#myModal').find('#stage_text_color_span').css('background',json.stage_text_color);
				$('#btndel').css('display','block');
				$('#stagelist').css('display','block');
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}

function delete_stage(){
	id=$('#myModal').find('#column_id').val();
	$.ajax({
		type:'GET',
		url:'<?php echo base_url().'admin_workflow/delete_stage/';?>'+id,
		data:{},
		success:function(data){
			console.log(data);
			json=$.parseJSON(data);
			if(json.hasOwnProperty('success')){
				 $('#msg').html('<div class="alert alert-success">'+json.success+'</div>');
				 setTimeout(function(){
				 	window.location.href='<?php echo base_url().'admin/workflow';?>';
				 },1000);
				
			}else if(json.hasOwnProperty('error')){
				alert(json.error);
			}
		}
	});
}

function clean(){
	/*$('#myModal').find('#column_id').val();
		$('#myModal').find('#stage_name').val();
		$('#myModal').find('#stage_color').val('#00AABB');*/
		$('#stageform').reset();
}



$(document).ready(function () {

	

       var Items = $("#SortMe li");

     $('#SortMe').sortable({
         disabled: false,
         axis: 'y',
         forceHelperSize: true,
         update: function (event, ui) {
             var Newpos = ui.item.index();
             alert("You moved item to position " + Newpos);

         }
     }).disableSelection();
 });
//11-05-17
</script>
 <style>
    .sort{width: 100%;height: 15px;text-align: right;}
    .sort-a{text-align: right; position: absolute;margin-left: -10px;margin-top: -21px; color:#d3d3d3}
    .sort-a:before{ content: "\f0d8"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    .sort-d{text-align: right; position: absolute;margin-left: -10px;margin-top: -13px; color: #d3d3d3}
    .sort-d:before{ content: "\f0d7"; position: absolute; font-family: FontAwesome; margin-right: -20px; }
    .Nodot {
    list-style: none;


}
  .dr_hide:{
  	display:none;
  }
.ListItem:Hover {
    cursor: pointer;
}
</style>

<?php $this->load->view('admin/includes/vwFooter'); ?>