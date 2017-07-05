<?php
//Defining constants
define("MINIMUM_ID_LENGTH", 5);
define("MAXIMUM_ID_LENGTH", 20);
		
define("MINIMUM_PASSWORD_LENGTH", 6);
define("MAXIMUM_PASSWORD_LENGTH", 32);

define("MAX_FIRST_NAME_LENGTH", 20);
define("MAX_LAST_NAME_LENGTH", 30);

define("MAXIMUM_EMAIL_LENGTH", 255);

//minimum age to register to site
define("MIN_AGE", 18);

//must put input into the textbox
define("MIN_INPUT", 1);

//User Types
define ("ADMIN", "a");
define ("CLIENT", "c");
define ("INCOMPLETE_CLIENT", "i");
define ("DISABLED_CLIENT", "x");

define ("OPEN_REPORT", "O");
define ("CLOSE_REPORT","C");

//Cookie length
define ("30_DAY_COOKIE", time()+86400*30);

//YESTERDAY TIME FOR DELETING COOKIE
define("EXPIRED_COOKIE", time()-3600);

define ("UPLOAD_TO_FOLDER", "./uploads");
define ("MAX_UPLOAD_SIZE", 100000);
define ("MAX_UPLOADS", 10);

//Website Addresses
define ("LOGIN_ADDRESS", "./login.php");
define ("DISPLAY_PROFILE_ADDRESS", "./display_profile.php");
define ("CREATE_PROFILE_ADDRESS", "./create_profile.php");

define("CITY_TABLE","city");
define("BODY_TABLE","body_type");
define("EDUCATION_TABLE","education");
define("ETHNICITY_TABLE","ethnicity");
define("GENDER_TABLE","gender");
define("GENDER_SOUGHT_TABLE","gender_sought");
define("INTENT_TABLE","intent");
define("HAIR_TABLE","hair_colour");
define("DRINKS_TABLE","drinks");
define("PROFESSION_TABLE","profession");
define("RELIGION_TABLE","religion");
define("MARITAL_STATUS_TABLE","marital_status");
define("USER_TABLE","users");
define("USER_PROFILE_TABLE","user_profile");
define("HAS_CHILDREN_TABLE","has_children");

?>