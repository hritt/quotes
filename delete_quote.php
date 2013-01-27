<?php
define('TITLE','Delete a quote');
include('templates/header.html');

print '<h2>Delete a quotation</h2>';

//强制只有管理员才可以登录
if(!is_administrator()){
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.html');
	exit();
}
include('mysql_connect.php');

if(isset($_GET['id'])&&is_numeric($_GET['id'])&&($_GET['id']>0)){
	$query ="select quote,source,favorite from quotes where quote_id={$_GET['id']}";
	if($r=mysql_query($query,$dbc)){
		$row=mysql_fetch_array($r);
		print  '<form action="delete_quote.php" method="post">
				<p>Are you sure you want to delete this quote?</p>
				<div><blockquote>'.$row['quote'].'</blockquote>-'.$row['source'];
				
				if($row['favorite']==1){
					print '<strong>Favorite!</strong>';
				}
				print '</div><br/><input type="hidden" name="id" value="'.$_GET['id'].'" />
				<p><input type="submit" name="submit" value="Delete this Quote!" /></p>
				</form>';
	}else{//无法获取信息
		print '<p class="error">Could not retrieve the data because:<br/>'.mysql_error($dbc).'.</p>
							<p>The query being run was:'.$query.'</p>';
	}
}elseif(isset($_POST['id'])&&is_numeric($_POST['id'])&&($_POST['id']>0)){//处理表单
	$query="delete from quotes where quote_id={$_POST['id']} LIMIT 1";
	$r=mysql_query($query,$dbc);
	
	if(mysql_affected_rows($dbc)==1){
		print '<p>The quote entry has been deleted.</p>';
	}else{
		print '<p class="error">Could not delete the entry because:<br/>'.mysql_error($dbc).'.</p>
							<p>The query being run was:'.$query.'</p>';
	}
}else{//没有获取表单
	print '<p class="error">This page has been accessed in error.</p>';
}

mysql_close($dbc);
include('templates/footer.html');
?>

