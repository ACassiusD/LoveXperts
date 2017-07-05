<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-12-06";
$filename = "interests.php";
$description = "This is where people will be able to see their interests and show interests";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">
		<!-- CONTENT GOES HERE -->
		<?php
			if (isset($_GET['id']))
			{
				pg_execute($dbconn, "remove_interest", array($_GET['id'],$_SESSION['user_id']));
				echo "<p>No longer Interested by ". $id ."</p>";
				header("Location: interests.php");
			}
			else
			{
				header("Location: dashboard.php");
			}
		
		?>
		<!-- CONTENT ENDS HERE -->
	</div>
</div>
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>