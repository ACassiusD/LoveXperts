<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "change_password.php";
$description = "This page will be used to host the form that will allow account creation for our website and store their information in our database";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">
        
        <?php

            $old_password ="";
            $confirm_password = "";
            $new_password = "";
            $output = "";
            $error = "";

            if($_SESSION['loggedin'] = true)
            {
                $output .= "Welcome, " . $_SESSION['user_id'] . " To Change your password, Enter old password and new password twice." ;
                
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                    $old_password = trim($_POST['old_password']);
                    $confirm_password = trim($_POST['conf_password']);
                    $new_password = trim($_POST['new_password']);
                    $output = "";
                
                    if(strlen($new_password) < MINIMUM_PASSWORD_LENGTH)//if the password is too short message will be display
                    {
                        $error .= 'Password invalid, must be between ' . MINIMUM_PASSWORD_LENGTH. ' and ' .MAXIMUM_PASSWORD_LENGTH. ' characters.<br/>';
                    }
                    else if(strlen($new_password) > MAXIMUM_PASSWORD_LENGTH)//if the password is too long message will be display
                    {
                        $error .= 'Password invalid, must be between ' . MINIMUM_PASSWORD_LENGTH. ' and ' .MAXIMUM_PASSWORD_LENGTH. ' characters.<br/>';
                    }

                    if($new_password !== $confirm_password)//if the password is not the same as comfirm password
                    {
                        $error .= " Password and Confirm Password don't match.<br/>";
                    }
                    if($old_password == $new_password)
                    {
                        $error .= "New password Cannot be the same as the Old";   
                    }
                    
                    
                    if(empty ($error))
                    {
                        $result = pg_execute($dbconn, "password_query", array($_SESSION['user_id'], md5($old_password)));
                                         
                        $record = pg_num_rows($result);
                        
                        if($record == 1) {
                            pg_execute($dbconn,"password_update", array($_SESSION['user_id'],md5($new_password), md5($old_password)));   
                            $output = "Your password was changed sucessfully";
                        }
                        else
                        {
                            $output = "Current password incorrect";
                        }
                        
                    }
                }
            }
            else
            {
                $output .= "You must be logged in before using this service.\n";
            }
        
            echo $output;
            echo $error;
        ?>
        
        
        
        <form id="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			
            <tr>
				<td><strong>Old Password</strong></td>
				<td><input type="password" name="old_password" value= "" size="20" /></td>
			</tr>
            <tr>
                <td><strong>New Password</strong></td>
                <td><input type="password" name="new_password" value="" size="20"</td>
            </tr>
                <tr>
				    <td><strong>Confirm Password</strong></td>
				    <td><input type="password" name="conf_password" value="" size="20" /></td>
                </tr>
                <tr>
                    <td><input type="submit" value = "Change Password" /></td>    
                </tr>
            </table>
        </form>
    </div>
</div>