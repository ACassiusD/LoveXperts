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

                $output = '<p>To change your password, Enter your user name and email</p>';
                
                
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $user_id = trim($_POST['user_name']);
                    $to = trim($_POST['email']);
                    
                    $result = pg_execute($dbconn,"password_email_query",array($user_id, $to));                
                    
                    $record = pg_num_rows($result);
                
                    if($record == 1)
                    {
					$user = pg_fetch_assoc($result, 0);
                        $characterSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
                        
                        $characterSet =  str_shuffle($characterSet);
                        $message = "";
                        $password = "";
                        
                        for($i = 0; $i<8; $i++)
                        {
                            $password .= $characterSet[$i];    
                        }
                        
                        
                        $date = date("Y-m-d h:i:s a");
                        
                        
                        $subject = "LoveXperts Password Change Request";
                        $message .= "Hello, " . $user['first_name'] . " " . $user['last_name'] . "<br>";
                        $message .= "Your account request a password change on ". $date . "<br>";
                        $message .= "Here is your new password to log in with: " . $password . "<br>";
                        $message .= "Here's a link to log in: <a href='http://opentech2.durhamcollege.org/wede3201/group10/login.php'>Click Here</a>";
                        $headers = 'From: support@lovexperts.com' . "\r\n" ;
                        
                        echo $message;
                        //echo "<p>Email To: " . $to. "</p>";
                        //echo "<p>Subject: " . $subject . "</p>";
                        //echo "<p>Message: " . $message. "</p>";
                        //echo "<p>Headers: " . $headers . "</p>";
                         //mail($to,$subject,$message,$headers);
                        
                        pg_execute($dbconn,"password_change", array($user['user_id'],md5($password),$to));
                        
                        $_SESSION['loginMessage'] = "An email as been sent to your email address<br>";
                        
                        
                        //Email To: " . $to. "Subject: " . $subject . "</p>" . "<p>Message: " . $message. "</p>" . "<p>Headers: " . $headers . "</p>";
                        
                        //header("Location: login.php");
                    }
                    else
                    {
                        $output .= "Email and username are not correct";
                    }
                    echo $output;
                }
            
            else
            {
                
            }
        ?>
        <form id="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<table border="0" cellpadding="10" >
			
            <tr>
				<td><strong>User name</strong></td>
                <td><input name="user_name" value="" size="20"</td>
			</tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><input name="email" value="" size="20"</td>
            </tr>
                <tr>
                    <td><input type="submit" value = "Password Request" /></td>    
                </tr>
            </table>
        </form>
        
    </div>

</div>