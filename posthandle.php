<?php

//���������Ϣ
//header("charset = utf-8");  //���ڵ�½�����POST������û����������֤cookie
include("config.php");

$PT= $_POST['title'];
$menuID=$_POST['menuID'];
$postTitle =trim($PT);
$postContent =$_POST['content'];
$postContent =trim($postContent);
$postName = $_COOKIE['name'];


		if( $postTitle==NULL || $postContent==NULL ){ 
		echo "<script> alert('Sorry, the information you submitted is not complete!');location.href ='post.php?menuID=$menuID';</script>;";
		}
		else {	
	
		$redis = new Redis();
		$redis->connect("127.0.0.1","6379");// ������������Ϊ������׼��
      
		$num = $redis->incr("$postName:messagenum");
		$redis->zAdd('rank', "$num", "$postName");

		date_default_timezone_set('prc');
		$time = date('y-m-d/H:i:s',time());

		$sql = "insert into bbs(name,time,title,content,menu) values ('$postName','$time','$postTitle','$postContent','$menuID')";
		mysql_query($sql,$q);
		
		$sq="select * from menu where id=".$menuID; 
        $result=mysql_query($sq,$q); 
        while ($row=mysql_fetch_array($result)) { 
         $MENUpostnum = $row['postnum'];
		}
        $MENUpostnum = $MENUpostnum+1;
		$slq ="update menu set postnum=".$MENUpostnum." where id=".$menuID;
		mysql_query($slq,$q);  //����menu����Ӧ������Ŀ���Ե��ܷ�����Ŀ

		echo "<script>location.href= 'index.php?menuID=$menuID'; </script>";
        }


?>