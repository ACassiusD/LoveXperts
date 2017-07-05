<!-- Dashboard -->
<!-- INCLUDING HEADER WITH PHP -->

<?php
#VARIABLES
$date = "2015-30-09";
$filename = "dashboard.php";
$description = "This page will be where users are redirected when they log in";	

include './includes/header.php';
?>
<?php
//Restrict access to this page unless the user was sent here from register.php
if($_SESSION['fromRegister'] == "false"){
   //send them back
   header("Location: dashboard.php");
}
else{
   //reset the variable
   $_SESSION['fromRegister'] = "false";
}
?>

<div id="wrapper1">

	<div class="content">
		<p>Congratulation, your account has been created!</p> <br/>
		<p>Click <a href="./login.php">Here </a> to log in!<br/></p>

	</div>
</div>
 
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
