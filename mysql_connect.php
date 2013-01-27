<?php

//create table quotes(
//quote_id int unsigned not null auto_increment,
//quote text not null,--utf8_general_ci
//source varchar(100) not null,
//favorite tinyint(1) unsigned not null,
//date_entered timestamp not null default current_timestamp,
//primary key(quote_id)
//)

//连接
$dbc=mysql_connect('localhost','root','');
//选中
mysql_select_db('quotes',$dbc);
?>