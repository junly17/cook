<?php require_once("fn_layoutControl.php");
	open_head("Register Form","guest");
?>
	<style type="text/css">
		@import url(userData.css)
	</style>
<?php 
	close_head(); 
    open_body(); 
?>	  
<?php
	if(isset($_SESSION["arrData"]) ){
		$inputData = $_SESSION['arrData']; 
	} else {
		$inputData["username1"] = "" ;
		$inputData["fName1"]= "" ;
	    $inputData["lName1"] = "" ;
	    $inputData["email1"] = "" ;
	}
?>
<div id="reg_form">
	<div id="top"><h2>สมัครสมาชิกเว็บไซต์</h2></div>

	<form name="register" action="register_process.php" method="post">
		<ul> ข้อมูลสำหรับเข้าระบบ (กรุณากรอกให้ครบทุกช่อง)
			<li class="title"> <br/>ชื่อผู้ใช้ : <input name="username1" type="text" size ="50" maxlength="13" 
            								value="<?php echo $inputData["username1"];?>" /></li>
			<li class="cond"> (ภาษาอังกฤษ และตัวเลขเท่านั้น จำนวน6-13 ตัวอักษร)</li>
			<li class="title"> <br/> รหัสผ่าน : <input name="password1" type="password" size ="50" maxlength="25" value="" /></li>         
			<li class="cond"> (ภาษาอังกฤษ ตัวเลข และเครื่องหมาย_เท่านั้น จำนวน6-13 ตัวอักษร) </li>
			<li class="title"> <br/> ยืนยันรหัสผ่าน : <input name="confirmPwd1" type="password"  size ="50" maxlength="25"value="" /></li>
			<li class="cond"> (ต้องกรอกให้ตรงกับรหัสผ่าน)</li>
		</ul>
                        
		<br/><br/>
          <hr/>  
		           		
		<ul> ข้อมูลส่วนตัว (กรุณากรอกให้ครบทุกช่อง)     
			<br/>
			<li class="title1"><br/> เพศ : <input name="gender1" type="radio" value="M"/> ชาย <input name="gender1" type="radio" value="F"/> หญิง 							</li>
			<li class="title"><br/> ชื่อ : <input name="fName1" type="text" size="50" value="<?php echo $inputData["fName1"];?>" /></li>
			<li class="title"> <br/> นามสกุล : <input name="lName1" type="text" size="50" value="<?php echo $inputData["lName1"];?>" /></li>
			<li class="title"> <br/> อีเมล์ : <input name="email1" type="text" size ="50" value="<?php echo $inputData["email1"];?>" /></li>
			<li class="cond"> ตัวอย่าง someone@hotmail.com </li>
		</ul>
            
		<br/><br/>
		<div id="btns"><input name="btnOk"id="btnOk" type="submit" value="สมัครสมาชิก"/>
							<input name="btnClear" id="btnClear"type="submit" value="ล้างข้อมูล"/>
		</div>
	</form><br/>
</div>


<?php close_body() ?>