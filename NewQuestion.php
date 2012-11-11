<?php require_once("fn_layoutControl.php");
	open_head("New Question","member");	  
?>
	<style type="text/css">
	@import url(questionAndAns.css)
	</style>
	
<?php close_head(); ?>
<?php open_body();

if($_GET['Action'] == "Save")
{   $conn = connect_db();
	//*** Insert Question ***//
	$sql = "INSERT INTO webboard ";
	$sql .="(CreateDate,Question,Details,Name) ";
	$sql .="VALUES ";
	$sql .="('".date("Y-m-d H:i:s")."','".$_POST["txtQuestion"]."','".$_POST["txtDetails"]."','".$_POST["txtName"]."') ";
	$result = mysqli_query($conn,$sql);
	
	header("location:Webboard.php");
}

?>

<form action="NewQuestion.php?Action=Save" method="post" name="frmMain" id="frmMain">
  <table width="621" border="1" cellpadding="1" cellspacing="1">
    <tr>
      <td>Question</td>
      <td><input name="txtQuestion" type="text" id="txtQuestion" value="" size="70"></td>
    </tr>
    <tr>
      <td width="78">Details</td>
      <td><textarea name="txtDetails" cols="50" rows="5" id="txtDetails"></textarea></td>
    </tr>
    <tr>
      <td width="78">Name</td>
      <td width="647"><input name="txtName" type="text" id="txtName" value="" size="50"></td>
    </tr>
  </table>
  
  <input name="btnSave" type="submit" id="btnSave" value="Submit">
</form>

<?php 
mysqli_free_result($result);
mysqli_close($conn);
close_body() ;
?>