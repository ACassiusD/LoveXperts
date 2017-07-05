<?php 
//This the the file that will hold all of the databse commands using pg_prepare

//A function that will connect to the local database
function db_Connect( )
{
	//connect to the database (replace with a function)
	$conn = pg_connect("host=127.0.0.1 dbname=lovexpertsDB user=Admin password=password"); 
	return $conn;
}	

//Set up the database connection
$dbconn = db_Connect( );

//Prepare statement for login page
pg_prepare($dbconn, "login_query", 'SELECT * FROM
			users WHERE user_id = $1 AND password = $2');	

//Prepare a statement to see if the user_id exists in the database's users table
pg_prepare($dbconn, "id_query", 'SELECT user_id FROM users WHERE user_id = $1');

//Update the last access time
pg_prepare($dbconn, "update_last_access", 'UPDATE users SET last_access = $1 WHERE user_id = $2');


//Insert valid user register info into users database
pg_prepare($dbconn, "register_user", 'INSERT INTO users (user_id, user_type, password, first_name, last_name, email_address, birth_date, enroll_date, last_access)
				VALUES ($1, $2, $3, $4, $5, $6, $7, now(), now())');

//checking database for login
pg_prepare($dbconn, "user_login", 'SELECT * FROM users WHERE user_id = $1');

//Update the last access time
pg_prepare($dbconn, "profile_query", 'SELECT * FROM profiles WHERE user_id = $1');

//Update users table
pg_prepare($dbconn, "update_user", 'UPDATE users 
         SET first_name=$2, last_name=$3, email_address=$4, birth_date=$5
         WHERE user_id = $1');

//Update profile
pg_prepare($dbconn, "profile_update", 'UPDATE profiles
                                        SET gender=$2,gender_sought=$3,city=$4,intent=$5,education=$6,ethnicity=$7,profession=$8,
                                        has_children=$9,body_type=$10,drinks=$11,religion=$12,hair_colour=$13,marital_status=$14,
                                        headline=$15,self_description=$16,match_description=$17
                                        WHERE user_id=$1');
//Create new profile
pg_prepare($dbconn, "Make_New_Profile", 'INSERT INTO profiles(user_id,gender,gender_sought,age, city,intent ,education,
                                        ethnicity ,profession ,has_children ,body_type ,drinks ,religion ,hair_colour ,
                                        marital_status,headline,self_description,match_description,images) 
                                        VALUES ( $1 ,$2 ,$3,$4, $5, $6, $7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18, $19)');
//Update incomplete to complete
pg_prepare($dbconn, "Update_incompelete", 'UPDATE users SET user_type=$1 WHERE user_id = $2');

pg_prepare($dbconn, "password_query", "SELECT * from users WHERE user_id = $1 and password = $2"); 

pg_prepare($dbconn, "password_update", "UPDATE users SET password=$2 WHERE user_id=$1 AND password=$3");

pg_prepare($dbconn, "password_email_query", "SELECT * from users WHERE user_id = $1 and email_address = $2"); 

pg_prepare($dbconn, "password_change", "UPDATE users SET password=$2 WHERE user_id=$1 and email_address=$3");

//Statement to get all of a users interests
pg_prepare($dbconn, "get_interests", "SELECT * FROM interests WHERE interested_id=$1");

//Statement to get all the users interested in logged in user
pg_prepare($dbconn, "get_interested", "SELECT * FROM interests WHERE interested_in_id=$1");


//Check for similar interests
pg_prepare($dbconn, "check_similar", "SELECT * FROM interests WHERE interested_id=$1 AND interested_in_id=$2");

 
//Geoff Deliv 5 - Closes the report
pg_prepare($dbconn,"close_report","UPDATE offensives SET status='C' WHERE offending_id=$1 ");
//Geoff Deliv 5 - Gathers all the reports for admin.php
pg_prepare($dbconn, "gather_reports", "SELECT * FROM offensives WHERE status=$1");
//Geoff Deliv 5 - Inserts a report
pg_prepare($dbconn, "insert_report", "INSERT INTO offensives(reporting_id,offending_id, status, reporting_time) VALUES ($1,$2,$3,$4)");
 
//Geoff Deliv 5 - Checks if a user has already reported the viewing user
pg_prepare($dbconn, "report_query", "SELECT * from offensives WHERE reporting_id=$1 AND offending_id=$2");
 
//Geoff Deliv 5 - Check to see if a user as been reported
pg_prepare($dbconn, "Has_been_reported" , "SELECT * from offensives WHERE offending_id=$1");
 
//Geoff Deliv 5 - Used to insert an interest
pg_prepare($dbconn, "insert_interest", "INSERT INTO interests(interested_id,interested_in_id, interest_time) VALUES ($1,$2,$3)");
 
//Geoff Deliv 5 - Removes the interest if the user is no longer interested in who they are viewing.
pg_prepare($dbconn, "remove_interest", "DELETE FROM interests WHERE interested_id=$1 AND interested_in_id=$2");
 
//Geoff Deliv 5 - Checks if the user as already shown interest in the other
pg_prepare($dbconn, "interest_query", "SELECT * from interests WHERE interested_id=$1 and interested_in_id = $2 ");
 
//Geoff Deliv 5 - Updates the user info, Used in Display_profile
pg_prepare($dbconn, "update_user_type", "UPDATE users SET user_type = $2 WHERE user_id=$1");

//Gathers all users of a usertype
pg_prepare($dbconn, "gather_user_type", "SELECT * from users WHERE user_type=$1");

function buildDropdown($dbconn, $tableName, $select ){
    $dropDownScript = "<select name=". $tableName ." style='width:150px;'>"; 
    
    $query = "SELECT property, value FROM " .$tableName;
       
    $results = pg_query($dbconn, $query );
    
    $count = 0;
        
    while($row = pg_fetch_row($results)) {
        if ($row[1]==$select)
			$dropDownScript .= "<option selected=\"selected\" value=". $row[1] ." >" . $row[0] . "</option>";
		else
			$dropDownScript .= "<option value=". $row[1] ." >" . $row[0] . "</option>";
        $count +=1;
    }
    
    $dropDownScript .= "</select>";
    
    echo $dropDownScript;
}

function buildRadio($dbconn,$tableName,$select){
    
    $dropDownScript = ""; 
    $options = array();
    
    $query = "SELECT property, value FROM " .$tableName;
       
    $results = pg_query($dbconn, $query );
    
    while($row = pg_fetch_row($results)) {
		if ($row[1]==$select)
			$dropDownScript .= "<input checked=\"checked\" type='radio' name=".$tableName." value= ". $row[1] .">" . $row[0] . "</input>";
		else
			$dropDownScript .= "<input type='radio' name=".$tableName." value= ". $row[1] .">" . $row[0] . "</input>";
    }
    
    
    
    echo $dropDownScript;
}

function buildCheckBox ($dbconn, $tableName, $value)
{
	//Holds the output and builds the checkbox
	$checkBoxScript = "";
	
	$query = "SELECT * FROM " .$tableName;
	
	//Getting all records from the database
	$results = pg_query($dbconn, $query);

	//Goes through every row found
	for($index = 1; $index < pg_num_rows($results); $index++)
	{
		//Get the value and city name for the row
		$dbName = pg_fetch_result($results, $index, 1);
		$dbValue = pg_fetch_result($results, $index, 0);
		
		//If the bit is set make it a checked box otherwise make it a non checked box
		if ((intval($value) & intval($dbValue)) != 0)
		{
			$checkBoxScript .= "<div style='align:left;'><input checked=\"checked\" type='checkbox' name=".$tableName.'[]'." value= ". $dbValue .">" . $dbName . "</input><br></div>";
		}
		else
		{
			$checkBoxScript .= "<div style='align:left;'><input type='checkbox' name=".$tableName.'[]'." value= ". $dbValue .">" . $dbName . "</input><br></div>";
		}
    }
	if ($tableName == 'city')
	{
		$checkBoxScript .= "<div style='align:left;'><input type='checkbox'  id='city_toggle' onclick=cityToggleAll(); name='city[]' value='0'>TOGGLE ALL</input><br></div>";
	}
	//Print Table
	echo $checkBoxScript;
}

function getProperty($dbconn,$value, $tableName)
{
    $query = "SELECT property FROM " . $tableName . " WHERE value =". $value;
    $results = pg_query($dbconn, $query);
    $row = pg_fetch_row($results);
    return $row[0];
}
function buildSearchResult($dbconn, $user_id)
{
    $script = "<table class=\"center\" border=\"0\" style=\"height:150px; width:750px;\"><tr><td style=\"height:175px; width:175px;\"><img src=\"images/EmptyProfile.jpg\" style=\"height:150px; width:150px;\" alt=\"Display Profile\"></img></td><td><table border=\"1\" style=\"align:top; height:130px; width:550px;\"><tr>";
    
    $result = pg_execute($dbconn, "profile_query", array($user_id));

    $userInfo = pg_fetch_assoc($result);
    
    
    
    //Store users profile info in variables
    $gender = $userInfo['gender'];					
    				
    $age = $userInfo['age'];
    
    $ethnicity = $userInfo['ethnicity'];
						
    $headline = $userInfo['headline'];
						
    $matchDescription = $userInfo['match_description'];
    
    $script .= "<td><a href=\"./display_profile.php?passedUserId=". $user_id . "\">" . $headline . "</a></td></tr><tr><td>";
    $script .= str_pad($matchDescription,100);
    
    $script .= "</td></tr></table><table border=\"1\" style=\"width:550px;\"><tr><td>Age: ";
    $script .= $age;
    
    $script .= "</td><td>Gender: ";
    $script .= getProperty($dbconn,$gender,GENDER_TABLE);
    $script .= "</td><td>Ethnicity: ";
    $script .= getProperty($dbconn,$ethnicity, ETHNICITY_TABLE);
    
    $script .="</td></tr></table></td></tr></table>";
        
    return $script;
}

//Build for users interests without a match
function buildInterestResult($dbconn, $user_id)
{
    $script = "<table class=\"center\" border=\"0\" style=\"height:150px; width:750px;\"><tr><td style=\"height:175px; width:175px;\"><img src=\"images/EmptyProfile.jpg\" style=\"height:150px; width:150px;\" alt=\"Display Profile\"></img></td><td><table border=\"1\" style=\"align:top; height:130px; width:550px;\"><tr>";
    
	//Get the users info
    $result = pg_execute($dbconn, "profile_query", array($user_id));
    $userInfo = pg_fetch_assoc($result);
    
    //Store users profile info in variables
    $gender = $userInfo['gender'];					 				
    $age = $userInfo['age'];   					
    $headline = $userInfo['headline'];	
	$city = $userInfo['city'];
    
    $script .= "<td><a href=\"./display_profile.php?passedUserId=". $user_id . "\">" . $user_id . "</a></td></tr><tr><td>";
    $script .= $age." • ". getProperty($dbconn,$city,CITY_TABLE). ", Ontario, Canada";
    
    $script .= "</td></tr></table><table border=\"1\" style=\"width:550px;\"><tr><td>";
    $script .= '<form action="remove_interest.php?id='.$user_id.'" method="post">';
	$script .= '<input type="submit" name="btnRemoveInterest" value = "Remove Interest" />';
    $script .= '</form>';
	$script .= "</td></tr></table></td></tr></table>";
        
    return $script;
}

//Build for users interests with a match
function buildInterestResultMatch($dbconn, $user_id)
{
    $script = "<table style: background-color: #FFFF33; class=\"center\" border=\"0\" style=\"height:150px; width:750px;\"><tr><td style=\"height:175px; width:175px;\"><img src=\"images/EmptyProfile.jpg\" style=\"height:150px; width:150px;\" alt=\"Display Profile\"></img></td><td><table style: background-color: #FFFF33; border=\"1\" style=\"align:top; height:130px; width:550px;\"><tr>";
    
	//Get the users info
    $result = pg_execute($dbconn, "profile_query", array($user_id));
    $userInfo = pg_fetch_assoc($result);
    
    //Store users profile info in variables
    $gender = $userInfo['gender'];					 				
    $age = $userInfo['age'];   					
    $headline = $userInfo['headline'];	
	$city = $userInfo['city'];
    
    $script .= "<th style=\"background-color: #ffffff\"><a href=\"./display_profile.php?passedUserId=". $user_id . "\">" . $user_id . "</a></th></tr><tr><td>";
    $script .= $age." • ". getProperty($dbconn,$city,CITY_TABLE). ", Ontario, Canada - ITS A MATCH!!!";
    
    $script .= "</td></tr></table><table border=\"1\" style=\"width:550px;\"><tr><td>";
    $script .= '<form action="remove_interest.php?id='.$user_id.'" method="post">';
	$script .= '<input type="submit" name="btnRemoveInterest" value = "Remove Interest" />';
    $script .= '</form>';
	$script .= "</td></tr></table></td></tr></table>";
        
    return $script;
}

function buildInterestedResult($dbconn, $user_id)
{
    $script = "<table class=\"center\" border=\"0\" style=\"height:150px; width:750px;\"><tr><td style=\"height:175px; width:175px;\"><img src=\"images/EmptyProfile.jpg\" style=\"height:150px; width:150px;\" alt=\"Display Profile\"></img></td><td><table border=\"1\" style=\"align:top; height:130px; width:550px;\"><tr>";
    
	//Get the users info
    $result = pg_execute($dbconn, "profile_query", array($user_id));
    $userInfo = pg_fetch_assoc($result);
    
    //Store users profile info in variables
    $gender = $userInfo['gender'];					 				
    $age = $userInfo['age'];   					
    $headline = $userInfo['headline'];	
	$city = $userInfo['city'];
    
    $script .= "<td><a href=\"./display_profile.php?passedUserId=". $user_id . "\">" . $user_id . "</a></td></tr><tr><td>";
    $script .= $age." • ". getProperty($dbconn,$city,CITY_TABLE). ", Ontario, Canada";
    
    $script .= "</td></tr></table><table border=\"1\" style=\"width:550px;\"><tr><td>";
    $script .= '<form action="remove_interested.php?id='.$user_id.'" method="post">';
	$script .= '<input type="submit" name="btnRemoveInterest" value = "Remove Interest" />';
    $script .= '</form>';
	$script .= "</td></tr></table></td></tr></table>";
        
    return $script;
}

//Build for interested users with a match
function buildInterestedResultMatch($dbconn, $user_id)
{
    $script = "<table class=\"center\" border=\"0\" style=\"height:150px; width:750px;\"><tr><td style=\"height:175px; width:175px;\"><img src=\"images/EmptyProfile.jpg\" style=\"height:150px; width:150px;\" alt=\"Display Profile\"></img></td><td><table border=\"1\" style=\"align:top; height:130px; width:550px;\"><tr>";
    
	//Get the users info
    $result = pg_execute($dbconn, "profile_query", array($user_id));
    $userInfo = pg_fetch_assoc($result);
    
    //Store users profile info in variables
    $gender = $userInfo['gender'];					 				
    $age = $userInfo['age'];   					
    $headline = $userInfo['headline'];	
	$city = $userInfo['city'];
    
    $script .= "<th style=\"background-color: #ffffff\"><a href=\"./display_profile.php?passedUserId=". $user_id . "\">" . $user_id . "</a></th></tr><tr><td>";
    $script .= $age." • ". getProperty($dbconn,$city,CITY_TABLE). ", Ontario, Canada - ITS A MATCH!!!";
    
    $script .= "</td></tr></table><table border=\"1\" style=\"width:550px;\"><tr><td>";
    $script .= '<form action="remove_interested.php?id='.$user_id.'" method="post">';
	$script .= '<input type="submit" name="btnRemoveInterest" value = "Remove Interest" />';
    $script .= '</form>';
	$script .= "</td></tr></table></td></tr></table>";
        
    return $script;
}
?>

 