<?php
if($_COOKIE['name']!=""){

	setCookie("name","",time()-1);
	echo "<script>location.href='index.php';</script>";
}else{}
?>