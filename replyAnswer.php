<?php require_once("fn_layoutControl.php");
	open_head("view Answer","member");	  
?>
	<style type="text/css">
		@import url(questionAndAns.css)
	</style>	
<?php close_head(); ?>

<?php open_body(); ?>
<?php
	    $conn = connect_db();

	    $a = $_POST['name1'];
		$b = $_POST['message1'];
		$d = $_POST['id_quiz'];
		$e = NULL;
		
	    $stm ="INSERT INTO reply (Name,Details,QuestionID,ReplyID) VALUES ('$a','$b','$d','$e')";
		mysqli_query($conn,$stm);
		mysqli_free_result($result);
		mysqli_close($conn);

close_body() ;?>