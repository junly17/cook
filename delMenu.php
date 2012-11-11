<?php require_once("fn_layoutControl.php");
?>
<?php	 $conn = connect_db();

	if (isset($_GET['allmenuid']) && $_GET['allmenuid'] !="") {
		$myid = explode(",",$_GET['allmenuid']);
		for ($i=0; $i<count($myid); $i++) {
			
		$sqlStr = "DELETE FROM menu WHERE menuID =".$myid[$i];
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
			$sqlStr = "DELETE FROM consist WHERE consistMenuID =".$myid[$i];
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";			
			$sqlStr = "DELETE FROM imgtable WHERE img_menuID =".$myid[$i];
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";	
						
		}
		
	} else if (isset($_GET['menuID'])) {
	$mymenuID= $_GET['menuID'];
    	$sqlStr = "DELETE FROM menu WHERE menuID =".$mymenuID;
          	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
		$sqlStr = "DELETE FROM consist WHERE consistMenuID =".$mymenuID;
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";	
						
						$sqlStr = "DELETE FROM imgtable WHERE img_menuID =".$mymenuID;
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";		
	} 
				
						
		
		@mysqli_close($conn);
				header("Location: menuList.php");
				exit();
		
		?>