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
								<a href="#">Translator</a>
							</li>
							<li class="active">Email List</li>
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
								Translator
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View List
								</small>
							</h1>
						</div><!-- /.page-header -->

                        <?php if ($this->session->flashdata('msg')!="") { ?>
                         <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p> <?php echo $this->session->flashdata('msg'); ?> </p>
                        </div>
                    <?php } ?>
                           <?php if ($this->session->flashdata('wmsg')!="") { ?>
			 <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo $this->session->flashdata('wmsg'); ?> </p>
            </div>
		<?php } ?>



						<div class="row">
							<div class="col-xs-12">						
                                
								    <div> 
                                    <?php 
									$id=$this->uri->segment(3);	
									$sql1 = "SELECT * FROM jobpost WHERE id = '$id'";
									$val1 = $this->db->query($sql1);
									$fetch1= $val1->row(); 
									?>
                                    
                                    <div class="row">
                                    	<div class="col-xs-2">	
                                        <h4>Job Name:</h4>
                                    
                                        </div>
                                        <div class="col-xs-8">	
                                           <h5> <?php echo $fetch1->name; ?></h5>
                                        
                                        </div>
                                    </div>
                                      <div class="row">
                                    	<div class="col-xs-2">	
                                        <h4>Job Details:</h4>
                                      
                                        </div>
                                        <div class="col-xs-8">	
                                         <h5> <?php echo $fetch1->description; ?></h5>
                                        
                                        </div>
                                    </div>                                  
                                    <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Translator Invitation List"
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Invitation Description</th>
                                                 <th class="center">Invited Email Addresses</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
										foreach ($translator as $array) {
									foreach ($array as $key => $value) {
										$options_translator[$key] = $key;
									  }
									  break;
									}
										 ?>
                                        <?php
										$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');	
									//	echo'<pre>'; print_r($translator);	die;								
  										foreach ($translator as $key => $row) {
									
										?>            
                                          <tr>
                                            <td><?php echo $row['description']; ?></td>
                                        <?php
										if($row['invite_id']!=""){
											$sql = "SELECT * FROM invite WHERE id in( " . $row['invite_id'] . " )";
											//echo $sql; die;
											$val = $this->db->query($sql);
											$rows = $val->result_array();
											$k = 0;
											$date_array = '';
											foreach ($rows as $row) {
											if($k == 0) {
											$date_array.=$row['email'];
											} else {
											$date_array.=' , '.$row['email'];
											}					
											$k++;
											}
										}
										//echo $date_array;die;
										
										
										//echo'<pre>';print_r($row_email);die;
										 ?>    
                                            <td><?php echo $date_array; ?></td>
                                                               
                                         </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                 
                                    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>                                  
                                </div>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

<script type="text/javascript">
function alert(id)
{
    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>admin_translator/delete/"+id;
	}
}
</script>


<?php
$this->load->view('admin/includes/vwFooter');
?>
