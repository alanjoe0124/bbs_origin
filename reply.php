<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>php make page list</title> 
<style type="text/css">
div#container{ width:1340px;height:550px;margin:0px;}
div#header {background-color:#99bbbb; height:80px;}
div#menu {background-color:#ffff99; height:480px; width:120px; float:left;}
div#friends {background-color:#EEEEEE;  height:480px; width:100px; float:left; }
div#title {background-color:#FEEEEE; height:480px; width:1000px; float:left;}
div#rank {background-color:#ffff99;  height:480px;width:120px; float:left;}
div#footer {background-color:#99bbbb;clear:both; text-align:center;height:40px;}
h1 {margin-bottom:7;}
h2 {margin-bottom:0; font-size:20px;}
ul {margin:0;}
li {list-style:none;}

<!-- 
.page a:link { 
color: #0000FF; 
text-decoration: none; 
} 
.page a:visited { 
text-decoration: none; 
color: #0000FF; 
} 
.page a:hover { 
text-decoration: none; 
color: #0000FF; 
} 
.page a:active { 
text-decoration: none; 
color: #0000FF; 
} 
.page{color:#0000FF;} 
--> 
</style>
</head>

<body>

<div id="container">

<div id="header">
<table >
<tr>
<td width="80px"><h1><a href ="index.php">BBS</a></h1></td>
<?php if ( $_COOKIE['name'] !="") { 
	$username = $_COOKIE['name'];
	?>
<td width="60px"><h2><?php echo "$username";?></h2></td>
<td width="60px"><h2><a href ="logout.php">退出</a></h2></td>
<?php }else{?>
<td><h2><a href ="login.php">登陆</a></h2></td>
<td><h2><a href ="register.php">注册</a></h2></td>
<?php }?>
<!--<td><h2><a href ="post.php?menuID=<?php echo $_GET['menuID'] ?>">发帖</a></h2></td>-->
</tr>
</table>
</div>

<div id="menu">
<h2>Menu</h2>
<ul>
<?php   
include("config.php");  
$menuID=$_GET['menuID'];
$sql="select * from menu where id=".$menuID; 
$result=mysql_query($sql,$q); 
while ($row=mysql_fetch_array($result)) { 

?>
<li><a href = "index.php?menuID=<?php echo $row['id']?>"><?php echo $row['subject']?></a></li>
<?php } ?>
</ul>
</div>

<div id="friends">
</div>

<div id="title">
<h2>评论</h2>
<?php $id=$_GET['id'];

?>
<a href ="contentSc.php?id=<?php echo $id?>&menuID=<?php echo $menuID ?>">返回</a>
<table align = "center" width = "678" >
<tr>
<td>
<form name = "reply" method = "post" action = "replyhandle.php">

<p>
内容：
</p>

<p>
<textarea name = "content" id = "content" cols = "45" rows = "5"> </textarea>
</p>
<input type ="hidden" name="pa" value="<?php echo $id ?>">
<input type ="hidden" name="menuID" value="<?php echo $_GET['menuID'] ?>">
<p>
<input type = "submit" name = "button" id = "button" value = "提交">
<input type = "reset" name = "button2" id = "button2" value = "重置">
</p>
</form>
</td>
</tr>
</table>

</div>

<div id="rank">

</div>

<div id="footer">Copyright W3School.com.cn</div>

</div>

</body>
</html>