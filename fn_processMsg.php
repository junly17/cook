<?php function process_msg($msg,$urlRedirect){
		$info = pathinfo($urlRedirect);
		echo '<center><h2>'.$msg.'</h2></center>';
		echo '<br/><center><a href="'.$info['filename'].'.php"</a> ตกลง </center><br/><br/><br/>';
		exit;
}?>

<?php function process_msg($msg,$page){
		//echo "<h2>Sorry,You can't access this page.</h2>";	
		echo "<h2>System is backing to home page.</h2><h2>Please wait :))</h2>";	
        echo"<meta http-equiv=\"refresh\"content=\"4;URL=home.php\">";
		exit;
}?>
