<?php require_once("fn_layoutControl.php");
	
	  open_head("Ban User","admin");	  
?>

<style type="text/css">
@import url(bannedUser.css)
</style>

<?php close_head(); ?> 
<?php open_body(); ?> 

<div id="addBannedUser">
<div id="addBannedUser2">
<br/>
<h2>Add Banned User</h2>
<br/>

<div id="formAdd">
<form action="searchBanUser.php" method="post" >
<input type="hidden" name="admin" size ="20" value="admin">
Ban Username : <input type="text" name="bannedUser" size ="28"/>
<input type="submit" value="search" id="searchBtn"/>
</form>
<br/><br/>

Search Result :
<br/>
<?php
if (isset($_GET['banusers'])) {
	if ($_GET['banusers'] == "none") { 
		echo "ไม่พบ user ตามที่ค้นหาค่ะ";
	} else {
		$res = explode(",",$_GET['banusers']);
		echo "<ul>";
		for ($i=0;$i<count($res);$i++) {
			$name = $res[$i];
			
			echo "<li class=\"box\"><span class=\"left\">$name</span><input class=\"right\" type=\"button\" value=\"Ban\" onclick=\"window.location.href='doBanUser.php?username=$name'\"></li>";	
			
		}
		echo "</ul>";
	}
	
}
else {
	echo "ใส่ username ของ user ที่ต้องการ ban และกดปุ่ม search.";
}

?>


<br/><br/>
</div>
</div>

</div>   
<?php close_body() ;?>