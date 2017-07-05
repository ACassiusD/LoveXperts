<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "index.php";
$description = "This is the default page for our website that contains usefull information about the website";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div id="welcome" class="container">
	<!-- Contemt -->
		<div class="title">
			<h2>WELCOME TO LOVEXPERTS</h2>
			<span class="byline">The dating experts of WEDE3301</span> 
		</div>
		<div class="content">
			<p>LoveXperts is a mock dating website currently being developed by Alex Donnelly, Dan Munusami and Geoff Veale for the Web Development class WEDE3201 at Durham College. During the development of this site we will be incorporating the pages to be fed by a database and be 100% functional. Users will be able to create an account, edit their profile, search users etc. Note this is not a real dating website and should not be used as such!</p>
		</div>
	</div>
</div>
 
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
