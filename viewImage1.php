<?php


if(isset($_GET['isbn'])) {
	$dbconn = @new mysqli("localhost","root","","cooking") or die('Error : ' .mysqli_error());
	
	$isbn = $_GET['isbn'];

	

	$query = "SELECT img_data,img_name FROM imgtable WHERE id = $isbn";
	
	$result = $dbconn->query($query) or die(mysqli_error());

	list($img,$name) = $result->fetch_array();
	
	echo $img;

	
	$dbconn->close();

}
?>
