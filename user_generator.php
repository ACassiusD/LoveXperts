<?php
//Include names
include './includes/generation_arrays.php';
include './includes/functions.php';
include './includes/db.php';
include './includes/constants.php';

//How many users to generate
 define("NUMBER_TO_GENERATE", 1000);
 
//Used to create the username
$first_name;
$last_name;
 
//Shared variable for primary/forign key in users and user profile database
$user_id;
 
//Varaibles to fill out the users database
$password = "password";
$user_type; 
$email_address; 
$first_name;
$last_name; 
$birth_date;
$enroll_date = 2015-10-15; 
$last_access = 2015-10-15; 

//Variables to fill out user profile 
$gender_string;
$gender;
$gender_sought;
$age;
$city;
$intent;
$education; 
$ethnicity;
$profession;
$has_children; 
$body_type; 
$drinks; 
$religion; 
$hair_colour;
$marital_status; 
$headline; 
$self_description; 
$match_description;
$images = 0;

//Max number variables
$base = 2;
$minus1 = -1;
$zero = 0;
$gender_max = 1;
$age_min = 18;
$age_max = 99;
$min_date = "October 15 1997";
$max_date = "October 15 1950";

//Amount of choises for each database table
$hair_choices = 7;
$gender_sought_choices = 3;
$city_coices = 7;
$intent_choices = 5;
$education_choices = 8;
$ethnicity_choices = 10;
$profession_choices = 9;
$has_children_choices = 4;
$body_choices = 6;
$drinks_choices = 6;
$religion_choices = 10;
$marital_status_choices = 7;


//Holds a random value
$power;
$randval;

//A function to create a seed, Source http://php.net/manual/en/function.srand.php
function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}

 
 for ($counter = 1; $counter <= NUMBER_TO_GENERATE; $counter++)
 {
	//Generate if user is male or female
	srand(make_seed());
	$gender = rand( $zero,$gender_max );
	 
	 //Seed and create first name
	srand(make_seed());

	if ($gender == 0)
	{
		$gender_string = "male";
		$first_name = ucfirst(strtolower($male_names[rand( $zero, count($male_names)-1 )]));
	}
	else
	{
		$gender_string = "female";
		$first_name = ucfirst(strtolower($female_names[rand( $zero, count($female_names)-1 )]));
	}

	//Seed and create last name
	srand(make_seed());
	$last_name = ucfirst(strtolower($last_names[rand( $zero, count($last_names)-1 )]));
	
	//Create username
	srand(make_seed());
	$user_id = $last_name.$first_name[0].rand(10,99);
	
	//Create user type
	$user_type = $user_types[rand( $zero, count($user_types)-1 )];
	
	//Create email address
	srand(make_seed());
	$email_address = $user_id."@".$email_domains[rand( $zero, count($email_domains)-1 )];
	
	//Generate Birthday
	$birth_date = rand_date($min_date, $max_date);
	
	
	//Now we will generate the information for the users profile
	
	//Generating gender sought
	$gender_sought = random_profile_value($gender_sought_choices);
	
	//Generate age
	$age = calculateAge($birth_date);
	
	//Generate city
	$city = random_profile_value($city_coices);
	
	//Generate intent
	$intent = random_profile_value($intent_choices);
	
	//Education
	$education = random_profile_value($education_choices);
	
	//Ethenticity
	$ethnicity = random_profile_value($ethnicity_choices);
	
	//Profession
	$profession = random_profile_value($profession_choices);
	
	//Children
	$has_children = random_profile_value($has_children_choices);
	
	//Body
	$body_type = random_profile_value($body_choices);
	
	//Drinks
	$drinks = random_profile_value($drinks_choices);
	
	//Religion
	$religion = random_profile_value($religion_choices);
	
	//Generating hair color
	$hair_colour = random_profile_value($hair_choices);
	
	//Marital Status
	$marital_status = random_profile_value($marital_status_choices);
	
	//Generating headline
	$headline = "Come be mine!";
	
	//Generating self descripotion
	$self_description = "My name is ".ucfirst(strtolower($first_name))." ".ucfirst(strtolower($last_name))." I am a ".$age." year old ".$gender_string." interested in ".getProperty($dbconn,$intent,INTENT_TABLE);
	
	//Generating match description
	$match_description = "I am looking for a nice person of ".getProperty($dbconn,$gender_sought,GENDER_SOUGHT_TABLE). " gender.";
	 
	 //Check the output
	 if ($gender == 0)
	 {
		echo "Male, ";
	 }
	 else
	 {
		echo "Female, ";
	 }
	 
	 echo $first_name.", ".$last_name.", ".$user_id.", ".$email_address.", ".$user_type.", ".$birth_date.
	 ", ".$age."<br/>".$self_description."<br/>".$match_description;
	 
	 echo "<br/><br/>";
	 
	//Input information into users table
	pg_execute($dbconn, "register_user", array($user_id, $user_type, md5($password), $first_name, $last_name, $email_address, $birth_date));
		
	//If user is C or A profile type insert information into profile datatype
	if ($user_type == "a" or $user_type == "c")
	{
		pg_execute($dbconn, "Make_New_Profile", array($user_id, $gender, $gender_sought,$age , $city, $intent, $education, $ethnicity, $profession, $has_children, $body_type, $drinks, $religion, $hair_colour, $marital_status, $headline, $self_description, $match_description, $images));
	}
	echo "Successfully registered ".NUMBER_TO_GENERATE." users.";
 }
 
 







?>