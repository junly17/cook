<?php require_once("fn_layoutControl.php");
	open_head("View Question","member");	  
?>
	<style type="text/css">
	@import url(questionAndAns.css)
	</style>
<?php close_head(); ?>
<?php open_body(); 

	if(empty($_POST['title'])||empty($_POST['message'])||empty($_POST['username'])){
		process_msg("กรุณากรอกแบบฟอร์มให้ครบทุกช่อง","postQuestion_form.php");
	} else {	
		$a = $_POST['title'];
		$b = $_POST['message'];
		$c = $_POST['username'];
		//$d = $_POST['email'];
		
		if($_POST['show']="yes"){
		    $showw = true;
		}
		if($_POST['show']="no"){
			$showw = false;
		}
		
		$conn = connect_db();		
		$stm ="INSERT INTO question (quesID,quesTitle,quesMessage,quesPin,quesUsername,showAcc,quesActiveDate)".
	     		" VALUES (NULL,'$a','$b','0','$c','$showw',NOW())";
		$result = mysqli_query($conn,$stm);
		$affected = mysqli_affected_rows($conn);
		
		if($affected == 1){
			process_msg("ระบบโพสต์คำถามของคุณเรียบร้อยแล้ว กลับไปหน้าแสดงกระทู้ทั้งหมด","webboard.php");
		} else{
			process_msg("system error!!  post your answer again ,please","postQuestion_form.php");
		}
	}
			mysqli_free_result($result);
		    mysqli_close($conn);
close_body() ;
?>
