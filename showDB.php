<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$conn = mysqli_connect('localhost','root','','cooking') or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
$sql="SELECT * FROM picture";
$result = mysqli_query($conn,$sql);

while($data = mysqli_fetch_array($result)){
echo $data["file_id"]. " - " ."<img src=viewImage.php?filesID=$data[file_id]>" . " - " .
$data["file_name"]. " - " . $data["file_type"]. " - ".$data["file_size"];
?>



<img src="viewImage.php?filesID=<?=$data["file_id"];?>" /><?=$data["file_name"];?>">
<?php 
}
?>
</body>
</html>

<?php mysqli_close($conn);?>	
