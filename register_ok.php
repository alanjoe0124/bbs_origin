<?php
//ע����֤
include("config.php");
$RegisterName = preg_replace('/\s/','',$_POST['name']); //ɾ���ַ����еĿո�
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
					setCookie("name",$RegisterName);     //ʹ��cookie������name
				    $redis = new Redis();                //ʹ��redis�洢set  �û���-�����ַ
					$redis->connect("127.0.0.1","6379");
		
                    $redis->zAdd('rank', 0, "$RegisterName");
                    $redis->set("$RegisterName:messagenum",'0'); // ���������У�ͬʱ������������
	//				var_dump($redis->zRange('rank',0,-1));


					echo "<script> alert('register success.');location.href = 'index.php';</script>";
				}
}


?>