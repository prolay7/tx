<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="sujay mondal">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>favicon.ico">

    <title><?php echo SITE_NAME; ?></title>

    <!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" />
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>font-awesome.css" />
       

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo HTTP_JS_PATH; ?>ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>respond.js"></script>
        
		<![endif]-->
<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery1x.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>

        <!-- page specific plugin scripts -->
		<!--<script src="<?php echo HTTP_JS_PATH; ?>dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>-->

		<!--[if lte IE 8]>
		  <script src="<?php echo HTTP_JS_PATH; ?>excanvas.js"></script>
		<![endif]-->
		<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.custom.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.ui.touch-punch.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.easypiechart.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>jquery.sparkline.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.pie.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>flot/jquery.flot.resize.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.scroller.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.colorpicker.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.fileinput.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.typeahead.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.wysiwyg.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.spinner.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.treeview.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.wizard.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.aside.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.ajax-content.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.touch-drag.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.sidebar.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.submenu-hover.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.widget-box.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings-rtl.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.settings-skin.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.searchbox-autocomplete.js"></script>



		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace.onpage-help.css" />
		<link rel="stylesheet" href="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/elements.onpage-help.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>ace/ace.onpage-help.js"></script>
		<!--<script src="<?php echo HTTP_JS_PATH; ?>js/rainbow.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/generic.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/html.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/css.js"></script>
		<script src="<?php echo HTTP_DOCS_PATH_ADMIN; ?>assets/js/language/javascript.js"></script>-->
        
        

  </head>						
  <body>
						    <?php
							//echo $bid_id;die;
					
							$list_query="SELECT * FROM `bidjob` WHERE id='$bid_id'";
                            $val_query=$this->db->query($list_query);
							$bid=$val_query->row();
							
							$bid->trans_id;
							$job_id=$bid->job_id;
							$bid->proposal;
							$bid->file; 
							
							$job_sql="SELECT * FROM `jobpost` WHERE id='$job_id'";
                            $job_query=$this->db->query($job_sql);
							$job_fetch=$job_query->row();
                   			?>
                            <?php 
                            $attributes = array('class' => 'form-registration', 'id'=>'user-registration', 'enctype' => 'multipart/form-data'); 
                            ?>
                            <h3 style="color:#6fb3e0 ;padding-left: 20px;" ><strong >Details Of Bid</strong></h3>
  						<div class="col-xs-12">
  								
  							  <?php  if($this->session->flashdata('message_success_new')){ ?>
								 	
                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button> 
                                        <p> <?php echo $this->session->flashdata('message_success_new'); ?> </p>
                                    </div> <?php
                                } ?>
  							<div class="form-group" style="padding-top:30px; overflow: hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Name : </label>
                            <div class="col-sm-9">
                            <?php 
                            echo $job_fetch->name;
                            ?>
                            </div>
                            </div>
                            
                            <div class="form-group" style=" overflow: hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Description : </label>
                            <div class="col-sm-9">
                            <?php 
                            echo $job_fetch->description;
                            ?>
                            </div>
                            </div>
                            
                            <div class="form-group" style=" overflow: hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Translator Name : </label>
                            <div class="col-sm-9">
                            <?php 
                            $sql1=" SELECT * FROM `translator` WHERE id='$bid->trans_id'";
                            $val1=$this->db->query($sql1);
                            $trans=$val1->row();
                            echo $trans->first_name."&nbsp;".$trans->last_name;
                            ?>
                        
                            
                            
                           
                            </div>
                            </div>
                            <div class="form-group" style="overflow:hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Time needed : </label>
                            <div class="col-sm-9">
                           <?php   echo $bid->time_need;?>
                            
                            </div>
                            </div>
                             <div class="form-group" style="overflow:hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price : </label>
                            <div class="col-sm-9">
                           <?php   echo $bid->price;?>
                            
                            </div>
                            </div>
                             <div class="form-group" style="overflow:hidden;">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Proposal : </label>
                            <div class="col-sm-9">
                           <?php   echo $bid->proposal;?>
                            
                            </div>
                            </div>
                            <div class="clearfix" > </div>
                            
                            
                            <?php 
                       // $string=rtrim($bid->file, " "); 
                        $view=explode("##",$bid->file);
                        array_pop($view);
                        $num_of_file= count($view);
						//echo  $num_of_file;die;
                        ?>
                        
                        
                        <?php  if($bid->file!= "") { 
                        for ($i = 0; $i < $num_of_file; $i++){
                        if($view[$i]!= "") {
							 $vie = strstr($view[$i], '/');
                		$str = ltrim($vie, '/');
						if($str == ''){
						$str = $view[$i];
						}
                        
                        ?> 
                                    <div class="form-group"  style=" overflow:hidden">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> View File :                                        </label>

										<div class="col-sm-9">
                            <a href="<?php echo base_url(); ?>uploads/bidjobpost/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
                            
										</div>
									</div>
                                              
                                    <?php }}} //else { ?>
                            
                            
                            
                            
                      <!--      <div class="form-group" style=" overflow:hidden">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1 "> View File :  </label>
                            <div class="col-sm-9">
                            <?php echo $bid->file;?>
                            </div>
                            </div>-->
                            
                            
          			 </div>
                            
  
  							<div class="clearfix" > </div>
                            
                            
                            
             </body>
          </html>