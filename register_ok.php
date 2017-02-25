<?php
//注册验证
include("config.php");
$RegisterName = preg_replace('/\s/','',$_POST['name']); //删除字符串中的空格
$RegisterName = strtolower($RegisterName);
$RegisterPwd = preg_replace('/\s/','',$_POST['password']);
if( $RegisterName==NULL || $RegisterPwd==NULL || $_POST['email']==NULL){ 
	echo "<script> location.href ='register.php';</script>;";
}else{
	$sq = "select * from member where name = '".$RegisterName."'";
	$result = mysql_query($sq,$q);
	$count = mysql_num_rows($result);
		if($count >0 ) {
			echo "<script>alert('The name has been used.');location.href ='register.php';</script>";
			}else{
					$name = $RegisterName;
					$pwd= $RegisterPwd;
					$email = $_POST['email'];
					$sql = "insert into member(name, password, email) values ('$name','$pwd','$email')";
					mysql_query($sql,$q);
					setCookie("name",$RegisterName);     //使用cookie来传递name
				    $redis = new Redis();                //使用redis存储set  用户名-邮箱地址
					$redis->connect("127.0.0.1","6379");
		
                    $redis->zAdd('rank', 0, "$RegisterName");
                    $redis->set("$RegisterName:messagenum",'0'); // 加入排名中，同时将留言数置零
	//				var_dump($redis->zRange('rank',0,-1));


					echo "<script> alert('register success.');location.href = 'index.php';</script>";
				}
}


?>