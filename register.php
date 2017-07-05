<!-- INCLUDING HEADER WITH PHP -->
<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "register.php";
$description = "This page will be used to host the form that will allow account creation for our website and store their information in our database";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">
	
	<!-- CONTENT GOES HERE -->

	<?php 
	//varibles to store the output and error messages
	$output = "";
	$error = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$login = "";
		$password = "";   
		$confirmpassword = "";
		$firstname = "";
		$lastname = "";
		$email = "";
		$dateofbirth = "";
	}

	else if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$login = trim($_POST['user_id']); 
		$password = trim($_POST['password']); 
		$confirmpassword = trim($_POST['conf_passwd']);
		$firstname = trim($_POST['first_name']);
		$lastname = trim($_POST['last_name']);
		$email = trim($_POST['email_address']);	
		$year =  $_POST['year'];
		$month = $_POST['month'];
		$day = $_POST['day'];
		
		$dateofbirth = $_POST['year'].$_POST['month'].$_POST['day'];
		$conn = db_connect();
	//error messages for invalid input
			if(strlen($login) < MINIMUM_ID_LENGTH)//if the username is too short message will be display
			{
				$error .= 'Username is too short, must be at least ' . MINIMUM_ID_LENGTH . ' characters long.<br/>';//error stores the message
				$login = "";
			}
		
			else if (strlen($login) > MAXIMUM_ID_LENGTH)//if the username is too long message will be display
			{
				$error .= 'Username is too long, must be no more than ' . MAXIMUM_ID_LENGTH . ' characters long.<br/>';
				$login = "";
			}
			
			else if (strlen($login) < MIN_INPUT)
			{
				$error .= $login . "Please enter a Username.<br/>";
				$login = "";
			}

			if(strlen($password) < MINIMUM_PASSWORD_LENGTH)//if the password is too short message will be display
			{
				$error .= 'Password invalid, must be between ' . MINIMUM_PASSWORD_LENGTH. ' and ' .MAXIMUM_PASSWORD_LENGTH. ' characters.<br/>';
			}
		
			else if(strlen($password) > MAXIMUM_PASSWORD_LENGTH)//if the password is too long message will be display
			{
				$error .= 'Password invalid, must be between ' . MINIMUM_PASSWORD_LENGTH. ' and ' .MAXIMUM_PASSWORD_LENGTH. ' characters.<br/>';
			}

			if($password !== $confirmpassword)//if the password is not the same as comfirm password
			{
				$error .= " Password and Confirm Password don't match.<br/>";
			}

			if(strlen($firstname) > MAX_FIRST_NAME_LENGTH)//if the first name is too long message will be display
			{
				$error .= $firstname . "First Name is too long.<br/>";
				$firstname = "";
			}
			
			else if (strlen($firstname) < MIN_INPUT)
			{
				$error .= $firstname . "Please input a First Name.<br/>";
				$firstname = "";
			}

			if(strlen($lastname) > MAX_LAST_NAME_LENGTH)//if the last name is too long message will be display
			{
				$error .= $lastname . "Last Name is too long.<br/>";
				$lastname = "";
			}
			
			else if (strlen($lastname) < MIN_INPUT)
			{
				$error .= $lastname . "Last Name is too short.<br/>";
				$lastname = "";
			}
			
			//Check if date is valid

			if ($_POST['year'] == "")
			{
				$error .= "Please select a year.<br/>";
				$dateofbirth = "";
			}
			else if ($_POST['month'] == "")
			{
				$error .= "Please select a month.<br/>";
				$dateofbirth = "";
			}	
			else if ($_POST['day'] == "")
			{
				$error .= "Please select a day..<br/>";
				$dateofbirth = "";
			}	
			else if (calculateAge($dateofbirth) < MIN_AGE)
			{
				$error .= "You must be at least 18 years old to register to this site.<br/>";
				$dateofbirth = "";
				$year = "";
				$month = "";
				$day = "";
			}
			if(strlen($email) > MAXIMUM_EMAIL_LENGTH)//if the email is too long message will be display
			{
				$error .= $email . "Your email is too long ";
				$email = "";
			}

			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))//checks if it's a valid email
			{
				$error .= $email . " Invalid email, Please enter a valid email ";
				$email = "";
			}

			if (empty ($error)) 
			{

				//$sql = "SELECT * FROM users WHERE user_id = '$login'";
				//$results = pg_query($conn, $sql);
				$results = pg_execute($dbconn, "user_login", array($login));
				
				if(pg_num_rows($results))//if the user already exists
				{ 
					$error .= $login . " User was Found Please Enter Another User"; 
					$login = "";
				} 
				else //if everything is valid, it will store the users data into users 
				{ 
					$date = date('Y-m-d');
					//$sql = "INSERT INTO users (user_id, password, first_name, last_name, email_address, birth_date, enroll_date)
					//VALUES ('$login', '$password', '$firstname', '$lastname', '$email', '$dateofbirth', '$date')";
					
					pg_execute($dbconn, "register_user", array($login, INCOMPLETE_CLIENT, MD5($password), $firstname, $lastname, $email, $dateofbirth));
					
					$_SESSION['fromRegister'] = "true";
					header("Location:account_created.php");
				}			
			}	
	}
		//displays the output and error
		echo $error;
		echo $output;
		//echo $dateofbirth;
		//echo calculateAge($dateofbirth);
		//echo $_POST['birth_date'];
	?>
	<!--form for user to enter data to register to the site-->
	<h2>Please register in our system</h2>
	<p>Please enter your personal information</p>

		<form id="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			<tr>
				<td><strong>Username</strong></td>
				<td><input type="text" name="user_id" value= "<?php echo $login ?>" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Password</strong></td>
				<td><input type="password" name="password" value= "" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Confirm Password</strong></td>
				<td><input type="password" name="conf_passwd" value="" size="20" /></td>
			</tr>
			<tr>
				<td><strong>First Name</strong></td>
				<td><input type="text" name="first_name" value="<?php echo $firstname ?>" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Last Name</strong></td>
				<td><input type="text" name="last_name"  value="<?php echo $lastname ?>" size="20" /></td>
			</tr>
				<tr>
				<td><strong>Date of Birth</strong></td>
				<td>
				<?php
				//Creating year select
				echo '<select name="year">';
				echo '<option></option>';
				//We let people older than 18 but less than 70 on the site
				for($i = date('Y', strtotime('-18 years')); $i >= date('Y', strtotime('-88 years')); $i--){
					//Make the drop down sticky when generating the values if one of the values is equal to the month
					if ($i == $year)
					{
						echo "<option value='$i' selected>" . $i . "</option>\n";
					}
					else
					{
						echo "<option value='$i'>$i</option>";
					}
				} 
				echo '</select>/';
				
				//Creating Month select
				echo '<select name="month">';
				echo '<option></option>';
				for($i = 1; $i <= 12; $i++){
					$i = str_pad($i, 2, 0, STR_PAD_LEFT);
					if ($i == $month)
					{
						echo "<option value='$i' selected>" . $i . "</option>\n";
					}
					else
					{
						echo "<option value='$i'>$i</option>";
					}
				}
				echo '</select>/';
				
				//Creating Day select
				echo '<select name="day">';
				echo '<option></option>';
				for($i = 1; $i <= 31; $i++){
					$i = str_pad($i, 2, 0, STR_PAD_LEFT);
					if ($i == $day)
					{
						echo "<option value='$i' selected>" . $i . "</option>\n";
					}
					else
					{
						echo "<option value='$i'>$i</option>";
					}
				}
				echo '</select>';
				?>
				</td>
				<!--<td><input type="text" name="birth_date"  value="<?php //echo $dateofbirth ?>" size="20" /></td> -->
			</tr>
			<tr>
				<td><strong>Email Address</strong></td>
				<td><input type="text" name="email_address" value="<?php echo $email ?>" size="20" /></td>
			</tr>

			</table>
			<table border="0" cellspacing="15" >
		<tr>
			<td><input type="submit" value = "Register" /></td><td><input type="reset" value = "Clear" /></td>
		</tr></table>
		</form>
		<p>Already have an account? <a href="./login.php">Click Here </a><br/></p>
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
