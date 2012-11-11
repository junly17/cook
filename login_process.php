<?php require_once("fn_layoutControl.php");
	  require_once("fn_validate.php");
	  open_head("Login Process","guest");
	  close_head(); 
	  open_body();
?>
<?php 
	//define('URL_BACK',"login_form.php");
	define('URL_GOTO',"index.php");
	if(isset($_POST["registerBtn"])){
		process_msg("ร้องขอใบสมัครสมาชิก","register_form.php");
		exit;
	} else {
		if (empty($_POST['name1']) && empty($_POST['pwd1']) )
		{	process_msg("Please fill username and password before",URL_GOTO);
			
		} elseif( empty($_POST['name1']) ){
			process_msg("Please fill username before",URL_GOTO);
		
		} elseif( empty($_POST['pwd1']) ) {	
			process_msg("Please fill password before",URL_GOTO);
		
		}else {

				$username2 = $_POST['name1'];
				$pwd2 = $_POST['pwd1'];
			
				
				$conn = connect_db();
				$sql = "SELECT username,password FROM user WHERE username='$username2' AND password =DES_ENCRYPT('$pwd2','webapp')";
				$result2 = mysqli_query($conn,$sql);
				mysqli_close($conn);
				
				$row2 = mysqli_fetch_assoc($result2);
				$num_row2 = mysqli_num_rows($result2);
				
				if($num_row2 == 1){
					$_SESSION['sessMember'] = $row2['username'];
										
					if(isset($_POST['cookiAcc1'])&& $_POST['cookiAcc1']=="yes"){
						  $data = $username2."|".$pwd2;
						  $data = base64_encode($data);
						  $url = "setcookie.php?createOrDel=create&data=".$data ;
						  //$msg = "<center><h2>....ระบบกำลังดำเนินการตรวจสอบ กรุณารอสักครู่...</center></h2>";
						  //	$info = pathinfo($url);
						//	echo '<center><h2>'.$msg.'</h2></center>';
							//echo '<br/><center><a href="'.$info['filename'].'.php"</a> ตกลง </center><br/><br/><br/>';
						 echo"<center><h2>....ระบบกำลังดำเนินการตรวจสอบ กรุณารอสักครู่...</center></h2>";
						//  echo "<a href=\"$url\">daaaa</a>";
						 echo'<meta http-equiv="refresh"content="3;URL='.$url.'">' ; 	
					}
					else{
					  echo"<center><h2>....ระบบกำลังดำเนินการตรวจสอบ กรุณารอสักครู่...</center></h2>";				
						$url = "setcookie.php?createOrDel=delete";
						
						echo'<meta http-equiv="refresh"content="3;URL='.$url.'">' ; 	

					}

			} else {
				    $msg = "Username or/and Password is fail!!";
				    process_msg($msg,URL_GOTO);
		}

}
}
mysqli_free_result($result2);
close_body(); ?>