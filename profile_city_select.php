<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-03-11";
$filename = "profile_city_select.php";
$description = "This page will allow the user to choose which reigon they want to search users in.";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div id="welcome" style="width:100%"  class="container">
		<!-- Content -->
		<?php 
		//First check the users session and cookies to see if they need to be here to redirected to profile_search.

	    //Only preform processing when form has been submitted
        if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//Check if checkbox was submitted
			if(isset($_POST[CITY_TABLE]))
			{
				//If something on check box was clicked set cookie and session and point to profile search
				setcookie('cityValue', sumCheckBox($_POST[CITY_TABLE]));
				$_SESSION['cityValue'] = sumCheckBox($_POST[CITY_TABLE]);
				header( "Location: ./search_users.php" ); 
			}
			else
			{
				//If nothing was selected on the checkbox output an error.
				echo "ERROR! Nothing Selected.";
			}	
		}
		?>	
		
		<div class="title">
			<h2>Choose the reigon you would like to search</h2>
		</div>
		
		<!-- Form for reigion -->
		<form id="Input" method="post" style="width:100%" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			<tr>
				<td>
					<img src="./images/image_map.png" alt="image map" ISMAP USEMAP="#mapareas"></img>
					
					<map name="mapareas" id="ImageMapsCom-image-maps-2015-11-03-133042">
					<area shape="rect" coords="862,658,864,660" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" />
					<area  alt="" title="Port Perry" href="./search_users.php?passedCity=16" shape="poly" coords="203,11,203,301,646,302,645,107,523,145,530,55,470,62,425,104,423,10" style="outline:none;" target="./profile_search.php"    />
					<area  alt="" title="Pickering" href="./search_users.php?passedCity=8" shape="poly" coords="3,301,205,304,205,455,105,455,95,607,66,598,35,614,2,580" style="outline:none;" target="./profile_search.php"     />
					<area  alt="" title="Ajax" href="./search_users.php?passedCity=4" shape="poly" coords="105,455,204,458,203,604,152,613,104,608" style="outline:none;" target="./profile_search.php"     />
					<area  alt="" title="Whitby" href="./search_users.php?passedCity=2" shape="poly" coords="203,303,205,605,255,604,280,596,310,610,310,301" style="outline:none;" target="./profile_search.php"     />
					<area  alt="" title="Oshawa" href="./search_users.php?passedCity=1" shape="poly" coords="308,300,307,608,331,607,393,621,425,614,423,302" style="outline:none;" target="./profile_search.php"       />
					<area  alt="" title="Clearington" href="./search_users.php?passedCity=32" shape="poly" coords="422,300,420,615,490,627,502,639,543,634,573,621,651,644,748,641,862,655,861,341,647,342,648,303" style="outline:none;" target="./profile_search.php"     />
					</map>			
				</td>
				<!-- Building the checkbox -->
				<td valign="top">
					<strong>City:</strong> <br/> <br/>
					<?php buildCheckBox($dbconn, 'city', '');?>			
				</td>
			</tr>
			
			<!-- Submit Button -->
			</table>
			<br/>
			<table border="0" cellspacing="15" >
			<tr>
				<td><input type="submit" value = "Submit" /></td>
			</tr>
			</table>
		</form>
		
		<script type="text/javascript">
		<!--
			/*NOTE: for the following function to work, on your page
					you have to create a checkbox id'ed as city_toggle
						
			<input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">
					
				and each city checkbox element has to be an named as an 
				array (specifically named "city[]")
				e.g.
					<input type="checkbox" name="city[]" value="1">Ajax
			*/
			function cityToggleAll()
			{
				//alert("In cityToggleAll()");  //alerts used for de-bugging
				var isChecked = document.getElementById("city_toggle").checked;
				var city_checkboxes = document.getElementsByName("city[]");
				for (var i in city_checkboxes){
				//SAME AS for ( i = 0; i < city_checkboxes.length; i++){
					city_checkboxes[i].checked = isChecked;
				}		
			}
			
		//-->
		</script>		

	</div>
</div>
</div>
 
<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
