<?php require_once("fn_layoutControl.php"); 

	$idQ = $_POST['id_ques'];
	$conn = connect_db();
	
	$sql1 ="DELETE FROM answer WHERE ans_quesID = '".$idQ."'";
	$sql2 ="DELETE FROM question WHERE quesID = '".$idQ."'";
	
	mysqli_query($conn,$sql1);
	mysqli_query($conn,$sql2);
	echo "<center><h2>กระทู้ถามตอบนี้ถูกลบเรียบร้อยแล้ว</h2></center>";

	
?>