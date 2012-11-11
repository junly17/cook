<?php require_once("fn_layoutControl.php");
	open_head("Menu List","guest");
?>
<link type="text/css" rel="stylesheet" href="menuList.css" />
<link rel="stylesheet" media="screen,projection" href="css/ui.totop.css" />
<?php 

close_head(); 
open_body(); 
$conn = connect_db();


if (isset($_GET['sort'])) {
	if ($_GET['sort']=="วันเวลาล่าสุด") {
		$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu ORDER BY menuDate DESC";
		$ch = 1;
	} else if ($_GET['sort']=="ตัวอักษร") {
		$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu ORDER BY menuName";
		$ch = 2;
	}  else {
		$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu ORDER BY menuPoint";
		$ch = 3;
	}
} else {

$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu ORDER BY menuDate DESC";
$ch = 1;
}

$result = mysqli_query($conn, $sqlStr);
	




	



?>








    	<div id = "groupbtn">
       
       
       <form action="delMenu.php" method="get" onsubmit="return confirm('ยืนยัน?')">
       <?php
	   if( isset($_SESSION['sessMember']) ) {
	   ?>
       <button type="button" name="addbtn" onclick="window.location.href='recipeDetail.php'"><img src="Button-Add-icon.png" width="20px" height="20px" /></button>
         
    	<button type="submit" name="delbtn" id="delbtn"><img src="symbol_delete.png" width="20px" height="20px" /></button>
       <input type="button" name="selectall" id="selectall" value="Select All" />
        <input type="button" name="clearall" id="clearall" value="Clear All" />
    	 <?php
	   }
	   ?>
       
        </div>
    	<label for="sortType">ผลการค้นหา: เรียงลำดับตาม </label>
        <select name="sortType" id = "sortType">
        	<option <?php if($ch==1)echo "selected=\"selected\""; ?>>วันเวลาล่าสุด</option>
            <option  <?php if($ch==2)echo "selected=\"selected\""; ?>>ตัวอักษร</option>
            <option  <?php if($ch==3)echo "selected=\"selected\""; ?>>คะแนน</option>
        
        </select>
		<table id="menuListTable" cellspacing="0" width="900px">
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
                   
                    <td>
                   
                    	<input type="hidden" class="menuid" value="<?php echo $row['menuID']; ?>"/>
                    	<?php
						if ( isset($_SESSION['sessMember']) && ($row['menuUsername'] == $_SESSION['sessMember']) ) {
							
						?>
                    	<input type="checkbox" name="check" class="chkbox"/>
						<?php
						}
						?>
                       
                       
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
                   
                    <td>
                   
                    	<input type="hidden" class="menuid" value="<?php echo $row['menuID']; ?>"/>
                    	<?php
						if ( isset($_SESSION['sessMember']) && ($row['menuUsername'] == $_SESSION['sessMember'])) {
							
						?>
                    	<input type="checkbox" name="check" class="chkbox"/>
						<?php
						}
						?>
                       
                       
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
					mysqli_close($conn);
			   ?>
            </tbody>
        </table>
        <input type="hidden" class="allmenuid" name="allmenuid" value="" />
           </form>
         <script type="text/javascript" src="jquery-1.8.1.min.js"></script> 
         <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<!-- easing plugin ( optional ) -->
	<script src="js/easing.js" type="text/javascript"></script>
         <script type="text/javascript">
		
		
		$(document).ready(function() {
								
	
							
								   $("#selectall").click(function() {	
																 $(".chkbox").attr("checked", "true");  
															
																    });
								     $("#clearall").click(function() {	
																 $(".chkbox").removeAttr("checked");  
															
																    });
								   
								    $("#delbtn").click(function() {
											var chk = $(".chkbox");
											var allid = "";
											for(var i=0; i<chk.length; i++) {
												if(chk[i].checked == true) {
													allid = allid +  $(".menuid")[i].value +",";
													
												}
												
											}
											allid =allid.substring(0, allid.length-1);
											$(".allmenuid")[0].value = allid;
							
								    });
									  $("#sortType").change(function() {
												var val = this.value;
												var url = "menuList.php?sort=" + val;
												 window.location.href = url;		  
																  
									});
									
									});
		
		</script>
           
  <?php close_body(); ?>
