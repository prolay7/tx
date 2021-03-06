<?php
$this->load->view('vwHeader');
?>
 <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<!--<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-1.8.0.min.js"></script>-->
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>



<?php if($this->session->flashdata('success_message'))
        { ?>
<script>
jQuery(document).ready(function(){
	alert("<?php echo $this->session->flashdata('success_message'); ?>");
});
</script>
<?php } ?>
<style>
.invisible
{
display:block	!important
}
.write
{
padding-left: 289px;
padding-top: 20px;
color: #5bbc2e;
}
</style>


		<?php
	
		if($results[0]['job_type']==1){

					?>
				<div id="content">



				  <div id="title">
					<h1 class="inner title-2">Job Details
						  <ul class="breadcrumb-inner">
						<li> <a href="<?php echo base_url()?>">Home</a></li>
					 <?php    $alias = $this->uri->segment(2); ?>
						<li> <a href="<?php echo base_url()?>job/<?php echo $alias;?>">Job Details</a></li>
					  </ul>
					</h1>
				  </div>
				  <div class="inner">


						<?php if($this->session->flashdata('success_message'))
						{ ?>
							<div class="alert alert-block alert-success">
							<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
							</button>
							<p><?php echo $this->session->flashdata('success_message'); ?></p>
							</div>
						<?php
						}
						?>
						<?php if($this->session->flashdata('error_message'))
						{ ?>
						<div class="alert alert-block alert-danger">
							<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
							</button>
							<p><?php echo $this->session->flashdata('error_message'); ?></p>
							</div>
						<?php
						}
						?>
					<!-- Content Inner -->
					<div class="content-inner ">

					 <div id="content">


						<div class="heading-l">
						  <h2> Job Description </h2>
						</div>
                         <?php
						$string=rtrim($results[0]['file'], " ");
						$view=explode("##",$string);
						array_pop($view);
						// print_r('xxx'.$view); exit;
						$num_of_file= count($view);
						?>
						<div class=" border box-1">
						  <div id="job-content-field">
							<div class="field-container single no_border">
							  <div class="header-fields">

								<div class="title-company">
								  <div class="title"><strong>Job Name:</strong><a href="#"> <?php echo $results[0]['name']?></a></div>
								</div>
							  </div>
							  <div class="body-field">
							  	<div class="teaser">

                                	<!--<div class="title"><strong>Due Date:</strong><a href="#"> <?php echo date('jS F Y', strtotime($results[0]['dueDate'])); ?></a></div>-->
                                	<div class="title"><strong>Due Date:</strong><a href="#"> <?php echo $results[0]['dueDate']; ?></a></div>
                                </div>
								<div class="teaser">
								  <p><strong>Description:</strong><?php echo $results[0]['description']?></p>
								</div>

							  </div>
							  <div class="block-fields">
							 <div class="block ">
								  <div class="block-content">

								   <?php $language_id=$results[0]['language'];
								//echo $language_id;
								$pieces = explode("/", $language_id);
								$languagef_id=$pieces[0];
								$sql5="select `name` from `languages` where `id`='$languagef_id'";
								$query5=$this->db->query($sql5);
								$fetch5=$query5->row();
								$languagef_name=$fetch5->name;

								$language_id=$pieces[1];
								$sql6="select `name` from `languages` where `id`='$language_id'  ";
								//echo $sql;die;
								$query6=$this->db->query($sql6);
								$fetch6=$query6->row();
								$language_name=$fetch6->name;						 ?>
									<div class = "tag-field">From  <?php echo  $languagef_name;?></div>

									<div class = "tag-field">To <?php echo  $language_name;?></div>
									<div class = "tag-field">Job Posted: <?php echo date("jS F, Y", strtotime($results[0]['created']));?></div>
								 <div style="clear:both"></div>
									<div><strong>Files  :
									</strong></div>
									<?php
                                    if ($results[0]['proofread_job_id']) {
								
                                        $sql = "SELECT p.* FROM proofread_jobs_docs p  JOIN translator t ON t.id = p.translator_id  WHERE p.proofread_job_id = ".$results[0]['proofread_job_id']."  AND  p.is_active = 1 ORDER BY p.doc_order ASC;";
                                        $query = $this->db->query($sql);
                                       
                                        if ($query->num_rows()) {
                                    ?>

                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width: 70%">
                                        <thead>
                                            <tr>
                                                <th class="center" style="width: 5%; text-align: center;">#</th>
                                                <th class="center" style="width: 30%">Original File</th>
                                                <th class="center" style="width: 30%">Translated File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
									$k=1;
                                        foreach ($query->result_array() as $i => $result) {
                                            $original = explode('/', $result['original_file']);
                                            $translated = explode('/', $result['translated_file']);
                                            if(file_exists('./uploads/review/'.$result['original_file'])== true && file_exists('./uploads/review/'.$result['translated_file']) ==true) {
                                                ?>
                                                <tr>
                                                    <!--<td style="text-align: center; vertical-align: middle;"><?php// echo $result['doc_order'] ?></td>-->
													<td style="text-align: center; vertical-align: middle;"><?php echo $k; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() ?>front/job/document/viewer/<?php echo $result['id'] ?>/original_file"
                                                           class="btn btn-app btn-purple btn-lg"
                                                           target="_blank"><?php echo $original[1]; ?></a></td>
                                                    <td>
                                                        <a href="<?php echo base_url() ?>front/job/document/viewer/<?php echo $result['id'] ?>/translated_file"
                                                           class="btn btn-app btn-purple btn-lg"
                                                           target="_blank"><?php echo $translated[1]; ?></a></td>
                                                </tr>
                                                <?php
                                           $k++; }
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        }
                                    } else {  ?>
									
								  <?php
									 for ($i = 0; $i < $num_of_file; $i++){
										 if($view[$i]!="" && file_exists("./uploads/jobpost/".$view[$i])) {
										     $filepath = str_replace("/","&slash&",$view[$i]);
                                             
										 $vie = strstr($view[$i], '/');
											 $str = ltrim($vie, '/');
											 if($str == ''){
												 $str = $view[$i];
												 }
									?>
									
									
									<div class = "tag-field" style="clear:both;">
                                        <a href="<?php echo base_url() ?>front/document/viewer1/<?php echo $filepath; ?>" class="tag-field" style="margin:0px;" target="_blank"><?php echo $str; ?></a>
                                    </div>
									<?php }} ?>
									
									<?php } ?>
								  </div>
								  <!-- Cleaner -->
								  <div class="clear"></div>


								  <!-- /Cleaner -->
								</div>
							  <div class="block ">
								<div class="block-content invisible">
									<?php
									 for ($i = 0; $i < $num_of_file; $i++){
										 if($view[$i]!="" && file_exists("./uploads/jobpost/".$view[$i])) {

								?>
									<!-- <div class = "tag-field"><a href="<?php echo base_url() ?>front/job/document/viewer/<?php echo $fetch1->id ?>" class="tag-field" target="_blank">Download</a></div> -->
                                    <div class = "tag-field"><a href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $view[$i]; ?>" class="tag-field" target="_blank">Download</a></div>
									<?php } }echo "<br />"; ?>

								   </div>
								   </div>
							  </div>
							  <div class="block-fields">



							  <div class="block ">
								<div class="block-content">


								   </div>
								   </div>

							  </div>
							  <!--<input type="reset" class="btn gray next-btn" value="Login to Proposal">-->

							</div>
						  </div>
						</div>

						<div class="clear"></div>

						<div class="heading-l">
						  <h2>Send a proposal </h2>

						</div>
                        <?php $jobid=$results[0]['id'];

			$id=$this->session->userdata('translator_id');

			$sql="SELECT *  FROM  `send_invitation`  WHERE `job_id`=$jobid  AND `invite_id` LIKE '%".$id."%'";
			//echo $sql;die;


			//echo $sql;die;
			$query=$this->db->query($sql);
			$val=$query->num_rows();
			if($val>0){ ?>
						 <?php if(!$this->session->userdata('is_translator')){
								$job_alias=$this->uri->segment(2);
								?>
								<a href="<?php echo base_url()?>translator/login" class="btn gray next-btn">Login To Bid </a>

						 <?php } else{
							 $sql1 = "SELECT * from bidjob WHERE trans_id = '" . $this->session->userdata('translator_id') . "' AND job_id = '".$results[0]['id']."'";
							$val1 = $this->db->query($sql1);
							if($val1->num_rows()=='1'){
							$fetch1= $val1->row();
								?>
						<div class=" block field-container odd  hide">
							<div class="block background">
							   <div class = "block-content">
							   <h2 class="title-1">Edit Your Bid</h2>
							   <div class = "block-content">
								<?php
								$attributes = array('class' => 'form-changeprofilepicture', 'id'=>'user-changeprofilepicture');
								echo form_open_multipart('translator/bidjobedit', $attributes);
								?>
								<div class="about">
								<input type="hidden" name="job_id" value="<?php echo $fetch1->job_id ?>"/>
								 <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Expected Turnaround Time *(In days)                   </label>
									<input id="time_need" name="time_need_day" type="text" class="form-control validate[required] text-input" placeholder="Time You Need" value="<?php echo ($fetch1->time_need)/1440 ;?>"  >
									 <input id="time_need" name="time_need" type="hidden" class="form-control validate[required] text-input" placeholder="Time You Need" value="<?php echo $fetch1->time_need ;?>"  >

									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Your Quote for this translation job * ( In US dollars)                   </label>
									<input id="price" name="price" type="text" class="form-control validate[required,custom[number]] text-input" placeholder="Price" value="<?php echo $fetch1->price ;?>" >


										<?php
										$view=explode("##",$fetch1->file);
										array_pop($view);
										$num_of_file= count($view);
										if($fetch1->file!= "") {
										for ($i = 0; $i < $num_of_file; $i++){
										if($view[$i]!= "") {
										 $vie = strstr($view[$i], '/');
										$str = ltrim($vie, '/');
										if($str == ''){
										$str = $view[$i];
										}

										?>
									<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Uploaded File :                                        </label>

														<div class="col-sm-9">
											<a href="<?php echo base_url(); ?>uploads/bidjobpost/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
											 <a href="javascript:void(0);" class="btn btn-danger" onclick="removealert('<?php echo $fetch1->id; ?>','<?php echo $view[$i]; ?>')">Remove File</a>
														</div>
													</div>
									<input type="hidden" name="prefile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $fetch1->file; ?>" />
									<input type="hidden" name="numberfile" id="numberfile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $num_of_file; ?> " />
									<?php }}} ?>


                                        <div style="clear:both; height:7px; display:block;"></div>
                                        <div class="col-sm-4">
                                        <label class="control-label no-padding-right" for="form-field-1">You should be able to upload up to 5 files </label>
                                        </div>
                                        <div class="col-sm-8 ">
                                        <div id="mulitplefileuploader">Upload</div>
                                        <div id="status"></div>
                                        <input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                                        </div>
                                        <div style="clear:both; height:7px; display:block;"></div>
                                        <div class="col-sm-12">
                                        <label class="control-label no-padding-right" for="form-field-1">Message about your Proposal*</label>
                                        </div>
                                        <div style="clear:both; height:7px; display:block;"></div>
                                        <textarea id="editor" name="proposal" class="form-control validate[required] text-input" placeholder="Your Proposal" rows="5" ><?php echo $fetch1->proposal ;?></textarea>

								</div>
							   <?php if($fetch1->awarded!=1) {?>
								<div id = "send">
								<input id="send_btn" type="submit" value="Submit"></a>
							  </div>
							  <?php }?>
								<div id = "send" class="invisible">
								<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Send
						   </button>&nbsp; &nbsp;
								<button class="btn btn-info" type="reset" >
										<i class="ace-icon fa fa-undo bigger-110"></i>
										Reset
									</button>
							  	</div>

								</form>

						   </div>
							</div>
							</div>

						</div>
							<?php
							}else{

							?>
					   <div class="block field-container odd  hide">
							   <div class="block background">
							   <div class = "block-content">
							   <h2 class="title-1">Post Your Bid</h2>
							   <div class = "block-content">
							<?php
								$attributes = array('class' => 'form-changeprofilepicture', 'id'=>'user-changeprofilepicture');
								echo form_open_multipart('translator/bidjob', $attributes);
								?>
								<div id = "about">
								 <input type="hidden" name="id" value="<?php echo $results[0]['id']?>"/>


								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Expected Turnaround Time *(In Days)                     </label>
									<input id="time_need_day" name="time_need_day" type="text" class="form-control validate[required] text-input" placeholder="Time You Need"  >


									<input id="time_need" name="time_need" type="hidden" class="form-control validate[required] text-input" placeholder="Time You Need"  >
									 <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Your Quote for this translation job * ( In US dollars)                      </label>
									<input id="price" name="price" type="text" class="form-control validate[required,custom[number]] text-input" placeholder="Price" >
                                    <div style="clear:both; height:7px; display:block;"></div>
                                        <div class="col-sm-4">
                              <label class="control-label no-padding-right" for="form-field-1">You should be able to upload up to 5 files   </label>
                              </div>
                                        <div style="clear:both; height:7px; display:block;"></div>
									    <div class="col-sm-8 ">
													<div id="mulitplefileuploader">Upload</div>
													<div id="status"></div>
													<input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
													</div>
										<div style="clear:both; height:7px; display:block;"></div>
								        <div class="col-sm-12">
                              <label class="control-label no-padding-right" for="form-field-1">Message about your Proposal*  </label>
                              </div>
								        <div style="clear:both; height:7px; display:block;"></div>
									    <textarea id="editor" name="proposal" class="form-control  text-input" placeholder="Your Proposal" rows="5"></textarea>

								</div>
								<div id = "send">
								<input id="send_btn" type="submit" value="Submit"></a>
							  </div>
							</form>
							</div>
							</div>
							</div>
						</div>

					  <div class="clear"></div>
					  <?php }}?>

                    <?php }else{  ?>
                      <div class=" block field-container odd  hide">
                        <div class="block background">
                        <div class = "block-content">

                		<div class="write">Your don't have any invitation for this job. You are unable to bid for this job.
                        </div>
                      </div>
                      </div><!--end of .table-responsive-->
                    </div>
                  <?php } ?>
					</div>


					  </div>


					  <div class="clear"></div>


					</div>


				  </div>
				<?php

		}
		else{ ?>
                <div id="content">

                  <div id="title">
                    <h1 class="inner title-2">Job Details
                          <ul class="breadcrumb-inner">
                        <li> <a href="<?php echo base_url()?>">Home</a></li>
                     <?php    $alias = $this->uri->segment(2); ?>
                        <li> <a href="<?php echo base_url()?>job/<?php echo $alias;?>">Job Details</a></li>
                      </ul>
                    </h1>
                  </div>
                  <div class="inner">

                        <?php if($this->session->flashdata('success_message'))
                        { ?>
                            <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p><?php echo $this->session->flashdata('success_message'); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <?php if($this->session->flashdata('error_message'))
                        { ?>
                        <div class="alert alert-block alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                            </button>
                            <p><?php echo $this->session->flashdata('error_message'); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    <!-- Content Inner -->
                    <div class="content-inner ">




                      <!-- Content Center -->
                     <div id="content">
                      <!-- Content Left -->

                      <!-- /Content Left -->

                      <!-- Content Center -->

                        <div class="heading-l">
                          <h2> Job Description </h2>
                        </div> <?php //print_r($results);

                        // $string=rtrim($results[0]['file'], " ");
                        // $view=explode("##",$string);
                        // array_pop($view);
                        //print_r($view);
                        // $num_of_file= count($view);

                        // echo '<pre>'; print_r($results); exit;

                        // $job_type = ($results[0]['proofreadType'] == 'editing' or $esults[0]['proofreadType'] == 'comparison') ? 'Proof Reading - ' . ucfirst($results[0]['proofreadType']) . '/' . $esults[0]['proofreadType']  : 'Translation';

                        if ($results[0]['proofread_required'] == 1 and $results[0]['proofreadType'] == 'editing') {
                            $job_type = 'Proof Reading / '.ucfirst($results[0]['proofreadType']);
                        } else if ($results[0]['proofread_required'] == 1 and $results[0]['proofreadType'] == 'comparison') {
                            $job_type = 'Proof Reading / '.ucfirst($results[0]['proofreadType']);
                        } else {
                            $job_type = 'Translation';
                        }

                        ?>
                        <div class=" border box-1">
                          <div id="job-content-field">
                            <div class="field-container single no_border">
                              <div class="header-fields">

                                <div class="title-company">
                                  <div class="title"><strong>Job Name:</strong><a href="#"> <?php echo $results[0]['name']?></a></div>

                                </div>
                              </div>
                              <div class="body-field">
                                  <div class="teaser">
                                  	<div class="title"><strong>Job Type:</strong><br/><a href="#"> <?php echo $job_type; ?></a></div>
                                    <div style="font-size: 12px; margin-top: 7px;">
                                        <?php if ($results[0]['proofread_required'] == 1 and $results[0]['proofreadType'] == 'editing') {?>
                                        <p><span style="font-style: italic; font-weight: bold;">Proof Reading / Editing</span>: means that English Speaking linguists can bid and review the final translation for grammar and accuracy in English.</p>
                                        <?php } ?>
                                        <?php if ($results[0]['proofread_required'] == 1 and $results[0]['proofreadType'] == 'comparison') { ?>
                                        <p><span style="font-style: italic; font-weight: bold;">Proof Reading / Comparison</span>: means you can only bid if you have the same language pair listed on the job. Because you are required to compare the original doc and translation for accuracy.</p>
                                        <?php } ?>
                                    </div>
                                  </div>

                              	<div class="teaser">
                                    <?php
                                    if ($results[0]['dueDate']) {
                                        $due = $results[0]['dueDate'];
                                        $due_arr = explode(' ', $due);
                                        $date = str_replace('-', '/', $due_arr[0]).' '.$due_arr[1].' '.$due_arr[2];
                                        $due_date = date('jS F Y h:i A', strtotime($date)).' EST';
                                      // $due_date = date('jS F Y h:i A', strtotime($due)).' EST';
                                    } else {
                                        $due_date = 'No due date set';
                                    }
                                    ?>
                                	<div class="title"><strong>Due Date : </strong><a href="#"> <?php echo $due_date; ?></a></div>
                                </div>
                                <div class="teaser">
                                  <p><strong>Description:</strong><?php echo $results[0]['description']?></p>
                                </div>

                              </div>
                                <?php
                                if ($results[0]['proofread_required'] == 1 and $results[0]['proofreadType'] == 'editing'){
                                    $language_id=$results[0]['language'];
                                    //echo $language_id;
                                    $pieces = explode("/", $language_id);
                                    $languagef_id=$pieces[0];
                                    $sql5="select `name` from `languages` where `id`='$languagef_id'";
                                    $query5=$this->db->query($sql5);
                                    $fetch5=$query5->row();
                                    $languagef_name=$fetch5->name;

                                    $language_id=$pieces[1];
                                    $sql6="select `name` from `languages` where `id`='$language_id'  ";
                                    //echo $sql;die;
                                    $query6=$this->db->query($sql6);
                                    $fetch6=$query6->row();
                                    $lang_to=$fetch6->name;
                                    ?>
                                    <div class="body-field">
                                        <p style="font-size: 14px;color: #f00;line-height: 19px;">We need you to proofread a translated file that is now in <?php echo $lang_to; ?>, since you are fluent in <?php echo $lang_to; ?>, your job would be to make sure that the file has proper grammar and flows smoothly in <?php echo $lang_to; ?>. This does not require that you knwo the original source language . However if you identify anything that is concerning please let us know so we can address it with the translator that completed that file.
                                        </p>
                                    </div>





                                        <?php }else{?>
                                    <div class="block ">
                                        <div class="block-content">

                                            <?php $language_id=$results[0]['language'];
                                            //echo $language_id;
                                            $pieces = explode("/", $language_id);
                                            $languagef_id=$pieces[0];
                                            $sql5="select `name` from `languages` where `id`='$languagef_id'";
                                            $query5=$this->db->query($sql5);
                                            $fetch5=$query5->row();
                                            $languagef_name=$fetch5->name;

                                            $language_id=$pieces[1];
                                            $sql6="select `name` from `languages` where `id`='$language_id'  ";
                                            //echo $sql;die;
                                            $query6=$this->db->query($sql6);
                                            $fetch6=$query6->row();
                                            $language_name=$fetch6->name;						 ?>
                                            <div class = "tag-field">From  <?php echo  $languagef_name;?></div>
                                            <div class = "tag-field">To <?php echo  $language_name;?></div>
                                            <div class = "tag-field">Job Posted: <?php echo date("jS F, Y", strtotime($results[0]['created']));?></div>
                                            <div style="clear:both"></div>
                                            <div><strong>Files:</strong>
                                                <div>
                                                    <a href="<?php echo $results[0]['file_link']; ?>" target="_blank"><?php echo $results[0]['file_link']; ?></a>
                                                </div>
                                            </div>

                                            <?php
                                            if ($results[0]['proofread_job_id']) {

                                                $sql = "SELECT p.* FROM proofread_jobs_docs p  JOIN translator t ON t.id = p.translator_id  WHERE p.proofread_job_id = ".$results[0]['proofread_job_id']."  AND  p.is_active = 1 ORDER BY p.doc_order ASC;";
                                                $query = $this->db->query($sql);
                                                if ($query->num_rows()) {
                                                    ?>

                                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width: 70%">
                                                        <thead>
                                                        <tr>
                                                            <th class="center" style="width: 5%; text-align: center;">#</th>
                                                            <th class="center" style="width: 30%">Original File</th>
                                                            <th class="center" style="width: 30%">Translated File</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $k=1;
                                                        foreach ($query->result_array() as $i => $result) {
                                                            $original = explode('/', $result['original_file']);
                                                            $translated = explode('/', $result['translated_file']);
                                                            if(file_exists('./uploads/review/'.$result['original_file'])== true && file_exists('./uploads/review/'.$result['translated_file']) ==true) {
                                                                ?>
                                                                <tr>
                                                                    <!--<td style="text-align: center; vertical-align: middle;"><?php// echo $result['doc_order'] ?></td>-->
                                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $k; ?></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url() ?>front/job/document/viewer/<?php echo $result['id'] ?>/original_file"
                                                                           class="btn btn-app btn-purple btn-lg"
                                                                           target="_blank"><?php echo $original[1]; ?></a></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url() ?>front/job/document/viewer/<?php echo $result['id'] ?>/translated_file"
                                                                           class="btn btn-app btn-purple btn-lg"
                                                                           target="_blank"><?php echo $translated[1]; ?></a></td>
                                                                </tr>
                                                                <?php
                                                                $k++; }
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <?php
                                                if ($results[0]['file']) {
                                                    $files = explode('##', $results[0]['file']);

                                                    foreach ($files as $file){
                                                        if($file != "" && file_exists("./uploads/jobpost/".$file)) {
                                                            $filepath = str_replace("/","&slash&",$file);
                                                            $vie = strstr($file, '/');
                                                            $str = ltrim($vie, '/');
                                                            if ($str == ''){
                                                                $str = $file;
                                                            }

                                                            ?>

                                                            <div class = "tag-field" style="clear:both;">
                                                                <a href="<?php echo base_url() ?>front/document/viewer1/<?php echo $filepath; ?>" class="tag-field" style="margin:0px;" target="_blank"><?php echo $str; ?></a>
                                                            </div>
                                                        <?php }} ?>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- /Cleaner -->
                                        </div>
                                        <div class="block ">
                                            <div class="block-content invisible">
                                                <?php
                                                //  for ($i = 0; $i < $num_of_file; $i++){
                                                //      if($view[$i]!="" && file_exists("./uploads/jobpost/".$view[$i])) {

                                                ?>
                                                <div class = "tag-field"><a style="margin: 0px;" href="<?php echo base_url(); ?>uploads/jobpost/<?php echo $view[$i]; ?>" class="tag-field" target="_blank">Download</a></div>
                                                <?php //} }echo "<br />"; ?>

                                            </div>
                                        </div>
                                    </div>
                               <?php }?>
                              <div class="block-fields">

                              <div class="block-fields">



                              <div class="block ">
                                <div class="block-content">


                                   </div>
                                   </div>

                              </div>
                              <!--<input type="reset" class="btn gray next-btn" value="Login to Proposal">-->

                            </div>
                          </div>
                        </div>

                        <div class="clear"></div>

                        <div class="heading-l">
                          <h2>Send a proposal </h2>

                        </div>
					<?php
                    $translator_id =$this->session->userdata('translator_id');
                    //echo $results[0]['proofread_required']; die;
                    if ($results[0]['proofreadType'] == 'editing') {
                        $language = explode('/', $results[0]['language']);
                        $sql=" SELECT `language` FROM `translator` WHERE `id`='$translator_id' AND language LIKE '%/".$language[1].",%'";
                        $val = $this->db->query($sql);

                        $condition = $val->num_rows() >= 1;
                    } else {

                        $language = explode('/', $results[0]['language']);
                        $lang = $language[0] . "/" . $language[1];
                        $lang_reverse = $language[1].'/'.$language[0];

                        $sql = "SELECT * FROM translator WHERE ( language LIKE '%{$lang}%' OR language LIKE '%".$lang_reverse."%')";
                        $val = $this->db->query($sql);




                        $condition = $val->num_rows() >= 1;

                    }

                    //echo $sql; die;

                     if ($condition){
                    ?>

                         <?php if(!$this->session->userdata('is_translator')){
                                $job_alias=$this->uri->segment(2);
                                /*$this->session->unset_userdata('referrer_url');
                                $this->session->unset_userdata('last_url');

                                $data = array('last_url' =>  base_url().'job/'.$job_alias);
                                $this->session->set_userdata($data);*/

                                ?>
                                <a href="<?php echo base_url()?>translator/login" class="btn gray next-btn">Login To Bid </a>

                         <?php } else{
                             $sql1 = "SELECT * from bidjob WHERE trans_id = '" . $this->session->userdata('translator_id') . "' AND job_id = '".$results[0]['id']."'";
                            $val1 = $this->db->query($sql1);
                            if($val1->num_rows()=='1'){
                            $fetch1= $val1->row();

                                ?>



                    <div class=" block field-container odd  hide">
                    <div class="block background">
                               <div class = "block-content">
                               <h2 class="title-1">Edit Your Bid</h2>
                               <div class = "block-content">
                    <?php
                                $attributes = array('class' => 'form-changeprofilepicture', 'id'=>'user-changeprofilepicture');
                                echo form_open_multipart('translator/bidjobedit', $attributes);
                                ?>
                            <!--<form name="" id="" action="">-->
                                <div class="about">
                                <input type="hidden" name="job_id" value="<?php echo $fetch1->job_id ?>"/>
                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Expected Turnaround Time *(In days)                   </label>
                                    <input id="time_need" name="time_need_day" type="text" class="form-control validate[required] text-input" placeholder="Time You Need" value="<?php echo ($fetch1->time_need)/1440 ;?>"  >
                                     <input id="time_need" name="time_need" type="hidden" class="form-control validate[required] text-input" placeholder="Time You Need" value="<?php echo $fetch1->time_need ;?>"  >

                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Your Quote for this translation job * ( In US dollars)                   </label>
                                    <input id="price" name="price" type="text" class="form-control validate[required,custom[number]] text-input" placeholder="Price" value="<?php echo $fetch1->price ;?>" >


                                        <?php

                                      //  $string=rtrim($fetch1->file, " ");
                                        $view=explode("##",$fetch1->file);
                                        array_pop($view);
                                        $num_of_file= count($view);
                                        //echo  $num_of_file;die;
                                        ?>


                                        <?php  if($fetch1->file!= "") {
                                        for ($i = 0; $i < $num_of_file; $i++){
                                        if($view[$i]!= "") {
                                         $vie = strstr($view[$i], '/');
                                        $str = ltrim($vie, '/');
                                        if($str == ''){
                                        $str = $view[$i];
                                        }

                                        ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Uploaded File :                                        </label>

                                                        <div class="col-sm-9">
                                                    <!-- <a href="<?php echo base_url() ?>front/document/viewer1/<?php echo $fetch1->job_id ?>/<?php echo base64_encode($view[$i]) ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a> -->
                                            <a href="javascript:void(0)" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
                                            <!-- <a href="<?php echo base_url(); ?>uploads/bidjobpost/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a> -->
                                             <a href="javascript:void(0);" class="btn btn-danger" onclick="removealert('<?php echo $fetch1->id; ?>','<?php echo $view[$i]; ?>')">Remove File</a>
                                                        </div>
                                                    </div>
                            <input type="hidden" name="prefile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $fetch1->file; ?>" />
                            <input type="hidden" name="numberfile" id="numberfile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $num_of_file; ?> " />
                                                    <?php }}} ?>


                              <div style="clear:both; height:7px; display:block;"></div>
                              <div class="col-sm-4">
                              <label class="control-label no-padding-right" for="form-field-1">You should be able to upload up to 5 files                      </label>
                              </div>
                              <div class="col-sm-12 ">
                                                    <div id="mulitplefileuploader">Upload</div>
                                                    <div id="status"></div>
                                                    <input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                                                    </div>

                              <div style="clear:both; height:7px; display:block;"></div>
                              <div class="col-sm-4"><label class="control-label no-padding-right" for="form-field-1">Message about your Proposal*                      </label>  </div>
                              <div style="clear:both; height:7px; display:block;"></div>
                              <textarea id="editor" name="proposal" class="form-control validate[required] text-input" placeholder="Your Proposal" rows="5" ><?php echo $fetch1->proposal ;?></textarea>

                                </div>
                               <?php if($fetch1->awarded!=1) {?>
                                <div id = "send">
                                <input id="send_btn" type="submit" value="Submit"></a>
                              </div>
                              <?php }?>
                                            <div id = "send" class="invisible">

                                <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Send
                           </button>&nbsp; &nbsp;
                                <button class="btn btn-info" type="reset" >
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                              </div>

                            </form>

                           </div>
                            </div>
                            </div>

                        </div>
                            <?php	//}

                            }else{

                            ?>
                       <div class="block field-container odd  hide">
                               <div class="block background">
                               <div class = "block-content">
                               <h2 class="title-1">Post Your Bid</h2>
                               <div class = "block-content">
                            <?php
                                $attributes = array('class' => 'form-changeprofilepicture', 'id'=>'user-changeprofilepicture');
                                echo form_open_multipart('translator/bidjob', $attributes);
                                ?>
                                <div id = "about">
                                 <input type="hidden" name="id" value="<?php echo $results[0]['id']?>"/>


                                   <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Expected Turnaround Time *(In Days)                     </label>
                                    <input id="time_need_day" name="time_need_day" type="text" class="form-control validate[required] text-input" placeholder="Time You Need"  >


                                    <input id="time_need" name="time_need" type="hidden" class="form-control validate[required] text-input" placeholder="Time You Need"  >
                                     <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Your Quote for this translation job * ( In US dollars)                      </label>
                                    <input id="price" name="price" type="text" class="form-control validate[required] text-input" placeholder="Price" >
                                    <div style="clear:both; display:block; height:7px;"></div>
                                    <div class="col-sm-12">
                                    <label class="control-label no-padding-right" for="form-field-1">You should be able to upload up to 5 files                      </label>
                                    </div>
                                    <div style="clear:both; display:block; height:5px;"></div>
								    <div class="col-sm-12 ">
                                                    <div id="mulitplefileuploader">Upload</div>
                                                    <div id="status"></div>
                                                    <input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                                                    </div>
                                    <div style="clear:both; display:block; height:10px;"></div>
                                    <div class="col-sm-12">
                                    <label class="control-label no-padding-right" for="form-field-1"> Message about your Proposal*                      </label>
                                    </div>
                                     <div style="clear:both; display:block; height:5px;"></div>


                                    <textarea id="editor" name="proposal" class="form-control  text-input" placeholder="Your Proposal" rows="5"></textarea>

                                </div>
                                <div id = "send">
                                <input id="send_btn" type="submit" value="Submit"></a>
                              </div>
                            </form>
                            </div>
                            </div>
                            </div>
                        </div>
                        <!--/similar Jobs Block-->

                      <!-- /Content Center -->
                      <div class="clear"></div>
                      <!-- Clear Line -->

                    </div><?php }}
					}else{?>
                        <div class=" block field-container odd  hide">
                        <div class="block background">
                        <div class = "block-content">

                		<div class="write">Your Language is not matched with this job. You are unable to bid for this job.
                        </div>
                      </div>
                      </div><!--end of .table-responsive-->
                    </div>

                    <?php }

					?>


                      </div>


                      <div class="clear"></div>


                    </div>


                  </div>
		<?php } ?>
<div class="clearfix"></div>

 <div class="clear"></div>
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/css/samples.css" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css" />
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>
<script>


$(document).ready(function() {
		$('#time_need_day').change(function() {
		var days = $(this).val();
		//alert(days);
		var hours = days*1440;
		//alert(hours);
		$(time_need).val(hours);

	});
	});

</script>
      <script type="text/javascript">
function removealert(id,file)
{

    del =confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
	else
	{
	window.location.href="<?php echo base_url(); ?>translator/removefile/"+id+"/"+file;
	}
}
</script>
<script>
$(document).ready(function()
{ 		var $fileUpload = $("#numberfile").val();
		var file=parseInt($fileUpload);
		var num=5;
		if (file!=0){
         var filecount= num-file;
		}else{
			var filecount=5;
		}


	var settings = {
	dataType: "html",
	url: "<?php echo base_url().'translator/'.'upload';?>",
	method: "POST",
    allowedTypes:"jpg,jpeg,docx,xls,xlsx,ppt,pptx,png,gif,doc,pdf,zip,tar,txt,ai,mp3,wav,csv",
	fileName: "myfile",
	maxFileCount:filecount,
	multiple: false,
	onSuccess:function(files,data,xhr)
	{
		var total=$('#totalFile').val();
		$('#totalFile').val(total+data);
		var total1=$('#totalFile').val();
		var filePath = data;
		var currentId= $(".remove-file-cls").attr("id");
 		 $('#upload-statusbar-'+currentId).find('.remove-file-cls').html("<a href='javascript:void(0);' onclick='return theFunction();' class='test' id='"+filePath+"'>Remove</a>");
	},
    afterUploadAll:function()
    {

    },
	onError: function(files,status,errMsg)
	{
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}

$("#mulitplefileuploader").uploadFile(settings);

});
</script>
<script>
$(document).ready(function(){

});
</script>
<script type="text/javascript">
  	function theFunction () {//alert("hello");
	var id = $(".test").attr('id');
	//alert(ID);

		 $.ajax({
					dataType: "html",
					type: "POST",
					data: {id:id},
					cache: false,
					url:  '<?php echo  base_url().'translator/linkdelete';?>',
					success: function (data, textStatus){
						alert(data);


                	}
            });



    return;
    }
</script>

<?php
$this->load->view('vwFooter');
?>

<?php
$this->load->view('vwFooterLower');

?>
