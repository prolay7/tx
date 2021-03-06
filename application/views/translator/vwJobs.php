<?php
$this->load->view('vwHeader');
?>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>select2.css">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>select2-bootstrap.css">
<style media="screen">
    .candidate-meta {
        margin-left: -5px !important;
    }

    .select-drop{
    width: 100%!important;
        border-color: #5bbc2e!important;
    }
    .select2-drop-active{
        border-color: #5bbc2e!important;
    }
    .select2-container-active .select2-choice, .select2-container-multi.select2-container-active .select2-choices{
        border-color: #5bbc2e!important;
    }
    .select2-container .select2-choice{
        height: 27px;
        line-height: 1.200;
        margin-bottom: 7px;
    }
    .select2-results .select2-highlighted {
        color: #5bbc2e!important;
        background-color: transparent;!important;
        line-height: 1.5;
        font-size: 15px;
    }
</style>

<div id="content">
  <div id="title">
    <h1 class="inner">Available Jobs<span id="jobs-counter">(<?php echo $count_jobpost; ?>)</span>
      <ul class="breadcrumb-inner">
        <li> <a href="<?php echo base_url()?>">Home</a></li>
        <li> <a href="<?php echo base_url()?>jobs">Jobs</a></li>
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
    <!-- Content Inner -->
    <div class="content-inner">


      <!-- Content Left -->
         <div class="content-left">
         <div id="search-filter" class="block background">
         <?php
		  $lansql="select * from `languages`";
		  $lanquery=mysql_query($lansql);
		  $lansql1="select * from `languages`";
		  $lanquery1=mysql_query($lansql1);
		  ?>

			<?php
         /*   $sql=" SELECT * FROM `languages` ORDER BY name asc ";
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
            $newvalue = $value1.' To '.$value2;
            $newArray[$newkey] = $newvalue;
            }
            }
            }*/
            ?>


          <h2 class="title-1">Search</h2>
          <div class="block-content">
            <style type="text/css">
			.invisible {
			display:none !important;
			}
		    </style>
            <?php

            $attributes= array('class' => 'form-inline reset-margin', 'id' => 'search-job-page');
            $options_category = array();
            foreach ($jobpost as $array) {
              foreach ($array as $key => $value) {
                $options_category[$key] = $key;
              }
              break;
            }
              echo form_open('front/jobs', $attributes);
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width:255px;height: 20px;"');
              echo form_label('From Language:', 'language_from');
			  $language=explode('/',$language_from_selected);
			  //print_r($language_from_selected);
			  $language[0];
			  $language[1];

			  ?>
             <select id="lang_from" class="select-drop validate[required]" name="language_from">
             <option value=""> Select Language </option>
              <?php
			   $sql=" SELECT * FROM `languages` ORDER BY name asc ";
            $val=$this->db->query($sql);
            $lang=$val->result();
			  foreach($lang as $lang1) {


				  ?>
             <option value="<?php echo $lang1->id;?>" <?php if($lang1->id==$language[0]){echo 'selected';}?>><?php echo $lang1->name; ?>
             </option>
             <?php }?>
             </select>

              <?php
			  echo form_label('To Language:', 'language_to');?>
			  <select id="lang_to" class="select-drop validate[required]"  name="language_to">
             <option value=""> Select Language </option>
             <?php
			 $sql=" SELECT * FROM `languages` ORDER BY name asc ";
            $val=$this->db->query($sql);
            $lang=$val->result();
			 foreach($lang as $lang1) {?>
             <option value="<?php echo $lang1->id; ?>" <?php if($lang1->id==$language[1]){echo 'selected';}?>><?php echo $lang1->name; ?>
             </option>
             <?php }?>
             </select>
             <label>Job Type</label>
             <select class="select-drop" id="job_typ" name="job_type">
                 <option value="-1">Select Job Type</option>
                 <option value="translation">Translation</option>
                 <option value="proofreading">Proof Reading</option>
             </select>
             <?php   echo form_dropdown('order', $options_category, $order, 'class="span2 invisible"');
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 invisible"');
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-info', 'value' => 'Search');
              echo form_submit($data_submit);
			  ?>
              <input type="reset" class="btn gray next-btn" onClick="reload_page()" value="Reset">
              <?php
              echo form_close();
              ?>

          </div>


        </div>


      </div>
      <!-- /Content Left -->

      <!-- Content Center -->
      <div class="content-center">

        <div class="clear"></div>
        <div class="heading-l">
          <h2> Available Jobs </h2>
        </div>
        <div class="clear"></div>
          <div class="clear"></div>

<?php
$id=$this->session->userdata('translator_id');
$sql="select language from translator where id='$id'";
$val = $this->db->query($sql);
$lang=$val->result();
// print_r($lang);
$language=$lang[0]->language;
$language = explode(",", $lang[0]->language);
//print_r($language);
$language2=$language[1];
//echo $language2;
$language3=explode("/",$language2);
//print_r($language3);
$language4=$language3[0];
//echo $language4;
if($language4!="P")
{
?>


<?php
			  if($count_jobpost!='0') {
                  foreach($jobpost as $genfetch) {
                      if ($genfetch['proofread_required'] == 1) {
                          $job_type = 'Proof Reading/' . ucfirst($genfetch['proofreadType']);
                      } else {
                          $job_type = 'Translation';
                      }

                      $translator_id =$this->session->userdata('translator_id');
                      $sql=" SELECT `language` FROM `translator` WHERE `id`='$translator_id'";
                      $val=$this->db->query($sql);
                      $translator_lan=$val->row();
                      //print_r($translator_lan);
                      $translator_lang= $translator_lan->language;
                      $language = explode(",", $translator_lang);

                      array_shift($language);
                      array_pop($language);


                      $language_id=$genfetch['language'];
                      // if (in_array($language_id, $language)){


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
                      $language_name=$fetch6->name;
                      ?>
                      <?php if(!empty($genfetch['alias'])) { ?>
                          <div id="job-content-fields">
                              <div id="list" class="view_mode">
                                  <div class="field-container odd box-1">



                                      <div class="header-fields">

                                          <?php
                                          $date=date("jS F, Y", strtotime($genfetch['created']));
                                          $mon=substr($date,5,3);
                                          $day=substr($date,0,4);
                                          ?>
                                          <!--<div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>-->
                                          <div class="title-company ">
                                              <div class="title" ><a href="<?php echo base_url().'job/'.$genfetch['id'].'/'.$genfetch['alias']; ?>" ><?php echo $genfetch['name'];?></a></div>
                                          </div>
                                      </div>
                                      <div class="body-field">
                                          <div class="teaser">
                                              <p><?php

                                                  $des=strlen(strip_tags($genfetch['description']));
                                                  if($des>150){
                                                      echo substr(strip_tags($genfetch['description']),0,150).'...';
                                                  }
                                                  else{
                                                      echo strip_tags($genfetch['description']);
                                                  }
                                                  ?>
                                              </p>
                                          </div>

                                          <ul class="candidate-meta meta-fields">
                                              <li class="pull-left" style="margin-right: 10px">Job Type: <span><?php echo $job_type ?></span></li>
                                              <li class="pull-left" style="margin-right: 15px">Job Posted: <span><?php echo $date; ?></span></li>
                                              <li class="pull-left">Translate From: <span>
				  <?php echo $languagef_name; ?></span></li>
                                              <li class="pull-right" style="margin-right: 10px;">Translate To: <span>
				  <?php echo $language_name;  ?></span></li>
                                              <!--  <li class="pull-right">Career Level: <span>Mid Career</span></li>-->
                                          </ul>

                                      </div>



                                  </div>

                              </div>

                          </div>
                      <?php } ?>
                      <?php

                  }
              }
              else
              {
                  ?>
                  <div class="title" align="center">No Records Found!</div>
                  <?php
              }
			  ?>
    <div class="clear"></div>
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

<?php }else{
    $sql1="select * from jobpost where proofreadType='editing' ORDER BY id DESC ";
    $val1 = $this->db->query($sql1);
    $alldata=$val1->result();
    foreach($alldata as $row1) {
        //$row1=$lang->language;

        $language = explode(",", $row1->language);
//print_r($language);
        $language2=$language[0];
//echo $language2;
        $language3=explode("/",$language2);
//print_r($language3);
       //echo '<pre>';print_r($language3);
        $language4=$language3[1];
        //echo $language4;
        if($language4==1){
?>
          <div id="job-content-fields">
          <div id="list" class="view_mode">
              <div class="field-container odd box-1">



                  <div class="header-fields">

                      <?php
                      $date=date("jS F, Y", strtotime($row1->created));
                      $mon=substr($date,5,3);
                      $day=substr($date,0,4);
                      ?>
                      <!--<div class="date"><?php echo $day; ?><span><?php echo $mon; ?></span></div>-->
                      <div class="title-company ">
                          <div class="title" ><a href="<?php echo base_url().'job/'.$row1->id.'/'.$row1->alias; ?>" ><?php echo $row1->name; ?></a></div>
                      </div>
                  </div>
                  <div class="body-field">
                      <div class="teaser">
                          <p><?php

                              $des=strlen(strip_tags($row1->description));
                              if($des>150){
                                  echo substr(strip_tags($$row1->description),0,150).'...';
                              }
                              else{
                                  echo strip_tags($row1->description);
                              }
                              ?>
                          </p>
                      </div>

                      <ul class="candidate-meta meta-fields">
                          <li class="pull-left" style="margin-right: 10px">Job Type: <span>Proof Reading/Editing</span></li>
                          <li class="pull-left" style="margin-left: 100px">Job Posted: <span><?php echo $date; ?></span></li>
                          <!--<li class="pull-left">Translate From: <span>
				  <?php echo $languagef_name; ?></span></li>-->
                          <li class="pull-right" style="margin-right: 10px;">Translate To: <span>
				 English</span></li>
                          <!--  <li class="pull-right">Career Level: <span>Mid Career</span></li>-->
                      </ul>

                  </div>



              </div>

          </div>

      </div>


 <?php   } }?>

<div class="clear"></div>
        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
  <?php  } ?>

      </div>
    <!-- /Content Center -->

      <div class="clear"></div>
      <!-- Clear Line -->

    </div>
    <!-- /Content Inner -->

  </div>
</div>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>select2.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#lang_from").select2({
            allowClear:true,
            placeholder: 'Select Language From'
        });

        $("#lang_to").select2({
            allowClear:true,
            placeholder: 'Select Language To'
        });

        $("#job_typ").select2({
           allowClear:true,
            placeholder:'Select job type'
        });


    });
function reload_page()
{
window.location.href="<?php echo base_url().'front_job/reset'; ?>";
}
</script>
<?php
$this->load->view('vwFooter');
?>
<?php
$this->load->view('vwFooterLower');
?>
