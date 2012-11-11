<?php require_once("fn_layoutControl.php");
	 open_head("home","guest");	  
?>


<link rel="stylesheet" type="text/css" href="jquery-ui-1.7.2.custom/css/smoothness/jquery-ui-1.7.2.custom.css">
<link type="text/css" rel="stylesheet" href="menuList.css" />
<script type="text/javascript" src="jquery-ui-1.7.2.custom/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#tabs").tabs(); 
	});
</script>
<style type="text/css">
	.ui-tabs{
	font-family:tahoma;
	font-size:16px;
	}
	.imgOrder {
		left:0px;
		width: 120px;
		height: 120px;
		border:2px solid #000000;
		float:left;
	}
	.detailOrder {
		position: relative;
		margin:10px;
		width: 650px;
		float:left;
		color:#FF3300;
	}
	
	.frame {
		background-color:;
		width:850px;
		height:150px;
		margin:5px 20px;
		}

</style>
<?php close_head(); ?>

<?php open_body();
$conn = connect_db();?>


 หน้าแรก...
         	<div id="tabs">
            
				<ul>
					<li><a href="#tabs-1">MENU</a></li>
					<li><a href="#tabs-2">TECHNIQUE</a></li>
				</ul>
                <div id="tabs-1">
<?php 

$sqlStr = "SELECT menuID,menuName,menuUsername,menuPoint,menuDate FROM menu ORDER BY menuDate DESC";
$result = mysqli_query($conn, $sqlStr);
$coun=1;
while($row = mysqli_fetch_assoc($result)) {
	if($coun>5){exit;}
		$mymenuID =  $row['menuID'];						
          $sqlP = "SELECT id FROM imgtable WHERE img_menuID = ".$mymenuID." AND img_indexAtPage = 0";
				
				  $result34 = @mysqli_query($conn, $sqlP)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row34 = mysqli_fetch_assoc($result34);
				  $temp = $row34['id'];
			
?>
                
                <div class="frame">
                    	<?php echo "<div ><img class=\"imgOrder\" src=\"viewImage1.php?isbn=".$temp."\"  /> </div>"; ?>
                        <div class="detailOrder">
                        	<?php echo $row['menuName']?> <br/>
                            By <?php echo $row['menuUsername']; ?><br/>   
                            Rating -- <?php echo $row['menuPoint']; ?> 
                            
                        </div>
                    </div>
<?php } ?>                  
                  
				</div>
                
				<div id="tabs-2">
                
     
<?php $sqlStr = "SELECT techID,techName,techUsername,techPoint,techDate FROM technique ORDER BY techDate DESC";
$result = mysqli_query($conn, $sqlStr);  
$coun2 =1;
while($row = mysqli_fetch_assoc($result)) {
	if($coun2 >5){exit;}
				$mytechID =  $row['techID'];						
         		 $sqlP = "SELECT id FROM imgtable WHERE img_techID = ".$mytechID." AND img_indexAtPage = 0";
				
				  $result35 = @mysqli_query($conn, $sqlP)
                  			Or die("<p>Unable to execute the query.</p>"
                  			. "<p>Error code " . mysqli_errno($conn)
                  			. ": " . mysqli_error($conn)) . "</p>";	 
				  $row35 = mysqli_fetch_assoc($result35);
				  $temp = $row35['id'];
			
?>			
        
                
					<div class="frame">
                    	<?php echo "<div ><img class=\"imgOrder\" src=\"viewImage1.php?isbn=".$temp."\"  /> </div>"; ?>
                        <div class="detailOrder">
                        	<?php echo $row['techName']?><br/>
                            By <?php echo $row['techUsername']; ?><br/> 
                            Rating --  <?php echo $row['techPoint']; ?> 
                            
                        </div>
                    </div>
  <?php } ?>                       
				</div>
            </div>

<?php   close_body(); ?> 

