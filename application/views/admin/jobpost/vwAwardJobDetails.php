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
								<a href="#">View</a>
							</li>
							<li class="active">View Awarded Job</li>
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
                        <?php
							$this->load->view('admin/includes/vwSidebar-settings');
						?>
						<!-- /.ace-settings-container -->
						
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
							Awarded Job Details				
							</h1>
						</div><!-- /.page-header -->
                    
                        
            <div class="row">
            
            
            <div class="col-xs-12">
            <div class="col-xs-6">
            <?php //print_r($fetch);die;
				$translator_id=$fetch->trans_id;
				$sql = "SELECT * FROM translator WHERE id = '" . $fetch->trans_id . "'";
				$val = $this->db->query($sql);
				$fetch1=$val->row();
				$name=$fetch1->first_name ."  ". $fetch1->last_name ;
				
				//echo $fetch1->first_name;die;
				
				$sql1 = "SELECT * FROM jobpost WHERE id = '" . $fetch->job_id . "'";
				$val1 = $this->db->query($sql1);
				$fetch2=$val1->row();
				$fetch2->name;
				//echo $fetch2->name;die;
				/*$sql="select * from `translator` where `id`='$translator_id'";
				//echo $sql;die;
				$query=mysql_query($sql);
				$fetch=mysql_fetch_array($query);
				$trans_name=$fetch['first_name'].'&nbsp;'.$fetch['last_name'];
				//echo $trans_name; 
				$job_id=$fetch->job_id;
				//echo $fetch->job_id; die;
				$jobsql="select * from `jobpost` where `id`='$job_id'";
				//echo $jobsql; die; 
				$jobquery=mysql_query($jobsql);
				$jobfetch=mysql_fetch_array($jobquery);
				$job_title=$jobfetch['name'];
				//$job_alias=$jobfetch['alias'];*/
			
			 ?>
            
         <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Translator Name: </label>
                <div class="col-sm-8">
                <?php 
					echo $name;
				 ?>
                </div>
            </div> 
            <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Job Name: </label>
                <div class="col-sm-8">
                <?php 
					echo $fetch2->name;	
				?>
                </div>
            </div> 
            
            <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Award Date: </label>
                <div class="col-sm-8">
                <?php 
					echo date("jS F, Y", strtotime($fetch->award_date));	
				//echo $fetch->proposal; ?>
                </div>
            </div>                        
            <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Proposal: </label>
                <div class="col-sm-8">
                <?php echo $fetch->proposal; ?>
                </div>
            </div>
            
             <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Stage: </label>
                <div class="col-sm-8">
               <?php if($fetch->stage==2){?>
                <a href="#" class="btn btn-success">Completed</a>
                <?php } else {?>
                <a href="#" class="btn btn-danger">Working</a>
                <?php } ?>
                </div>
            </div>
            <?php if($fetch->stage==2){?>
            <div class="form-group" style="padding-top:10px; overflow: hidden;">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Complete Date: </label>
                <div class="col-sm-8">
                <?php 
					echo date("jS F, Y", strtotime($fetch->complete_date));	
				//echo $fetch->proposal; ?>
                </div>
            </div>
            <?php } ?>
            
        
            </div>

								<!-- PAGE CONTENT ENDS -->
							</div>
                            
                            
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
<script type="text/javascript">
function doconfirm()
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
}
</script>


<?php
$this->load->view('admin/includes/vwFooter');
?>
