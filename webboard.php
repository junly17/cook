<?php require_once("fn_layoutControl.php");
	open_head("Webboard","member");	  
?>
	<style type="text/css">
		@import url(questionAndAns.css)
	</style>
	
<?php close_head(); ?>
<?php open_body(); ?>

	<div id=" showWebboard">
		<h3> แสดงกระทู้ทั้งหมด </style></h3>[<a href="postQuestion_form.php">ตั้งกระทู้ใหม่</a>]
		<br/><hr/>
<?php

	 
		$conn = connect_db();
		$stm = "SELECT * FROM question ORDER BY quesActiveDate DESC";
		$result = mysqli_query($conn,$stm);
	
		while($row = mysqli_fetch_array($result)) {
		
			$id_q 		 =	$row['quesID'];
			$title_q 	 =	$row['quesTitle'];
			$message_q	 =	$row['quesMessage'];
			$pin_q 		 = 	$row['quesPin'];
			$date_q 	 =	$row['quesDate'];
			$showEmail_q =	$row['showAcc'];
			$ansCount_q	 =	$row['ques_ansCount'];
			$username_q	 =	$row['quesUsername'];
			$actDate_q	 =	$row['quesActiveDate'];
			
			echo"<span class=\"q1\"><b>".$id_q."</b></style></span>";
			echo"<span class=\"q2\"><a href=\"viewAnswer.php?id_quiz=$id_q\" target=\"$id_q\">".$title_q."</a></span>";
			
			echo"<span class=\"q4\"> [by ".$username_q."</span>";
			echo"<span class=\"q4\"> เมื่อ".$date_q."]</font></style></span>";
				
			
			echo"<span class=\"q0\">".$ansCount_q."คำตอบ</span>";
			echo"<span class=\"q0\">--เปลี่ยนแปลงล่าสุุด".$actDate_q."</span><br/>";
		}
    	mysqli_free_result($result);
     	mysqli_close($conn);
?>
	<hr/><br/><br/><br/><br/><br/> 
	</div>
<?php close_body() ;?>