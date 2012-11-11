<?php require_once("fn_layoutControl.php");
	
	  open_head("List Banned User","admin");	  
?>

<style type="text/css">
@import url(bannedUser.css)
</style>

<?php close_head(); ?>

<?php open_body(); ?>

<?php

$conn = connect_db();
 
		$a = $_GET['bannedUser'];
		$b = $_GET['expireTime'];
		$c = $_GET['unit'];
		$d = $_GET['reason'];
		$e = $_GET['admin'];
		
	$stm ="INSERT INTO banneduser (Username,ExpireTime,UnitOfTime,Reason,Admin) VALUES ('$a','$b','$c','$d','$e')";
	$result1 = mysqli_query($conn,$stm);
?> 

<div id="listBannedUser">

<br/>
<h2>List Banned User</h2>
<br/>
<div id="searchTab">
	<form action="" method="">
		<input type="text" size="60" name="key" id="key"/><input type="submit" value="Search">
	</form>
</div>

<form action="" method="">
	<table border="2" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>Ban User</th>
				<th>Expire time</th>
				<th>Unit of time</th>
				<th>Reason</th>
				<th>ADMIN</th>
			</tr>
		</thead>
		<tbody>
<?php  

	$stm = "SELECT * FROM banneduser";
	$result = mysqli_query($conn,$stm);
	while($row = mysqli_fetch_array($result)) {
	
	echo "<tr><td><input type=\"checkbox\" name=\"username\" value=\"userBanned\"/></td>"
		."<td>".$row[0]."</td>"
    	."<td>".$row[1]."</td>"    
    	."<td>".$row[2]."</td>"    
    	."<td>".$row[3]."</td>"     
    	."<td>".$row[4]."</td></tr>" ;     
    	 

}

 mysqli_free_result($result);
 mysqli_close($conn);
?>	  
		</tbody>
	</table>
	
<div id="btns">
	<button name="Select All" onclick="">Select All</button>
	<input type="submit" value="Delete" />
</div>

</form>
<br/><br/><br/>
</div>

<?php close_body() ;?>
