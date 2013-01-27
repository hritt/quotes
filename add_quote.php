<?php
define('TITLE','Add a quote');
include('templates/header.html');

print '<h2>Add a quotation</h2>';

//强制只有管理员才可以登录
if(!is_administrator()){
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.html');
	exit();
}

//检查表单是否提交
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(!empty($_POST['quote'])&&!empty($_POST['source'])){
		include('mysql_connect.php');//这里因为mysql_connect.php的位置放的不同，我写的和原来不相同
		
		$quote=mysql_real_escape_string(trim(strip_tags($_POST['quote'])),$dbc);
		$source=mysql_real_escape_string(trim(strip_tags($_POST['source'])),$dbc);
		
		//创建favorite值
		if(isset($_POST['favorite'])){
			$favorite=1;
		}else{
			$favorite=0;
		}
		
		$query="insert into quotes(quote,source,favorite) values ('$quote','$source','$favorite')";
		$r=mysql_query($query,$dbc);
		
		if(mysql_affected_rows($dbc)==1){
			print '<p>Your quotation has been stored.</p>';
		}else{
			print '<p class="error">Could not store the quote because:<br/>'.mysql_error($dbc).'.</p>
								<p>The query being run was:'.$query.'</p>';
		}
		
		mysql_close($dbc);//关闭连接
	}else{
		print '<p class="error">Please enter a quotation and a source!</p>';
	}
}
?>

<form action="add_quote.php" method="post">
	<p><label>Quote<textarea name="quote" rows="5" cols="30"></textarea></label></p>
	<p><label>Source<input type="text" name="source"/></label></p>
	<p><label>Is this a favorite?<input type="checkbox" name="favorite" value="yes"/></label></p>
	<p><input type="submit" name="submit" value="Add This Quote!" /></p>
</form>

<?php include('templates/footer.html');?>