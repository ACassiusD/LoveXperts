<?php

#VARIABLES
$date = "2015-11-17";
$filename = "profile_images.php";
$description = "This page will allow the user to upload images to their profile";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">

<?php
$error = "";
	if (isset($_SESSION['loggedin']))
	{
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{	
			$folder = UPLOAD_TO_FOLDER . "/" . $_SESSION['user_id'];
			
			if (!is_dir($folder))
				mkdir($folder);
						
			foreach($_FILES["pictures"]["error"] as $key=>$value)
			{
				if($_FILES['pictures']['size'][$key] > MAX_UPLOAD_SIZE)
				{
					$error .= "File selected is too big. <br/>";
				}
				else if($_FILES['pictures']['type'][$key] != "image/pjpeg" && $_FILES['pictures']['type'][$key] != "image/jpeg")
				{
					$error .= "Your profile pictures must be of type JPEG. <br/>";
					$error .= "Failed to upload \"" . $_FILES["pictures"]["name"][$key] . "\"<br/>";
				}
				else
				{
					if ($value == UPLOAD_ERR_OK)
					{
						$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
										
						$index = 0;
						
						while(file_exists("$folder/image$index.jpg"))
							$index ++;
						
						if ($index >= MAX_UPLOADS)
						{
							$error = "You have reached the max number of uploads";
							break;
						}
						else
						{		
							move_uploaded_file($tmp_name, "$folder/image$index.jpg");
						}
					}
					else
					{
						$error .= "Error uploading image \"" . $_FILES["pictures"]["name"][$key] . "\"";
					}
				}
			}
		}
	}
	else
	{
		header( "Location: login.php" ); 
	}
 ?>

	<div class="title">
		<h3>
			<?php echo $error; ?>
		</h3>
	</div>
	
	<div>
		<?php
			$folder = UPLOAD_TO_FOLDER . "/" . $_SESSION['user_id'];
			
			$index = 0;
			
			while(file_exists("$folder/image$index.jpg"))
			{
				echo "<img style=\"width: 20%;\" src=\"$folder/image$index.jpg\"/>";
				$index ++;
			}
		?>
	</div>
<p>
	Choose a file to upload to your profile.
	<?php
	echo "<br/>".$folder;
	?>
</p>

<form id="uploadform" enctype="multipart/form-data" method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
	<table class="content" cellpadding="10" >
		<tr>
			<td><strong>Select image for upload: </strong></td>
			<td><input name="pictures[]" type="file" id="uploadfile" multiple="multiple" /></td>
			<td><input type="submit" value="Upload New Image" /></td>
		</tr>
	</table>

</form>
</div>
</div>

<!-- End of Main Content-->
					
<?php include './includes/footer.php';?>