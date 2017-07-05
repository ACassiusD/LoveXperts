<!-- INCLUDING HEADER WITH PHP -->
<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-11-17";
$filename = "user_update.php";
$description = "This page will allow the user to update their user info";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">

<?php 
	//Taking the session informations and storing it into the form
	$output = "";
	$error = "";
	$numberOfErrors = 0;
	$userID	= $_SESSION['user_id'];	
	$firstName = $_SESSION['first_name'];
	$lastName = $_SESSION['last_name'];
	$age = $_SESSION['age'];
	$email = $_SESSION['email_address'];
	$dateofbirth = $_SESSION['birth_date'];
	$dateArray = explode('-', $dateofbirth);
	$year=$dateArray[0];
	$month=$dateArray[1];
	$day=$dateArray[2];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		
		if ($_POST['first_name'] != $firstName)
		{

			
			if(strlen($_POST['first_name']) > MAX_FIRST_NAME_LENGTH)//if the first name is too long message will be display
			{
				$error .= $_POST['first_name'] . "First Name is too long.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
			else if (strlen($_POST['first_name']) < MIN_INPUT)
			{
				$error .= $_POST['first_name'] . "Please input a First Name.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
			else
			{
				$firstName = $_POST['first_name'];
			}

		}
	

		if ($_POST['last_name'] != $lastName)
		{
			if(strlen($_POST['last_name']) > MAX_LAST_NAME_LENGTH)//if the last name is too long message will be display
			{
				$error .= $_POST['last_name'] . "Last Name is too long.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
			
			else if (strlen($_POST['last_name']) < MIN_INPUT)
			{
				$error .= $_POST['last_name'] . "Last Name is too short.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
			else
			{
				$lastName = $_POST['last_name'];
			}
		}
		
		if ($_POST['year'] == "")
			{
				$error .= "Year can not be blank.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
		else if ($_POST['month'] == "")
			{
				$error .= "Month can not be blank.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}	
		else if ($_POST['day'] == "")
			{
				$error .= "Day can not be blank.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			}
		else
		{
			$dateofbirth = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			}
		
		if (calculateAge($dateofbirth) < MIN_AGE)
			{
				$error .= "The date entered is not permitted.<br/>";
				$numberOfErrors = $numberOfErrors + 1;
			
			}
		
		
		if ($_POST['email_address'] != $email)
		{
			if(strlen($_POST['email_address']) > MAXIMUM_EMAIL_LENGTH)//if the email is too long message will be display
			{
				$error .= $_POST['email_address'] . "Your email is too long ";
				$numberOfErrors = $numberOfErrors + 1;
			}

			else if(!filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL))//checks if it's a valid email
			{
				$error .= $_POST['email_address'] . " Invalid email, Please enter a valid email ";
				$numberOfErrors = $numberOfErrors + 1;
			}
			else
			{
				$email = $_POST['email_address'];
			}
		}
		
		if ($numberOfErrors == 0)
		{
			pg_execute($dbconn, "update_user", array($_SESSION['user_id'], $firstName, $lastName, $email, $dateofbirth));
			echo "Update was Successful!";
			$_SESSION['age'] = calculateAge($dateofbirth);
			$_SESSION['first_name'] = $firstName;
			$_SESSION['last_name'] = $lastName;
			$_SESSION['email_address'] = $email;
			$_SESSION['birth_date'] = $dateofbirth;
			
		}
		else
		{
			echo "<h3>".$error."</h3>";
			echo "there was an error";
		}
		
		//$lastName = $_SESSION['last_name'];
		//$age = $_SESSION['age'];
		//$email = $_SESSION['email_address'];
		//$dateofbirth = $_SESSION['birth_date'];
		
	}	
		
			
				
		//displays the output and error


		//echo $dateofbirth;
		//echo calculateAge($dateofbirth);
		//echo $_POST['birth_date'];
	?>

		<form id="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			<tr>
				<td><strong>Username</strong></td>
				<td><?php echo $userID ?></td>
			</tr>
			<tr>
				<td><strong>First Name</strong></td>
				<td><input type="text" name="first_name" value="<?php echo $firstName ?>" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Last Name</strong></td>
				<td><input type="text" name="last_name"  value="<?php echo $lastName ?>" size="20" /></td>
			</tr>
			<tr>
				<td><strong>Age</strong></td>
				<td><?php echo calculateAge($dateofbirth) ?></td>
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
			</tr>
			<tr>
				<td><strong>Email Address</strong></td>
				<td><input type="text" name="email_address" value="<?php echo $email ?>" size="20" /></td>
			</tr>
		<tr>
			<td><input type="submit" value = "Update" /></td>
		</tr>
		</table>
		</form>
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
