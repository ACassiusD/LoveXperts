<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "search_users.php";
$description = "Users will be able to query a number of users in our databse through this page to find their perfect match";	

include './includes/header.php';
?>
<!-- CONTENT GOES HERE -->


<!-- About Me -->
<div id="wrapper1">
	<div class="content">
		
	<?php		
		//IF NO INFORMATION FOR THE CITY VALUE WAS SENT TO THIS PAGE
		if(!isset($_SESSION['cityValue']) AND (!isset($_COOKIE['cityValue'])) AND $passedCity = "")
		{
			header( "Location: profile_city_select.php" ); 
		}
		else
		{

			//Declares the variable to hold the passed city value 
			$cityOutputValue;
				
			if(isset($_GET['passedCity']))
			{
				//GET THE VALUE FROM PASSED GET VARIABLE
				$cityOutputValue = $_GET['passedCity'];
				//Store it in the session
				$_SESSION['cityValue'] = $cityOutputValue;	
			}
			//If user was send from checkbox form
			else
			{
				//Get value of cities from session
				$cityOutputValue = $_SESSION['cityValue'];	
			}
			//Find the values for the citys.
			$query = "SELECT * FROM " . CITY_TABLE;
			
			//Getting all records from the database
			$results = pg_query($dbconn, $query);
			
			//Will hold and display output
			$listOfCities = "";
			
			//Goes through every row found and if the value of that row is part of cityOutputValue add the name to the list of cities
			for($index = 1; $index < pg_num_rows($results); $index++)
			{
				$dbName = pg_fetch_result($results, $index, 1);
				$dbValue = pg_fetch_result($results, $index, 0);
				if ((intval($cityOutputValue) & intval($dbValue)) != 0)
				{
					$listOfCities .= $dbName.", ";
				}
			}
		
			
			//Displays list at top of what cities are being searched.
			echo "Searching users in ". $listOfCities. ' click <a href="./profile_city_select.php">Here!</a> to change.';
			
			//SETTING VARIABLES TO HOLD VALUES FROM FORM, WILL EQUAL COOKIE IF COOKIE IS SET.
			if (isset($_COOKIE['myGenderValue'])){
			$myGenderValue = $_COOKIE['myGenderValue'];} else {
			$myGenderValue = 0;}
			
			if (isset($_COOKIE['genderSaughtValue'])){
			$genderSoughtValue = $_COOKIE['genderSaughtValue'];} else {
			$genderSoughtValue = 0;}
				
			if (isset($_COOKIE['bodyValue'])){
			$bodyValue = $_COOKIE['bodyValue'];} else {
			$bodyValue = 0;}
			
			//AGE VALUES
			if (isset($_COOKIE['minAge'])){
			$minAge = $_COOKIE['minAge'];} else {
			$minAge = MIN_AGE;}
			
			if (isset($_COOKIE['maxAge'])){
			$maxAge = $_COOKIE['maxAge'];} else {
			$maxAge = MIN_AGE;}
		
			if (isset($_COOKIE['professionValue'])){
			$professionValue = $_COOKIE['professionValue'];} else {
			$professionValue = 0;}		

			if (isset($_COOKIE['religionValue'])){
			$religionValue = $_COOKIE['religionValue'];} else {
			$religionValue = 0;}

			if (isset($_COOKIE['educationValue'])){
			$educationValue = $_COOKIE['educationValue'];} else {
			$educationValue = 0;}

			if (isset($_COOKIE['maritalValue'])){
			$maritalValue = $_COOKIE['maritalValue'];} else {
			$maritalValue = 0;}

			if (isset($_COOKIE['ethnicityValue'])){
			$ethnicityValue = $_COOKIE['ethnicityValue'];} else {
			$ethnicityValue = 0;}		

			if (isset($_COOKIE['intentValue'])){
			$intentValue = $_COOKIE['intentValue'];} else {
			$intentValue = 0;}	

			if (isset($_COOKIE['drinksValue'])){
			$drinksValue = $_COOKIE['drinksValue'];} else {
			$drinksValue = 0;}	

			if (isset($_COOKIE['childrenValue'])){
			$childrenValue = $_COOKIE['childrenValue'];} else {
			$childrenValue = 0;}				
							
			//Only preform processing when form has been submitted
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				//If variable is > 0 it means something was checked and we can query database to search users
				$anythingChecked = 0;
				//If something is checked in the checkbox, set the value of it to the variable and create a cookie
				//Cookies will be created if user is logged on
				
				//If something is checked for this table
				if (isset($_POST[GENDER_TABLE])){
					//Set the value to the variable
					$myGenderValue = $_POST[GENDER_TABLE];
					//If user is logged in create cookie
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('myGenderValue', $_POST[GENDER_TABLE], constant('30_DAY_COOKIE'));}
					//Add 1 to anything checked variable to let it know at least one thing was checked.
					$anythingChecked .= 1;}	else {
					//if nothing was checked set the variable to 0
					$myGenderValue = 0;
					//If cookie is set delete it.
					if (isset ($_COOKIE['myGenderValue'])){
					setcookie("myGenderValue", "", constant('EXPIRED_COOKIE'));}}
				
				if (isset($_POST[GENDER_SOUGHT_TABLE])){
					$genderSoughtValue = $_POST[GENDER_SOUGHT_TABLE];
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('genderSoughtValue', $_POST[GENDER_SOUGHT_TABLE], constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$genderSoughtValue = 0;
					if (isset ($_COOKIE['genderSoughtValue'])){
					setcookie("genderSoughtValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST['minAge'])){
					$minAge = $_POST['minAge'];
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('minAge', $_POST['minAge'], constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$minAge = MIN_AGE;
					if (isset ($_COOKIE['minAge'])){
					setcookie("minAge", "", constant('EXPIRED_COOKIE'));}}	
				
				if (isset($_POST['maxAge'])){
					$maxAge = $_POST['maxAge'];
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('maxAge', $_POST['maxAge'], constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$maxAge = MIN_AGE;
					if (isset ($_COOKIE['maxAge'])){
					setcookie("maxAge", "", constant('EXPIRED_COOKIE'));}}	
					
				if (isset($_POST[BODY_TABLE])){
					$bodyValue = sumCheckBox($_POST[BODY_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('bodyValue', sumCheckBox($_POST[BODY_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$bodyValue = 0;
					if (isset ($_COOKIE['bodyValue'])){
					setcookie("bodyValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[PROFESSION_TABLE])){
					$professionValue = sumCheckBox($_POST[PROFESSION_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('professionValue', sumCheckBox($_POST[PROFESSION_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$professionValue = 0;
					if (isset ($_COOKIE['professionValue'])){
					setcookie("professionValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[RELIGION_TABLE])){
					$religionValue = sumCheckBox($_POST[RELIGION_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('religionValue', sumCheckBox($_POST[RELIGION_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$religionValue = 0;
					if (isset ($_COOKIE['religionValue'])){
					setcookie("religionValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[EDUCATION_TABLE])){
					$educationValue = sumCheckBox($_POST[EDUCATION_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('educationValue', sumCheckBox($_POST[EDUCATION_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$educationValue = 0;
					if (isset ($_COOKIE['educationValue'])){
					setcookie("educationValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[MARITAL_STATUS_TABLE])){
					$maritalValue = sumCheckBox($_POST[MARITAL_STATUS_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('maritalValue', sumCheckBox($_POST[MARITAL_STATUS_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$maritalValue = 0;
					if (isset ($_COOKIE['maritalValue'])){
					setcookie("maritalValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[ETHNICITY_TABLE])){
					$ethnicityValue = sumCheckBox($_POST[ETHNICITY_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('ethnicityValue', sumCheckBox($_POST[ETHNICITY_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$ethnicityValue = 0;
					if (isset ($_COOKIE['ethnicityValue'])){
					setcookie("ethnicityValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[INTENT_TABLE])){
					$intentValue = sumCheckBox($_POST[INTENT_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('intentValue', sumCheckBox($_POST[INTENT_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$intentValue = 0;
					if (isset ($_COOKIE['intentValue'])){
					setcookie("intentValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[DRINKS_TABLE])){
					$drinksValue = sumCheckBox($_POST[DRINKS_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('drinksValue', sumCheckBox($_POST[DRINKS_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$drinksValue = 0;
					if (isset ($_COOKIE['drinksValue'])){
					setcookie("drinksValue", "", constant('EXPIRED_COOKIE'));}}
					
				if (isset($_POST[HAS_CHILDREN_TABLE])){
					$childrenValue = sumCheckBox($_POST[HAS_CHILDREN_TABLE]);
					if(isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == true){
					setcookie('childrenValue', sumCheckBox($_POST[HAS_CHILDREN_TABLE]), constant('30_DAY_COOKIE'));}
					$anythingChecked .= 1;}	else {
					$childrenValue = 0;
					if (isset ($_COOKIE['childrenValue'])){
					setcookie("childrenValue", "", constant('EXPIRED_COOKIE'));}}				
			
				//Check variable to see if anything was checked
				if ($anythingChecked > 0)
				{
					//Redirect and query
                    
                    //==============Inital script Starts here=============================
                    
                    
                    //If user is looking for users of both gender
                    if($genderSoughtValue == 2)
                    {
                        $searchScript = "SELECT profiles.user_id FROM profiles, users WHERE 1 = 1";
                        $searchScript .= " AND (gender_sought = '" . $myGenderValue . "'";
                        $searchScript .= " OR gender_sought = '" . 2 . "')";						
                        $searchScript .= " AND age >= '" . $minAge . "' AND age <= '" .$_COOKIE['maxAge']. "'" ;
                    }
                    else
                    {
                        $searchScript = "SELECT profiles.user_id FROM profiles, users WHERE 1 = 1";
                        $searchScript .= " AND gender = '" . $genderSoughtValue . "'";						
                        $searchScript .= " AND (gender_sought = '" . $myGenderValue . "'";
						$searchScript .= " OR gender_sought = '" . 2 . "')";
                        $searchScript .= " AND age >= '" . $minAge . "' AND age <= '" .$maxAge. "'" ;
                    
                    }
                    
                    
                    //If there is city value
                    if(isset($_COOKIE['cityValue']) ){
                    //get an array of binary numbers of that value.
                        $binaryNumbers = getBinaryNumbersOf($_COOKIE['cityValue']);
        
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);
                        foreach($binaryNumbers as $number)
                        {   
                            $searchScript .= "profiles.city = " . intval($binaryNumbers[$count]);
            
                        if($count+1 != $length)
                        {
                            $searchScript .= " OR ";
                        }
                        $count++;
                        }
                    $searchScript .= ") ";
        
            
                    }
                    if($bodyValue > 0 ){
                    
                        $binaryNumbers = getBinaryNumbersOf($bodyValue);
        
                        $searchScript .= " AND ( "; 
        
                        $count = 0;
                        
                        $length = count($binaryNumbers);
                        foreach($binaryNumbers as $number)
        
                        {   
            
                            $searchScript .= "profiles.body_type = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";

                    }
    
    
                    if($professionValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($professionValue);
        
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);
                        foreach($binaryNumbers as $number)
                        {
                            $searchScript .= "profiles.profession = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";
                    }

 
                    if($religionValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($religionValue);
        
        
                        $searchScript .= " AND ( "; 
       
                        $count = 0;
       
                        $length = count($binaryNumbers);
       
                        foreach($binaryNumbers as $number)
                        {   
                            $searchScript .= "profiles.religion = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";

                            }

                            $count++;
                        }
                        $searchScript .= ") ";

                    }

                    
 
                    if($educationValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($educationValue);
        
        
                        $searchScript .= " AND ( "; 
        
                        $count = 0;
        
                        $length = count($binaryNumbers);
        
                        foreach($binaryNumbers as $number)
        
                        {   
            
                            $searchScript .= "profiles.education = " . intval($binaryNumbers[$count]);

                            
            
                            if($count+1 != $length)
            
                            {
                
                                $searchScript .= " OR ";
            
                            }
            
                            $count++;
        
                        }
        
                        $searchScript .= ") "; 

                    }
 
                    if($maritalValue > 0 ){

                        $binaryNumbers = getBinaryNumbersOf($maritalValue);

                        $searchScript .= " AND ( "; 
        
                        $count = 0;
        
                        $length = count($binaryNumbers);
        
                        foreach($binaryNumbers as $number)
                        {   
                            $searchScript .= "profiles.marital_status = " . intval($binaryNumbers[$count]);
        
                            if($count+1 != $length)
                            
                            {
                                $searchScript .= " OR ";
            
                            }
            
                            $count++;
        
                        }
        
                        $searchScript .= ") ";
        
    
                    }
                    if($ethnicityValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($ethnicityValue);
        
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);
                        foreach($binaryNumbers as $number)
                        {   
            
                            $searchScript .= "profiles.ethnicity = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";
                    }
 
                    if($intentValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($intentValue);
        
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);
                        foreach($binaryNumbers as $number)
                        {   
            
                            $searchScript .= "profiles.intent = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";
                    }

 
                    if($drinksValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($drinksValue);
        
        
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);

                        foreach($binaryNumbers as $number)
                        {           
                            $searchScript .= "profiles.drinks = " . intval($binaryNumbers[$count]);
    
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";    
                    }

                    if($childrenValue > 0 ){
        
        
                        $binaryNumbers = getBinaryNumbersOf($childrenValue);
    
                        $searchScript .= " AND ( "; 
                        $count = 0;
                        $length = count($binaryNumbers);
        
                        foreach($binaryNumbers as $number)
                        {   
                            $searchScript .= "profiles.has_children = " . intval($binaryNumbers[$count]);
            
                            if($count+1 != $length)
                            {
                                $searchScript .= " OR ";
                            }
                            $count++;
                        }
                        $searchScript .= ") ";
                    }
    
                    $searchScript .= "and users.user_id = profiles.user_id and users.user_type <> 'd' ORDER BY users.last_access DESC LIMIT " . floatval(200);
    
                    //echo "<br/><br/>".$searchScript;
                    $results = pg_query($searchScript);
                    $count = pg_num_rows($results);
                    $results = pg_fetch_all($results);
                    $_SESSION['searchResults'] = $results;
                    
                    //If one user is found
                    if($count == 1)
                    {
						foreach ($_SESSION['searchResults'] as $value) {
						//get usernid
						$userId = $value['user_id']; 
						echo $userId . "<br />";}	
						header( "Location: display_profile.php?passedUserId=".$userId); 
                    }
                    elseif($count == 0)
                    {
                        echo "No matches found, Try extending search";    
                    }
                    else
                    {
                        //echo"<br/><br/>". print_r($_SESSION['searchResults']);
                        
						//echo"<br/><br/><br/>". print_r($count);
                        header("Location: search_results.php");    
                    }
				}
				else
				{
					//Let the user know that they need to select something so we can query the database
					echo "<br/>ERROR! Please select something to search users!";
				}
			}
		}


        ?>
		
		<h2>Search Profile</h2>
	<!-- form for create profile -->
		<form id="input" method="post" style="width:800px" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            
			<!-- A table for users profile info that doesnt not require typing in something -->
            <table border="1" class="table-header-box">
				<tr>
					<th><strong>I am:</strong></th>
					<td><?php buildRadio($dbconn, GENDER_TABLE, $myGenderValue);?></td>
					
					<th><strong>Looking for:</strong></th>
					<td><?php buildRadio($dbconn, GENDER_SOUGHT_TABLE, $genderSoughtValue);?></td>	

					<th><strong>AGE:</strong></th>
					<td><?php ageDropDown(18, 99, 'minAge', $minAge); echo " to "; ageDropDown(18, 99, 'maxAge', $maxAge);?>;</td>						
				</tr>	
				<tr>	
					<th><strong>Body Type:</strong></th>
					<td><?php buildCheckBox($dbconn, BODY_TABLE, $bodyValue);?></td>
					
					<th><strong>Occupation:</strong></th>
					<td><?php buildCheckBox($dbconn, PROFESSION_TABLE, $professionValue);?></td>
					
					<th><strong>Religion:</strong></th>
					<td> <?php buildCheckBox($dbconn, RELIGION_TABLE, $religionValue);?></td>
				</tr>
				<tr>	
					<th><strong>Education:</strong></th>
					<td><?php buildCheckBox($dbconn,EDUCATION_TABLE, $educationValue);?></td>

					<th><strong>Relationship Status:</strong></th>
					<td><?php buildCheckBox($dbconn, MARITAL_STATUS_TABLE, $maritalValue);?></td>
					
					<th><strong>Ethnicity:</strong></th>
					<td><?php buildCheckBox($dbconn, ETHNICITY_TABLE, $ethnicityValue);?></td>
				</tr>
				<tr>
					<th><strong>Intent:</strong></th>
					<td><?php buildCheckBox($dbconn, INTENT_TABLE, $intentValue);?></td>
				
					<th><strong>Drinks:</strong></th>
					<td><?php buildCheckBox($dbconn, DRINKS_TABLE, $drinksValue);?></td>
					
					<th><strong>Has Children?:</strong></th>
					<td><?php buildCheckBox($dbconn, HAS_CHILDREN_TABLE, $childrenValue);?></td>
				</tr> 
				<tr>
				<td><input type="submit" value="Search" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>


