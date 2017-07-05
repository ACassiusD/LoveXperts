<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "login.php";
$description = "This is where users will be able to log into our their account securly through our database";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">
	
		<!-- CONTENT GOES HERE -->

		<?php
			//Declaring variables for login password and output.
			$login = "";
			//Making login sticky with cookie
			if(isset($_COOKIE['LoginCookie']))
			{
				$login = $_COOKIE['LoginCookie'];
				$password = "";
				$output = "";
			}
                
			if(isset($_SESSION['Passwordmessage']))
			{
				echo $_SESSION['Passwordmessage'];
			}


			//Only preform processing when form has been submitted
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				
				//Retrieve information from the form and store them in the proper variables
				$login = trim($_POST['login']);
				$password = md5(trim($_POST['pass']));
				
				//Execute the prepared query and storing the results
				$result = pg_execute($dbconn, "login_query", array($login, $password));
				
				//Storing the number of records found from the query
				$records = pg_num_rows($result);			
				
				//If a single record was found
				if ($records ==1) 
				{
					
					//Storing the only results  into variables for use
					$userInfo = pg_fetch_assoc($result);
					
					//Taking the user info and storing it into the session
					$_SESSION['loggedin'] = true;
					$_SESSION['user_id'] = $userInfo['user_id'];					
					$_SESSION['age'] = calculateAge($userInfo['birth_date']);
					$_SESSION['user_type'] = $userInfo['user_type'];				
					$_SESSION['first_name'] = $userInfo['first_name'];
					$_SESSION['last_name'] = $userInfo['last_name'];
					$_SESSION['email_address'] = $userInfo['email_address'];
					$_SESSION['birth_date'] = $userInfo['birth_date'];
					$_SESSION['enroll_date'] = $userInfo['enroll_date'];
					$_SESSION['last_access'] = $userInfo['last_access'];
					
					//Decalres a date varaible
					$date = date("Y-m-d h:i:s a");
										
					//Updates users last access time
					pg_execute($dbconn, "update_last_access", array($date, $login));
					
					//Set up a cookie for the users login id for 30 days
					setcookie("LoginCookie", $userInfo['user_id'], constant("30_DAY_COOKIE") ); /* expire in 30 days*/
					
					//Check if the user is a complete user or admin and store their profile information in the session
					if ($_SESSION['user_type'] == constant("CLIENT") || $_SESSION['user_type'] == constant("ADMIN"))
					{
						//Query and retreve users profile info
						$profileResult = pg_execute($dbconn, "profile_query", array($login));
						
						$userInfo = pg_fetch_assoc($profileResult);
						
						//Store users profile info in session
						$_SESSION['gender'] = $userInfo['gender'];	
						$_SESSION['gender_sought'] = $userInfo['gender_sought'];				
						$_SESSION['city'] = $userInfo['city'];
						$_SESSION['intent'] = $userInfo['intent'];
						$_SESSION['education'] = $userInfo['education'];
						$_SESSION['ethnicity'] = $userInfo['ethnicity'];
						$_SESSION['profession'] = $userInfo['profession'];
						$_SESSION['has_children'] = $userInfo['has_children'];					
						$_SESSION['body_type'] = $userInfo['body_type'];
						$_SESSION['drinks'] = $userInfo['drinks'];
						$_SESSION['religion'] = $userInfo['religion'];
						$_SESSION['hair_colour'] = $userInfo['hair_colour'];
						$_SESSION['marital_status'] = $userInfo['marital_status'];
						$_SESSION['headline'] = $userInfo['headline'];
						$_SESSION['self_description'] = $userInfo['self_description'];
						$_SESSION['match_description'] = $userInfo['match_description'];	
						
					}
                    if($_SESSION['user_type'] == constant("ADMIN"))
                    {
                        header( "Location: admin.php" );
                    }
					else if ($_SESSION['user_type'] == constant("DISABLED_CLIENT") && $_SESSION['loggedin'] == true)
					{
						$output = "Sorry but your account has been ban from this website.";
					}
                    else
                    {
					   header( "Location: dashboard.php" );
                    }

				}
				else
				{
					//Execute the prepared query and storing the results 
					$login_id_results = pg_execute($dbconn, "id_query", array($login));
					
					//Storing the number of records found from the query
					$login_id_records = pg_num_rows($login_id_results);
					
					if ($login_id_records == 1) 
					{
						$password = "";
						$output="<h3> <br/> Password is incorrect </h3>";
					}
					else
					{
						$login = "";
						$password = "";
						$output="<h3> <br/> Login/password not found in the database </h3>";
					}
				}	
				echo $output;
			}  
			
		
		//Display any errors and clean them up
		if (isset($_SESSION['viewProfileError']) AND $_SESSION['viewProfileError'] != "")
		{
			echo $_SESSION['viewProfileError'];
			$_SESSION['viewProfileError'] ="";
		}
		?>	
		<!-- Making the login form -->
		<form id="Input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			<tr>
				<td><strong>Login ID</strong></td>
				<td><input type="text" name="login" value="<?php echo htmlspecialchars($login); ?>" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Password</strong></td>
				<td><input type="password" name="pass" value="<?php echo htmlspecialchars($password); ?>" size="20" /></td>
			</tr>
			</table>
			<table border="0" cellspacing="15" >
			<tr>
				<td><input type="submit" value = "Log In" /></td>
			</tr>
			</table>
		</form>
		
		<p>
			Need an account? Create one <a href="./register.php">Here!</a>
		</p>
        <p>
			Forgot your password? Request a new one <a href="./request_password.php">Here!</a>
		</p>
		
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>