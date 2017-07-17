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
								<a href="#">Invoice</a>
							</li>
							<li class="active">Send Invoice</li>
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
								Invoice
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Send Invoice
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                             
                            
                            <?php 								
			$attributes = array('class' => 'form-horizontal', 'id'=>'admin-edit', 'enctype' => 'multipart/form-data'); 
			echo form_open('admin_jobpost/send_invoice',$attributes); 
			
			$id=$id;	
			$job_id=$job_id;
			$trans_id=$trans_id;
			$bidsql="select * from `bidjob` where `id`='$id'";
			$bidval=$this->db->query($bidsql); 
			$bidfetch=$bidval->row();
			$bid_price=$bidfetch->price;
			$awarded_date=$bidfetch->award_date;
			$comp_time=$bidfetch->time_need;
			$invoice_id=time();	
			$jobsql="select * from `jobpost` where `id`='$job_id'";
			$jobval=$this->db->query($jobsql); 
			$jobfetch=$jobval->row();
			$job_name=$jobfetch->name;										
									?>
             <input name="bid_id" id="bid_id"  type="hidden" value="<?php echo $id; ?>">
             <input name="job_id" id="job_id"  type="hidden" value="<?php echo $job_id; ?>">
             <input name="trans_id" id="trans_id"  type="hidden" value="<?php echo $trans_id; ?>">
             <input name="comp_time" id="comp_time"  type="hidden" value="<?php echo $comp_time; ?>">
              
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Job Title</label>
                <div class="col-sm-9">
 <input name="job_title" id="job_title" class="col-xs-10 col-sm-5 validate[required]"  type="text" value="<?php echo $job_name; ?>" readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Price</label>
                <div class="col-sm-9">
 <input name="job_price" id="job_price" class="col-xs-10 col-sm-5 validate[required]"  type="text" value="$<?php echo $bid_price; ?>" readonly>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Awarded Date</label>
                <div class="col-sm-9">
                    <input name="award_date" id="award_date" class="col-xs-10 col-sm-5 validate[required]"  type="text" value="<?php echo date('Y-m-d',strtotime($awarded_date)); ?>" readonly>
                </div>
            </div>
            
           
      
                                    
               <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Invoice No</label>
                <div class="col-sm-9">
      <input name="invoice_id" id="invoice_id" class="col-xs-10 col-sm-5 validate[required]"  type="text" 
      value="<?php echo $invoice_id; ?>" readonly>
                </div>
            </div>
            
                <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>
                <div class="col-sm-9">
                    <textarea name="invoice_desc" id="editor" class="col-xs-10 col-sm-5 validate[required]">
                    </textarea>
                    
                </div>
            </div>                          
                 
          
         
                 
           
             <div class="clearfix form-actions">
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
									</div>
                
               

            <?php echo form_close(); ?> 
                      
                              
                              
                    
                    <!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

<!-- page specific plugin ck editor scripts -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>


<script>
    initSample();
</script>

 
<?php
$this->load->view('admin/includes/vwFooter');
?>
    