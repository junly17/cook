

<?php require_once("fn_layoutControl.php");
	open_head("Menu Detail","guest");
?>
<link type="text/css" rel="stylesheet" href="style.css" />
<link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
<script type="text/javascript">
function chkform() {
				var error1 = document.getElementById("chkerror1");
				var error2 = document.getElementById("chkerror2");
				var error3 = document.getElementById("chkerror3");
				var error4 = document.getElementById("chkerror4");
				var error5 = document.getElementById("chkerror5");	
			
				if (error1.value == "" || error2.value == "" || error3.value == "" || error4.value == "เลือกหน่วยวัดปริมาณ.." || error5.value == "") {
					alert("กรุณากรอกข้อมูลที่สำคัญให้ครบถ้วนค่ะ");
					if (error1.value == "") { 			
						var name = document.getElementById("error1");
						name.style.visibility = "visible";			
					} else {
						var name = document.getElementById("error1");
						name.style.visibility = "hidden";		
					} 
					if (error2.value == "" || error3.value == "" || error4.value == "เลือกหน่วยวัดปริมาณ.." ) {
						var name2 = document.getElementById("error2");
						name2.style.visibility = "visible";
					} else {
							var name2 = document.getElementById("error2");
						name2.style.visibility = "hidden";
					}
					if (error5.value == "") {
						var name3 = document.getElementById("error5");
						name3.style.visibility = "visible";
					} else {
							var name3 = document.getElementById("error5");
						name3.style.visibility = "hidden";
						
					}
					
					return false;
					
				} else if (isNaN(parseInt(error3.value))) {
							alert("กรุณากรอกจำนวนวัตถุดิบเป็นตัวเลขค่ะ");
								var name2 = document.getElementById("error2");
						name2.style.visibility = "visible";
							var name = document.getElementById("error1");
						name.style.visibility = "hidden";	
							
							var name = document.getElementById("error5");
						name.style.visibility = "hidden";		
							return false;
				} 
				else {
					return confirm("ยืนยัน?");
				}
			
}


</script>

<?php 

close_head(); 
open_body(); 



$conn = connect_db();
	//ถ้ามาจากหน้าลิสรายการอาหารหรือหน้ารายละเอียดรายการอาหาร
	if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
  		if (isset($_REQUEST['menuName'])) {
			
			$postMenuName = $_REQUEST['menuName'];	
			if (isset($_REQUEST['content'])) {
				$postMenuDes = $_REQUEST['content'];
			} else {
				$postMenuDes="";
			}
			for($i=0;$i<count($_REQUEST['content2']);$i++) {
				if ($_REQUEST['content2'][$i] != "")
					$postMenuStepArr[] = $_REQUEST['content2'][$i];
			}
			$postMenuStep = implode(",", $postMenuStepArr);
			
			for($i=0;$i<count($_REQUEST['ingredient']);$i++) {
				if ($_REQUEST['ingredient'][$i] != "")
					$postMatNameArr[] = $_REQUEST['ingredient'][$i];
				if ($_REQUEST['amount5'][$i] != "")
					$postMatUnitArr[] = $_REQUEST['amount5'][$i];
				if ($_REQUEST['amount1'][$i] != "")
					$postMatQuanArr[] = $_REQUEST['amount1'][$i];		
			}
			$postMenuNumOfMat = count($postMatNameArr);
			$postMenuPoint = 0;
			$postMenuVDO =$_REQUEST['urlhidden'];
		
			$postMenuUsername = $_SESSION['sessMember'];
			
			
			
			
	 		if(isset($_REQUEST['post']) && $_REQUEST['post']==true) {
				

	  			$sqlStr = "INSERT INTO menu (menuID, menuName, menuDes, menuStep, menuNumOfMat,menuPoint,menuVDO,menuUsername,menuChangeDate ) VALUES ( NULL,'$postMenuName','$postMenuDes','$postMenuStep','$postMenuNumOfMat','$postMenuPoint','$postMenuVDO','$postMenuUsername',NOW())";
          		$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
				$mymenuID = mysqli_insert_id($conn);
				for($i=0;$i<$postMenuNumOfMat;$i++) {			
						$sqlStr = "SELECT matID FROM material WHERE matName = '$postMatNameArr[$i]' AND matUnit = '$postMatUnitArr[$i]'";
          		$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
			
				$numrow = mysqli_num_rows($result);
				
				if ($numrow ==0) {
				
			
				$sqlStr = "INSERT INTO material (matID, matName, matUnit ) VALUES ( NULL ,'$postMatNameArr[$i]','$postMatUnitArr[$i]')";
          		$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				$mymatIDArr[] = mysqli_insert_id($conn);
				} else {
					$row = mysqli_fetch_assoc($result);
					$mymatIDArr[] = $row['matID'];
				}
				
					$sqlStr = "INSERT INTO consist (consistMenuID, consistMatID, consistMatQuan ) VALUES ( '$mymenuID' ,'$mymatIDArr[$i]','$postMatQuanArr[$i]')";
          			$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
					
					
					
				}//ech for	
				
				for ($i=0; $i<count($_FILES['upfile']);$i++) {
					
						if($_FILES['upfile']['size'][$i] > 0) { 
         					$fileName    = $_FILES['upfile']['name'][$i]; 
         			 		$tmpName     = $_FILES['upfile']['tmp_name'][$i]; 
          			 		$fileSize    = $_FILES['upfile']['size'][$i]; 
					 		$fileType    = $_FILES['upfile']['type'][$i]; 
			 
					 		$fp          = fopen($tmpName, 'r'); 
					 		$imgContent  = fread($fp, filesize($tmpName)); 
					 		fclose($fp); 
			 
         
							$fileName = $conn->real_escape_string($fileName);
							$fileType = $conn->real_escape_string($fileType);
							$imgContent = $conn->real_escape_string($imgContent);
          
							$query = "INSERT INTO imgtable(img_name, img_type, img_size, img_data, img_indexAtPage, img_menuID, img_techID, img_username) VALUES ('$fileName', '$fileType', $fileSize, '$imgContent','$i','$mymenuID',-1,\"none\")";
		
							$conn->query($query) or die('Error: query failed'.mysqli_error($conn));
							$imgidArr[] = $conn->insert_id;
							
						}
				}
				if(isset($imgidArr)){
				$imgid = implode(",", $imgidArr);
				} else {
				$imgid = "";
				}
			}//end if
			else {
				$mymenuID = $_REQUEST['id'];
				$sqlStr = "SELECT consistMatID FROM consist WHERE consistMenuID =".$mymenuID ;
				$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
				while ($row = mysqli_fetch_assoc($result)) {
					$matIDList[] = $row['consistMatID'];
				}
				$sqlStr = "DELETE FROM consist WHERE consistMenuID =".$mymenuID ;
				$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
				
				$sqlStr = "UPDATE menu SET menuName='$postMenuName',menuDes='$postMenuDes',menuVDO='$postMenuVDO',menuStep='$postMenuStep',menuNumOfMat='$postMenuNumOfMat',menuPoint='$postMenuPoint',menuChangeDate=NOW(),menuUsername='$postMenuUsername' WHERE menuID='$mymenuID'";
          		$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
				for($i=0;$i<$postMenuNumOfMat;$i++) {			
					$sqlStr = "SELECT matID FROM material WHERE matName = '$postMatNameArr[$i]' AND matUnit = '$postMatUnitArr[$i]'";
          		$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
			
				$numrow = mysqli_num_rows($result);
				
				if ($numrow ==0) {
				
			
				$sqlStr = "INSERT INTO material (matID, matName, matUnit ) VALUES ( NULL ,'$postMatNameArr[$i]','$postMatUnitArr[$i]')";
          		$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				$mymatIDArr[] = mysqli_insert_id($conn);
				} else {
					$row = mysqli_fetch_assoc($result);
					$mymatIDArr[] = $row['matID'];
				}
				
					$sqlStr = "INSERT INTO consist (consistMenuID, consistMatID, consistMatQuan ) VALUES ( '$mymenuID' ,'$mymatIDArr[$i]','$postMatQuanArr[$i]')";
          			$result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				}//ech for
				
				for ($i=0; $i<count($_FILES['upfile']);$i++) {
					
						if($_FILES['upfile']['size'][$i] > 0) { 
					
         					$fileName    = $_FILES['upfile']['name'][$i]; 
         			 		$tmpName     = $_FILES['upfile']['tmp_name'][$i]; 
          			 		$fileSize    = $_FILES['upfile']['size'][$i]; 
					 		$fileType    = $_FILES['upfile']['type'][$i]; 
			 
					 		$fp          = fopen($tmpName, 'r'); 
					 		$imgContent  = fread($fp, filesize($tmpName)); 
					 		fclose($fp); 
			 
         
							$fileName = $conn->real_escape_string($fileName);
							$fileType = $conn->real_escape_string($fileType);
							$imgContent = $conn->real_escape_string($imgContent);
          
		  	$sqlStr = "DELETE FROM imgtable WHERE img_menuID =".$mymenuID . " AND img_indexAtPage = ".$i ;
				$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
						
								$query = "INSERT INTO imgtable(img_name, img_type, img_size, img_data, img_indexAtPage, img_menuID, img_techID, img_username) VALUES ('$fileName', '$fileType', $fileSize, '$imgContent','$i','$mymenuID',-1,\"none\")";
	
							$conn->query($query) or die('Error: query failed'.mysqli_error($conn));
						
						
						}
				}
			}	
		}else {
			$mymenuID = $_REQUEST['menuID'];
		}
		$sqlStr = "SELECT menuName,menuDes,menuVDO, menuStep,menuNumOfMat,menuChangeDate,menuUsername FROM menu WHERE menuID = '$mymenuID'";
        $result = mysqli_query($conn, $sqlStr);
		
		$row = mysqli_fetch_assoc($result);
		$boxMenuName = $row['menuName'];
		$boxMenuDes = $row['menuDes'];
		$boxMenuVDO = $row['menuVDO'];
		$boxMenuStepArr = explode(",",$row['menuStep']);
		$boxMenuNumOfMat = $row['menuNumOfMat'];
		$boxMenuChangeDate = $row['menuChangeDate'];
		$boxMenuUsername = $row['menuUsername'];
		
		
		$sqlStr = "SELECT consistMatID,consistMatQuan FROM consist WHERE consistMenuID = '$mymenuID'";
        $result = mysqli_query($conn, $sqlStr);
		unset($mymatIDArr);
		
		while($row = mysqli_fetch_assoc($result)) {
					
					$mymatIDArr[] = $row['consistMatID'];
					$sqlStr2 = "SELECT matName,matUnit FROM material WHERE matID = ".$row['consistMatID'];
        			$result2 = mysqli_query($conn, $sqlStr2);
					$row2 = mysqli_fetch_assoc($result2);
					$boxMatName[] = $row2['matName'];
					$boxMatUnit[] = $row2['matUnit'];
					$boxMatQuan[] = $row['consistMatQuan'];
					mysqli_free_result($result2);
		}
		//$mymatid = implode(",", $mymatIDArr);
		
		$sqlStr = "SELECT comID,comContent, comDate,comChangeDate,comUsername FROM comment WHERE comMenuID = '$mymenuID' ORDER BY comDate";
        $result = mysqli_query($conn, $sqlStr);
		$numOfCom = mysqli_num_rows($result);
		
		if($numOfCom>0) {
			while($row = mysqli_fetch_assoc($result)) {
				$boxComContent[] = $row['comContent'];
				$boxComDate[] =$row['comDate'];
				$boxComChangeDate[] =$row['comChangeDate'];
				$boxComUsername[] =$row['comUsername'];
				$boxComID[] = $row['comID'];
		}	}
		
		mysqli_free_result($result);
		
  	}
	else {
		if (isset($_SESSION['sessMember'])) {
		$boxMenuName = "";
		$boxMenuDes = "";
		$boxMatName[0] = "";
		$boxMatName[1] = "";
		$boxMatName[2] = "";
		$boxMatQuan[0]="";
		$boxMatQuan[1]="";
		$boxMatQuan[2]="";
		$boxMatUnit[0]="";
		$boxMatUnit[1]="";
		$boxMatUnit[2]="";
		}
		else {
			echo "Please log in.";
			echo"<meta http-equiv=\"refresh\"content=\"2;URL=index.php\">";
				exit();
		}
	}

?>

<div id="recipeDetailContent">


        	
            <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
			?>
            <div class="forcen">โดย: <?php echo $boxMenuUsername; ?> ---แก้ไขครั้งสุดท้ายเมื่อ: <?php echo $boxMenuChangeDate; ?> </div>
            <?php
			}
			else {
			?>
            <div class="forcen">โดย: <?php echo $_SESSION['sessMember']; ?></div>
            <?php
			}
			if (isset($_SESSION['sessMember']) && isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
			?>
            <form action="addPoint.php" method="get" onsubmit="return confirm('ยืนยัน?')">
            	  <input type="hidden" name="menuID" value="<?php echo $mymenuID; ?>" />
				  <button type="submit" name="likebtn" id="likebtn"><img src="Star-Full.png" width="20px" height="20px" /></button>
            </form>
            <?php
			}
			if ((isset($boxMenuUsername) && isset($_SESSION['sessMember']) && $boxMenuUsername == $_SESSION['sessMember'])) {
			?>
            <form action="delMenu.php" method="get" onSubmit="return confirm('ยืนยัน?')">
            
            <input type="submit" name="button1" value="ลบเมนูอาหาร" class="showon" id="delmenu" />
            <input type="hidden" name="menuID" value="<?php echo $mymenuID; ?>"/>
                 </form>
			      <input type="button" name="button2" value="แก้ไขเมนูอาหาร" class="showon" id="edit"/> 
                <?php
			}
				?>
                  <form action="<?php $PHP_SELF;?>" method="post" ENCTYPE="multipart/form-data" onSubmit="return chkform()" >
                   <?php
		
			if ((isset($boxMenuUsername) && isset($_SESSION['sessMember']) && $boxMenuUsername == $_SESSION['sessMember'])) {
			?>
            <div id="deleteAndEdit"> 
				  
                  <input type="submit" name="save" value="บันทึกการแก้ไข" class="saveEdit" id="save" disabled="disabled"> 
			</div>
              <?php
			}
				?>
		    <div id="recipeName"> <b>ชื่อเมนูอาหาร : </b> <input type="text" id="chkerror1" name="menuName" size="40" class="readon" value="<?php echo $boxMenuName; ?>"/>		<span class="star">****<span>
            <p class="error" id="error1">กรุณากรอกชื่อเมนูอาหารค่ะ</p>
			</div>
            
             
			
            <input type="hidden" name="id" value="<?php echo $mymenuID; ?>"/> 
			<div id="recipeDetail"> <center> <b>รายละเอียดเมนูอาหาร </b><br>
				<textarea rows="5" cols="100" name="content" class="readon"><?php echo $boxMenuDes; ?></textarea>	
			</div>
			<div id="recipePhoto"><b>รูปภาพอาหาร</b>
            <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_menuID = ".$mymenuID." AND img_indexAtPage = 0";
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\"  height=\"500px\" /> </div>";
				
		
			}
			else {
				 echo "<div id=\"completeImg\" class=\"complete\"></div>";
			}
			?><input type="file" name="upfile[]"  id="upfile" class="hidon"/>
			</div>
            
			<div id="ingredient"><b>วัตถุดิบที่ใช้ </b><br><br>
            
             <div id="matlistbox00" ><span id="forrem00">ชื่อวัตถุดิบ : <input type="text" id="chkerror2" name="ingredient[]" class="readon" value= "<?php echo $boxMatName[0];?>"/> 
				          ปริมาณที่ใช้ :<input id="chkerror3" type="text" name="amount1[]" size="5" class="readon" value="<?php echo $boxMatQuan[0];?>"/>
					 หน่วยวัดปริมาณที่ใช้ : <?php 
					 if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
						 echo "<input type=\"text\"  name=\"amount5[]\"   class=\"readonp\" value=\"".$boxMatUnit[0]."\"/>";
						
						 
					 } else {
						 echo "<select id=\"chkerror4\"   name=\"amount5[]\"><option selected=\"selected\">เลือกหน่วยวัดปริมาณ..</option><option>ช้อนชา</option><option>ช้อนโต๊ะ</option><option>มิลลิลิตร</option><option>ลิตร</option><option>ช้อนชา</option><option>ขีด</option><option>กิโลกรัม</option><option>ถ้วยตวง</option><option>ซีซี</option><option>ออนซ์</option><option>ควอต</option><option>ปอนด์</option><option>แกลลอน</option><option>ลบ.ซม.</option></select>";
					 }
					 
					 ?></span><span class="star">****<span></div>
                     
                         <?php 
					 if ((isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) && count($boxMatQuan)>1) {
						 echo "<div id=\"matlistbox01\" ><span id=\"forrem01\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\"  class=\"readon\" value= \"".$boxMatName[1]."\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\" value=\"".$boxMatQuan[1]."\"/> หน่วยวัดปริมาณที่ใช้ : <input type=\"text\" name=\"amount5[]\"  class=\"readonp\" value=\"".$boxMatUnit[1]."\"/><input id=\"remmatbtn01\" type=\"button\" name=\"delbutton\" value=\"ลบ\" class=\"hidon\"/></div>";
						 
					 } else if (!(isset($_REQUEST['menuName']) || isset($_REQUEST['menuID']))) {
						 echo "<div id=\"matlistbox01\" ><span id=\"forrem01\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\" value= \"\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\" value=\"\"/> หน่วยวัดปริมาณที่ใช้ : <select name=\"amount5[]\"><option selected=\"selected\">เลือกหน่วยวัดปริมาณ..</option><option>ช้อนชา</option><option>ช้อนโต๊ะ</option><option>มิลลิลิตร</option><option>ลิตร</option><option>ช้อนชา</option><option>ขีด</option><option>กิโลกรัม</option><option>ถ้วยตวง</option><option>ซีซี</option><option>ออนซ์</option><option>ควอต</option><option>ปอนด์</option><option>แกลลอน</option><option>ลบ.ซม.</option></select></span><input id=\"remmatbtn01\" type=\"button\" name=\"delbutton\" value=\"ลบ\" class=\"hidon\"/></div>";
					 }
					 
					 ?> <?php 
					 if ((isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) && count($boxMatQuan)>2) {
						 echo "<div id=\"matlistbox02\" ><span id=\"forrem02\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\" value= \"".$boxMatName[2]."\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\" value=\"".$boxMatQuan[2]."\"/> หน่วยวัดปริมาณที่ใช้ : <input type=\"text\" name=\"amount5[]\"  class=\"readonp\" value=\"".$boxMatUnit[2]."\"/><input id=\"remmatbtn02\" type=\"button\" name=\"delbutton\" value=\"ลบ\" class=\"hidon\"/></div>";
						 
					 } else if (!(isset($_REQUEST['menuName']) || isset($_REQUEST['menuID']))) {
						 echo "<div id=\"matlistbox02\" ><span id=\"forrem02\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\" value= \"\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\" value=\"\"/> หน่วยวัดปริมาณที่ใช้ : <select name=\"amount5[]\"><option selected=\"selected\">เลือกหน่วยวัดปริมาณ..</option><option>ช้อนชา</option><option>ช้อนโต๊ะ</option><option>มิลลิลิตร</option><option>ลิตร</option><option>ช้อนชา</option><option>ขีด</option><option>กิโลกรัม</option><option>ถ้วยตวง</option><option>ซีซี</option><option>ออนซ์</option><option>ควอต</option><option>ปอนด์</option><option>แกลลอน</option><option>ลบ.ซม.</option></select></span><input id=\"remmatbtn02\" type=\"button\" name=\"delbutton\" value=\"ลบ\" class=\"hidon\"/></div>";
					 }
					 
					 ?>  
                      <?php 
		 if ((isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) && count($boxMatQuan)>3) {
			for ($i=3;$i<count($boxMatQuan);$i++) {
					  
					  echo "<div id=\"matlistbox".(30+$i)."\" ><span id=\"forrem".(30+$i)."\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\" value=\"".$boxMatName[$i]."\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\" value=\"".$boxMatQuan[$i]."\"/> หน่วยวัดปริมาณที่ใช้ : <input type=\"text\" name=\"amount5[]\"  class=\"readonp\" value=\"".$boxMatUnit[$i]."\"/></span><input id=\"remmatbtn".(30+$i)."\" type=\"button\" name=\"delbutton\" value=\"ลบ\" class=\"hidon\"/></div>";
						 
			}
		}?><span id="allbtn">
                         <input id="remmatbtn03" type="button" name="delbutton" value="ลบ" class="hidon"/>
                          <input id="remmatbtn04" type="button" name="delbutton" value="ลบ" class="hidon"/>
                           <input id="remmatbtn05" type="button" name="delbutton" value="ลบ" class="hidon"/>
                            <input id="remmatbtn06" type="button" name="delbutton" value="ลบ" class="hidon"/>
                             <input id="remmatbtn07" type="button" name="delbutton" value="ลบ" class="hidon"/>
                              <input id="remmatbtn08" type="button" name="delbutton" value="ลบ" class="hidon"/>
                               <input id="remmatbtn09" type="button" name="delbutton" value="ลบ" class="hidon"/>
                                <input id="remmatbtn10" type="button" name="delbutton" value="ลบ" class="hidon"/>
                                 <input id="remmatbtn11" type="button" name="delbutton" value="ลบ" class="hidon"/>
                                  <input id="remmatbtn12" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         
                         <input id="remmatbtn13" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn14" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn15" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn16" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn17" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn18" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn19" type="button" name="delbutton" value="ลบ" class="hidon"/>
                         <input id="remmatbtn20" type="button" name="delbutton" value="ลบ" class="hidon"/><div id="endlist">.</div>
                         </span>
                      <p class="error" id="error2">กรุณากรอกชื่อวัตถุดิบที่ใช้อย่างน้อยหนึ่งชนิด พร้อมปริมาณที่ใช้เป็นตัวเลข และเลือกหน่วยวัดปริมาณที่ใช้ค่ะ</p>
                     
					 <input id="addmat"  type="button" name="button4" value="เพิ่มวัตถุดิบ" class="hidon"/>
                     <input id="remmat"  type="button" name="button4" value="ลบวัตถุดิบทั้งหมด" class="hidon"/>
				<div id="ingredientPhoto">รูปภาพประกอบ
				       <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_menuID = ".$mymenuID." AND img_indexAtPage = 1";
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\" height=\"500px\"  /> </div>";
				mysqli_free_result($result);
		
			}
			else {
				 echo "<div id=\"completeImg2\" class=\"complete\"></div>";
			}
			?><input type="file" name="upfile[]" class="hidon" />
				</div>
			</div>
			<div id="process"> <b>ขั้นตอนในการประกอบอาหาร </b><br>
                <div id="vdoClip"><div id="crop"> <input id="hidevdo"  type="button" name="butto" value="ไม่ใช้ VDO" class="hidon"/></div><div id="showhide"><span>คลิปวีดิโอประกอบการทำอาหาร</span>	
				      <div id="vdobox">
                      <?php
					  if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
						  if (isset($_REQUEST['urlhidden'] ) && $_REQUEST['urlhidden']!="" )
						echo "<iframe width=\"640\" height=\"355\" src=\"http://www.youtube.com/embed/".$boxMenuVDO."\" frameborder=\"0\" allowfullscreen></iframe>";  
					  }
					  ?>
                      </div>
                      <div><label for="vdourl" class="hidon">รหัส Youtube VDO: </label>
				      <input id="vdourl" class="hidon" type="text" name="vdourl" value="ใส่ รหัสวีดีโอ 11 หลัก จาก Youtube ค่ะ " size="50" />
                       <input id="vdobtn"  type="button" name="button4" value="Show VDO!!" class="hidon"/>
                       <input id="urlhidden" type="hidden" name="urlhidden" value=""  />
                      </div>
                      </div> 
                     
				</div>
                
				<div id="step"><div id="step00"><span>ขั้นตอนที่ 1</span> 
				     <div id="detail00">
                     <?php
					 if((isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) && count($boxMenuStepArr)>0) {
						 $tempStep = $boxMenuStepArr[0];
						echo "<textarea rows=\"3\" id=\"chkerror5\" cols=\"80\" name=\"content2[]\" class=\"readon\">".$tempStep."</textarea>";  
					  } else {
				         echo "<textarea rows=\"3\" id=\"chkerror5\" cols=\"80\" name=\"content2[]\" class=\"readon\"></textarea>"; 
					  }
					 ?>
                     <span class="star">****<span>
				     </div>
                     <p class="error" id="error5">กรุณากรอกขั้นตอนการประกอบอาหารอย่างน้อยหนึ่งขั้นตอนค่ะ</p>
				     <div id="detailPhoto00"><b>รูปภาพประกอบ</b>
				      <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_menuID = ".$mymenuID." AND img_indexAtPage = 2";
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\" height=\"500px\"  /> </div>";
				mysqli_free_result($result);
		
			}
			else {
				 echo "<div id=\"completeImg00\" class=\"complete\"></div>";
			}
			?><input type="file" name="upfile[]" id="file00"  class="hidon"/><hr id="hr00"/>
				     </div></div><?php 
					 if((isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) && count($boxMenuStepArr)>1) {
						 for($i=1;$i<count($boxMenuStepArr);$i++) {
							 $num = 30+$i;
						echo "<div id=\"step".$num."\"><span>ขั้นตอนที่ ".($i+1)."</span><div id=\"detail".$num."\"><textarea rows=\"3\" cols=\"80\" name=\"content2[]\" class=\"readon\">".$boxMenuStepArr[$i]."</textarea></div><div id=\"detailPhoto".$num."\"><b>รูปภาพประกอบ</b>";
						
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				$mynum = 2+$i;
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_menuID = ".$mymenuID." AND img_indexAtPage = ".$mynum;
			
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\" height=\"500px\"  /></div><input type=\"file\" name=\"upfile[]\" id=\"file".$num."\"  class=\"hidon\"/><hr id=\"hr".$num."\"/></div></div>";
				mysqli_free_result($result);
		
			}
			else {
				 echo "<div id=\"completeImg".$num."\" class=\"complete\"></div><input type=\"file\" name=\"upfile[]\" id=\"file".$num."\"  class=\"hidon\"/><hr id=\"hr".$num."\"/></div></div>";
			}
			
						
			
						 }
					  }
					 
					 ?>
                     
                     </form>
                     <span id="allfilebtn"><input type="file" name="upfile[]"  id="file01" class="hidon"/>
                       <input type="file" name="upfile[]" id="file02" class="hidon"/>
                       <input type="file" name="upfile[]" id="file03" class="hidon"/>
                       <input type="file" name="upfile[]"  id="file04" class="hidon"/>
                       <input type="file" name="upfile[]" id="file05" class="hidon"/>
                       <input type="file" name="upfile[]" id="file06" class="hidon"/>
                        <input type="file" name="upfile[]" id="file07" class="hidon"/>
                       <input type="file" name="upfile[]" id="file08" class="hidon"/>
                       <input type="file" name="upfile[]"id="file09" class="hidon"/>
                       <input type="file" name="upfile[]"  id="file10" class="hidon"/>
                       <input type="file" name="upfile[]" id="file11" class="hidon"/>
                       <input type="file" name="upfile[]" id="file12" class="hidon"/>
                        <input type="file" name="upfile[]"  id="file13" class="hidon"/>
                       <input type="file" name="upfile[]"  id="file14" class="hidon"/>
                       <input type="file" name="upfile[]" id="file15" class="hidon"/>
                       <input type="file" name="upfile[]" id="file16"  class="hidon"/>
                       <input type="file" name="upfile[]" id="file17" class="hidon"/>
                       <input type="file" name="upfile[]" id="file18" class="hidon"/>
                       <input type="file" name="upfile[]" id="file19" class="hidon"/>
                       <input type="file" name="upfile[]" id="file20" class="hidon"/>
                       <span id="endfilelist"></span>
                         </span>
                     <div id="addButton" class="hidon"> <input type="button" name="button7" value="เพิ่มขั้นตอน"  id="addfilebtn"/>
                     <input type="button" name="button7" value="ลบขั้นตอน"  id="delfilebtn"/>
                     <input type="button" name="button7" value="ลบขั้นตอนทั้งหมด"  id="delallfilebtn"/>
				     </div>
				</div> 
                 <?php
			if (isset($_SESSION['sessMember'])) {
				?>
				<div id="PostButton"><input type="submit" name="post" value="โพสขั้นตอนการทำอาหาร" id="post"/>
                 
				</div>
                <?php } ?> 
               
			</div >
            <input type="hidden" name="imgid" value="<?php echo $imgid; ?>">
             
             <form action="postComment.php?" method="get" onSubmit="return confirm('ยืนยัน?')">
            <?php
			if (isset($_SESSION['sessMember'])) {
				?>
			<div id="addComment" class="showon"><b>แสดงความคิดเห็น </b><br><br>
			
			     <textarea rows="5" cols="100" name="content3" id="areaComment" ></textarea>
				 <input type="submit" name="button9" value="Comment" id="commentbtn" />
                 <input type="hidden" name="formenuid" value="<?php echo $mymenuID; ?>"/>
				
			</div>
            <?php } else {
				echo "กรุณาสมัครสมาชิกและเข้าสู่ระบบเพื่อแสดงความคิดเห็น";
				
			}?> 
            </form>
            
			<div id="showComment" >
            <?php
			
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID']) || isset($_SESSION['fromcom'])) {
				
				if($numOfCom>0) {
					for($i=$numOfCom-1; $i>=0;$i--) {
						if (isset($_SESSION['sessMember']) && ($boxComUsername[$i] == $_SESSION['sessMember'])) {
						echo "<form action=\"editComment.php\" method=\"get\"><div id=\"com".$i."\"><div>ความคิดเห็นที่ ".($i+1).": </div><textarea id=\"txtar".$i."\" rows=\"5\" cols=\"100\"  readonly=\"yes\" name=\"ment\">".$boxComContent[$i]."</textarea><div id=\"postDate".$i."\"> โดย: ".$boxComUsername[$i]." แก้ไขครั้งสุดท้ายเมื่อ: ".$boxComChangeDate[$i]."</div></div><hr/><input type=\"hidden\" name=\"hidcom\" value=\"".$boxComID[$i]."\" /><input type=\"hidden\" name=\"hidcom1\" value=\"".$mymenuID."\"/><input type=\"hidden\" name=\"hidcom2\" value=\"menu\"/></form>";
						} else {
						echo "<div id=\"com".$i."\"><div>ความคิดเห็นที่ ".($i+1).": </div><textarea id=\"txtar".$i."\" rows=\"5\" cols=\"100\"  readonly=\"yes\" name=\"ment\">".$boxComContent[$i]."</textarea><div id=\"postDate".$i."\"> โดย: ".$boxComUsername[$i]." แก้ไขครั้งสุดท้ายเมื่อ: ".$boxComChangeDate[$i]."</div></div><hr/><input type=\"hidden\" name=\"hidcom\" value=\"".$boxComID[$i]."\" /><input type=\"hidden\" name=\"hidcom1\" value=\"".$mymenuID."\"/><input type=\"hidden\" name=\"hidcom2\" value=\"menu\"/>";
						}
					}
				}
				
				unset($_SESSION['fromcom']);
				
			}
			@mysqli_close($conn);
			?>
            
            
            </div>
           
	
        
         <script type="text/javascript" src="jquery-1.8.1.min.js"></script> 
         <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<!-- easing plugin ( optional ) -->
	<script src="js/easing.js" type="text/javascript"></script>
         <script src="js/jquery.ui.totop.js" type="text/javascript"></script>
  
    <script type="text/javascript">
	
		
		

		$(document).ready(function() {
			
			
			
			
			
			
			
			
			
			
			
			
			
			var comment = document.getElementById("showComment");
	//	var val = $("#areaComment").attr("value");
	//	$("#areaComment").replaceWith("<textarea rows=\"5\" cols=\"100\" name=\"content3\" id=\"areaComment\" >' '</textarea>");   
			if(comment.hasChildNodes()) {
				var div = $("#showComment > form > div");
				
				for(var i=$("#showComment > form > div").length-1; i>=0; i--) {
						
					if(i>9)
					var nextno = parseInt(div[i].id.substring(div[i].id.length-2, div[i].id.length));
					else
					var nextno = parseInt(div[i].id.substring(div[i].id.length-1, div[i].id.length));
					
				//$("<div id=\"com"+temptxt+"\"><div>ความคิดเห็นที่ "+(nextno+1)+": </div><textarea id=\"txtar"+temptxt+"\" rows=\"5\" cols=\"100\"  readonly=\"yes\">"+val+"</textarea><div id=\"postDate"+temptxt+"\">โพสต์เมื่อ: "+displayTime()+"</div></div><hr/>").insertBefore("#"+comment.firstChild.id);
			
					var box = document.getElementById("com"+nextno);
				
					var txtarea = box.getElementsByTagName("textarea")[0];
					
					var put = document.createElement("input");
					var ok = document.createElement("input");
					ok.id = "okbtn"+nextno;
						ok.type = "submit";
						ok.value = "บันทึก";
					put.id = "put"+nextno;
					put.type = "button";
					put.value = "แก้ไข";
					put.onclick = function () {
					var mynum = parseInt(this.id.substring(3, this.id.length));
				
				
						$("#txtar"+mynum).removeAttr("readonly");
				
						$("#okbtn"+mynum).removeAttr("disabled");
						
						$("#okbtn"+mynum).click(function() {
							if( confirm("ยืนยัน?")) {
							$("#txtar"+mynum).attr('readonly' , '1');
							var postDate = document.getElementById("postDate"+mynum);
							postDate.innerHTML = "แก้ไขครั้งล่าสุดเมื่อ: "+displayTime();
							$("#put"+mynum).removeAttr("disabled");
							$("#okbtn"+mynum).attr("disabled", "disabled");
							}
						});
					
						$("#"+this.id).attr("disabled", "disabled");
					};
					$(ok).insertAfter("#"+txtarea.id);
					$(put).insertAfter("#"+txtarea.id);
					
				$("#"+ok.id).attr("disabled", "disabled");
					//ok.css("visibility", "hidden");
			
					//$(put).css("float","right");
					//$(ok).css("float","right");
					//$(ok).css("clear","right");
				}  //end for 
		}
								   
								   
				
								   
								   $().UItoTop({ easingType: 'easeOutQuart' });
			var type =	<?php
					if (isset($_REQUEST['menuID'])) {
						echo  "\"fromMenuListPage\"";
					} else if (isset($_REQUEST['menuName'])) {
						echo  "\"fromMenuPostPage\"";
					}else {
						echo  -1;	
					}
				
					?>	;
			if(type == "fromMenuListPage"||type == "fromMenuPostPage") {
				//ต่อ DB ดึงข้อมูลมาตาม id  นำข้อมูลใส่ในช่อง
				
				refreash();
			}    
								   
								   
				$("#delmenu").click(function() {				   
					
		
			
		});	   
								   
								   
								   
								   
								   
								   
								   
								   
								   
								 function handleFileSelect(evt) {
    var files = evt.target.files; 
    for (var i = 0, f; f = files[i]; i++) {

      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile) {
        return function(e) {
          
		  var myurl = "url(" + e.target.result + ")";
         
		  $("#"+evt.target.previousSibling.id).css("background-image", myurl);
        };
      })(f);

      reader.readAsDataURL(f);
	
	   $("#"+evt.target.previousSibling.id).hide();
	    $("#"+evt.target.previousSibling.id).fadeIn("slow");
		
    }
  }
  
  var up =  document.getElementsByName('upfile[]');
	for(var i=0; i<up.length; i++) {
		
 up[i].addEventListener('change', handleFileSelect, false);   
	}
  
  
  
			
							
					
  
  $("#addmat").click(function() {
							 var spanallbtn = document.getElementById("allbtn");
							 var allbtn = spanallbtn.getElementsByTagName("input");
							 if (allbtn.length==0) {
								alert("ไม่สามารถเพิ่มวัตถุดิบได้แล้วค่ะ!!"); 
							 } else {
								 var nextNum = allbtn[0].id.substring(allbtn[0].id.length-2, allbtn[0].id.length);
								  var tempText = "<div id=\"matlistbox"+nextNum+"\"><span id=\"forrem"+nextNum+"\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\"/> ปริมาณที่ใช้ :<input type=\"text\" name=\"amount1[]\" size=\"5\" class=\"readon\"/> หน่วยวัดปริมาณที่ใช้ : <select name=\"amount5[]\"> <option selected=\"selected\">เลือกหน่วยวัดปริมาณ..</option><option>ช้อนชา</option><option>ช้อนโต๊ะ</option><option>มิลลิลิตร</option><option>ลิตร</option><option>ช้อนชา</option><option>ขีด</option><option>กิโลกรัม</option><option>ถ้วยตวง</option><option>ซีซี</option><option>ออนซ์</option><option>ควอต</option><option>ปอนด์</option><option>แกลลอน</option><option>ลบ.ซม.</option></select></span></div>";
								  $(tempText).insertBefore("#allbtn");
								  $("#remmatbtn"+nextNum).insertAfter("#forrem"+nextNum);
								  $("#remmatbtn"+nextNum).css("visibility","visible");
								   $("#remmatbtn"+nextNum).css("float","none");
								     $("#remmatbtn"+nextNum).css("height","auto");
									  $("#remmatbtn"+nextNum).css("width","auto");
									   $("#matlistbox"+nextNum).hide();
							  $("#matlistbox"+nextNum).fadeIn("slow");	
							 }
							
							
					
  
	});
							 
 
   
   
  
  
	var allidbtndel = "#remmatbtn00,#remmatbtn01,#remmatbtn02,#remmatbtn03,#remmatbtn04,#remmatbtn05,#remmatbtn06,#remmatbtn07,#remmatbtn08,#remmatbtn09,#remmatbtn10,#remmatbtn11,#remmatbtn12,#remmatbtn13,#remmatbtn14, #remmatbtn15,#remmatbtn16,#remmatbtn17,#remmatbtn18,#remmatbtn19,#remmatbtn20" ;
  $(allidbtndel).click(function() {  
						 
						 
						  $(this).insertBefore("#endlist");
					var numOfrow = this.id.substring(this.id.length-2, this.id.length);
					
					
					
					
				
					$("#matlistbox"+numOfrow).remove();
					
						  
						 $(this).css("visibility","hidden"); 
								  $(this).css("float","left"); 
								   
								      $(this).css("height","0px");
									  $(this).css("width","0px");
							  
							  });
  
   $("#remmat").click(function() {
			var ingedient = document.getElementById("ingredient");
			var matlistbox = ingedient.getElementsByTagName("div"); 
			for (var i=matlistbox.length-3; i>=1; i--) {
		$("#" + matlistbox[i].lastChild.id).css("visibility", "hidden");
		 $("#" + matlistbox[i].lastChild.id).css("float","left"); 
								   
								      $("#" + matlistbox[i].lastChild.id).css("height","0px");
									 $("#" + matlistbox[i].lastChild.id).css("width","0px");
				$("#" + matlistbox[i].lastChild.id).insertBefore("#endlist");
				
				$("#" + matlistbox[i].id).remove();
			
			}
								 
							 
								 
	 });
   
   
   
    $("#addfilebtn").click(function() {
			 var spanallfilebtn = document.getElementById("allfilebtn");
							 var allfilebtn = spanallfilebtn.getElementsByTagName("input");
							 if (allfilebtn.length==0) {
								alert("ไม่สามารถเขั้นตอนได้แล้วค่ะ!"); 
							 } else {
								 var nextNum = allfilebtn[0].id.substring(allfilebtn[0].id.length-2, allfilebtn[0].id.length);
								 var stp = document.getElementById("allfilebtn");
								 var inp = stp.getElementsByTagName("input");
								// var tempnum = 22- inp.length;
								 var tempnum = $("#step > div").length;
							
								  var tempText = "<div id=\"step"+nextNum+"\"><span>ขั้นตอนที่ "+tempnum+"</span><div id=\"detail"+nextNum+"\"><textarea rows=\"3\" cols=\"100\" name=\"content2[]\" class=\"readon\"></textarea></div><div id=\"detailPhoto"+nextNum+"\">รูปภาพประกอบ<div id=\"completeImg"+nextNum+"\" class=\"complete\"></div><hr id=\"hr"+nextNum+"\"/></div></div>";
								  $(tempText).insertBefore("#allfilebtn");
								 
								  $("#file"+nextNum).insertBefore("#hr"+nextNum);  
								  $("#file"+nextNum).css("visibility","visible");
								  
								     $("#file"+nextNum).css("height","auto");
									  $("#file"+nextNum).css("width","auto");
									   $("#step"+nextNum).hide();
							  $("#step"+nextNum).show("slow");	
							 
							 
							 }
		
							 
								 
	 });
   
   $("#delfilebtn").click(function() { 
						var allfilebtn = document.getElementById("allfilebtn");
						var nextNum = allfilebtn.previousSibling.id.substring(allfilebtn.previousSibling.id.length-2, allfilebtn.previousSibling.id.length);
						if (nextNum != "00") {
						var hr = document.getElementById("hr"+nextNum);
						var filebtn = hr.previousSibling;
					
						 
						  $(filebtn).insertBefore("#endfilelist");
						
					
					
					
					
				
					$("#step"+nextNum).remove();
					
						}
						 $(filebtn).css("visibility","hidden");
						 $(filebtn).css("width","0px");
						 $(filebtn).css("height","0px");
							  
							  });
   
   
    $("#delallfilebtn").click(function() {
							   
			var tempText;	   
			
			for (var i=$("#step > div").length-1; i>=1; i--) {
				var tempID = $("#step > div")[i].id;
				var num = tempID.substring(tempID.length-2, tempID.length);
				
	$("#file"+num).css("visibility", "hidden");
	 
								   
								      $("#file"+num).css("height","0px");
									 $("#file"+num).css("width","0px");
				$("#file"+num).insertBefore("#endfilelist");
				
				$("#step"+num).remove();
			
			}
							 
							 
								 
	 });
   
   
   function refreash() {
	   	$(".readon").attr("readonly","yes");
							$(".readon,.readonp").css("background-color","transparent");
							
							$(".readon,.readonp").css("border-style","none");
							$(".hidon,.star").css("visibility","hidden");
							$(".showon").css("visibility","visible");
							$("#post").css("visibility","hidden");
							
	   
   }
   
   
   
   
   
   

  
				
	
	
   
   
   function displayTime() {
    var str = "";

    var currentTime = new Date()
    var hours = currentTime.getHours()
    var minutes = currentTime.getMinutes()
    var seconds = currentTime.getSeconds()

    if (minutes < 10) {
        minutes = "0" + minutes
    }
    if (seconds < 10) {
        seconds = "0" + seconds
    }
    str += hours + ":" + minutes + ":" + seconds + " ";
    if(hours > 11){
        str += "PM"
    } else {
        str += "AM"
    }
    return str;
}
   
   
   
    $("#edit").click(function() { 
   		
   							$(".readon,.readonp").removeAttr("readonly");
							$(".readon,.readonp").css("background-color","white");
							$(".readon,.readonp").css("border-width","medium");
							$(".readon,.readonp").css("border-style","solid");
							$(".hidon,.star").css("visibility","visible");
							
							$(".showon").attr("disabled","disabled");
							$("#save").removeAttr("disabled");
							$("#allbtn > input").css("visibility","hidden");
							
							var readonp = document.getElementsByName("amount5[]");
						
							for (var i =0 ;i< readonp.length; i++) {
								var text = readonp[i].value;	
								
								$(readonp[i]).replaceWith("<select id=\"chkerror4\" name=\"amount5[]\"><option >เลือกหน่วยวัดปริมาณ..</option><option>ช้อนชา</option><option>ช้อนโต๊ะ</option><option>มิลลิลิตร</option><option>ลิตร</option><option>ช้อนชา</option><option>ขีด</option><option>กิโลกรัม</option><option>ถ้วยตวง</option><option>ซีซี</option><option>ออนซ์</option><option>ควอต</option><option>ปอนด์</option><option>แกลลอน</option><option>ลบ.ซม.</option></select>");
								
								var selectele = document.getElementsByName("amount5[]")[i];
								selectele.value = text;
							}
							
   							
   						
   
    });
   
  
   $("#hidevdo").click(function() {
								$("#showhide").slideToggle("slow");
								if ($(this).attr("value") == "ไม่ใช้ VDO") {
									$("#urlhidden").attr("value","");
									
									$(this).attr("value","ใช้ VDO");
									$("#vdobox").empty();
								} else {
									
									var vdourl = $("#vdourl").attr("value");
									$("#urlhidden").attr("value",vdourl);	
									$(this).attr("value","ไม่ใช้ VDO");
									
								}
   			
			
   
     });
	$("#vdobtn").click(function() {
		var vdourl = $("#vdourl").attr("value");
		$("#vdobox").empty();
		$("#vdobox").append("<iframe width=\"640\" height=\"355\" src=\"http://www.youtube.com/embed/"+vdourl+"?&autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>");
		
		
		$("#vdobox").hide();
		$("#vdobox").show("slow");
						   
		$("#urlhidden").attr("value",vdourl);			   
     });
	
	$("#vdourl").focus(function() {
					$(this).attr("value","");		
								
								
								});
	
	$("#post").click(function() {
					$(this).attr("visibility","hidden");		
					
					var sele = document.getElementById("sc00");
					alert(sele.selectIndex);
					
					
					
					
					
								});
	
	
								   });
		
			
		</script>
        </div>
        <?php close_body(); ?>
