<?php
//检查是否为管理员
function is_administrator($name='Samuel',$value='Clemens'){//使用带默认值的参数
	if(isset($_COOKIE[$name])&&($_COOKIE[$name]==$value)){
		return true;
	}
	else{
		return false;
	}
}
?>