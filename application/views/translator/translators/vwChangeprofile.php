<?php $this->load->view('vwHeader'); ?>

<style>
    .transdrop { width:100% !important; }
</style>

<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/uploadfilemulti.css" />
<!--<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery-1.8.0.min.js"></script>-->
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.fileuploadmulti.min.js"></script>

<div id="content">
    <div id="title">
        <h1 class="inner title-2">My Profile
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit Profile
            </small>
            <ul class="breadcrumb-inner">
                <li> <a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
                <li> <a href="<?php echo base_url()?>translator/changeprofile">Change Profile</a></li>
            </ul>
        </h1>
    </div>


    <div class="inner">

        <!-- Content Inner -->
        <div class="content-inner">

            <!-- Content Center -->
            <div class="content-center">

                <div class="block field-container odd box-1 hide">

                    <!--<div id="contacts" class="block post-box box-1 contact-address">-->
                    <div class="block-content">
                        <div class="block background">

                            <div class="row" style=" margin-left:-15px">
                                <div class="col-sm-6"><h2 class="title-1">Edit Profile</h2></div>
                                <div class="col-sm-6">
                                    <form action="" method="POST">
                                    <button class="btn btn-danger pull-right" style=" margin-top: 15px" id="del_acc" type="button">Deactivate My Account</button>
                                </form>
                                </div>
                            </div>
                             

                            <div class = "block-content">

                                <?php if (validation_errors()!="") { ?>
                			        <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p><?php echo validation_errors(); ?> </p>
                                    </div>
                		        <?php } ?>

                                <?php if (isset($message_error) && $message_error!="") { ?>
                			        <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <p><?php echo $message_error; ?> </p>
                                    </div>
                		        <?php } ?>

                                <?php if (isset($message_success) && $message_success!="") { ?>
                			        <div class="alert alert-block alert-success">
                				        <button type="button" class="close" data-dismiss="alert">
                					       <i class="ace-icon fa fa-times"></i>
                				        </button>
                                        <p><?php echo $message_success; ?> </p>
                                    </div>
                		        <?php } ?>

                                <?php if($this->session->flashdata('success_message')){ ?>
                        	        <div class="alert alert-block alert-success">
                				        <button type="button" class="close" data-dismiss="alert">
                					       <i class="ace-icon fa fa-times"></i>
                				        </button>
                                        <p><?php echo $this->session->flashdata('success_message'); ?> </p>
                                    </div>
                                <?php } ?>

                                <?php if($this->session->flashdata('error_message')){ ?>
                        	        <div class="alert alert-block alert-success">
                				        <button type="button" class="close" data-dismiss="alert">
                					       <i class="ace-icon fa fa-times"></i>
                				        </button>
                                        <p><?php echo $this->session->flashdata('error_message'); ?> </p>
                                    </div>
                                <?php } ?>

                                <?php
                                    $attributes = array('class' => 'form-registration', 'id'=>'changeprofile', 'data-parsley-validate'=>"");
                                    echo form_open('translator/myprofile', $attributes);
                                ?>

                                <div id = "about">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Email(Username)<span class='error-label'>*</span></label>
                                    <input title="Your email address" type="email" name="email_address" class="form-control text-input" placeholder="Email address" onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['email_address']; ?>" readonly/>

                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">First Name<span class='error-label'>*</span></label>
                                    <input title="Your FirstName" type="text" name="first_name" class="form-control text-input validate[required] " placeholder="First Name"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['first_name']; ?>"/>

                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Last Name<span class='error-label'>*</span></label>
                                    <input title="Your LastName" type="text" name="last_name" class="form-control  validate[required] text-input" placeholder="Last Name"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['last_name']; ?>"/>

                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Location</label>
                                    <input title="Your Location" type="text" name="location" class="form-control text-input" placeholder="Location"  onfocus="$(this).addClass('active');" onblur="$(this).removeClass('active');" value="<?php echo $results[0]['location']; ?>"/>

                                    <?php
                                        $view = explode("##",$results[0]['file']);
                                        array_pop($view);
                                        $num_of_file = count($view);
                                    ?>

                                    <?php  if($results[0]['file']!= "") {
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
                                                        <a href="<?php echo base_url(); ?>uploads/user/<?php echo $view[$i]; ?>" class="btn btn-success" target="_blank"><?php echo $str; ?></a>
                                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="removealert('<?php echo $results[0]['id']; ?>','<?php echo $view[$i]; ?>')">Remove File</a>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="prefile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $results[0]['file']; ?>" />
                                                <input type="hidden" name="numberfile" id="numberfile" size="20" class="col-xs-10 col-sm-5" value="<?php echo $num_of_file; ?> " />

                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                    <div class="form-group" style = "margin-bottom: 80px;">
                                        <div class = "col-md-4">

                                            <p style = "font-weight:bold; font-size: 15px;"><span>Resume and Sample Work Upload</span></p>
                                            <p style = "margin-top: -10px;"><small>You are allowed to upload up to 5 files only</small></p>

                                        </div>
                                        <div class = "col-md-6">
                                        <?php /*<div class="col-sm-9 col-sm-offset-3">*/ ?>
                                            <div id="mulitplefileuploader">Upload</div>
                                            <div id="status"></div>
                                            <input type="hidden" name="totalFile" id="totalFile" value="" class="validate[required]" />
                                        </div>
                                    </div>
<?php

 $id=$results[0]['id'];
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
if($language4!='P')
{
?>
<div>
                                    <h4>Select Language Pairs ( Up to 6 pairs)</h4>

                                    <?php
                                        $arrlanguage = $results[0]['language'];
                                        $language = explode(",", $arrlanguage);
                                        array_shift($language);
                                        array_pop($language);
										
										
                                    ?>

                                    <?php
                                        $sql=" SELECT * FROM `languages` ORDER BY `name` ";
                                        $val=$this->db->query($sql);
                                        $lang=$val->result();
                                    ?>

                                    <table id = "languagePairSelection" class="table">
                                            <tr>
                                                <th>Translate From</th>
                                                <th>Translate To</th>
                                                <th></th>
                                            </tr>

                                    <?php for($i = 0; $i < count($language); $i++) { $j = $i + 1; ?>

                                        <?php
                                            if(isset($language[$i])) {
                                                $lanSet = $language[$i];
                                                $lan = explode("/", $lanSet);
                                            } else {
                                                $lan = array('0', '0');
                                            }
                                        ?>


                                            <tr>
                                                <td>
                                                    <select class = "form-control" name = "languageFrom[]">
                                                        <option>Select Language</option>
                                                    <?php foreach ($allLanguages as $rowLanguages){ ?>
                                                        <option <?php if($lan[0] == $rowLanguages->id) { echo "selected"; }?> value = "<?php echo $rowLanguages->id; ?>"><?php echo $rowLanguages->name; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class = "form-control" name = "languageTo[]">
                                                        <option>Select Language</option>
                                                    <?php foreach ($allLanguages as $rowLanguages){ ?>
                                                        <option <?php if($lan[1] == $rowLanguages->id) { echo "selected"; }?> value = "<?php echo $rowLanguages->id; ?>"><?php echo $rowLanguages->name; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class = "btn btn-danger delRowBtn" type = "submit"><i class = "fa fa-times"></i></button>
                                                </td>
                                            </tr>

                                    <?php } ?>
                                    </table>

                                        <input id = "addlanguagePair" type = "button" class = "btn btn-primary pull-right" value = "Add More Language Pair" onclick = "insertLanguagePair()" />
                                    </div>
<?php
}else{ 
	
 } ?>	
					

		
                                    


                                </div>

                                <div id = "send">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>
                                    <button class="btn btn-info" type="reset" >
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>

                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content Center -->

            <!-- Content Right -->
            <div class="content-right">
 		        <?php $this->load->view('translator/includes/vwSidebar-left'); ?>
            </div>
            <!-- /Content Right -->

            <div class="clear"></div>
            <!-- Clear Line -->
        </div>
        <!-- /Content Inner -->
    </div>
</div>

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
    function removealert(id,file){
    	del =confirm("Are you sure to delete permanently?");
        if(del!=true) {
            return false;
        } else {
    	   window.location.href="<?php echo base_url(); ?>translator/removefile1/"+id+"/"+file;
    	}
    }
</script>

<script>
    $(document).ready(function() {
        var $fileUpload = $("#numberfile").val();
    	var file=parseInt($fileUpload);

    	var num=5;
    	if (file!=0){
            var filecount= num-file;
    	}else{
    		var filecount=5;
    	}

        var settings = {
        	dataType: "html",
        	url: "<?php echo base_url().'translator/'.'uploads';?>",
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
  	function theFunction () {

        var id = $(".test").attr('id');

        $.ajax({
    		dataType: "html",
    		type: "POST",
    		data: {id:id},
    		cache: false,
    		url:  '<?php echo  base_url().'translator/linkdelete1';?>',
    		success: function (data, textStatus){
    			alert(data);
          	}
        });
    	exit;
    }
</script>

<script>
    function insertLanguagePair(){

        var rowCount = $('#languagePairSelection tr').length;

        if(rowCount <= 6){
            var tbl = $("#languagePairSelection");
            $("<tr><td><select class = 'form-control' name = 'languageFrom[]' ><option>Select Language</option><?php foreach ($allLanguages as $rowLanguages){ ?><option value = '<?php echo $rowLanguages->id; ?>'><?php echo $rowLanguages->name; ?></option><?php } ?></select></td><td><select class = 'form-control' name = 'languageTo[]'><option>Select Language</option><?php foreach ($allLanguages as $rowLanguages){ ?><option value = '<?php echo $rowLanguages->id; ?>'><?php echo $rowLanguages->name; ?></option><?php } ?></select></td><td><button class = 'btn btn-danger delRowBtn' type = 'submit'><i class = 'fa fa-times'></i></button></td></tr>").appendTo(tbl);

        }

    }

    $(document.body).delegate(".delRowBtn", "click", function() {
        $(this).closest("tr").remove();
    });
</script>

<?php $this->load->view('vwFooter'); ?>
<?php $this->load->view('vwFooterLower'); ?>
