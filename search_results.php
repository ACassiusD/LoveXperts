<!-- INCLUDING HEADER WITH PHP -->
<!-- INCLUDING HEADER WITH PHP -->
<?php

#VARIABLES
$date = "2015-30-09";
$filename = "search_users.php";
$description = "Users will be able to query a number of users in our databse through this page to find their perfect match";	
$deliverable3author = "Geoffrey Veale";
include './includes/header.php';
?>
<!-- CONTENT GOES HERE -->


<!-- About Me -->
<div id="wrapper1">
	<div class="content">
		<?php 

            $results = $_SESSION['searchResults'];
			$numberOfResults = count($results);
            if(isset($_GET['page']))
            {
                //Page number for nav bar
                $page = $_GET['page'];    
            }
            //echo print_r($_SESSION['searchResults']);
    
            //If more than 10 results print pagination
            if(count($results) > 10)
            {
                $count = 1;
                $script = "";
                
                 for($index = 0; $index <= $numberOfResults; $index+=10) 
                 {
                        
                    $script .= "<a href=\"search_results.php?page=". $count ."\">". $count ."</a>";
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
					foreach($_SESSION['searchResults'] as $Print)
					{
						//get usernid
						$userId = $Print['user_id']; 
						
						
						//buildSearchResult in db.php
						echo buildSearchResult($dbconn, $userId );  
					}
			}
        
            

 ?>
        
	</div>
</div>

<!-- CONTENT ENDS HERE -->

<!-- INCLUDING Footer WITH PHP -->
<?php include './includes/footer.php';?>
