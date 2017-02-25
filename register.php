<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>BBS</title> 
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
<td><h1><a href ="index.php">BBS</a></h1></td>

<td><h2><a href ="login.php">登陆</a></h2></td>
<td><h2><a href ="register.php">注册</a></h2></td>

</tr>
</table>
</div>

<div id="menu">

</div>

<div id="friends">

</div>

<div id="title">
<h2>Register</h2>


<table align = "center" width = "678" >
<tr>
<td>
<form name = "zhuce" method = "post" action = "register_ok.php">
<p>
Name:
<input name = "name" type = "text" id = "name">
</p>

<p>password: <input name = "password" type = "password" id = "password"> </p>
<p>Email: <input name = "email" type = "text" id = "email"> </p>


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

<div id="footer">Copyright </div>

</div>

</body>
</html>