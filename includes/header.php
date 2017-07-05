<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : SweetCourse 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130919

-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

	<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

	<?php
		date_default_timezone_set('America/Toronto');
		//Requiring functions.php, constants.php, and db.php
		require_once 'functions.php';
		require_once 'constants.php';
		require_once 'db.php';	
		
		//Start a session
		session_start();
	?>
	
	<!-- 
	Author: Alex Donnelly, Dan Munusami and Geoff Veale
	File name: <?php echo"$filename";?>
	Date: <?php echo"$date";?>
	Description: <?php	echo"$description";?>
	-->
</head>

<body>
<!-- HEADER -->
<div id="header-wrapper">
	<div id="header" class="container">
		<!-- iadding the name of the website and the logo -->
		<div id="logo">
				<img src="./images/logo.png" width="450" height="200" alt="Logo" />
		</div>
		<!-- Adding the menu (This needs to be changed dynamicly depending on what page the include is called on) -->
		<div id="menu">
			<ul>
				<?php 
				//Homepage Always avaliable
				displayMenuItem('/index.php') ?> accesskey="1" title="">Homepage</a></li>
				<?php 
				//Search users Always avaliable
				displayMenuItem('/profile_city_select.php') ?> accesskey="7" title="">Search Users</a></li>			
				
				<?php //If user is not logged in, display register, login and request password pages.
				if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
				{
					displayMenuItem('/login.php'); echo ' accesskey="2" title="">Login</a></li>';
					displayMenuItem('/register.php'); echo ' accesskey="3" title="">Register</a></li>';
					displayMenuItem('/request_password.php'); echo ' accesskey="4" title="">Request Password</a></li>';					
				}
				//Logged in users have access to these depending on their account status
				elseif(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true)
				{

					//If user is an admin
					if ($_SESSION['user_type'] == "a")
					{
						displayMenuItem('/admin.php'); echo 'accesskey="5" title="">Admin Dashboard</a></li>';
						displayMenuItem('/create_profile.php'); echo 'accesskey="6" title="">Update Profile</a></li>';
					}
					//Display these thinks only if there are incomplete or complete user
					else if ($_SESSION['user_type'] == "c" || $_SESSION['user_type'] =="i")
					{
						displayMenuItem('/dashboard.php'); echo 'accesskey="7" title="">Dashboard</a></li>';
						//Only if users is complete
						if ($_SESSION['user_type'] == "c")
						{
							displayMenuItem('/create_profile.php'); echo 'accesskey="8" title="">Update Profile</a></li>';
							displayMenuItem('/interests.php'); echo 'accesskey="9" title="">Interests</a></li>';		
						}	
						else
						{
							displayMenuItem('/create_profile.php'); echo 'accesskey="10" title="">Create Profile</a></li>';	
						}
					}
					//All Logged in users see these
					displayMenuItem('/user_update.php'); echo 'accesskey="11" title="">Update User</a></li>';
					displayMenuItem('/display_profile.php'); echo 'accesskey="12" title="">Display Profile</a></li>';
					displayMenuItem('/profile_images.php'); echo 'accesskey="13" title="">Upload Images</a></li>';
					displayMenuItem('/change_password.php'); echo 'accesskey="14" title="">Change Password</a></li>';
					displayMenuItem('/user_logout.php'); echo 'accesskey="15" title="">Logout</a></li>';	
				}
				?>
			</ul>
			
			<?php
			//Checks if the user is logged in and presents message in the header
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
			{
				//Create the output
				$output = "<p>Logged in as <a href='".constant("DISPLAY_PROFILE_ADDRESS")."'>".$_SESSION['user_id']."</a></p>";
			} 
			else 
			{
				$loginAddress = "./login.php";
				$output = "<p>Please <a href='".constant("LOGIN_ADDRESS")."'>Log In</a></p>";
			}
			echo $output;
				
			?>
		</div>
	</div>
</div>


