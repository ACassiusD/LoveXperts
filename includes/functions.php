<?php

//A function that compaired the requested URI to the page name to see if it is the current page item and highlight its menu item
function displayMenuItem($pageName)
{
	//Hold URI in a variable
	$URI = $_SERVER["REQUEST_URI"];
	
	//Create the variable to be echo'd if it is the current page item
	$currentPage = '<li class="current_page_item"><a href=".'.$pageName.'"';
	//Create the variable to be echo'd if it is not the current page item
	$notCurrentPage = '<li><a href="'.$pageName.'"';
    
	//Echo the proper output variable depending on if the page name is the same as the URI
	if ($pageName == $URI)
	{
        echo $currentPage;
	}
	else
	{
		echo $notCurrentPage;
	}
}

//A function that echos the copyright symbol, year and my name.
function displayCopyrightInfo( )
{
	$date = date('Y');
	echo "&copy; Alex Donnelly, Dan Munusami and Geoff Veale $date";
}

//A function to help generate a random date source http://stackoverflow.com/questions/14186800/random-time-and-date-between-2-date-values

function rand_date($min_date, $max_date) {
    /* Gets 2 dates as string, earlier and later date.
       Returns date in between them.
    */

    $min_epoch = strtotime($min_date);
    $max_epoch = strtotime($max_date);

	srand(make_seed());
    $rand_epoch = rand($min_epoch, $max_epoch);

    return date('Y-m-d', $rand_epoch);
}

//A funtion to get a random number from 0 up to a certan power of 2
function random_profile_value ($number_of_values){
	$output;
	
	$power = rand(-1, $number_of_values-2);
	if ($power == -1)
		$output = 0;
	else	
		$output = pow(2, $power);
	return $output;
}
function calculateAge($date)
{
	$current = date("Ymd");
	$dateofbirth = date("Ymd", strtotime($date));
	return intval(($current - $dateofbirth) / 10000);
}

//Valid date function source http://stackoverflow.com/questions/19271381/correctly-determine-if-date-string-is-a-valid-date-in-that-format
function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}
 
 /*
	this function should be passed a integer power of 2, and any 
	decimal number,	it will return true (1) if the power of 2 is 
	contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

/*
	this function can be passed an array of numbers 
	(like those submitted as part of a named[] check 
	box array in the $_POST array).
*/
function sumCheckBox($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
	  $sum += $array[$i]; 
	}
	return $sum;
}

function SetCheckboxCookie($tableName, $cookieName)
{
	//Variable that will return 1 if something in the checkbox was checked or returns 0 if nothing was checked
	$isChecked = 0;
	if(isset($_POST[$tableName]))
	{    
		$isChecked = 1;
		setcookie($cookieName, sumCheckBox($_POST[$tableName]));
	}
	else
	{
		setcookie($cookieName, 0);
	}
	return $isChecked;
}
	
//Create age dropdown
function ageDropDown($minAge, $maxAge, $name, $savedValue)
{
	echo '<select name="'.$name.'">';
	echo '<option></option>';
	for($i = $minAge; $i <= $maxAge; $i++){
		$i = str_pad($i, 2, 0, STR_PAD_LEFT);
		if ($i == $savedValue)
		{
			echo "<option value='$i' selected>" . $i . "</option>\n";
		}
		else
		{
			echo "<option value='$i'>$i</option>";
		}
	}
	echo '</select>';	
}

function getBinaryNumbersOf($value)
{
    $binaryArray = array();
    
    while($value != 0 )
    {
        array_push($binaryArray, pow(2,floor(log($value)/log(2))));
        $value = $value - pow(2,floor(log($value)/log(2)));
    }
        
        
    return $binaryArray;
}

?>