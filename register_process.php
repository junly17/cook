<?php require_once("fn_layoutControl.php");
	  require_once("fn_validate.php");
	  open_head("Register Process","guest");
	  close_head(); 
	  open_body();
?>

<?php
	
	define('URL_BACK',"register_form.php");
	define('URL_GOTO',"index.php");


	if(isset($_POST["btnClear"])){
		unset($_SESSION["arrData"]);		
    	process_msg("ล้างข้อความในแบบฟอร์มแล้ว",URL_BACK);
		exit;
   }else{
   		$_SESSION["arrData"] = $_POST;
   }
   
   
	if( empty($_POST['username1']) || empty($_POST['password1']) || empty($_POST['confirmPwd1']) || empty($_POST['gender1']) 
								   ||  empty($_POST['fName1']) || empty($_POST['lName1']) || empty($_POST['email1']) ){
			process_msg("กรุณากรอกแบบฟอร์มให้ครบทุกช่อง",URL_BACK);

	} elseif (valid_user($_POST['username1'])===false ){
			process_msg("ชื่อผู้ใช้ไม่ถูกต้อง",URL_BACK);
	} elseif (strcmp($_POST['username1'],$_POST['password1'])==0){
			process_msg("รหัสผ่านต้องไม่เหมือนชื่อผใช้",URL_BACK);
	} elseif (strcmp($_POST['password1'],$_POST['confirmPwd1'])!=0){
			process_msg("รหัสผ่านกับยืนยันรหัสผ่านต้องตรงกัน",URL_BACK);
	}elseif (valid_pwd($_POST['password1'])===false ){
			process_msg("รหัสผ่านไม่ถูกต้องตามเงื่อนไขที่กำหนด",URL_BACK);	
	} elseif (valid_email($_POST['email1'])===false ){
			process_msg("อีเมล์ไม่ถูกต้อง",URL_BACK);
	} else {
            $conn = connect_db();
			$sql = "SELECT * FROM user Where username ='".$_POST['username1']."' ";
			$result = mysqli_query($conn,$sql);

			$num_row = mysqli_num_rows($result);
			if($num_row == 1){
				process_msg("ชื่อผู้ใช้".$_POST['username1']."ซ้ำ กรุณาใช้ชื่ออื่น",URL_BACK);
			} else {
				
				$a = $_POST['username1'];
				$b = $_POST['password1'];
				$c = $_POST['confirmPwd1'];
				$d = $_POST['gender1'];	
				$e = $_POST['fName1'];
				$f = $_POST['lName1'];			
				$g = $_POST['email1'];	 
        		$userPoint1 = 0;
				$userType1 = "member";
				
		        $stm ="INSERT INTO user(username,password,gender,fName,lName,email,userPoint,userType)".
					  "VALUES ('".trim($a)."',DES_ENCRYPT('$b','webapp'),'$d','$e','$f','$g','$userPoint1','$userType1')";
                $result = mysqli_query($conn,$stm ); 
				$affected = mysqli_affected_rows($conn);
				
				mysqli_close($conn);
				
				if($affected==1){
					unset($_SESSION["arrData"]);
					process_msg("สมัครสมาชิกเรียบร้อยแล้ว <br/> กรุุณาทำการLogInเข้าสู่ระบบก่อน <br/> เพื่อใช้สิทธิในระดับสมาชิก",URL_GOTO);
					
					}	
				else{
					process_msg("เกิดข้อผิดพลาดในระบบ ไม่สามารคบันทึกข้อมููลได้ในขณะนี้<br/>กรุณาสมัครใหม่อีกครั้ง",URL_BACK);
					}	
			}
	}	

?> 

<?php close_body(); ?>