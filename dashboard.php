<!-- Dashboard -->


<!-- INCLUDING HEADER WITH PHP -->

<?php

#VARIABLES
$date = "2015-30-09";
$filename = "dashboard.php";
$description = "This page will be where users are redirected when they log in";	

include './includes/header.php';
?>

<div id="wrapper1">

	<div class="content">
	
	<?php
		//Checks if the user is logged in and displays a personal message'
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
		{
			//Creating the output
			$output = "Welcome ".$_SESSION['first_name']." ". $_SESSION['last_name']." AKA ".$_SESSION['user_id']."<br/>".
			 "Your email is: ". $_SESSION['email_address']."<br/>".					 
			 "You enrolled: ". $_SESSION['enroll_date']."<br/>".
			 "You last logged in : ". $_SESSION['last_access']."<br/>".
			 "Todays date is: ". $date;	
			 
			//Checks to see if the user is a complete users
			//If user is incomplete add a line onto the output to ask user to fill out profile
			if ($_SESSION['user_type'] == constant("INCOMPLETE_CLIENT"))
			{
				$output = $output."<br/> <b>-IMPORTANT- </b>  Please fill out profile information <a href='".constant("CREATE_PROFILE_ADDRESS")."'>HERE</a> <b> -IMPORTANT-</b>";
			}
		} 
		else 
		{
			$output = "Please log in";
		}
			echo $output
		?>
		<div id="welcome" class="container">
			<div class="title">
				<h2>WELCOME TO LOVEXPERTS</h2>
				<span class="byline">Why wait to met your perfect partner? Search for your perfect partner now.</span> 
			</div>
			<img src="./images/happy-couple.jpg" alt="Happy Couple" style="width:304px;height:228px;"></img>
			<img src="./images/trust-forgive.jpg" alt="Happy Couple" style="width:304px;height:228px;"></img>
			<img src="./images/WineCouple.jpg" alt="Happy Couple" style="width:304px;height:228px;"></img>
		</div>
	</div>
</div>
 
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
