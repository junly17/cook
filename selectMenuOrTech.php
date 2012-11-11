<?php
$name = $_GET['searchText'];
$choice = $_GET['searchFrom'];
if ($choice == "รายการอาหาร") {
	header("Location: menuList.php?search=$name");
				exit();
} else if ($choice == "เทคนิค") {
	header("Location: techList.php?search=$name");
				exit();
} 
	


?>