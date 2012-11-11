<?php require_once("fn_layoutControl.php");
	  require_once("fn_validate.php");
	  open_head("Register Process","guest");
	  close_head(); 
	  open_body();
?>

<?php 
	define('URL_BACK',"profile.php");
	$conn = connect_db();
	
if(isset($_POST['changePwd'])){
		if(!empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['password3'])) {
	
					if (strcmp($_POST['username1'],$_POST['password2'])==0){
					process_msg("รหัสผ่านต้องไม่เหมือนชื่อผู้ใช้",URL_BACK);
					} 
					
					if (valid_pwd($_POST['password2'])===false ){
					process_msg("รหัสผ่านไม่ถูกต้องตามเงื่อนไขที่กำหนด",URL_BACK);	
					} 
					
					if (strcmp($_POST['password2'],$_POST['password3'])!=0){
					process_msg("รหัสผ่านใหม่กับยืนยันรหัสผ่านใหม่่ต้องตรงกัน",URL_BACK);
					}
			
							//$p1 = $_POST['password1'];
							$p2 = $_POST['password2'];
							//$p3 = $_POST['password3'];
							$sql ="UPDATE user SET password=DES_ENCRYPT('$p2','webapp') WHERE username='".$_SESSION["sessMember"]."'";
			    			$result1 = mysqli_query($conn,$sql); 
							
							$affected1 = mysqli_affected_rows($conn);
							
		if($affected1==1){
			
			@$username = $_SESSION['sessMember'];
			unset($_SESSION['sessMember']);
			session_destroy();

		if(isset($_COOKIE["cookiMember"])){
			$url = "setcookie.php?createOrDel=delete";
			//process_msg("logging out from system",$url);
						
		}
								$msg1 = "แก้ไขพาสเวิร์ดเรียบร้อยแล้ว <br/> กรุุณาทำการLogInเข้าสู่ระบบใหม่ <br/> เพื่อใช้สิทธิในระดับสมาชิก<br/>";
								echo'<meta http-equiv="refresh"content="5;URL='.$url.'">' ; 	
								
							
							}else{
								process_msg("เกิดข้อผิดพลาดในระบบ ไม่สามารถเปลี่ยนพาสเวิร์ดได้ในขณะนี้<br/>กรุณาเปลี่ยนพาสเวิร์ดใหม่อีกครั้ง","profile.php");
								}	
		}
			
}
if(isset($_POST['save'])){
		if( !empty($_POST['name1']) && !empty($_POST['surname1']) && !empty($_POST['email1']) ){
	     	if (valid_email($_POST['email1'])===false ){
						process_msg("อีเมล์ไม่ถูกต้อง",URL_BACK);
			}
			   
			 if( !empty($_POST['name1']) && !empty($_POST['surname1']) && !empty($_POST['email1']) ){
				
		    	if( $_POST['gender1'] == "F"){
					$gen = 'F';
				}else{	
					$gen = 'M';
				}
				
				$e = $_POST['name1'];
				$f = $_POST['surname1'];			
				$g = $_POST['email1'];	 
        		//$userPoint1 = 0;
				//$userType1 = "member";
				
		$stm ="UPDATE user SET gender='".$gen."',fName='".$e."',lName='".$f."',email='".$g."' WHERE username='".$_SESSION["sessMember"]."'";
				$result2 = mysqli_query($conn,$stm); 
				$affected2 = mysqli_affected_rows($conn);
				
				
				if($affected2==1){
					echo"<meta http-equiv=\"refresh\"content=\"1;URL=profile.php\">" ; 
				}else{
						process_msg("เกิดข้อผิดพลาดในระบบ ไม่สามารถแก้ไขข้อมูลส่วนตัวได้ในขณะนี้<br/>กรุณาทำการแก้ไขใหม่อีกครั้ง","profile.php");
				}	
			}
     }
}
			
				
mysqli_close($conn);
		
	
?> 

<?php close_body(); ?>