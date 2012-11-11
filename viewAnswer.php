<?php require_once("fn_layoutControl.php");
	open_head("view Answer","member");	  
?>
	<style type="text/css">
		@import url(questionAndAns.css)
	</style>
	<script type="text/javascript" src="jquery-1.8.2.js"></script>
<?php close_head(); ?>
<?php open_body(); ?>
<?php 
			    
				$mem = $_SESSION['sessMember'];
			
				$conn = connect_db();
				$sql = "SELECT * FROM user WHERE username='$mem'";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_array($result)) {
						$a 	 =	$row[0];
						$b	 =	$row[1];
						$c	 =	$row[2];
						$d 	= 	$row[3];
						$e 	 =	$row[4];
						$f  =	$row[5];
						$g	 =	$row[6];
						$h	 =	$row[7];
					}
				mysqli_close($conn);
?>
	<div id="showNoAns"></div>
	
		&nbsp<a href="webboard.php">ดูกระทู้ทั้งหมด<a> [<a href="postQuestion_form.php">ตั้งกระทู้ใหม่</a>]<hr/>
		
	<div id="showAns">	
		<div id="postDetail">
		<form action="editQuestion.php" method="post" name="editQues"> 
			<?php
				$conn = connect_db();
				$id_qq = $_GET['id_quiz'];
				
				$stm = "SELECT * FROM question WHERE quesID = '$id_qq'" ;
				$result = mysqli_query($conn,$stm);
				if(mysqli_num_rows($result) != 0){
					while($row = mysqli_fetch_array($result)) {
						$id_q 		 =	$row[0];
						$title_q 	 =	$row[1];
						$message_q	 =	$row[2];
						$pin_q 		 = 	$row[3];
						$date_q 	 =	$row[4];			
						$showAcc	 =	$row[5];
						$ansCount	 =	$row[6];
						$username_q	 =	$row[7];
					}
			
				?>
			
				 <input id="id_q" name="id_q" type="hidden" value="<?php echo $id_q ;?>" />
				 <h3><input id="tit" name="tit" type="text" value="<?php echo $title_q ;?>" readonly="yes" size="50"/></h3>
				 <span class="a4">รายละเอียดคำถาม :</span> &nbsp;
				 <textarea id="mess" name="mess" cols="45px" rows="4px" readonly="yes"><?php echo $message_q; ?></textarea>
			
				<?php if($username_q == $_SESSION['sessMember']){?>
					<button type="button" id="edit2"><span class="textB">ลบ</span></button>					
					<button type="button" id="edit1"><span class="textB">แก้ไข</span></button>
					<button type="submit" name="save" id="save">
					<span class="textB">บันทึก</span></button>
			
			
				<?php }
				
				echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ถาม : ".$username_q;	
				echo " | วันเวลาที่ถาม : <font color=\"red\">".$date_q."</font></h4>";
				if($showAcc==1){
					echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;E-mail : ".$f;
					}
				if($showAcc==0){
					echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;E-mail : ไม่ต้องการแสดงอีเมล์";
				}
				
				}?>
					
		</form>	
		<br><br>
		</div><hr/>

			<div id="oldAnswer">
			<form action="editAnswer.php" method="get">
			<?php
				$sql1 = "SELECT * FROM answer WHERE ans_quesID='$id_qq'";
					$result1 = mysqli_query($conn, $sql1);
					$num_rows = mysqli_num_rows($result1);					
					if($num_rows == 0){
						echo "ยังไม่มีใครตอบคำถาม";
					}
					$i=0;
					$n=0;
					
					while ($i < $num_rows){
						$rows = mysqli_fetch_array($result1);			
							$id_a 		 =	$rows[0];
							$message_a 	 =	$rows[1];
							$date_a	 	 =	$rows[2];
							$username_a  = 	$rows[3];
							$quesID_a 	 =	$rows[4];						
						$n++;
						?>
				<div class="eachAns">
			
					<input name="id_q_<?php echo $n ;?>" type="hidden" value="<?php echo $id_q ;?>" />
					<input name="id_a_<?php echo $n ;?>" type="hidden" value="<?php echo $id_a ;?>" />
							<span class="a4">คำตอบที่<?php echo $n ;?></span>
							<span class="a2">&nbsp;จาก <?php echo $username_a ; ?></span>
							<span class="a3"> | <?php echo $date_a ;?></font></span><br/>
						<span class="a1">รายละเอียดคำตอบ : </span>  
						<textarea class="messA" name="messA" id="<?php echo $id_a ;?>"
						cols="50px" rows="2px" readonly="yes"><?php echo $message_a ;?></textarea>	
			
			      <?php
				     echo "<hr color=#FFCC00></div>";
				  
				 	 $i++;
					}
				mysqli_free_result($result);
				mysqli_close($conn);
			?>
		 </form>
		 </div><br/><br/>
 
		&nbsp;&nbsp;&nbsp;<u>ร่วมตอบคำถาม</u><br/><br/>
		<div id="answer">
			<form name="replyAnswer" method="post" action="replyAnswer_process.php">
				
				<input type="hidden" name="id_quiz" size ="20" value="<?php echo $id_qq ?>"/>
				
				ชื่อ : <br/>
				<input type="text" name="username" value="<?php echo $_SESSION['sessMember'] ?>" size="30" readonly="readonly"/><br/>
				รายละเอียด :<br/>
				<textarea name="mess" cols="70px" rows="5" ></textarea><br/>
							
				
				<input type="submit" name="answer" value="ตอบคำถาม">
				<input type="reset" name="cancle" value="ยกเลิก">
			
		
		</div>
		</form><br/><br/><br/>
		

	</div>
<?php close_body() ;?>
<script type="text/javascript" src="jquery-1.8.2.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		    $("#edit1").css("background-color","#7FDFAA");	
			$("#save").hide();
			$("#edit2").css("background-color","#FF9FFF");
			
			$(".editA1").css("background-color","#7FDFAA");	

			
		
			$("#edit1").mouseover(function(){
				$("#edit1").css("background-color","#0FA");	
				$("#edit1").css("cursor","pointer");	
			});		
			$("#edit1").mouseout(function(){
				$("#edit1").css("background-color","#7FDFAA");	
			});		
			
			$("#edit1").click(function(){
				$("#edit1").hide();
				$("#save").show();
				$("#save").css("cursor","pointer");	
				$("#save").css("background-color","#0FA");	
					
				$("#mess").css("background-color","white");
			    $("#mess").css("border-style","inset");
				$("#mess").removeAttr("readonly","yes");
				$("#mess").attr("rows","8");
				
				$("#tit").css("background-color","white");
			    $("#tit").css("border-style","inset");
				$("#tit").removeAttr("readonly","yes");
			});		
			
			$("#edit2").mouseover(function(){
				$("#edit2").css("cursor","pointer");	
				$("#edit2").css("background-color","#FF5FFF");	
			});
			$("#edit2").mouseout(function(){
				$("#edit2").css("cursor","pointer");	
				$("#edit2").css("background-color","#FF9FFF");	
			});
			
			$("#edit2").click(function(){			
				
				var confirmm = confirm("คุณต้องการลบการถามคอบของคุณ?");
				
				if(confirmm == 1){
						var idQues = $("#id_q").val();	
						$.post(
								"delQuestion.php",
									{id_ques:idQues},
										function(data){
											 	$("#showAns").remove();
												$("#showNoAns").html(data);
											
											}
							);			
				}
				else{;}
			});
	
			$(".editA1").mouseover(function(){
				$(".editA1").css("background-color","#0FA");	
				$(".editA1").css("cursor","pointer");	
			});		
			$(".editA1").mouseout(function(){
				$(".editA1").css("background-color","#7FDFAA");	
			});		
			

		
			
	});	
	
	
	
	
	
	
</script>	
	