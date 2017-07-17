<!DOCTYPE html>
<html class="no-js pattern_1">
<head>
<title>Translation</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:300,400,700&amp;subset=latin,latin-ext"/>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/font-awesome-ie7.css" rel="stylesheet" type="text/css" />
<link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/reset.css"/>
<link id="color_css" rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/color_scheme_2.css"/>
<!--<link id="color_css" rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/color_scheme_1.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/jquery.combosex.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/jquery.flexslider.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>css/jquery.scrollbar.css"/>
  <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/validationEngine.jquery.css">

<!--[if (lte IE 9)]>
    <link rel="stylesheet" type="text/css" href="css/iefix.css"/>
    <![endif]-->
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.1.7.2.min.js"></script>
     <script type="text/javascript">
jQuery(document).ready(function() { 
 jQuery("#navigation").click(function(){  
 jQuery("#navigation").removeClass("current");
 jQuery(this).addClass("current");
 });
});
</script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery-ui.1.7.2.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.combosex.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.gmap.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/fitvids.js"></script><!-- fIt Video -->
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.validationEngine.js"></script>
<script>
    jQuery(document).ready(function(){
        // binds form submission and fields to the validation engine
        jQuery("#artist-registration").validationEngine();
		jQuery("#user-registration").validationEngine();
		jQuery("#login-form").validationEngine();
		jQuery("#artist-forgotpass").validationEngine();
		jQuery("#user-changeprofilepicture").validationEngine();
		jQuery("#changeprofile").validationEngine();
		jQuery("#requestForm").validationEngine();

    });
</script>
</head>
<body>

<!-- Bar -->
<div id="bar">
  <div class="inner"> 
    
    <!-- Language Menu -->
     <?php 
	$id = $this->session->userdata('translator_id');

     $sql1 = "SELECT * FROM `translator` WHERE  id = '$id' ";
     $results1 = $this->db->query($sql1);
     $home_content = "";
     if ($results1->num_rows > 0) 
	 {
       $result_arr1 = $results1->row(); 
       $translator= $result_arr1->first_name;
     }
     ?>
    <!-- /Language Menu --> 
    
    <!-- User Menu -->
    <ul id="user-menu">
     
    <?php  if($this->session->userdata('is_translator')){ ?>
    <li id="bookmarks" class="first"><a href="#">Welcome <?php echo $translator;?></a> </li>
    <li><a href="<?php echo base_url(); ?>translator/"><i class="ace-icon fa fa-cog"></i>My account</a></li>
    <li><a href="<?php echo base_url(); ?>translator/logout"><i class="ace-icon fa fa-power-off"></i>Logout</a></li>
<!--    <li  class="current"><a href="<?php echo base_url().'jobs';?>"><i class="ace-icon fa fa-share-square-o"></i>Jobs</a></li>-->
      <?php } else{ ?>
      <li id="login" class="first"><a href="<?php echo base_url()?>translator/login">Translator Login</a></li>
      <li id="register"><a href="<?php echo base_url()?>translator/registration">Translator Register</a></li>
      <!--<li  class="current"><a href="<?php echo base_url().'jobs';?>"><i class="ace-icon fa fa-share-square-o"></i>Jobs</a></li>-->
      <?php } ?>
    </ul>
    <!-- /User Menu --> 
    
  </div>
</div>
<!-- /Bar --> 

<!-- Header -->
<div id="header">
  <div class="inner"> 
    
    <!-- Logo -->
    <div id="logo"> <a href="<?php echo base_url()?>"><img src="<?php echo HTTP_FRONT_ASSETS_PATH_ADMIN; ?>images/Logo.png" width="205" height="50"  alt="logo"/></a><a class="menu-hider"></a></div>
    <!-- /Logo -->
    
    <!--<ul id="navigation">-->
      <?php /*?><li> <a href="index.html">Home</a></li>
      <li class="first expanded"><a href="jobs.html">Jobs</a>
        <ul class="submenu">
          <li><a href="jobs.html">Job listing</a></li>
          <li><a href="job.html">Job Details</a></li>
        </ul>
      </li>
      <li class="first expanded"><a href="candidates-listing.html">Candidates</a>
        <ul class="submenu">
          <li><a href="candidates-listing.html">Candidate Listing (with sidebar)</a></li>
          <li><a href="candidates-listing-no-sidebar.html">Candidate listing (without)</a></li>
          <li><a href="candidate.html">Candidate</a></li>
        </ul>
      </li>
      <li><a href="partners.html">Partners</a></li>
      <li><a href="contacts.html">Contact</a></li><?php */
	  
	  
		$sql1 = "SELECT * FROM cms WHERE id = '2'";
        $val1 = $this->db->query($sql1);
		$fetch1= $val1->row();
		
		
		$sql2 = "SELECT * FROM cms WHERE id = '3'";
        $val2 = $this->db->query($sql2);
		$fetch2= $val2->row();
		
		
		$sql3 = "SELECT * FROM cms WHERE id = '4'";
        $val3 = $this->db->query($sql3);
		$fetch3= $val3->row();
		
		
		$sql4 = "SELECT * FROM cms WHERE id = '5'";
        $val4 = $this->db->query($sql4);
		$fetch4= $val4->row();
		 
		 $sql5 = "SELECT * FROM cms WHERE id = '6'";
        $val5 = $this->db->query($sql5);
		$fetch5= $val5->row();
	  
	  
	  
	  
	  ?>
     
      <ul id="navigation">
   <li  class="current"><a href="<?php echo base_url()?>"><i class="ace-icon fa fa-home home-icon"></i>Home</a></li>
   
    <li  ><a href="<?php echo base_url()?>page/<?php echo $fetch1->alias;?>">About Us</a></li>
   <li  ><a href="<?php echo base_url()?>page/<?php echo $fetch2->alias;?>">Contact us</a></li>
      <li  ><a href="<?php echo base_url()?>page/<?php echo $fetch5->alias;?>">How It Works</a></li>
         <li  ><a href="<?php echo base_url().'jobs';?>"><i class="ace-icon fa fa-share-square-o"></i>Jobs</a></li>
    <!--<li  class="current"><a href="<?php echo base_url()?>page/<?php echo $fetch3->alias;?>">Terms and Conditions</a></li>
   <li  class="current"><a href="<?php echo base_url()?>page/<?php echo $fetch4->alias;?>">Privacy Policy </a></li>-->
    </ul>
    
   

      
      
    
    <div class="reponsive-nav">
     <select  class="select" name="menu1" id="menu1"> 
       <?php /*?> <option value="index.html">Home</option>
        <option value="jobs.html">Job listing</option>
        <option value="job.html">Job Details</option>
        <option value="candidates-listing.html">Candidate Listing (with sidebar)</option>
        <option value="candidates-listing-no-sidebar.html">Candidate listing (without sidebar)</option>
        <option value="candidate.html">Candidate Details</option>
        <option value="partners.html">Partners</option>
        <option value="contacts.html">Contact</option><?php */?>
        <option value="<?php echo base_url()?>">Home</option>
        
      </select>
    </div>
  </div>
</div>
<!-- /Header -->
