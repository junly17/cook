<?php require_once("fn_layoutControl.php");
	
	  open_head("Do Banned User","admin");	  
?>


<?php open_body(); ?>

<?php


if (isset($_REQUEST['username'])) {
	$conn = connect_db();
						$sqlStr = "DELETE FROM user WHERE username = \"".$_REQUEST['username']."\"";
						$result = mysqli_query($conn, $sqlStr);
						if (mysqli_affected_rows($conn) == 1) {
							
							echo "Ban user เรียบร้อย  กรุณารอซักครู่";	
						
							
						} else {
						  echo "Fail to ban user. Please try again.";	
						}
						@mysqli_close($conn);
					echo"<meta http-equiv=\"refresh\"content=\"3;URL=banUser.php?\">";
					

}
else {

	echo "ไม่พบ Username ที่จะ ban.. กรุณารอซักครู่";	
		echo"<meta http-equiv=\"refresh\"content=\"3;URL=banUser.php?\">";	
}


close_body() ;


?>