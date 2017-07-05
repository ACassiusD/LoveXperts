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
		
		if (isset($_SESSION['loggedin']) == false | $_SESSION['user_type'] != constant("CLIENT"))
		{
			header( "Location: dashboard.php" );
		}
		//Load the logged in users interest
		$user_interests_results = pg_execute($dbconn, "get_interests", array($_SESSION['user_id']));
		$results = pg_num_rows($user_interests_results);
		
		//Loading the users interested in logged in user
		$interester_users_results = pg_execute($dbconn, "get_interested", array($_SESSION['user_id']));
		$interested_results = pg_num_rows($interester_users_results);
		?>
		
		<table border="1" class="interests-table">
		<tr>
			<th>My Interests</th>
			<th>Interested In Me</th>
		</tr>
			<td>
			<?php
				//Builtd results if there are any
				if ($results != 0)
				{
					$user_interests = pg_fetch_all($user_interests_results);
					foreach($user_interests as $interest)
					{
						$userId = $interest['interested_in_id'];
						$similar_results = pg_execute($dbconn, "check_similar", array($userId, $_SESSION['user_id'] ));
						//If there is not a match
						if (pg_num_rows($similar_results) == 0)
						{	
							echo buildInterestResult($dbconn, $userId );  
						}
						//If there is a match
						else
						{
							echo buildInterestResultMatch($dbconn, $userId );  
						}

					}
				}
				else
				{
					echo "No interests found!";
				}
			?>
			</td>	
			<td>
			<?php
				//If there are results build them
				if ($interested_results != 0)
				{
					$interested_users = pg_fetch_all($interester_users_results);
					foreach($interested_users as $interest)
					{
						$userId = $interest['interested_id'];
						$similar_results = pg_execute($dbconn, "check_similar", array($_SESSION['user_id'],$userId  ));

						//If there is not a match
						if (pg_num_rows($similar_results) == 0)
						{	
							echo buildInterestedResult($dbconn, $userId );  
						}
						//If there is a match
						else
						{
							echo buildInterestedResultMatch($dbconn, $userId ); 	
						}											
					}
				}
				//If there are no results... thats pretty sad
				else
				{
					echo "No users currently interested.";
				}
				?>
			</td>		
		</table>
		<!-- CONTENT ENDS HERE -->
	</div>
</div>
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>