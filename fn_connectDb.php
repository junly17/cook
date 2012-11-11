<?php function connect_db(){
	$conn = mysqli_connect('localhost','root','','oom');
		if(!$conn){
			die("You cann't link to database");
		} else {
			mysqli_query($conn,"SET CHARSET UTF-8");
		return $conn;
		}
}?>