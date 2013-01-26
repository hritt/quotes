<?php
//若果cookie存在，则删除
if(isset($_COOKIE['Samuel'])){
	setcookie('Samuel',FALSE,time()-300);//要删除已存在的cookie，可以发送另一个同名cookie，将值设为FALSE，时间设为过去的时间
}
define('TITLE','Logout');
include('templates/header.html');

print '<p>You are now log out.</p>';

include('templates/footer.html');
?>