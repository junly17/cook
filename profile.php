<?php require_once("fn_layoutControl.php");
	
	  open_head("Profile","member");
	  $mem = $_SESSION['sessMember'];
	    	  
?>

  <link type="text/css" rel="stylesheet" href="menuList.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
	<style type="text/css">
		@import url(profileStyle.css)
	</style>
 	<script>
 			 $(document).ready(function() {
    		 $("#tabs").tabs();
  			});
  	</script>
	
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	
	<?php close_head(); ?>
	<?php open_body(); ?>
					<?php 
			    
				
			
				$conn = connect_db();
				$sql = "SELECT * FROM user WHERE username='$mem'";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_array($result)) {
						$a 	 =	$row[0];
						$b	 =	$row[1];
						$c	 =	$row[2];
						$d 	 = 	$row[3];
						$e 	 =	$row[4];
						$f   =	$row[5];
						$g	 =	$row[6];
						$h	 =	$row[7];
					}
				
				 ?>
  


<div id="tabs">
    <ul>
        <li class="tit"><a href="#fragment-1"><span>ข้อมูลส่วนตัว</span></a></li>
        <li class="tit"><a href="#fragment-2"><span>เมนูอาหารของฉัน</span></a></li>
        <li class="tit"><a href="#fragment-3"><span>เทคนิคของฉัน</span></a></li>
		<li class="tit"><a href="#fragment-4"><span>คำถามของฉัน</span></a></li>
    </ul>
	<div id="fragment-1">
	<div id = "pro">
		<form action="updateProfile.php" method="post">
		<h2>Profile Information : ข้อมูลส่วนตัว 		</h2> 
		
		<div id = "profile">
			<div class="buttonn"><input type="button" name="edit" value="แก้ไขข้อมูลส่วนตัว" id="edit" />
			<input type="submit" name="save" value="บันทึกการเแก้ไข" id="save" /><br/></div>
		</div>	
		
		<div id = "profile5">	
		
			<table>
			<tbody>
			<?php if($c == 'M'){ ?>
				<tr>
				<td class="text">Gender (เพศ) : </td>
				<td><input id="rad1" name="gender1" type="radio" checked="checked" value="M"/><span id="ra1"> ชาย </span> 
					<input id="rad2" name="gender1" type="radio" value="F"/><span id="ra2"> หญิง </span></td>
				</tr>
		
				
			<?php } else { ?>
				<tr>
				<td class="text">Gender (เพศ) : </td>
				<td><input id="rad1" name="gender1" type="radio" value="M"/><span id="ra1"> ชาย </span>
				<input name="gender1" id="rad2" type="radio" checked="checked" value="F"/><span id="ra2"> หญิง </span></td>	
			</tr>
			<?php }?>
				
				
				<tr>
				<td class="text">Name (ชื่อ) :</td>
				<td><input class="userprof" id="name1" type="text" name="name1"  value="<?php echo $d ?>"size ="30"readonly="readonly"></td>
				</tr>
				<tr>
				<td class="text">Surname (นามสกุล) :</td>
				<td><input class="userprof" id="surname1"type="text" name="surname1" value="<?php echo $e ?>"size ="30"readonly="readonly"></td>
				</tr>
				<tr>
				<td class="text">E-mail (อีเมล์)  :</td>
				<td><input class="userprof" id="email1" type="text" name="email1"  value="<?php echo $f ?>"size ="30"readonly="readonly"></td>
				</tr>
				<tr>
				<td class="text"><br/></td>
				<td></td>
				</tr>
				<tr>
				<td class="text">Username (ชื่อผู้ใช้) :</td>
				<td><input id="username1" type="text" name="username1" value="<?php echo $a ?>"size ="30" readonly="readonly"></td>
				</tr>
				<tr>
				<td class="text">Password (รหัสผ่าน) :</td>
				<td>------ <input type="button" id="pwdEditBtn" name="pwdEditBtn" value="เปลี่ยนรหัสผ่าน" size ="30" /> 
				 <input type="button" id="pwdCancleBtn" name="pwdEditBtn" value="ยกเลิกการเปลี่ยนรหัสผ่าน" size ="30" /> ----------</td>
				</tr>
			</tbody>
			</table>	
		<div id="pwdEdit">
			รหัสผ่านเก่า : <input class="pass" id="password1" type="password" name="password1" value="" size ="30" ><br/>
			รหัสผ่านใหม่ : <input class="pass" id="password2" type="password" name="password2" value="" size ="30" ><br/>
			ยืนยันรหัสผ่านใหม่  : <input class="pass" id="password3" type="password" name="password3" value="" size ="30" >
		
		</div>	<span class="cond">(รหัสผ่านต้องประกอบด้วยตัวอักษรภาษาอังกฤษ ตัวเลข และเครื่องหมาย_ เป็นจำนวน6-13 ตัวอักษรเท่านั้น) </span>
	<br></div>	
		
	<div id = "profile"> 
	<input type="submit" value="บันทึกรหัสผ่านใหม่" id="changePwd" name="changePwd"/>
	<br>
	Your Point : <span><?php echo $g ?></span>
	</div>	
	<div id = "prof">	
		<br/>
	</div>
	<div id="proff">
	<br/>
	</div>
	</form>
		</div>
	</div>
	
<div id="fragment-2">
		<?php
		$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu WHERE menuUsername = \"".$mem."\" ORDER BY menuDate DESC";
		$ch = 1;
		$result = mysqli_query($conn, $sqlStr);
		?>
		
		<table id="menuListTable" cellspacing="0" width="840px">
        	<tbody>
            
            	<?php
					$cn=1;
					$numOfCom = -1;
					
					
					while($row = mysqli_fetch_assoc($result)) {
						if (isset($_GET['search']) && $_GET['search'] !="") {
						
							$pos = strpos($row['menuName'], $_GET['search']);
							if ($pos !== false) {
     							$sqlStr2 = "SELECT comID FROM comment WHERE comMenuID = ".$row['menuID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);
						

				if($cn%2==1)
            		echo "<tr class=\"oddRow\">";
				else
					echo "<tr class=\"evenRow\">";
				?>
                	<td>
                    	<ul>
                        <?php
                    		echo "<li><a class=\"linkck\" href=\"recipeDetail.php?menuID=".$row['menuID']."\">".$row['menuName']."</a></li>";
						?>
                        </ul>
                    </td>
                    <td>
                    	โดย: <a href=""><?php echo $row['menuUsername']; ?></a>
                    </td>
                    <td>
                    	<ul>
                    	<li class="menuPointList">คะแนน: <?php echo $row['menuPoint']; ?></li>
                        </ul>
                    </td>
                    <td>
                    	จำนวนความคิดเห็น: <?php echo $numOfCom ; ?>
                    </td>
                    <td>
                    	โพสต์เมื่อ: <?php echo $row['menuDate']; ?>
                    </td>
                   
                    
                </tr>
               <?php
			   			$cn++;
						
							} 
		
						
						
						}
						
						else {
							$sqlStr2 = "SELECT comID FROM comment WHERE comMenuID = ".$row['menuID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);
						

				if($cn%2==1)
            		echo "<tr class=\"oddRow\">";
				else
					echo "<tr class=\"evenRow\">";
				?>
                	<td>
                    	<ul>
                        <?php
                    		echo "<li><a class=\"linkck\" href=\"recipeDetail.php?menuID=".$row['menuID']."\">".$row['menuName']."</a></li>";
						?>
                        </ul>
                    </td>
                    <td>
                    	โดย: <a href=""><?php echo $row['menuUsername']; ?></a>
                    </td>
                    <td>
                    	<ul>
                    	<li class="menuPointList">คะแนน: <?php echo $row['menuPoint']; ?></li>
                        </ul>
                    </td>
                    <td>
                    	จำนวนความคิดเห็น: <?php echo $numOfCom ; ?>
                    </td>
                    <td>
                    	โพสต์เมื่อ: <?php echo $row['menuDate']; ?>
                    </td>
                   
                    
                </tr>
               <?php
			   			$cn++;
						}
					}
					mysqli_free_result($result);
					if ($numOfCom>-1) {
					mysqli_free_result($result2);
					}
					
			   ?>
            </tbody>
        </table>

	
	
	</div>

    
    <div id="fragment-3">
	<?php
		$sqlStr = "SELECT techID,techName,techUsername,techPoint,techDate FROM technique WHERE techUserName = \"".$mem."\" ORDER BY techDate DESC";
		$ch = 1;


		$result = mysqli_query($conn, $sqlStr);
		?>
		
		<table id="menuListTable" cellspacing="0" width="840px">
        	<tbody>
            	<?php
					$cn=1;
					$numOfCom = -1;
					
					
					while($row = mysqli_fetch_assoc($result)) {
						if (isset($_GET['search']) && $_GET['search'] !="") {
						
							$pos = strpos($row['techName'], $_GET['search']);
							if ($pos !== false) {
     							$sqlStr2 = "SELECT comID FROM comment WHERE comTechID = ".$row['techID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);

				if($cn%2==1)
            		echo "<tr class=\"oddRow\">";
				else
					echo "<tr class=\"evenRow\">";
				?>
                	<td>
                    	<ul>
                        <?php
                    		echo "<li><a class=\"linkck\" href=\"techDetail.php?menuID=".$row['techID']."\">".$row['techName']."</a></li>";
						?>
                        </ul>
                    </td>
                    <td>
                    	โดย: <a href=""><?php echo $row['techUsername']; ?></a>
                    </td>
                    <td>
                    	<ul>
                    	<li class="menuPointList">คะแนน: <?php echo $row['techPoint']; ?></li>
                        </ul>
                    </td>
                    <td>
                    	จำนวนความคิดเห็น: <?php echo $numOfCom ; ?>
                    </td>
                    <td>
                    	โพสต์เมื่อ: <?php echo $row['techDate']; ?>
                    </td>
                   
                   
                </tr>
                <?php
			   			$cn++;
						
							} 
		
						
						
						}
						
						else {
							$sqlStr2 = "SELECT comID FROM comment WHERE comTechID = ".$row['techID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);
						

				if($cn%2==1)
            		echo "<tr class=\"oddRow\">";
				else
					echo "<tr class=\"evenRow\">";
				?>
                	<td>
                    	<ul>
                        <?php
                    		echo "<li><a class=\"linkck\" href=\"techDetail.php?menuID=".$row['techID']."\">".$row['techName']."</a></li>";
						?>
                        </ul>
                    </td>
                    <td>
                    	โดย: <a href=""><?php echo $row['techUsername']; ?></a>
                    </td>
                    <td>
                    	<ul>
                    	<li class="menuPointList">คะแนน: <?php echo $row['techPoint']; ?></li>
                        </ul>
                    </td>
                    <td>
                    	จำนวนความคิดเห็น: <?php echo $numOfCom ; ?>
                    </td>
                    <td>
                    	โพสต์เมื่อ: <?php echo $row['techDate']; ?>
                    </td>
                   
                    
                </tr>
               <?php
			   			$cn++;
						}
					}
					mysqli_free_result($result);
					if ($numOfCom>-1) {
					mysqli_free_result($result2);
					}
					
			   ?>
            </tbody>
        </table>

	
	
	
	</div>

    
    
<div id="fragment-4">
	
				<table border="1">
				<thead>
				<tr>
					<td>Question ID</td>
					<td>คำถาม</td>
					<td>วันที่ตั้ง</td>
					<td>จำนวนคำตอบ</td>
					<td>วันเวลาล่าสุดที่มีการอัพเดต</td>
				</tr>	
				</thead>
				
				<tbody>
	
		
		<?php	$stmm = "SELECT * FROM question WHERE quesUsername = \"".$mem."\" ORDER BY quesActiveDate DESC ";
				$resultt = mysqli_query($conn,$stmm);
	
		while($row = mysqli_fetch_array($resultt)) {
		
			$id_q 		 =	$row['quesID'];
			$title_q 	 =	$row['quesTitle'];
			$message_q	 =	$row['quesMessage'];
			$pin_q 		 = 	$row['quesPin'];
			$date_q 	 =	$row['quesDate'];
			$showEmail_q =	$row['showAcc'];
			$ansCount_q	 =	$row['ques_ansCount'];
			$username_q	 =	$row['quesUsername'];
			$actDate_q	 =	$row['quesActiveDate'];
			?>

				<tr>
					<td><?php echo $id_q ;?></td>
					<td><?php echo"<a href=\"viewAnswer.php?id_quiz=$id_q\"target=\"$id_q\">".$title_q."</a>";?></td>
					<td><?php echo $date_q ;?></td>
					<td><?php echo $ansCount_q ;?></td>
					<td><?php echo $actDate_q ;?></td>
				</tr>	
                

		<?php }
		
		mysqli_close($conn);
	?>
	
	
	
	                </tbody>
			</table>
	
	</div>

   
</div>

<?php close_body(); ?> 
<script type="text/javascript src="jquery-1.8.2.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#pwdEdit").hide();
	$("#save").hide();
	$("#pwdCancleBtn").hide();
	$("#changePwd").hide();
	$(".cond").hide();
	if ($("#rad1").attr("checked")== false) {
		$("#rad1").hide();
		$("#ra1").hide();
		
	}
	if ($("#rad2").attr("checked")== false) {
		$("#rad2").hide();
		$("#ra2").hide();
	}
	$("#edit").click(function(){
		$(":input.userprof").removeAttr("readonly");
		$(":input.userprof").css("border-style","inset");				
		$("#edit").hide();
		$("#save").fadeIn("fast");
		
		if ($("#rad1").attr("checked")== false) {
			$("#rad1").fadeIn("fast");
			$("#ra1").fadeIn("fast");	
		}
		if ($("#rad2").attr("checked")== false) {
			$("#rad2").fadeIn("fast");
			$("#ra2").fadeIn("fast");
		}
		
	});
	$("#save").click(function(){
		$(":input.userprof").attr("readonly","readonly");
		$(":input.userprof").css("border-style","hidden");
		$("#save").hide();		
		$("#edit").fadeIn("fast");
		
		if ($("#rad1").attr("checked")== false) {
		$("#rad1").hide();
		$("#ra1").hide();
		}
		if ($("#rad2").attr("checked")== false) {
		$("#rad2").hide();
		$("#ra2").hide();
		}
		$("#pwdEdit").hide();
		$("#pwdCancleBtn").hide();
		
	});	
	$("#pwdEditBtn").click(function(){
		$("#pwdCancleBtn").show();
		$("#pwdEdit").show();	
		$(".cond").show();
	 	$("#pwdEditBtn").hide();
		
		$("#changePwd").fadeIn("fast");
		
	});
	
	$("#pwdCancleBtn").click(function(){
		$("#pwdCancleBtn").hide();
		$("#pwdEdit").hide();	
		$("#changePwd").hide();
	 	$("#pwdEditBtn").show();
		$(":input.pass").attr("value","");
		
		
	});
 	
	$("#selectall").click(function() {	
		$(".chkbox").attr("checked", "true");
		});
	$("#clearall").click(function() {	
		$(".chkbox").removeAttr("checked");  
															
	});

});
</script>	