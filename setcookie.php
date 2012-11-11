<?php	
		 if($_GET["createOrDel"] = "create"){
			//if(!isset($_COOKIE["cookiMember"])){
		  		@$result = setcookie("cookiMember",$_GET["data"],time()+60*60*24*7);
		 	   // if($result === true){ 
				//	echo "create cookie success!!";
				//}else{ 
				//	echo "cookiMember is".$_COOKIE['cookiMember'];
				//}
			//}
			echo"<meta http-equiv=\"refresh\"content=\"1;URL=index.php\">" ; 	  
			}
		else if($_GET["createOrDel"] = "delete"){
				setcookie("cookiMember","");
	     
		  }
		echo"<meta http-equiv=\"refresh\"content=\"1;URL=index.php\">" ; 
?>
