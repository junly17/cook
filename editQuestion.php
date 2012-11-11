<?php require_once("fn_layoutControl.php");	
	open_head("edit question","member");	
	close_head();
	open_body(); 
	$conn = connect_db();
    if( !empty($_POST['id_q']) && !empty($_POST['tit']) && !empty($_POST['mess']) ){
		$a = $_POST['id_q'];
		$b = $_POST['tit'];
	    $c = $_POST['mess'];
	    $sql ="UPDATE question SET quesTitle='".$b."',quesMessage='".$c."',quesActiveDate=NOW() WHERE quesID='".$a."'";
	
	$result = mysqli_query($conn,$sql); 
	$affected = mysqli_affected_rows($conn);
	  if($affected==1){
				echo"<center><h1>การแก้ไขรายละเอียดคำถามของคุณถูกบันทึกเรียบร้อยแล้ว</h1></center>";
				echo"<center><h2><span class=\"right\"><a href=\"viewAnswer.php?id_quiz=$a\">"."ย้อนกลับ"."</a></span></h2></center>";
	  }
	}			
	
mysqli_close($conn);	

close_body(); 
?>