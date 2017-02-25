<?php
//连接数据库
$db = 'test';
$ip = '127.0.0.1';
$username = 'alan';
$password = 'secret';
$q = mysql_connect( $ip, $username, $password );
if ( !$q){
	die( 'Could not connect:'.mysql_error() );
}
mysql_query("set names utf8");
mysql_select_db("$db",$q );  //选择数据库
?>