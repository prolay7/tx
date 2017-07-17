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
							<li class="active"> List</li>
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
					 <?php if ($this->session->flashdata('message_success')!="") { ?>
			 <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p> <?php echo $this->session->flashdata('message_success'); ?> </p>
            </div>
		<?php } ?>


						<div class="row">
							<div class="col-xs-12">						
                                
								    <div>                                    
                                    <div class="pull-right tableTools-container"></div>
                                    </div>
                                    <div class="table-header">
                                        Results for "Translator Invitation List"
                                    </div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="center">Name</th>
                                                 <th class="center">Email Address</th>
                                                <th>Operations</th>
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
                                            <td><?php echo $row['first_name'].'&nbsp;'.$row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                          <?php $name=$row['first_name'].'&nbsp;'.$row['last_name']; ?>
                                            <td>
                                                <?php
                                                $admin_id = $this->session->userdata('admin_id');
                                                $adminsql = "select `admin_type` from `admin` where `id`='$admin_id' ";
                                                $adminquery = $this->db->query($adminsql);
                                                $adminfetch = $adminquery->row();
                                                $admin_type = $adminfetch->admin_type;
                                                print_r($admin_type);exit();
                                               if($admin_type != 4){
                                                ?>
                    <a class="green" href="<?php echo base_url(); ?>admin/translator/edit/<?php echo $row['id']; ?>">
                    <i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;
                    <a class="orange" href="#"  onclick="alert(<?php echo  $row['id']; ?>)">
                   <i class="ace-icon fa fa-trash bigger-130"></i>  </a>&nbsp;
                                                <?php } ?>
                 <a class="btn btn-info" href="<?php echo base_url(); ?>admin/translator/mail/<?php echo $row['id']; ?>">
                                        <i class="fa fa-paper-plane"></i>&nbsp;Resend Invitation
                                        </a>                                             
                                             </td>                                        
                                         </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                 
                                    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>                                  
                                </div>
                                <button class="btn btn-info btn-sm" onclick="goBack()">Go Back</button>
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
<script>
function goBack() {
    window.history.back();
}
</script>

<?php
$this->load->view('admin/includes/vwFooter');
?>
