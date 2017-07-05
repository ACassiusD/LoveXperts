<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-11-17";
$filename = "user_logout.php";
$description = "This page will allow the user to logout of the website";	

include './includes/header.php';
?>
<!-- CONTENT ENDS HERE -->

<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>



<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>