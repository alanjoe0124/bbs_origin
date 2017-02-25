<?php
//µÇÂ½ÑéÖ¤
include("config.php");
$postPSWord =trim($_POST['password']);
$postName = preg_replace('/\s/','',$_POST['name']);
$postName = strtolower($postName);
if( $postName==NULL || $postPSWord==NULL ){ 
	echo "<script> alert('Sorry, your name and password can not be null');location.href ='login.php';</script>;";
}else{
	if(!empty($postName) and !empty($postPSWord) ){
	$sql = "select * from member where name = '".$postName."' and password ='".$postPSWord."'";
	$result = mysql_query($sql,$q);
	$count = mysql_num_rows($result);
		if($count >0 ) {
		setCookie("name",$postName);
		echo "<script>location.href = 'index.php';</script>";
						}else{
							echo "<script> alert('Sorry, your name and password is wrong');location.href ='login.php';</script>;";
							}				
		}
	
}

?>