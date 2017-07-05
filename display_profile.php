<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "display_profile.php";
$description = "This page will be where users can edit and look at their profiles";	

include './includes/header.php';
?>
<!-- CONTENT GOES HERE -->


<!-- About Me -->
<div id="wrapper1">
	<div class="content" >
    <?php
		//Define varaibles to hold content
		$userID	= $_SESSION['user_id'];	
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		$age = $_SESSION['age'];
		$gender ="";
		$genderSought ="";						
		$city = "";
		$intent = "";
		$education = "";
		$ethnicity = "";
		$profession = "";
		$hasChildren = ""; 				
		$bodyType = "";
		$drinks = ""; 
		$religion = "";
		$hairColor = "";
		$maritalStatus = ""; 
		$headline = ""; 
		$selfDescription = ""; 
		$matchDescrtiption = ""; 
		
		//For profile picture
		$folder = UPLOAD_TO_FOLDER . "/" . $_SESSION['user_id'];
		
		//Find out if page was passed a profile id. If no id was send fill in logged in users information
		//If user is not logged in send them to log in page
		if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true)
		{			
			
            
            //If the user is an incomplete client and does not have a profile.
			if ($_SESSION['user_type'] == INCOMPLETE_CLIENT)
			{
				$error = "You have not created a profile yet. Create your profile <a href=./create_profile.php>Here!</a>";
				echo $error;
			}
			else
			{
				//If paged was passed a user id, User is not looking at their own profile
				if(isset($_GET['passedUserId']))
				{			
					$userID = $_GET['passedUserId'];
					
					//Get user info
					$userResult = pg_execute($dbconn, "user_login", array($userID));
					$userInfo = pg_fetch_assoc($userResult);
					$firstName = $userInfo['first_name'];
					$lastName = $userInfo['last_name'];
					$age = calculateAge($userInfo['birth_date']);
					$userType = $userInfo['user_type'];			
					
					//Get profile into
	
					$profileResult = pg_execute($dbconn, "profile_query", array($userID));
					$userInfo = pg_fetch_assoc($profileResult);
					
					$gender = getProperty($dbconn, $userInfo['gender'] , GENDER_TABLE);
					$genderSought = getProperty($dbconn, $userInfo['gender_sought'], GENDER_SOUGHT_TABLE);								
					$city = getProperty($dbconn, $userInfo['city'], CITY_TABLE); 
					$intent = getProperty($dbconn, $userInfo['intent'], INTENT_TABLE); 
					$education = getProperty($dbconn, $userInfo['education'], EDUCATION_TABLE); 
					$ethnicity = getProperty($dbconn, $userInfo['ethnicity'], ETHNICITY_TABLE);
					$profession = getProperty($dbconn, $userInfo['profession'], PROFESSION_TABLE);
					$hasChildren = getProperty($dbconn, $userInfo['has_children'], HAS_CHILDREN_TABLE); 				
					$bodyType = getProperty($dbconn, $userInfo['body_type'], BODY_TABLE);
					$drinks = getProperty($dbconn, $userInfo['drinks'], DRINKS_TABLE); 
					$religion = getProperty($dbconn, $userInfo['religion'], RELIGION_TABLE);
					$hairColor = getProperty($dbconn, $userInfo['hair_colour'], HAIR_TABLE);
					$maritalStatus = getProperty($dbconn, $userInfo['marital_status'], MARITAL_STATUS_TABLE);
					$headline = $userInfo['headline'];
					$selfDescription = $userInfo['self_description'];
					$matchDescrtiption = $userInfo['match_description'];	
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                    
                        //Determine what button was pressed to do what action
                        if(isset($_POST['btnDisable']))
                        {
                            //This Admin-Only button disables the user, Changes any reports of this user to closed. Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "update_user_type", array($userID, DISABLED_CLIENT));
                            pg_execute($dbconn, "close_report", array($userID));
                            echo "<p>Account disabled</p>"; 
                            header("Refresh:3 ");
                            
                        }
                        if(isset($_POST['btnRenable']))
                        {
                            //This Admin-Only button Updates the user type to Client. Meaning they can log in. Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "update_user_type", array($userID, CLIENT)); 
                            echo "<p>Account renabled</p>";
                            header("Refresh:3 ");
                        }
                        if(isset($_POST['btnInterested']))
                        {
                            //This button Inserts a interest into the interest table Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "insert_interest", array($_SESSION['user_id'],$userID, date("Y-m-d h:i:s a")));
                            echo "<p>Shown Interest for ". $userID ."</p>";
                            header("Refresh:3 ");
                        }
                        if(isset($_POST['btnNotInterested']))
                        {
                            //This button removes interest in the user Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "remove_interest", array($_SESSION['user_id'],$userID));
                            echo "<p>No longer Interested by ". $userID ."</p>";
                            header("Refresh:3 ");
                        }
                        if(isset($_POST['btnReport']))
                        {
                            //This button allows users to send a Report to the admin of offensive content Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "insert_report",array($_SESSION['user_id'],$userID, OPEN_REPORT, date("Y-m-d h:i:s a")));
                            echo "<p>Thank you for reporting.</p>";
                            header("Refresh:3 ");
                        }
                        
                        if(isset($_POST['btnNotOffencive']))
                        {
                            //This Admin-Only button Allows the admin to determine if a report is not offensive. Show a message and refresh the page after 3 secs
                            pg_execute($dbconn, "close_report", array($userID));
                            echo "<p>Report is closed</p>";
                            header("Refresh:3 ");
                        }
                        
                    }

                }
                    //User is looking at their own profile
				else
				{
                    echo "<p>This is what your account looks to others</p>";
					$gender = getProperty($dbconn, $_SESSION['gender'] , GENDER_TABLE);
					$genderSought = getProperty($dbconn, $_SESSION['gender_sought'], GENDER_SOUGHT_TABLE);				
					
					//GET AGE					
					$city = getProperty($dbconn, $_SESSION['city'], CITY_TABLE); 
					$intent = getProperty($dbconn, $_SESSION['intent'], INTENT_TABLE); 
					$education = getProperty($dbconn, $_SESSION['education'], EDUCATION_TABLE); 
					$ethnicity = getProperty($dbconn, $_SESSION['ethnicity'], ETHNICITY_TABLE);
					$profession = getProperty($dbconn, $_SESSION['profession'], PROFESSION_TABLE);
					$hasChildren = getProperty($dbconn, $_SESSION['has_children'], HAS_CHILDREN_TABLE); 				
					$bodyType = getProperty($dbconn, $_SESSION['body_type'], BODY_TABLE);
					$drinks = getProperty($dbconn, $_SESSION['drinks'], DRINKS_TABLE); 
					$religion = getProperty($dbconn, $_SESSION['religion'], RELIGION_TABLE);
					$hairColor = getProperty($dbconn, $_SESSION['hair_colour'], HAIR_TABLE);
					$maritalStatus = getProperty($dbconn, $_SESSION['marital_status'], MARITAL_STATUS_TABLE);
					$headline = $_SESSION['headline'];
					$selfDescription = $_SESSION['self_description'];
					$matchDescrtiption = $_SESSION['match_description'];	
				}	
			
            }
        }//User is not logged in.
		else
		{
			//Send user to login
			header( "Location: login.php" );
			//Write a message to use in login page.
			$_SESSION['viewProfileError'] = "!ERROR! You must log in to view a profile";
		}
	?>    
        
         <?php 
        if(isset($_GET['passedUserId']))
        {
            if($_SESSION['user_type'] == ADMIN)
            {
                //If the user is looking at another profile and is an admin
                $userTypeToString;
                       
                
                //Show him the type of user the viewing user is
                switch($userType){
                    case ADMIN:
                         $userTypeToString = "Admin" ;
                        break;
                     case DISABLED_CLIENT:
                        $userTypeToString = "Disabled" ;
                        break;
                    case INCOMPLETE_CLIENT:
                        $userTypeToString = "Incomplete" ;
                        break;
                    default:
                        $userTypeToString = "Complete";
                }
                
                echo "<p> This user is currently a " . $userTypeToString . " user </p>";
                echo '<form id="Input" method="post" action="" > ';
                
                
                //Display a button, One for disabled users to be renables and everyone else to be disabled
                if($userType != DISABLED_CLIENT)
                {
                    echo '<input type="submit" name="btnDisable" value = "Disable" />';
                }
                else
                {
                    echo '<input type="submit" name="btnRenable" value = "Renable" />';
                }
                
                //Check to see if they have been reported. If they have been reported. Display a Not offensive button
                $results = pg_execute($dbconn, "Has_been_reported",array($_GET['passedUserId']));
                $count = pg_num_rows($results);
                if($count > 0)
                {
                    echo '<input type="submit" name="btnNotOffencive" value = "Not Offensive" />';    
                }
                
                
                echo '</form>';
            }
        }
        ?>
        
        
       
		
	<h2><?php echo $headline ?></h2>
	<table class="center" border="1" width="1000">
		<tr>
			<td style="height:275px; width:275px;">
			<?php //Profile image
        
        //If the user is currently looking at another profile
        if(isset($_GET['passedUserId']))
        {
            if(file_exists("$folder/image0.jpg"))
			{
				//Display first picture in the folder 
				echo "<img src='$folder/image0.jpg' width='150' height='150' alt='Display Profile'></img>";
			}
			else
			{
				//else display deafult image
				echo "<img src='images/EmptyProfile.jpg' width='150' height='150' alt='Display Profile'></img>";
			}
        }
        else
        {
            if(file_exists("$folder/image0.jpg"))
			{
				//Display first picture in the folder
				echo "<img src='$folder/image0.jpg' width='150' height='150' alt='Display Profile'></img>";
				echo "<p>Change image <a href='./profile_images.php'>Here!</a></p>";
			}
			else
			{
				//else display deafult image
				echo "<img src='images/EmptyProfile.jpg' width='150' height='150' alt='Display Profile'></img>";
				echo "<p>No pictures uploaded, Upload pictures <a href='./profile_images.php'>Here!</a></p>";
			}  
        }
			?>
			</td>
			<td>
				<h1><u>Self Description</u></h1> <br/><br/>
				<?php echo $selfDescription ?>
			</td>			
		</tr>
		<tr>
			<td>
				<table border="0">
					<tr>
						<td>Username:</td>
						<td><?php echo $userID ?></td>
					</tr>	
					<tr>
						<td>Real Name:</td>
						<td><?php echo $firstName.' '.$lastName ?></td>
					</tr>					
					<tr>
						<td>Sex:</td>
						<td><?php echo $gender ?></td>
					</tr>						
					<tr>
						<td>Interested in:</td>
						<td><?php echo $genderSought ?></td>
					</tr>						
					<tr>
						<td>City:</td>
						<td><?php echo $city ?></td>
					</tr>						
					<tr>
						<td>Body Type:</td>
						<td><?php echo $bodyType ?></td>
					</tr>						
					<tr>
						<td>Occupation:</td>
						<td><?php echo $profession ?></td>
					</tr>							
					<tr>
						<td>Religion:</td>
						<td><?php echo $religion ?></td>
					</tr>									
					<tr>
						<td>Age:</td>
						<td><?php echo $age ?></td>
					</tr>								
					<tr>
						<td>Ethnicity:</td>
						<td><?php echo $ethnicity ?></td>
					</tr>
					<tr>
						<td>Education:</td>
						<td><?php echo $education ?></td>
					</tr>						
					<tr>
						<td>Hair Color:</td>
						<td><?php echo $hairColor ?></td>
					</tr>
					<tr>
						<td>Relationship Status:</td>
						<td><?php echo $maritalStatus ?></td>
					</tr>
					<tr>
						<td>Intent:</td>
						<td><?php echo $intent ?></td>
					</tr>						
					<tr>
						<td>Has Children:</td>
						<td><?php echo $hasChildren ?></td>
					</tr>	
					<tr>
						<td>Drinks:</td>
						<td><?php echo $drinks ?></td>
					</tr>	
				</table>
				</td>
				<td>
					<h1><u>Match Description</u></h1> <br/><br/>
					<?php echo $matchDescrtiption ?>
				</td>
			</tr>
        <tr>
            <td>
                <form action="" method="post">
                    <?php 
                        if(isset($_GET['passedUserId']))
                        
                        {
                            //Check to see if the user has liked this viewing user before
                            $results = pg_execute($dbconn,"interest_query", array($_SESSION['user_id'],$_GET['passedUserId']));
                            
                            $count = pg_num_rows($results);
                            //If Not
                            if($count == 0)
                            {
                                //Show him 
                                echo '<input type="submit" name=\'btnInterested\' value = "Show Interest" />';     
                            }
                            else
                            {
                                echo '<input type="submit" name=\'btnNotInterested\' value = "Not Interested" />';    
                            }
                            $reportResults = pg_execute($dbconn, "report_query" , array($_SESSION['user_id'],$_GET['passedUserId']));
                            $reportCount = pg_num_rows($reportResults);
                            if($reportCount == 0)
                            {
                                echo '<input type="submit" name=\'btnReport\' value = "Report User" />';
                            }
                            else
                            {
                                echo '<p>Already reported</p>';    
                            }
                        }

                    ?>
                    
                </form>
            </td>
        </tr>
				
		</table>
		
	</div>
		
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
