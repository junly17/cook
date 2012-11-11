<?php require_once("fn_layoutControl.php");
	 
	  open_head("Edit Answer","member");
	  close_head(); 

?>

	<style type="text/css">
		@import url(questionAndAns.css)
	</style>	
<?php close_head(); ?>

<?php open_body(); ?>
<?php

		$a = $_GET["id"];
		echo $a;
		$b = $_GET['messA'];
		$c = $_GET['id_a'];

		$conn = connect_db();
		
	    $sql1 ="UPDATE answer SET ansMessage='".$b."',ansDate=NOW() WHERE ansID='".$c."'";
	
	
		mysqli_query($conn,$sql1);
	
		
		$affected = mysqli_affected_rows($conn);
			if($affected == 1){
				$temp = mysqli_query($conn,"SELECT quesID,ques_ansCount FROM question WHERE quesID='".$a."'");
				$co = mysqli_fetch_assoc($temp);
				$count = $co['ques_ansCount']-1;
			
				$updateCount = mysqli_query($conn,"UPDATE question SET ques_ansCount='".$count."',quesActiveDate=NOW() WHERE quesID='".$a."'");	
				$url="viewAnswer.php?id_quiz=$a";
				//echo $url;
				echo"<center><h1>รายละเอียดคำตอบของคุณถูกบันทึกแล้ว</h1></center>";
				echo"<center><h2><span class=\"right\"><a href=\"viewAnswer.php?id_quiz=$a\">"."ย้อนกลับ"."</a></span></h2></center>";
		  	} else {
				echo"<center><h1>system error!!  post your answer again ,please</h1></center>";
				echo"<center><h2><span class=\"q2\"><a href=\"viewAnswer.php?id_quiz=$a\">"."ย้อนกลับ"."</a></span></h2></center>";
			}
		
	

mysqli_close($conn);
close_body() ;
?>
