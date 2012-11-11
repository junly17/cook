<?php require_once("fn_layoutControl.php");
	open_head("Post Question Form","member");	  
?>
	<style type="text/css">
	@import url(questionAndAns.css)
	</style>
<?php close_head(); ?>
<?php open_body(); ?>
<?php 
			    
				$mem = $_SESSION['sessMember'];
			
				$conn = connect_db();
				$sql = "SELECT * FROM user WHERE username='$mem'";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_array($result)) {
						$a 	=	$row[0];
						$b	 =	$row[1];
						$c	 =	$row[2];
						$d 	= 	$row[3];
						$e 	 =	$row[4];
						$f =	$row[5];
						$g	 =	$row[6];
						$h	 =	$row[7];
					}
				mysqli_close($conn);
?>
	<div id="postQ">
		<form name="postQuestion" action="postQuestion_process.php" method="post">
		<h2>ร่วมตั้งคำถาม</h2>
			<br/>
			หัวข้อกระทู้ :<br/>
				<input name="title" type="text" size="105" />
			<br/>
			รายละเอียด :
			<br/>
				<textarea name="message" cols="78" rows="5" wrap="virtual" id="message"></textarea>
			<br/>
			เจ้าของกระทู้ :
				<input name="username" id="username"class="readonly" value="<?php echo $_SESSION['sessMember'] ?>" type="text" size="50" readonly="readonly"/>
			<br/>
		       E-mail : <input name="email" id="email" class="readonly" value="<?php echo $f ?>" type="text" size="50" readonly="readonly"/> 
			  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input type="radio" checked="checked" name="show" value="yes"/> ต้องการแสดงอีเมล์ 
			  <input type="radio" name="show" value="no"/> ไม่ต้องการแสดงอีเมล์
			
	  <div class="right">
				<input type="submit" value="ตั้งคำถาม" name="post"/>
				<input type="reset" value="ล้างแบบฟอร์ม" name="cancle"/>
			</div>
		</form>
		<br/>
		<br/>
	</div>

<?php close_body() ;?>