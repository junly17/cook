<?php require_once("fn_layoutControl.php");
?>
<?php	 $conn = connect_db();

	if (isset($_GET['allmenuid'])) {
		$myid = explode(",",$_GET['allmenuid']);
		for ($i=0; $i<count($myid); $i++) {
			
		$sqlStr = "DELETE FROM technique WHERE techID =".$myid[$i];
	
         	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
		}
		
	} else {
	$mymenuID= $_GET['menuID'];
    	$sqlStr = "DELETE FROM technique WHERE techID =".$mymenuID;
          	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
	}
				
						
		
		@mysqli_close($conn);
				header("Location: techList.php");
				exit();
		
		?>