<?php

#VARIABLES
$date = "2015-30-09";
$filename = "admin.php";
$description = "This page will be where users are redirected when they log in";	

include './includes/header.php';
?>

<div id="wrapper1">

	<div class="content">
	
	<?php
		//Checks if the user is logged in and displays a personal message'
		if ($_SESSION['user_type'] == constant("ADMIN") && $_SESSION['loggedin'] == true)
		{
			//Creating the output
			$output = "Welcome Admin ".$_SESSION['first_name']." ". $_SESSION['last_name']." AKA ".$_SESSION['user_id']."<br/>".
			 "Your email is: ". $_SESSION['email_address']."<br/>".					 
			 "You enrolled: ". $_SESSION['enroll_date']."<br/>".
			 "You last logged in : ". $_SESSION['last_access']."<br/>".
			 "Todays date is: ". $date;	
		} 
		else 
		{
			header( "Location: dashboard.php" );
		}
			echo $output
		?>
		<div id="welcome" class="container">
			<div class="title">
				<h2>Admin Page</h2>
				
                <h1><a href="disabled_user.php" >View Disabled Users</a></h1>
			</div>
            <h2>Offensive Reports</h2>
                    <?php
                    
                    $results = pg_execute($dbconn,"gather_reports",array("O"));
                    $count = pg_num_rows($results);
                    if($count > 0)
                    {
                        echo '<table border="1" class="center"><tr><th>Reported user</th><th>Status</th><th>Reported by</th><th>Date Reported</th></tr>';
                        while($row = pg_fetch_assoc($results))
                        {
                        
                        echo "<tr><td><a href=\"./display_profile.php?passedUserId=". $row['offending_id'] . "\">" . $row['offending_id'] . "</a></td>:";
                        echo '<td>'. $row['status'] . '</td>';
                        echo "<td><a href=\"./display_profile.php?passedUserId=". $row['reporting_id'] . "\">" . $row['reporting_id'] . "</a></td><td>". $row['reporting_time'] . "</td></tr> "; 
                        }
                        echo '</table>';
                    }
                    else
                    {
                        echo '<h1>There are currently no offensives to view</h1>';    
                    }
                    
                    ?>
            
            
            
		</div>
	</div>
</div>
 
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
