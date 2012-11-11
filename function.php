<?php session_start(); ?>
<?php function show_header($pageTitle){ ?>
    	<?php  
			if(isset($_COOKIE["cookiMember"])&& !isset($_SESSION["sessMember"])){
				login_with_cookie();
			} ?>

        <?php //แสดงหน้าจอสำหรับสมาชิก
		 	if(!empty($_SESSION["sessMember"])){ ?>
            	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cook Cook</title>
<link type="text/css" rel="stylesheet" href="cookStyle.css">
</head>

<body>
<div id="footerfixed"></div>
    <div id="header"></div>
    <div id="login">
    
    
           <center><span id="identify"><?php echo $_SESSION["sessMember"] ?>เข้าสู่ระบบ</span><hr></center>
                <br />
       		    ชื่อผู้ใช้ : <input type="text" name="name2" id"name2" readonly="readonly" size="25" value="เชฟมือใหม่"/><br/>
        	    คะแนน : <input type="text" name="point2" id"point2" readonly="readonly" size="25 "value="1 ดาว"/><br/>
			    <center> <a href='logout_process.php'>Logout</a> </center>
               
   
       
     </div>
  
    <div id="menu">
   	 	<p class="button"><a href="home.php">HOME</a></p>
        <p class="button"><a href="prifile.php">PROFILE</a></p>
        <p class="button">รายการอาหาร</p>
        <p class="button">รายการอาหารจากวัตถุดิบ</p>
        <p class="button">เทคนิค</p>
        <p class="button">เพิ่มรายการอาหาร/เทคนิค</p>
        <p class="button"><a href="webboard.php"> Question &amp; Answer</a></p>
        <p class="button">ban uer</p>
    </div>
    <div id="container">
   		<div id="search">SEARCH : 
    		<input type="text" size="60" name="searchText"/> 
    		<select name="searchFrom">
        		<option>--ทั้งหมด--</option>
            	<option>รายการอาหาร</option>
            	<option>เทคนิค</option>
        	</select>
        	<button name="searchButt">SEARCH</button>
   		 </div>
         <div id="nevigate">Home &nbsp; >></div>
         <div id="content">
         
        <?php 
			} else { //แสดงหน้าจอสำหรับผู้ใช้ทั่วไป ?>

			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cook Cook</title>
<link type="text/css" rel="stylesheet" href="cookStyle.css">
</head>

<body>
<div id="footerfixed"></div>
    <div id="header"></div>
    <div id="login">
           <form action="login_process.php" method="post" >
              <center>LogIn</center><hr/>
       		   &nbsp; ชื่อผู้ใช้ :  &nbsp;<input type="text" name="name1" id"name1" size="23"/><br/>
        	  รหัสผ่าน :  &nbsp;<input type="text"name="pwd1" id="pwd1" size="23"/>
             <h5><input type="checkbox" name="cookiAcc1" id="cookiAcc1" checked="checked" value="yes"/> จดจำบัญชีและรหัสผ่านไว้</h5>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="logInBtn" value="เข้าสู่ระบบ" />
             
               <button type="submit" name="registerBtn" id="registerBtn"> สมัครสมาชิก</button></div></br>
            </form>
   
   </div>
    <div id="menu">
   	 	<p class="button"><a href="home.php">HOME</a></p>
        <p class="button">รายการอาหาร</p>
        <p class="button">รายการอาหารจากวัตถุดิบ</p>
        <p class="button">เทคนิค</p>

    </div>
    <div id="container">
   		<div id="search">SEARCH : 
    		<input type="text" size="60" name="searchText"/> 
    		<select name="searchFrom">
        		<option>--ทั้งหมด--</option>
            	<option>รายการอาหาร</option>
            	<option>เทคนิค</option>
        	</select>
        	<button name="searchButt">SEARCH</button>
   		 </div>
         <div id="nevigate">Home &nbsp; >></div>
         <div id="content">
		<?php } ?>
<?php }?>


<?php function show_footer(){ ?>

       <div id="footer"></div>	
    </div> 
    </div> 
 
</body>
</html>

<?php }?>

<?php function login_with_cookie(){
	$data = base64_decode($_COOKIE['cookiMember']);
	$data = explode("|",$data);
	$username = trim($data[0]);
	$swd = trim($data[1]);
$conn = connect_db();	
$sql = "SELECT username,password FROM user WHERE username='$username2' AND password = DES_ENCRYPT('$pwd2')";

$result2 = mysqli_query($conn,$sql);

$row2 = mysqli_fetch_assoc($result2);
$num_row2 = mysqli_num_rows($result2);

if($num_row2 == 1){

$_SESSION['sessMember'] = $row2['username'];
	}
	
mysqli_close($conn);

}?>


<?php function connect_db(){
	$conn = mysqli_connect('localhost','root','','oom');
	if(!$conn){
		die("You cann't link to database");
	} else {
		mysqli_query($conn,"SET CHARSET UTF-8");
		return $conn;
	}
}?>

<?php function process_msg($msg,$urlRedirect){
	$info = pathinfo($urlRedirect);
	echo '<center><h2>'.$msg.'</h2></center>';
	echo '<br/><center><a href="'.$info['filename'].'.php"</a> ตกลง </center><br/><br/><br/>';
	

	
	exit;
}?>


<?php function random_string(){
	$letter = 'abcdefghijklmnopqrstuvwxyz0123456789';
	while(strlen($str) <= 4){
		$str .=substr($letter,(rand()%strlen($letter)),1);
	}
	 return $str;
}?>


<?php function valid_user($user){
	if(preg_match('/^[a-z\d]{6,13}$/i',$user)){
			return true;
	} else {
			return false;
	}
}?>

<?php function valid_pwd($pwd){
	if(preg_match('/^[a-z\d_]{6,13}$/i',$pwd)){
			return true;
	} else {
			return false;
	}
}?>

<?php function valid_email($email){
	if(preg_match('/^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/',$email)){
			return true;
	} else {
			return false;
	}
}?>

