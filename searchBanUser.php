<?php require_once("fn_layoutControl.php");
	
	  open_head("Search Banned User","admin");	  
?>


<?php open_body(); ?>

<?php


if (isset($_REQUEST['bannedUser']) && $_REQUEST['bannedUser'] != "") {
	$conn = connect_db();
						$sqlStr = "SELECT username FROM user";
						$result = mysqli_query($conn, $sqlStr);
						while ($row = mysqli_fetch_assoc($result)) {
							$pos = strpos($row['username'], $_REQUEST['bannedUser']);
							if ($pos !== false) {
     							$userArr[] = $row['username'];
								
							}
						}
					
					@mysqli_close($conn);
					if(isset($userArr)) {
						$sendUser = implode(",",$userArr);
				header("Location: banUser.php?banusers=$sendUser");
				exit();
					} else {
							header("Location: banUser.php?banusers=none");
				exit();
					
					}
}
else {

	echo "กรุณาใส่ชื่อ user เพื่อค้นหา user ที่ต้องการ ban";	
		echo"<meta http-equiv=\"refresh\"content=\"3;URL=banUser.php?\">";	
}


close_body() ;


?>