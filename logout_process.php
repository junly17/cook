
<?php require_once("fn_layoutControl.php");
	  require_once("fn_validate.php");
	  open_head("Logout Process","member");
	  close_head(); 
	  open_body();
?>
<?php     
		
         
		$username = $_SESSION['sessMember'];
		unset($_SESSION['sessMember']);
		unset($_SESSION['checkAddPoint']);
		session_destroy();

			
		if(isset($_COOKIE["cookiMember"])){
			
			$url = "setcookie.php?createOrDel=delete";
			//process_msg("logging out from system",$url);
			echo'<meta http-equiv="refresh"content="3;URL='.$url.'">' ; 				
		}else{
			
			//process_msg("ต้องการออกจากระบบ?","index.php");
			
?>		
	
        <center><h3>Thanks <?php echo $username; ?> for visiting our web site.</h3></center>
                      echo"<meta http-equiv=\"refresh\"content=\"3;URL=index.php\">" ;
        <center><p> click <a href="login_process.php" >here</a> to go to login again.</p></center>
	

 <?php 
		}
close_body(); ?>

