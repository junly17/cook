﻿
<?php require_once("fn_layoutControl.php");
?>
<?php	 $conn = connect_db();
		
	
			$comCon = $_GET['content3'];
			$mymenuID = $_GET['formenuid'];
			$postMenuUsername = $_SESSION['sessMember'];
    $sqlStr = "INSERT INTO comment (comID, comContent, comTechID, comDate, comChangeDate,comUsername,comMenuID ) VALUES ( NULL,'$comCon','$mymenuID',NOW(),NOW(),'$postMenuUsername',-1)";
          	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
						$_SESSION['fromcom'] = true;
			
		
		@mysqli_close($conn);
				header("Location: techDetail.php?menuID=$mymenuID");
				exit();
		
		?>