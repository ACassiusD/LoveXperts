<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-11-17";
$filename = "disabled_user.php";
$description = "This page will allow admins to disable certain users";	

include './includes/header.php';
?>
<div id="wrapper1">
	<div class="content">
	
	<?php
	if ($_SESSION['user_type'] == constant("ADMIN") && $_SESSION['loggedin'] == true)
	{
	$sql = pg_execute($dbconn,"gather_user_type", array(DISABLED_CLIENT));
    $results = pg_fetch_all($sql);   
	$numberOfResults = pg_num_rows($sql);
        
	if(isset($_GET['page']))
            {
                //Page number for nav bar
                $page = $_GET['page'];    
            }
            //echo print_r($_SESSION['searchResults']);
    
            //If more than 10 results print pagination
        //echo $numberOfResults;
        if($numberOfResults > 0)
        {
            if($numberOfResults > 10)
            {
                $count = 1;
                $script = "";
                
                 for($index = 0; $index <= $numberOfResults; $index+=10) 
                 {
                        
                    $script .= "<a href=\"disabled_user.php?page=". $count ."\">". $count ."</a>";
                    $count++;
                    
                }
                echo $script;
                //Chunks the array into several arrays each containing 10(sometimes less if its a tailing array)
                $chunkedArray = array_chunk($results, 10);
                    //echo $chunkedArray;
                    //print("<pre>".print_r($chunkedArray[1],true)."</pre>");
                   
                
                
                //if the page number is set
                if(isset($page))
                {
                    $page = $page-1;
                    //Set the records to be printed to the Array Chunk at Page number
                    $recordsToPrint = $chunkedArray[$page];
                    
                    foreach($recordsToPrint as $record)
                    {
                        //get usernid
                        $userId = $record['user_id']; 
                        
                        
                        //buildSearchResult in db.php
                        echo buildSearchResult($dbconn, $userId );    
                    }
                    
                    
                }
				else
				{
					$recordsToPrint = $chunkedArray[0];
						
					foreach($recordsToPrint as $record)
					{
						//get usernid
						$userId = $record['user_id']; 
						
						
						//buildSearchResult in db.php
						echo buildSearchResult($dbconn, $userId );    
					}
				}
            }
			//Less than 10 records were found
			else
			{		
					foreach($results as $Print)
					{
						//get usernid
						$userId = $Print['user_id']; 
						
						
						//buildSearchResult in db.php
						echo buildSearchResult($dbconn, $userId );  
					}
			}
        }
        else
        {
            echo "<h1>There are no Disabled users currently</h1>";    
        }
	}
	else
	{
		header( "Location: dashboard.php" );
		echo "Sorry only admins can access this page";
	}
	
	?>
	
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
