<?php
//使用默认值定义两个变量
$loggedin=false;
$error=false;

//检查表单是否提交
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(!empty($_POST['email'])&& !empty($_POST['password'])){
		if((strtolower($_POST['email'])=='a@a.com')&&($_POST['password']=='aaa')){
			setcookie('Samuel','Clemens',time()+3600);//创建cookie//1小时后再次登录
			$loggedin=true;//标识已登录
		}else{
			$error='The submitted email address and password do not match those on file!';
		}
	}else{//表单未填完
		$error='Please ake sure you enter both an email address and a password!';
	}
}

//设置页面标题并包含页面头文件
define('TITLE','Login');
include('templates/header.html');

//在文件出错时打印出错信息
if($error){
	print '<p class="error">' .$error. '</p>';
}

//检查用户是否已登录，如果没有则显示表单
if($loggedin){
	print '<p>You are now logged in!</p>';
}else{
	print '<h2>Login Form</h2>
		   <form action="login.php" method="post">
		   <p><label>Email Address<input type="text" name="email"/></label></p>
		   <p><label>Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"/></label></p>
		   <p><input type="submit" name="submit" value="Log In"/></p>
		   </form>';
}

include('templates/footer.html');
?>