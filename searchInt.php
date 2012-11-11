<?php require_once("fn_layoutControl.php");
	open_head("Search Menu From Ingredient","guest");
?>
<link type="text/css" rel="stylesheet" href="searchIntStyle.css" />
<link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
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
<script type="text/javascript">
function chkform() {
				var error1 = document.getElementById("chkerror1");
				
				if (error1.value == "" ) {
					alert("กรุณากรอกรายการวัตถุดิบอย่างน้อยหนึ่งรายการค่ะ");
								
						var name = document.getElementById("error1");
						name.style.visibility = "visible";			
					
					return false;
					
				}
				else {
					return true;
				}
}


</script>

<?php 
close_head(); 
open_body();
$conn = connect_db();

?>
<div id="searchIntContent">
<h2>ค้นหารายการอาหารจากวัตถุดิบ</h2> 
		<div id = "topic">
			
			</div>	
		<div id = "input">	
        <form action="<?php $PHP_SELF;?>" method="get" onSubmit="return chkform()">
			<div id="ingredient">
          <div>**ใส่วัตถุดิบในการค้นหาอย่างน้อย 1 รายการ**</div>
             <div id="matlistbox00" ><span id="forrem00">ชื่อวัตถุดิบ : <input type="text" id="chkerror1" name="ingredient[]" class="readon" />
				         </span></div>
                <div id="matlistbox01" ><span id="forrem01">ชื่อวัตถุดิบ : <input type="text" name="ingredient[]" class="readon" />
				         </span><input id="remmatbtn01" type="button" name="delbutton" value="ลบ" class="hidon"/></div>
                          <div id="matlistbox02" ><span id="forrem02">ชื่อวัตถุดิบ : <input type="text" name="ingredient[]" class="readon" />
				         </span><input id="remmatbtn02" type="button" name="delbutton" value="ลบ" class="hidon"/></div>     
                    <span id="allbtn">
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
                         <p class="error" id="error1">กรุณากรอกรายการวัตถุดิบอย่างน้อยหนึ่งรายการค่ะ</p>
					 <input id="addmat"  type="button" name="button4" value="เพิ่มรายการวัตถุดิบ" class="hidon"/>
                     <input id="remmat"  type="button" name="button4" value="ลบวัตถุดิบทั้งหมด" class="hidon"/>
				
			</div>

			
			
				<div class = "search"><input type="submit" value="ค้นหา" id="search"/></div>
				</form>
	
		</div>	
		<?php
			if (isset($_GET['ingredient'])) {
					for($i=0;$i<count($_GET['ingredient']);$i++) {
						if ($_GET['ingredient'][$i] != "") {
							$postMatNameArr[] = $_GET['ingredient'][$i];
							
						}
					}
					
					for($i=0;$i<count($postMatNameArr);$i++) {
						$sqlStr = "SELECT matID,matName FROM material";
						$result = mysqli_query($conn, $sqlStr);
						while($row = mysqli_fetch_assoc($result)) {
							$pos = strpos($row['matName'], $postMatNameArr[$i]);
							if ($pos !== false) {
							$matIDList[$i][] = $row['matID'];
						
							}
						}
					}
					if (isset($matIDList)) {
					
					for($i=0;$i<count($matIDList);$i++) {
						$sqlStr = "SELECT consistMenuID FROM consist WHERE ";
						for($j=0;$j<count($matIDList[$i]);$j++) {
							$sqlStr =  $sqlStr . "consistMatID = ".$matIDList[$i][$j];
							if ($j < count($matIDList[$i])-1) {
								$sqlStr =  $sqlStr . " OR ";
							}
							
						}
						
						$result = mysqli_query($conn, $sqlStr);
						
						while($row = mysqli_fetch_assoc($result)) {
							$menuIDList[$i][] = $row['consistMenuID'];
							
						}
					}
					for($i=0;$i<count($menuIDList);$i++) {
							for($j=0;$j<count($menuIDList[$i]);$j++) {
								$onedi[] = $menuIDList[$i][$j]; 
							}
						
					}
					$count =0;	
					$uniqueMenuID = array_unique($onedi);
					for ($i=0; $i < count($uniqueMenuID); $i++) {
						for($j=0;$j<count($menuIDList);$j++) {
							for($k=0;$k<count($menuIDList[$j]);$k++) {
								if($uniqueMenuID[$i] == $menuIDList[$j][$k]) {
									$count++;
								}
							}
						}
						$resultArr[] = $uniqueMenuID[$i] . "," . $count;	
						$count = 0; 
					}
					
					$group1 = array();
						$group2= array();
						$group3= array();
					for ($i=0; $i < count($resultArr); $i++) {
					
						$all = explode(",",$resultArr[$i]);
						
						$id = $all[0];
						
						$num = (int)$all[1];
						
						$sqlStr = "SELECT menuNumOfMat FROM menu WHERE menuID =".$id ;
						$result = mysqli_query($conn, $sqlStr);
						$row = mysqli_fetch_assoc($result);
						
						if($num == $row['menuNumOfMat']) {
							$group1[] = $id;
						} else if($num== $row['menuNumOfMat']-1) {
							$group2[] = $id; 
						} else if ($num == $row['menuNumOfMat']-2) {
							$group3[] = $id;
						}
					}
					
		
		
		
		?>
		
		<br>
		<div id = "topic">
			<b>ผลการค้นหา :</b> 
			</div>	
			
			<div id="tabs">
    <ul>
        <li class="tit"><a href="#fragment-1"><span>วัตถุดิบครบ</span></a></li>
        <li class="tit"><a href="#fragment-2"><span>ขาดวัตถุดิบหนึ่งรายการ</span></a></li>
        <li class="tit"><a href="#fragment-3"><span>ขาดวัตถุดิบสองรายการ</span></a></li>
	
    </ul>
	<div id="fragment-1">
	<table cellspacing="0" width="800px">
        	<tbody>
         
            	<?php
				
				
					
					
					
					for ($i=0; $i<count($group1); $i++) {
					
					
					
					
					
					
					$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu WHERE menuID =".$group1[$i] ;
					$result = mysqli_query($conn, $sqlStr);
				
					$row = mysqli_fetch_assoc($result);
					
					
							$sqlStr2 = "SELECT comID FROM comment WHERE comMenuID = ".$row['menuID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);

				if($i%2==1)
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
                   
                    <td>
                   
                    	<input type="hidden" class="menuid" value="<?php echo $row['menuID']; ?>"/>
						
                       
                       
                    </td>
                </tr>
               <?php
			   			
					}
					
				
			   ?>

            </tbody>
        </table>
	
	</div>
	
    <div id="fragment-2">
	<table cellspacing="0" width="800px">
        	<tbody>
         
            	<?php
				
				
					
					
					
					for ($i=0; $i<count($group2); $i++) {
					
					
					
					
					
					
					$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu WHERE menuID =".$group2[$i] ;
					$result = mysqli_query($conn, $sqlStr);
				
					$row = mysqli_fetch_assoc($result);
					
					
							$sqlStr2 = "SELECT comID FROM comment WHERE comMenuID = ".$row['menuID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);

				if($i%2==1)
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
                   
                    <td>
                   
                    	<input type="hidden" class="menuid" value="<?php echo $row['menuID']; ?>"/>
                    	
                       
                       
                    </td>
                </tr>
               <?php
			   			
					}
					
				
			   ?>

            </tbody>
        </table>
	</div>

    
    <div id="fragment-3">
	<table cellspacing="0" width="800px">
        	<tbody>
         
            	<?php
				
				
					
					
					
					for ($i=0; $i<count($group3); $i++) {
					
					
					
					
					
					
					$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu WHERE menuID =".$group3[$i] ;
					$result = mysqli_query($conn, $sqlStr);
				
					$row = mysqli_fetch_assoc($result);
					
					
							$sqlStr2 = "SELECT comID FROM comment WHERE comMenuID = ".$row['menuID'];
							$result2 = mysqli_query($conn, $sqlStr2);
							$numOfCom = mysqli_num_rows($result2);

				if($i%2==1)
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
                   
                    <td>
                   
                    	<input type="hidden" class="menuid" value="<?php echo $row['menuID']; ?>"/>
                    	
                       
                       
                    </td>
                </tr>
               <?php
			   			
					}
					mysqli_free_result($result);
					
					mysqli_free_result($result2);
					
					mysqli_close($conn);
				} else {
					echo "<p>ไม่พบเมนูอาหารที่มีวัตถุดิบดังกล่าว</p>";
				}
			}
			   ?>

            </tbody>
        </table>
	</div>

    
	

   
</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
		
			
		
		 
        
        <script type="text/javascript" src="jquery-1.8.1.min.js"></script> 
        
	<!-- easing plugin ( optional ) -->
	<script src="js/easing.js" type="text/javascript"></script>
         <script src="js/jquery.ui.totop.js" type="text/javascript"></script>
  
    <script type="text/javascript">
	$(document).ready(function() {
	 $("#addmat").click(function() {
							 var spanallbtn = document.getElementById("allbtn");
							 var allbtn = spanallbtn.getElementsByTagName("input");
							 if (allbtn.length==0) {
								alert("ไม่สามารถเพิ่มวัตถุดิบได้แล้วค่ะ!!"); 
							 } else {
								 var nextNum = allbtn[0].id.substring(allbtn[0].id.length-2, allbtn[0].id.length);
								  var tempText = "<div id=\"matlistbox"+nextNum+"\"><span id=\"forrem"+nextNum+"\">ชื่อวัตถุดิบ : <input type=\"text\" name=\"ingredient[]\" size=\"20\" class=\"readon\"/></span></div>";
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
	   $("#remmat").click(function() {
			var ingedient = document.getElementById("ingredient");
			var matlistbox = ingedient.getElementsByTagName("div");
		
			for (var i=matlistbox.length-1; i>=2; i--) {
		$("#" + matlistbox[i].lastChild.id).css("visibility", "hidden");
		 $("#" + matlistbox[i].lastChild.id).css("float","left"); 
								   
								      $("#" + matlistbox[i].lastChild.id).css("height","0px");
									 $("#" + matlistbox[i].lastChild.id).css("width","0px");
				$("#" + matlistbox[i].lastChild.id).insertBefore("#endlist");
			
				$("#" + matlistbox[i].id).remove();
		
			}
								 
							 
								 
	 });
	   
	   var allidbtndel = "#remmatbtn01,#remmatbtn02,#remmatbtn03,#remmatbtn04,#remmatbtn05,#remmatbtn06,#remmatbtn07,#remmatbtn08,#remmatbtn09,#remmatbtn10,#remmatbtn11,#remmatbtn12,#remmatbtn13,#remmatbtn14, #remmatbtn15,#remmatbtn16,#remmatbtn17,#remmatbtn18,#remmatbtn19,#remmatbtn20" ;
  $(allidbtndel).click(function() {  
						 
						 
						  $(this).insertBefore("#endlist");
					var numOfrow = this.id.substring(this.id.length-2, this.id.length);
					
					
					
					
				
					$("#matlistbox"+numOfrow).remove();
					
						  
						 $(this).css("visibility","hidden"); 
								  $(this).css("float","left"); 
								   
								      $(this).css("height","0px");
									  $(this).css("width","0px");
							  
							  });
	   
	   
	   
  
	});
		
</script>
</div>
        <?php close_body(); ?>