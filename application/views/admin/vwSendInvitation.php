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
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
                        <!-- /.ace-settings-container -->

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Translator Invitation
								<!--<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Invitation
								</small>-->
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                         <?php if (validation_errors()!="") { ?>
                         <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo validation_errors(); ?> </p>
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
                     <?php if (isset($message_error) && $message_error!="") { ?>
                         <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo $message_error; ?> </p>
                        </div>
                    <?php } ?>
                    
                    
							<div class="col-xs-12">
                            
                            <?php
                            	//print_r($results);
								//die();
							?>
        <?php 
		$id=$this->uri->segment(3);
		$attributes = array('class' => 'form-registration', 'id'=>'user-registration', 'enctype' => 'multipart/form-data'); 
		echo form_open_multipart('admin_invite/send/'.$id.'' , $attributes); 
		?>
            <div class="col-xs-12">
            <div class="form-group" style="padding-top:30px; overflow: hidden;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Name : </label>
                <div class="col-sm-9">
                 <?php 
						$id=$this->uri->segment(3);
                        $sql1=" SELECT * FROM `jobpost` WHERE id='$id'";
						//echo  $sql1; die;
                        $val1=$this->db->query($sql1);
                        $job=$val1->result();
						foreach ($job as $job1) { 
						//echo '<pre>'; print_r($language);die;
                        ?>
                    
                    <input name="job_id" id="job_id" class="form-control col-xs-5 col-sm-5" value="<?php echo $job1->id; ?>" type="hidden" readonly>    
                    <input name="job_name" id="job_name" class="form-control col-xs-5 col-sm-5" value="<?php echo $job1->name; ?>" type="text" readonly>
                    <input name="job_alias" id="job_alias" class="form-control col-xs-5 col-sm-5" value="<?php echo $job1->alias; ?>" type="hidden" readonly>
                    
                    
                    <?php } ?>
                </div>
            </div>
           <?php /*?> <div class="form-group" style="overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Title : </label>
                <div class="col-sm-8">
                    <input name="title" id="title" class="form-control col-xs-10 col-sm-5" value="<?php echo $results[0]['title']; ?>" type="text">
                </div>
            </div>
              <div class="form-group" style=" overflow:hidden">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Alias <span class="rq-fld"></span> </label>
                <div class="col-sm-8">
                    <input name="alias" id="alias"  type="text" class="form-control col-xs-10 col-sm-5 " value="<?php echo $results[0]['alias']; ?>" />
                </div>
            </div><?php */?>
             
            <div class="form-group" style="overflow:hidden;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Email: </label>
                <div class="col-sm-9">
                  
                    <?php 
					
                        $sql=" SELECT * FROM `invite` ";
                        $val=$this->db->query($sql);
                        $lang=$val->result();
						
						//echo '<pre>'; print_r($language);die;
                        ?>
						<select name="email[]" id="email" class="form-control col-xs-5 col-sm-5 validate[required]" multiple="multiple">
							<option value="">Select email</option>
							<?php 
							
							foreach ($lang as $lang1) { ?>
							<option value="<?php echo $lang1->id; ?>"><?php echo $lang1->email; ?></option>
							 <?php }  ?>
						</select>
                       
                </div>
            </div>
              <div class="form-group" style=" overflow:hidden">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1 "> Description  </label>
                <div class="col-sm-9">
                    <textarea class=" validate[required]" id="editor" name="description" id="form-validation-field-0"  ></textarea>
                </div>
            </div>
            
            </div>
             
             
      
            
            <div class="col-md-offset-3 col-md-10" style="padding-top:30px;">
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

            <?php echo form_close(); ?>
            
        

								<!-- PAGE CONTENT ENDS -->
							<!-- /.col -->
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
        
        <!-- inline scripts related to this page -->
		
   <!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script> 
   <script type="text/javascript">
      CKEDITOR.replace( 'editor1' );
      CKEDITOR.add            
   </script>

   <script type="text/javascript">
      CKEDITOR.replace( 'editor2' );
      CKEDITOR.add            
   </script> 
   <script type="text/javascript">
      CKEDITOR.replace( 'editor3' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor4' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor5' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor6' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor7' );
      CKEDITOR.add            
   </script>
   <script type="text/javascript">
      CKEDITOR.replace( 'editor8' );
      CKEDITOR.add            
   </script>
      
<?php
$this->load->view('admin/includes/vwFooter');
?>
