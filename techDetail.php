

<?php require_once("fn_layoutControl.php");
	open_head("Technique Detail","guest");
?>
<link type="text/css" rel="stylesheet" href="style.css" />
<link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
<script type="text/javascript">
function chkform() {
				var error1 = document.getElementById("chkerror1");
				
				var error5 = document.getElementById("chkerror5");
				if (error1.value == ""  || error5.value == "") {
					alert("กรุณากรอกข้อมูลที่สำคัญให้ครบถ้วนค่ะ");
					if (error1.value == "") { 				
						var name = document.getElementById("error1");
						name.style.visibility = "visible";			
					} else {
						var name = document.getElementById("error1");
						name.style.visibility = "hidden";		
					} 
					if (error5.value == "") {
						var name = document.getElementById("error5");
						name.style.visibility = "visible";
					} else {
							var name3 = document.getElementById("error5");
						name3.style.visibility = "hidden";
						
					}
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
			
			
			$postMenuPoint = 0;
			$postMenuVDO =$_REQUEST['urlhidden'];
			$postMenuUsername = $_SESSION['sessMember'];
			
			
			
	 		if(isset($_REQUEST['post']) && $_REQUEST['post']==true) {
	  			$sqlStr = "INSERT INTO technique (techID, techName, techDes, techStep,techPoint,techVDO,techUsername,techPin,techChangeDate ) VALUES ( NULL,'$postMenuName','$postMenuDes','$postMenuStep','$postMenuPoint','$postMenuVDO','$postMenuUsername',0,NOW())";
          		$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
				$mymenuID = mysqli_insert_id($conn);
				
				
				for ($i=0; $i<count($_FILES['upfile']);$i++) {
					echo $i;
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
          
							$query = "INSERT INTO imgtable(img_name, img_type, img_size, img_data, img_indexAtPage, img_menuID, img_techID, img_username) VALUES ('$fileName', '$fileType', $fileSize, '$imgContent','$i',-1,'$mymenuID',\"none\")";
		
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
				
				$sqlStr = "UPDATE technique SET techName='$postMenuName',techDes='$postMenuDes',techVDO='$postMenuVDO',techStep='$postMenuStep',techPoint='$postMenuPoint',techChangeDate=NOW(),techUsername='$postMenuUsername' WHERE techID='$mymenuID'";
          		$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
						
				
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
          
		  	$sqlStr = "DELETE FROM imgtable WHERE img_techID =".$mymenuID . " AND img_indexAtPage = ".$i ;
				$result = @mysqli_query($conn, $sqlStr)
						Or die("<p>Unable to execute the query.</p>"
                  		. "<p>Error code " . mysqli_errno($conn)
                  		. ": " . mysqli_error($conn)) . "</p>";
								
						
								$query = "INSERT INTO imgtable(img_name, img_type, img_size, img_data, img_indexAtPage, img_menuID, img_techID, img_username) VALUES ('$fileName', '$fileType', $fileSize, '$imgContent','$i',-1,'$mymenuID',\"none\")";
	
							$conn->query($query) or die('Error: query failed'.mysqli_error($conn));
						
							
						}
				}
			}	
		}else {
			$mymenuID = $_REQUEST['menuID'];
		}
		$sqlStr = "SELECT techName,techDes,techVDO, techStep,techChangeDate,techUsername FROM technique WHERE techID = '$mymenuID'";
        $result = mysqli_query($conn, $sqlStr);
		
		$row = mysqli_fetch_assoc($result);
		$boxMenuName = $row['techName'];
		$boxMenuDes = $row['techDes'];
		$boxMenuVDO = $row['techVDO'];
		$boxMenuStepArr = explode(",",$row['techStep']);
		$boxMenuChangeDate = $row['techChangeDate'];
		$boxMenuUsername = $row['techUsername'];
	
			
		
		
		$sqlStr = "SELECT comID,comContent, comDate,comChangeDate,comUsername FROM comment WHERE comTechID = '$mymenuID' ORDER BY comDate";
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
		
		}
		else {
			echo "Please log in.";
			echo"<meta http-equiv=\"refresh\"content=\"2;URL=index.php\">";
				exit();
		}
	}

?>




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
            	  <input type="hidden" name="techID" value="<?php echo $mymenuID; ?>" />
				  <button type="submit" name="likebtn" id="likebtn"><img src="Star-Full.png" width="20px" height="20px" /></button>
            </form>
            <?php
			}
		
			if ((isset($boxMenuUsername) && isset($_SESSION['sessMember']) && $boxMenuUsername == $_SESSION['sessMember'])) {
			?>
            <form action="delTech.php" method="get" onSubmit="return confirm('ยืนยัน?')">
            <input type="submit" name="button1" value="ลบเทคนิค"  id="delmenu" class="showon"/>
            <input type="hidden" name="menuID" value="<?php echo $mymenuID; ?>"/>
                 </form>
			      <input type="button" name="button2" value="แก้ไขเทคนิค"  id="edit" class="showon"/> 
                  <?php
			}
				?>
               
                  <form action="<?php $PHP_SELF;?>" method="post" ENCTYPE="multipart/form-data" onSubmit="return chkform()" >
                   <?php
			
			if ((isset($boxMenuUsername) && isset($_SESSION['sessMember']) && $boxMenuUsername == $_SESSION['sessMember'])) {
			?>
            <div id="deleteAndEdit"> 
				  
                  <input type="submit" name="save" value="บันทึกการแก้ไข" class="saveEdit" id="save" disabled="disabled"/> 
			</div>
               <?php
			}
				?>
		    <div id="recipeName"> <b>ชื่อเทคนิค : </b> <input type="text" id="chkerror1" name="menuName" size="40" class="readon" value="<?php echo $boxMenuName; ?>"/>			<span class="star">****<span>
            <p class="error" id="error1">กรุณากรอกชื่อเทคนิคค่ะ</p>
			</div>
            
            <input type="hidden" name="id" value="<?php echo $mymenuID; ?>"/> 
			<div id="recipeDetail"> <center> <b>รายละเอียดเทคนิค </b><br>
				<textarea rows="5" cols="100" name="content" class="readon"><?php echo $boxMenuDes; ?></textarea>	
			</div>
			<div id="recipePhoto"><b>รูปภาพเทคนิค</b>
				   <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_techID = ".$mymenuID." AND img_indexAtPage = 0";
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\" height=\"500px\" /> </div>";
				
		
			}
			else {
				 echo "<div id=\"completeImg\" class=\"complete\"></div>";
			}
                  
            ?><input type="file" name="upfile[]"  class="hidon"/>
			</div>
            
			
			<div id="process"> <b>ขั้นตอนในการทำเทคนิค </b><br>
                <div id="vdoClip"><div id="crop"> <input id="hidevdo"  type="button" name="butto" value="ไม่ใช้ VDO" class="hidon"/></div><div id="showhide"><span>คลิปวีดิโอประกอบเทคนิค</span>	
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
                     <p class="error" id="error5">กรุณากรอกขั้นตอนการทำเทคนิคอย่างน้อยหนึ่งขั้นตอนค่ะ</p>
				     <div id="detailPhoto00"><b>รูปภาพประกอบ</b>
				     <?php
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID'])) {
				
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_techID = ".$mymenuID." AND img_indexAtPage = 1";
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\"  height=\"500px\" /> </div>";
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
				$mynum = 1+$i;
				
					
				 $sqlStr = "SELECT id FROM imgtable WHERE img_techID = ".$mymenuID." AND img_indexAtPage = ".$mynum;
				
				  $result = @mysqli_query($conn, $sqlStr)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row = mysqli_fetch_assoc($result);
				$temp = $row['id'];
			
				echo "<div ><img src=\"viewImage1.php?isbn=".$temp."\"height=\"500px\"  /></div><input type=\"file\" name=\"upfile[]\" id=\"file".$num."\"  class=\"hidon\"/><hr id=\"hr".$num."\"/></div></div>";
				mysqli_free_result($result);
		
			}
				else {
				 echo "<div id=\"completeImg".$num."\" class=\"complete\"></div><input type=\"file\" name=\"upfile[]\" id=\"file".$num."\"  class=\"hidon\"/><hr id=\"hr".$num."\"/></div></div>";
			}
			
				
						 }
					  }
					 
					 ?></form>
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
				<div id="PostButton"><input type="submit" name="post" value="โพสขั้นตอนการทำเทคนิค" id="post"/>
                 
				</div>
                <?php } ?> 
               
			</div >
              <input type="hidden" name="imgid" value="<?php echo $imgid; ?>">
             <form action="postTechComment.php?" method="get" onSubmit="return confirm('ยืนยัน?')">
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
            
			<div id="showComment">
            <?php
			
			if (isset($_REQUEST['menuName']) || isset($_REQUEST['menuID']) || isset($_SESSION['fromcom'])) {
				
				if($numOfCom>0) {
					for($i=$numOfCom-1; $i>=0;$i--) {
						if (isset($_SESSION['sessMember']) && ($boxComUsername[$i] == $_SESSION['sessMember'])) {
						echo "<form action=\"editComment.php\" method=\"get\"><div id=\"com".$i."\"><div>ความคิดเห็นที่ ".($i+1).": </div><textarea id=\"txtar".$i."\" rows=\"5\" cols=\"100\"  readonly=\"yes\" name=\"ment\">".$boxComContent[$i]."</textarea><div id=\"postDate".$i."\"> โดย: ".$boxComUsername[$i]." แก้ไขครั้งสุดท้ายเมื่อ: ".$boxComChangeDate[$i]."</div></div><hr/><input type=\"hidden\" name=\"hidcom\" value=\"".$boxComID[$i]."\" /><input type=\"hidden\" name=\"hidcom1\" value=\"".$mymenuID."\"/><input type=\"hidden\" name=\"hidcom2\" value=\"tech\"/></form>";
						}
						else {
						echo "<div id=\"com".$i."\"><div>ความคิดเห็นที่ ".($i+1).": </div><textarea id=\"txtar".$i."\" rows=\"5\" cols=\"100\"  readonly=\"yes\" name=\"ment\">".$boxComContent[$i]."</textarea><div id=\"postDate".$i."\"> โดย: ".$boxComUsername[$i]." แก้ไขครั้งสุดท้ายเมื่อ: ".$boxComChangeDate[$i]."</div></div><hr/><input type=\"hidden\" name=\"hidcom\" value=\"".$boxComID[$i]."\" /><input type=\"hidden\" name=\"hidcom1\" value=\"".$mymenuID."\"/><input type=\"hidden\" name=\"hidcom2\" value=\"tech\"/>";
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
	   
			if(comment.hasChildNodes()) {
				var div = $("#showComment > form > div");
				
				for(var i=$("#showComment > form > div").length-1; i>=0; i--) {
						
					if(i>9)
					var nextno = parseInt(div[i].id.substring(div[i].id.length-2, div[i].id.length));
					else
					var nextno = parseInt(div[i].id.substring(div[i].id.length-1, div[i].id.length));
					
			
			
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
					
				}  
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
							$(".readon").css("background-color","transparent");
							
							$(".readon").css("border-style","none");
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
   		
   							$(".readon").removeAttr("readonly");
							$(".readon").css("background-color","white");
							$(".readon").css("border-width","medium");
							$(".readon").css("border-style","solid");
							$(".hidon,.star").css("visibility","visible");
							
							$(".showon").attr("disabled","disabled");
							$("#save").removeAttr("disabled");
							$("#allbtn > input").css("visibility","hidden");
							
						
							
   							
   
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
