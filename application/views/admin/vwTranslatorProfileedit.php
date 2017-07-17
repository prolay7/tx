<?php
$this->load->view('admin/includes/vwHeader');
?>

<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<?php
				$this->load->view('admin/includes/vwSidebar-left');
			?>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Admin</a>
							</li>
							<li class="active">View Registered Translator</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!--<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>--><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<!-- /.ace-settings-container -->
						<?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Translator
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
								<?php if (isset($message_error) && $message_error!="") { ?>
                                     <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo $message_error; ?> </p>
                                    </div>
                                <?php } ?>
                                
                                <?php if (isset($message_success) && $message_success!="") { ?>
                                     <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo $message_success; ?> </p>
                                    </div>
                                <?php } ?>
                                 <?php  if($this->session->flashdata('flash_message')){
								 	if($this->session->flashdata('flash_message') == 'try_another') { ?>
                                    <div class="alert alert-block alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button> 
                                        <p> Alias name is not available. Try another. </p>
                                    </div> <?php
                                }} ?>
                                <?php if (validation_errors()!="") { ?>
                                     <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p> <?php echo validation_errors(); ?> </p>
                                    </div>
                                <?php } ?>
                                
                                
                                
                                <?php
							  //form data
							  $attributes = array('class' => 'form-horizontal', 'id' => '');
							  //form validation
							  echo form_open_multipart('admin/translators/edit/'.$results[0]['id'], $attributes);
							  ?>
                            
                                
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

										<div class="col-sm-9">
											<input name="email" type="text" id="form-field-1" class="col-xs-10 col-sm-5 validate[required]" value=" <?php echo $results[0]['email_address'] ?>" readonly />
										</div>
									</div>
                                    
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name </label>

										<div class="col-sm-9">
											<input name="first_name" type="text" id="form-field-1" class="col-xs-10 col-sm-5 validate[required]" value=" <?php echo $results[0]['first_name'] ?>" readonly="readonly" />
										</div>
									</div>
                                    
                                    
                                    
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name</label>

										<div class="col-sm-9">
											<input name="last_name" type="text" id="form-field-1" class="col-xs-10 col-sm-5 validate[required]" value=" <?php echo $results[0]['last_name'] ?>" readonly="readonly" />
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Location </label>
										<div class="col-sm-9">
											<input name="location" type="text" id="form-field-1" class="col-xs-10 col-sm-5 validate[required]" value=" <?php echo $results[0]['location'] ?>" readonly="readonly" />
										</div>
									</div>
                                    
                                <?php 
						
                    
                        $view=explode("##",$results[0]['file']);
                        array_pop($view);
                        $num_of_file= count($view);
						//echo  $num_of_file;
						
                        ?>
                        
                       
                        <?php  if($results[0]['file']!= "") { 
                        for ($i = 0; $i < $num_of_file; $i++){
                        if($view[$i]!= "") {
						 $vie = strstr($view[$i], '/');
                		$str = ltrim($vie, '/');
						if($str == ''){
						$str = $view[$i];
						}
                       // echo $str;
                        ?> 
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Uploaded File :                                        </label>

										<div class="col-sm-9">
                            <a href="<?php echo base_url(); ?>uploads/user/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
                             
										</div>
									</div>
         <!--   <input type="hidden" name="prefile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $results[0]['file']; ?>" />
			<input type="hidden" name="numberfile" id="numberfile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $num_of_file; ?> " />-->                                   
                                    <?php }}} ?>
                    
                    
              
                     <!-- <label class="col-sm-3 control-label no-padding-right" for="form-field-1">You should be able to upload up to 5 files                      </label>
                 <!--  <input type="file" name="userfile[]" id="userfile" data-buttonName="btn-primary" multiple="multiple" >-->
                   					<!--<div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                    <div id="mulitplefileuploader">Upload</div>
									<div id="status"></div>
                                    <input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                                    </div>
							    </div>-->
                    
                    
                               
                                    
                                    <div class="form-group">
                                   	 <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Language</label>
                                        <div class="col-sm-9">
												 <?php 
						$sql=" SELECT * FROM `languages`  ";
						$val=$this->db->query($sql);
						$lang=$val->result_array();
						//$sub[]=array;
						for($k = 0; $k < count($lang); $k++){
						$element = $lang[$k];
						$myArr[$element[id]] = $element[name];
						}
						//echo "<pre>";print_r($myArr);
						
						$newArray = array();
						foreach($myArr as $key1 => $value1){
							foreach($myArr as $key2 => $value2){
								if($value1 != $value2){
									$newkey = $key1.'/'.$key2;
									$newvalue = $value1.'/'.$value2;
									$newArray[$newkey] = $newvalue;
								}
							}
						}
						
						$arrlanguage = $results[0]['language'];
						$language = explode(",", $arrlanguage);
						//echo '<pre>'; print_r($language);die;
                        ?>
						<select  name="language[]" id="language"    multiple="multiple" class="col-xs-10 col-sm-5 validate[required]">
							<option value="">Select language</option>
								<?php 
							
							foreach ($newArray as $key=>$lang1) {
								$inIds = "'".str_replace("/", "','", $lang1)."'";
											$sql_lan="SELECT name FROM `languages` WHERE `name` IN(".$inIds.")";
											$val_lan=$this->db->query($sql_lan);
											$lang=$val_lan->result_array();
											 $lang2=$lang[0]['name'].' to '.$lang[1]['name']; ?>
							<option value="<?php echo $key; ?>" <?php if(in_array($key, $language)) { echo 'selected="selected"'; }?>><?php echo $lang2; ?></option>
							<?php }  ?>
						</select>
                                        </div>
                                    </div>	
                                    
                                     
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Created </label>

										<div class="col-sm-9">
											<input name="first_name" type="text" id="form-field-1" class="col-xs-10 col-sm-5 validate[required]" value="  <?php echo date("jS F ,Y", strtotime($results[0]['created']));?>" readonly="readonly" />
										</div>
									</div>
                                    
                                    
                                    
                                    
                                 <!--   <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>-->
                                    
                                <?php echo form_close(); ?>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

<!-- page specific plugin ck editor scripts -->
<!--<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>-->

<?php
$this->load->view('admin/includes/vwFooter');
?>