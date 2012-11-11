
<?php require_once("fn_layoutControl.php");
?>
<?php	 $conn = connect_db();
		//$type = $_GET['hidcom2'];
			$type = $_GET['hidcom2'];
			$comCon = $_GET['ment'];
			$mentID= $_GET['hidcom'];
	$mymenuID= $_GET['hidcom1'];
    	$sqlStr = "UPDATE comment SET comContent='$comCon',comChangeDate=NOW() WHERE comID='$mentID'";
          	$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
						$_SESSION['fromcom'] = true;
						
		
		@mysqli_close($conn);
		if ($type == "menu")
				header("Location: recipeDetail.php?menuID=$mymenuID");
				else
				header("Location: techDetail.php?menuID=$mymenuID");
				exit();
		
		?>