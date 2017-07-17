<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="sujay mondal">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>favicon.ico">

    <title><?php echo SITE_NAME; ?></title>

    <!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" />
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>font-awesome.css" />
       
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>datepicker.css" />
		
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
        
            <!--[if !IE]> -->
           <!-- <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo HTTP_JS_PATH; ?>jquery.js'>"+"<"+"/script>");
            </script>-->
            
            <!-- <![endif]-->
         <script src="<?php echo HTTP_JS_PATH; ?>jquery.min.js"></script>

         <script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>

		<script src="<?php echo HTTP_JS_PATH; ?>ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
		<script src="<?php echo HTTP_JS_PATH; ?>respond.js"></script>
        
		<![endif]-->
   
        

  </head>

  <body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Customer Service Admin Panel
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
                    		<!-- 		<li class="blue" >
							<a  href="#" data-toggle="dropdown" class="dropdown-toggle">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success" id="blue"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									<span class="badge badge-success" id="blue1"></span> Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar notificationMsg">
										<li><a href = "<?php echo base_url(); ?>admin/message/">View Messages</a></li>
									</ul>
								</li>

							
							</ul>
						</li> -->
                        
                    
                    
						

						<!-- #section:basics/navbar.user_menu -->
                        <li class="light-blue">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <!--<img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" />-->
                        <span class="user-info">
                        <small>Welcome,</small>
                        
                        <?php
                        $id = $this->session->userdata('admin_id');
                        $sql1 = "SELECT `first_name` FROM `admin` WHERE  `id` ='" . $id . "'";
						
                        $results1 = $this->db->query($sql1);
                        
                        if ($results1->num_rows > 0) {
                        $data = $results1->result_array();
                        //echo '<pre>'; print_r($data);die;
                        echo $data[0]['first_name'];
                        }
                        ?>
                        </span>
                        
                        <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <!-- <li>
                        <a href="<?php echo base_url(); ?>admin/changeprofile">
                        <i class="ace-icon fa fa-cog"></i>
                        Settings
                        </a>
                        </li> -->
                        
                        <!--<li>
                        <a href="profile.html">
                        <i class="ace-icon fa fa-user"></i>
                        Profile
                        </a>
                        </li>-->
                        <!-- <li class="divider"></li> -->
                        
                        <!-- <li>
                        <a href="<?php echo base_url(); ?>admin/changepass">
                        <i class="ace-icon fa fa-key"></i>
                        Change Password
                        </a>
                        </li> -->
                        
                        <!-- <li class="divider"></li> -->
                        
                        <li>
                        <a href="<?php echo base_url(); ?>admin/logout">
                        <i class="ace-icon fa fa-power-off"></i>
                        Logout
                        </a>
                        </li>
                        </ul>
                        </li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>
        