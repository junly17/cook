<!DOCTYPE html>
<html>
    <head>
        <title>Image Display from BLOB field</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
<?php
function showImg($id = null) {
    $dbhost = 'localhost';
    $dbuser = 'book4course';
    $dbpass = 'passwd';
    $dbname = 'book4course';

    $dbconn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Error Occurred-".mysqli_error());
 
    $query = "SELECT `id`, `img_name`, `img_type`, `img_size`, `img_data`
                     FROM imgTable ";
    if (is_null($id)) 
        $query = $query . ' ORDER BY `id`';
    else {
        $query = $query . ' WHERE `id`=' .$id;
    }

    $result = $dbconn->query($query) or die('Error, query failed');
 
    while($row = $result->fetch_array()){
        echo "<div>$row[img_name] " ;
        echo "<img src=\"viewimage.php?id=$row[id]\" width=\"100\" height=\"100\" /> </div>";
    }
 
   $dbconn->close();
   
 }
 
 $id = null;
 if (isset($_GET['id']) && intval($_GET['id'])) {
     $id = intval($_GET['id']);
 }
 showImg($id);
 
?>
    </body>
</html>