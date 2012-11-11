<?php function valid_user($user){
	if(preg_match('/^[a-z\d]{6,13}$/i',$user)){
			return true;
	} else {
			return false;
	}
}?>

<?php function valid_pwd($pwd){
	if(preg_match('/^[a-z\d_]{6,13}$/i',$pwd)){
			return true;
	} else {
			return false;
	}
}?>

<?php function valid_email($email){
	if(preg_match('/^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/',$email)){
			return true;
	} else {
			return false;
	}
}?>
