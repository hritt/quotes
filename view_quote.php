<?php
define('TITLE','View all quotes');
include('templates/header.html');

print '<h2>All quotes</h2>';

//强制只有管理员才可以登录
if(!is_administrator()){
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.html');
	exit();
}
include('mysql_connect.php');
$query ='select quote_id,quote,source,favorite from quotes order by date_entered desc';

if($r=mysql_query($query,$dbc)){
	while($row=mysql_fetch_array($r)){
		print "<div><blockquote>{$row['quote']} —— {$row['source']}</blockquote>\n";//打多个空格也只有一个空格有用
		if($row['favorite']==1){
			print '<strong>Favourite!</strong>';
		}
		//添加管理员连接
		print "<p><b>Quote Admin:</b><a href=\"edit_quote.php?id={$row['quote_id']}\">Edit</a> <-> 
										<a href=\"delete_quote.php?id={$row['quote_id']}\">Delete</a></p></div>\n";//注意引号的使用,加\
	}
}else{
	print '<p class="error">Could not retrieve the data because:<br/>'.mysql_error($dbc).'.</p>
						<p>The query being run was:'.$query.'</p>';
}

mysql_close($dbc);
include('templates/footer.html');
?>