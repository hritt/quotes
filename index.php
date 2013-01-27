<?php
include('templates/header.html');
include('mysql_connect.php');
//定义查询
if(isset($_GET['random'])){//如果变量被设置了
	$query='select quote_id,quote,source,favorite from quotes order by RAND() desc LIMIT 1';//只检索一行
}elseif(isset($_GET['favorite'])){
	$query='select quote_id,quote,source,favorite from quotes where favorite=1 order by RAND() desc LIMIT 1';
}else{
	$query='select quote_id,quote,source,favorite from quotes order by date_entered desc LIMIT 1';
}
//运行查询
if($r=mysql_query($query,$dbc)){
	$row=mysql_fetch_array($r);
	print "<div><blockquote>{$row['quote']} —— {$row['source']}</blockquote>";
	if($row['favorite']==1){
		print '<strong>Favorite!</strong>';
	}
	print '</div>';
	
	//如果管理员登录，显示管理链接
	if(is_administrator()){
		print "<p><b>Quote Admin:</b><a href=\"edit_quote.php?id={$row['quote_id']}\">Edit</a> <-> 
									<a href=\"delete_quote.php?id={$row['quote_id']}\">Delete</a></p>\n";
	}
}else{//没有运行查询
	print '<p class="error">Could not retrieve the data because:<br>'.mysql_error($dbc).'.</p><p>The query being run was:'.query.'</p>';
}

mysql_close($dbc);

print '<p><a href="index.php">Latest</a> <-> 
		<a href="index.php?random=true">Random</a> <-> 
		<a href="index.php?favorite=true">Favorite</a></p>';

include('templates/footer.html');
?>