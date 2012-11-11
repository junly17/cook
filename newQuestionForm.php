<?php require_once("fn_layoutControl.php");
	open_head("New Question Form","member");	  
?>
	<style type="text/css">
	@import url(questionAndAns.css)
	</style>
<?php close_head(); ?>
<?php open_body(); ?>

	<div id="postQ">
		<form name="postQuestion" action="viewQuestion.php" method="get">
		<h2>ร่วมตั้งคำถาม</h2>
			<br/>
			หัวข้อกระทู้ :<br/>
				<input name="title" type="text" size="105" />
			<br/>
			รายละเอียด :
			<br/>
				<textarea name="message" cols="78" rows="5" wrap="virtual" id="message"></textarea>
			<br/>
			อีเมล์ :
				<input name="email" type="text" size="60" />
			<br/>
			เจ้าของกระทู้ :
				<input name="owner" type="text" size="50" />
			<br/><br/>
			<div class="right">
				<input type="submit" value="ตั้งคำถาม" name="post"/>
				<input type="reset" value="ยกเลิก" name="cancle"/>
			</div>
		</form>
		<br/>
		<br/>
	</div>

<?php close_body() ;?>