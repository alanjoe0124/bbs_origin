<?php

//处理标题信息
//header("charset = utf-8");  //由于登陆后才能POST，所以没有在这里验证cookie
include("config.php");


$replyContent = $_POST['content'];
$replyName = $_COOKIE['name'];
$replyParent = $_POST['pa'];
$menuID = $_POST['menuID'];
$replyContent =trim($replyContent);
		if( $replyContent==NULL ){ 
		echo "<script> alert('Sorry, input is null!');location.href ='reply.php?menuID=$menuID';</script>";
		}
		else{	
	
		//$redis = new Redis();
		//$redis->connect("127.0.0.1","6379");// 增加留言数，为排名做准备

		//$num = $redis->incr("$name:messagenum");
		//$redis->zAdd('rank', "$num", "$name");

		date_default_timezone_set('prc');
		$time = date('y-m-d/H:i:s',time());

		$sql = "insert into bbs(name,time,content,parent) values ('$replyName','$time','$replyContent','$replyParent')";
		mysql_query($sql,$q);

		echo "<script>location.href= 'contentSc.php?id=$replyParent&menuID=$menuID'; </script>";
        }


?>