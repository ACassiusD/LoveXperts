<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "create_profile.php";
$description = "This page will be used to hold the form that will let users edit their profile and
change the information in our database";	

include './includes/header.php';
?>


<div id="wrapper1">
	<div class="content">
        <?php
            //If not user is logged in, Send them to Login page
            if($_SESSION['loggedin'] == true)
            {
				//If the form is accessed normally
                if($_SERVER["REQUEST_METHOD"] == "GET")
                {
					//Set the variables to default
                    $gender= 0;
                    $gender_sought = 0;   
                    $city = 0;
                    $intent = 0;
                    $education = 0;
                    $ethnicity = 0;
                    $profession = 0;
                    $has_children = 0;
                    $body_type = 0;
                    $drinks = 0;
                    $religion = 0;
                    $hair_colour = 0;
                    $marital_status = 0;
                    $headline = "";
                    $selfDescription = "";
                    $matchDescription = "";
					
					//If user is already a completed user or an admin fill their information in
					if($_SESSION['user_type'] == 'a' || $_SESSION['user_type'] == 'c')
					{
						$result = pg_execute($dbconn, "profile_query", array($_SESSION['user_id']));
						$userInfo = pg_fetch_assoc($result);
						
						$gender = $userInfo['gender'];	
	                    $gender_sought = $userInfo['gender_sought'];
						$city = $userInfo['city'];
						$intent = $userInfo['intent'];
						$education = $userInfo['education'];
						$ethnicity = $userInfo['ethnicity'];
						$profession = $userInfo['profession'];
						$has_children = $userInfo['has_children'];
						$body_type = $userInfo['body_type'];
						$drinks = $userInfo['drinks'];
						$religion = $userInfo['religion'];
						$hair_colour = $userInfo['hair_colour'];
						$marital_status = $userInfo['marital_status'];
						$headline = $userInfo['headline'];
						$selfDescription = $userInfo['self_description'];
						$matchDescription = $userInfo['match_description'];				
					}
                }
                //When the form is submitted
                else if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $error ="";
                
				extract ($_POST);
                    //Grab text from textboxes
                    $headline = trim($_POST['headline_box']);
                    $selfDescription = trim($_POST['self_description_box']);
                    $matchDescription = trim($_POST['match_description_box']);
                    
                    //Check to make sure they are long enough
                    if(strlen($headline) < 5) 
                    {
                        $error .= "Headline needs to be at least 5 characters long<br/>";  
                    }
                    if(strlen($selfDescription) < 5)
                    {
                        $error .= "Self Description needs to be at least 5 characters long<br/>";
                    }   
                    if(strlen($matchDescription) < 5)
                    {
                        $error .= "Match Description needs to be at least 5 characters long<br/>";
                    }
                    //Make sure gender is checked
					if(!isset($_POST['gender'])){
                    
                        $error .= "Gender must be checked";
                    }
					if(!isset($_POST['gender_sought']))
                    {    
                        $error .= "Gender sough must be checked"; 
                    }
					//If no errors
                    if(empty($error)) {                   
                       
                        //Grab data from dropdown boxes and set them equal to the variables
                        $city = $_POST['city'];
                        $gender= $_POST['gender'];
                        $gender_sought = $_POST['gender_sought']; 
                        $intent = $_POST['intent'];
                        $education = $_POST['education'];
                        $ethnicity = $_POST['ethnicity'];
                        $profession = $_POST['profession'];
                        $has_children = $_POST['has_children'];
                        $body_type = $_POST['body_type'];
                        $drinks = $_POST['drinks'];
                        $religion = $_POST['religion'];
                        $hair_colour = $_POST['hair_colour'];
                        $marital_status = $_POST['marital_status'];
                        $images = 0;
						
						//UPDATE SESSION
						$_SESSION['gender'] = $gender;
						$_SESSION['gender_sought'] = $gender_sought;											
						$_SESSION['city'] = $city;
						$_SESSION['intent'] = $intent;
						$_SESSION['education'] = $education;
						$_SESSION['ethnicity'] = $ethnicity;
						$_SESSION['profession'] = $profession;
						$_SESSION['has_children'] = $has_children;
						$_SESSION['body_type'] = $body_type;
						$_SESSION['drinks'] = $drinks;
						$_SESSION['religion'] = $religion;
						$_SESSION['hair_colour'] = $hair_colour;
						$_SESSION['marital_status'] = $marital_status;
						$_SESSION['headline'] = $headline;
						$_SESSION['self_description'] = $selfDescription;
						$_SESSION['match_description'] = $matchDescription;							
						
                        //query the database to see if the user need to create or update the profile
                         $result = pg_execute($dbconn, "profile_query", array($_SESSION['user_id']));
                        //If there are no profile table for that user, Make one
                        if(pg_num_rows($result) == 0)
                        {
                            pg_execute($dbconn, "Make_New_Profile", array($_SESSION['user_id'],$gender,$gender_sought,calculateAge($_SESSION['birth_date']),$city,$intent,$education,$ethnicity, $profession, $has_children, $body_type, $drinks,$religion,$hair_colour,$marital_status,$headline,$selfDescription,$matchDescription,$images));
                            $error .= "Profile Created successfully";
                            pg_execute($dbconn, "Update_incompelete" , array('c',$_SESSION['user_id']));
							//update session 
							$_SESSION['user_type'] = CLIENT;		
                        }
                        //If there is a profile already created, Update the old one with new input
                        else
                        {
                            pg_execute($dbconn, "profile_update", array($_SESSION['user_id'],$gender,$gender_sought, $city,$intent,$education,$ethnicity, $profession, $has_children, $body_type, $drinks,$religion,$hair_colour,$marital_status,$headline,$selfDescription,$matchDescription));
                            $error .= "Profile Updated Successfully";
                        }
                 
                    }
                    echo $error;
                }
            }
            else 
            {
                header( "Location: login.php" ); 
            } 
		
		if ($_SESSION['user_type'] == 'i')
		{
			echo "<h2>Create Profile</h2>";
		}
		else
		{
			echo "<h2>Update Profile</h2>";
		}

	   ?> 

	<!-- form for create profile -->
		<form id="input" method="post" style="width:800px" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            
			<!-- A table for users profile info that doesnt not require typing in something -->
            <table>
				<tr>
					<td><strong>Sex:</strong></td>
					<td> <?php buildRadio($dbconn, GENDER_TABLE, $gender);?></td>
					
					<td><strong>Body Type:</strong></td>
					<td><?php buildDropDown($dbconn, BODY_TABLE, $body_type);?></td>
				</tr>
				<tr>
					<td><strong>Sex Interested In:</strong></td>
					<td><?php buildRadio($dbconn, GENDER_SOUGHT_TABLE, $gender_sought);?></td>
					
					<td><strong>Occupation:</strong></td>
					<td><?php buildDropDown($dbconn,PROFESSION_TABLE, $profession)?></td>
				</tr>
					
				<tr>
					<td><strong>City:</strong></td>
					<td><?php buildDropDown($dbconn, CITY_TABLE, $city);?></td>
					
					<td><strong>Hair Colour:</strong></td>
					<td><?php buildDropDown($dbconn,HAIR_TABLE, $hair_colour);?></td>
				</tr>
					
				<tr>
					<td><strong>Religion:</strong></td>
					<td> <?php buildDropdown($dbconn, RELIGION_TABLE, $religion);?></td>
					
					<td><strong>Education:</strong></td>
					<td><?php buildDropDown($dbconn,EDUCATION_TABLE, $education);?></td>
				</tr>
				<tr>
					<td><strong>Relationship Status:</strong></td>
					<td><?php buildDropDown($dbconn, MARITAL_STATUS_TABLE, $marital_status);?></td>
					
					<td><strong>Ethnicity:</strong></td>
					<td><?php buildDropDown($dbconn, ETHNICITY_TABLE, $ethnicity);?></td>
				</tr>
				<tr>
					<td><strong>Intent:</strong></td>
					<td><?php buildDropdown($dbconn, INTENT_TABLE, $intent);?></td>

					<td><strong>Drinks:</strong></td>
					<td><?php buildDropdown($dbconn, DRINKS_TABLE, $drinks);?></td>
				</tr>
				<tr>
					<td><strong>Has Children?:</strong></td>
					<td><?php buildDropDown($dbconn, HAS_CHILDREN_TABLE, $has_children);?></td>
				</tr>
			</table>
            
			<!-- A table for the users headline, self description and match description -->
            <table>
                <tr>
                    <td>
                        <p>Headline</p>
                        <input type="text" name="headline_box" value="<?php echo $headline ?>" class="headline"/></input>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Self Description</p>
                        <textarea type="text" name="self_description_box" class="wideInput" /><?php echo $selfDescription ?></textarea>
                    </td>
                </tr>
                <tr>

                    <td>
						<p>Match Description</p>
                        <textarea type="text" name="match_description_box" class="wideInput" ><?php echo $matchDescription ?></textarea>
                    </td>
                </tr>
				    <td><input type="submit" value="Submit Info" /></td>
            </table>

		</form>
	</div>
</div>

<!-- INCLUDING HEADER WITH PHP -->
<?php include './includes/footer.php';?>