<?php require_once("fn_layoutControl.php");
	  require_once("fn_validate.php");
	  
	  open_head("Index","guest");
	  close_head(); 
	  open_body();
	 
	  if (isset($_SESSION['sessMember']) && !empty($_SESSION['sessMember'])) {
			echo"<center><h2>ยินดีต้อนรับ คุณ".$_SESSION['sessMember']."กำลังอยู่ในระบบ</h2></center>";
        } else {	
			echo"<center><h2>คุณไม่ได้เป็นสมาชิก หรือ ยังไม่ได้เข้าสุ่ระบบ</h2></center>";
        }

close_body(); ?>