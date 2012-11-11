<?php session_start(); ?>

<?php function connect_db(){
	$conn = mysqli_connect('localhost','root','','cooking');
		if(!$conn){
			die("You cann't link to database");
		} else {
			mysqli_query($conn,"SET CHARSET UTF-8");
		return $conn;
		}
}?>

<?php function login_with_cookie(){
	
		$data = base64_decode($_COOKIE['cookiMember']);
		
		$data = explode("|",$data);
		$username2 = trim($data[0]);
		$pwd2 = trim($data[1]);
		
		$conn = connect_db();	
		$sql = "SELECT username,password FROM user WHERE username='$username2' AND password =DES_ENCRYPT('$pwd2','webapp')";
		$result2 = mysqli_query($conn,$sql);
		
		$row2 = mysqli_fetch_assoc($result2);
		$num_row2 = mysqli_num_rows($result2);
	
		if($num_row2 == 1){
				$_SESSION['sessMember'] = $row2['username'];
		}
		mysqli_close($conn);
}?>


<?php function open_head($pageTitle,$pageGrantMinimum){ 
	
		if(isset($_COOKIE["cookiMember"]) && !isset($_SESSION["sessMember"])) {
		   login_with_cookie();
		}
		if(!empty($_SESSION['sessAdmin'])) {
			$userLv = "admin";			
		} else if(!empty($_SESSION['sessMember'])) {
			$userLv = "member";
		} else {
			$userLv = "guest";
		}
	
	if( ($pageGrantMinimum == "admin" && $userLv == "member")||($pageGrantMinimum == "admin" && $userLv == "guest")||
		($pageGrantMinimum == "member" && $userLv == "guest") ){
		echo "<h2>Sorry,You can't access this page.</h2>";	
		echo "<h2>System is backing to home page.</h2><h2>Please wait :))</h2>";	
        echo"<meta http-equiv=\"refresh\"content=\"4;URL=home.php\">";
		exit;
	} else { ?>
		
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $pageTitle; ?> </title>
		<link type="text/css" rel="stylesheet" href="cookStyle.css">
       
        <!-- define<title> and import others document-->
	<?php } ?>
<?php } ?>

<?php function close_head(){?>	
    </head>
<?php } ?>

<?php function open_body(){?>
	
    
		<?php if(!empty($_SESSION['sessAdmin'])) {?>
        	
<body>
<div id="topper">
    			<div id="header"></div>
    			<div id="login">
    					<center><span id="identify"><?php echo $_SESSION["sessAdmin"] ?>เข้าสู่ระบบ</span><hr></center>
            			<br />
       		    		ชื่อผู้ใช้ : <input type="text" name="name2" id"name2" readonly="readonly" size="25" value="เชฟมือใหม่"/><br/>
        	    		คะแนน : <input type="text" name="point2" id"point2" readonly="readonly" size="25 "value="1 ดาว"/><br/>
			    		<center> <a href='logout_process.php'>Logout</a> </center>          
    			</div>
</div>
<div id="container">
       	<div id="leftMenu">	
       			<div id="menu">
   	 					<button type="submit"class="button"><a href="home.php">HOME</a></button>
        				<div class="button"><br/><a href="profile.php">PROFILE</a></div>
        				<div class="button"><br/><a href="menuList.php">รายการอาหาร</a></div>
                        <div class="button"><br/><a href="techList.php">เทคนิคต่างๆ</a></div>
       	 				<div class="button"><br/><a href="searchInt.php">ค้นหารายการอาหารจากวัตถุดิบ</a></div>                       
       					<div class="button"><br/><a href="recipeDetail.php">เพิ่มรายการอาหาร</a></div>
                        <div class="button"><br/><a href="techDetail.php">เพิ่มเทคนิค</a></div>
        				<div class="button"><br/><a href="webboard.php"> QUESTION &amp; ANSWER</a></div>
                        <div class="button"><br/><a href="banUser.php">BAN USER</a></div>
   				</div>      
        
         </div>
         <div id="rightMenu">	
                <div id="search">
                <form action="selectMenuOrTech.php" method="get">
                SEARCH : 
    					<input type="text"  id="searchText" size="60" name="searchText"/> 
    					<select id="searchFrom" name="searchFrom">
        						
            					<option>รายการอาหาร</option>
            					<option>เทคนิค</option>
        				</select>
        				<button name="searchButt" type="submit">SEARCH</button>
   				 </form>
                 </div>
                 
         		<div id="nevigate">Home &nbsp; >>
                </div>
         		<div id="content"> 
				
		<?php } else if(!empty($_SESSION['sessMember'])) {?>
	
<body>
	
<div id="topper">
                <div id="header"></div>
    			<div id="login">
    					<center><span id="identify"><?php echo $_SESSION['sessMember'] ?>เข้าสู่ระบบ</span><hr></center>
            			<br />
       		    		ชื่อผู้ใช้ : <input type="text" name="name2" id"user" readonly="readonly" size="25" value="เชฟมือใหม่"/><br/>
        	    		คะแนน : <input type="text" name="point2" id"point" readonly="readonly" size="25 "value="1 ดาว"/><br/>
			    		<center> <a href='logout_process.php'>Logout</a> </center>          
    			</div>
</div>
<div id="container">
	<div id="leftMenu">	
       			<div id="menu">
        				<a href="home.php"><div class="button"><br/>HOME</div></a>
        				<a href="profile.php"><div class="button"><br/>PROFILE</div></a>
        				<a href="menuList.php"><div class="button"><br/>รายการอาหาร</div></a>
                        <a href="techList.php"><div class="button"><br/>เทคนิคต่างๆ</div></a>
       	 				<a href="searchInt.php"><div class="button"><br/>ค้นหารายการอาหารจากวัตถุดิบ</div></a>                       
       					<a href="recipeDetail.php"><div class="button"><br/>เพิ่มรายการอาหาร</div></a>
                        <a href="techDetail.php"><div class="button"><br/>เพิ่มเทคนิค</div></a>
        				<a href="webboard.php"><div class="button"><br/> QUESTION &amp; ANSWER</div></a>
        
   				</div>       
	</div>
    <div id="rightMenu">	
   				<div id="search">
                <form action="selectMenuOrTech.php" method="get">
                SEARCH : 
      					<input type="text"  id="searchText" size="60" name="searchText"/> 
    					<select id="searchFrom" name="searchFrom">
        						
            					<option>รายการอาหาร</option>
            					<option>เทคนิค</option>
        				</select>
        				<button name="searchButt" type="submit">SEARCH</button>
   				 </form>
                 </div>
         		<div id="nevigate">Home &nbsp; >>
                </div>
         		<div id="content"> 
    
	<?php } else { ?>

	 <body>
			
<div id="topper">	
       <div id="header">
       </div>
       <div id="login">
            
          	 	<form action="login_process.php" method="post" >
              			<center>LogIn</center><hr/>
       		  	 		&nbsp; ชื่อผู้ใช้ :  &nbsp;<input type="text" name="name1" id"name1" size="23"/><br/>
        	 			 รหัสผ่าน :  &nbsp;<input type="password"name="pwd1" id="pwd1" size="23"/>
              	 		
                     	&nbsp;&nbsp;<input type="checkbox" name="cookiAcc1" id="cookiAcc1" checked="checked" value="yes"/> &nbsp;&nbsp;
                        จดจำบัญชีและรหัสผ่านไว้&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="logInBtn" value="เข้าสู่ระบบ" />
				&nbsp;&nbsp;&nbsp;<button type="submit" name="registerBtn" id="registerBtn"> สมัครสมาชิก</button>
                </form>
       </div>
</div> 
<div id="container">
  	<div id="leftMenu">	   
   		 <div id="menu">
         
       			<div id="menu">
   	                              
   				        <a href="home.php"><div class="button"><br/>HOME</div></a>
        			
        				<a href="menuList.php"><div class="button"><br/>รายการอาหาร</div></a>
                        <a href="techList.php"><div class="button"><br/>เทคนิคต่างๆ</div></a>
       	 				<a href="searchInt.php"><div class="button"><br/>ค้นหารายการอาหารจากวัตถุดิบ</div></a>   
                
                
                
                
                </div>      

   		 </div>
   </div>		
   <div id="rightMenu">	 
                <div id="search">
                <form action="selectMenuOrTech.php" method="get">
                SEARCH : 
    					<input type="text"  id="searchText" size="60" name="searchText"/> 
    					<select id="searchFrom" name="searchFrom">
        						
            					<option>รายการอาหาร</option>
            					<option>เทคนิค</option>
        				</select>
        				<button name="searchButt" type="submit">SEARCH</button>
   				 </form>
                 </div>
         <div id="nevigate">Home &nbsp; >>
         </div>
         <div id="content">
	 <?php } ?>
<?php } ?>

<?php function close_body(){ ?>
		 </div> <!--end of #content tag-->
  </div><!--end of #rightMenu tag-->
  
 
  </div> <!--end of #container tag-->		   		
  <div id="footer"></div>   
   	   
    	

</body>
</html>

<?php } ?>


<?php function process_msg($msg,$urlRedirect){
		$info = pathinfo($urlRedirect);
		echo '<center><h2>'.$msg.'</h2></center>';
		echo '<br/><center><a href="'.$info['filename'].'.php"</a> ตกลง </center><br/><br/><br/>';
		exit;
}?>



