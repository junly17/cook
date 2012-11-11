<?php require_once("fn_layoutControl.php");
?>
<?php	 $conn = connect_db();

	if (isset($_GET['likebtn']) && !isset($_SESSION['checkAddPoint'])) {
		
		if (isset($_GET['techID'])) {
			$techid = $_GET['techID'];
			$sqlStr = "SELECT techPoint,techUserName FROM technique WHERE techID = ".$techid ;
			$result = mysqli_query($conn, $sqlStr);
			$row = mysqli_fetch_assoc($result);	
			$techusername =  $row['techUserName'];
			$newPoint = $row['techPoint']+1;
			$sqlStr = "UPDATE technique SET techPoint = ".$newPoint." WHERE techID = ".$techid ;
			$result = mysqli_query($conn, $sqlStr);
			
			$sqlStr = "SELECT userPoint FROM user WHERE username = \"".$techusername."\"" ;
			echo $sqlStr;
			$result = mysqli_query($conn, $sqlStr);
			$row = mysqli_fetch_assoc($result);	
			$newPoint = $row['userPoint']+1;
			echo $newPoint;
			$sqlStr = "UPDATE user SET userPoint = ".$newPoint." WHERE username = \"".$techusername."\"";
			$result = mysqli_query($conn, $sqlStr);
			$_SESSION['checkAddPoint'] = true;
		
			@mysqli_close($conn);
			echo "ให้คะแนนเรียบร้อย.. รอซักครู่";
				echo"<meta http-equiv=\"refresh\"content=\"3;URL=techDetail.php?menuID=$techid\">";	
				
		} else if (isset($_GET['menuID'])) {
			$menuid = $_GET['menuID'];
			$sqlStr = "SELECT menuPoint,menuUsername FROM menu WHERE menuID = ".$menuid ;
			$result = mysqli_query($conn, $sqlStr);
			$row = mysqli_fetch_assoc($result);	
			$techusername =  $row['menuUsername'];
			$newPoint = $row['menuPoint']+1;
			$sqlStr = "UPDATE menu SET menuPoint = ".$newPoint." WHERE menuID = ".$menuid ;
			$result = mysqli_query($conn, $sqlStr);
			
			$sqlStr = "SELECT userPoint FROM user WHERE username = \"".$techusername."\"" ;
			$result = mysqli_query($conn, $sqlStr);
			$row = mysqli_fetch_assoc($result);	
			$newPoint = $row['userPoint']+1;
			$sqlStr = "UPDATE user SET userPoint = ".$newPoint." WHERE username =  \"".$techusername."\"" ;
			$result = mysqli_query($conn, $sqlStr);
			$_SESSION['checkAddPoint'] = true;
			
			@mysqli_close($conn);
			echo "ให้คะแนนเรียบร้อย.. รอซักครู่";
				echo"<meta http-equiv=\"refresh\"content=\"3;URL=recipeDetail.php?menuID=$menuid\">";
				
			
		} 
		
		
	} else if (isset($_SESSION['checkAddPoint'])) {
			echo "ไม่สามารถโหวตได้ในขณะนี้.. รอซักครู่";
			if (isset($_GET['menuID'])) {
				$menuid = $_GET['menuID'];
			echo"<meta http-equiv=\"refresh\"content=\"3;URL=recipeDetail.php?menuID=$menuid\">";
			} else if (isset($_GET['techID'])) {
				$techid = $_GET['techID'];
			echo"<meta http-equiv=\"refresh\"content=\"3;URL=techDetail.php?menuID=$techid\">";	
			}
			
		}
				
						
		
		
		
		?>