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
span#page{text-decoration:underline;}
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
<?php }
 if ( $_COOKIE['name'] !="") {?>
<td><h2><a href ="post.php">发帖</a></h2></td>
<?php }else{}?>


</tr>
</table>
</div>

<div id="menu">
<h2>Menu</h2>
<ul>
<li><a href = "index.php">科技</a></li>
<li><a href = "life.php">生活</a></li>
</ul>
</div>

<div id="friends">

</div>

<div id="title">
<h2>Title</h2>

<table width="700" height="103" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC"> 
<tr> 
<th width="80" height="38" bgcolor="#E3E3E3" scope="col">Name</th> 
<th width="100" height="38" bgcolor="#E3E3E3" scope="col">Time</th>
<th width="500" bgcolor="#E3E3E3" scope="col">文章标题</th> 
</tr> 
<?php 
$link=MySQL_connect('localhost','alan','secret'); 
mysql_select_db('test',$link); 


$Page_size=3; //每页显示多少行
$result=mysql_query("select * from bbs where menu='lf'"); 
$count = mysql_num_rows($result);
$page_count = ceil($count/$Page_size); 

$init=1; 
       
$max_p=$page_count; 
$pages=$page_count; 

//判断当前页码 
//if(empty($_GET['page'])||$_GET['page']<0){ 
//$page=1; 
//}else { 
//$page=$_GET['page']; 
//} 
 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数


$offset=$Page_size*($page-1); //当前页的起始索引号 与 $page有联系
$sql="select * from bbs where menu='lf' order by time desc limit $offset,$Page_size "; 
$result=mysql_query($sql,$link); 
while ($row=mysql_fetch_array($result)) { 
?> 
<tr> 
<td bgcolor="#E0EEE0" height="25px"><div align="center"> 
<?php echo $row['name']?> 
</div></td> 
<td bgcolor="#E0EEE0" height="25px" width ="45px"><div align="center"> 
<?php echo $row['time']?> 
</div></td>
<td bgcolor="#E0EEE0"><div align="center"> 
<a href ="contentSc.php?id=<?php echo $row['id'];?>">     
<?php echo $row['title']?> 
</a>
</div></td> 
</tr> 
<?php 
} 

$key='<div class="page">'; 
$key.="<span>$page/$pages</span> "; //第几页,共几页 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a> "; //第一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a>"; //上一页 
}else { 
$key.="第一页 ";//第一页 
$key.="上一页"; //上一页 
} 
 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <span id = "page">'.$i.'</span>'; //当输出当前页时，在当前页数上加下划线，<span>用于小模块的样式内联到html中，<div>
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a> ";//下一页 <a href = "index.php?page=newpage">下页</a>
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a>"; //最后一页 
}else { 
$key.="下一页 ";//下一页 
$key.="最后一页"; //最后一页 
} 
$key.='</div>'; 
?> 
<tr> 
<td colspan="3" bgcolor="#E0EEE0"><div align="center"><?php echo $key?></div></td> 
</tr> 
</table> 
</div>

<div id="rank">

</div>

<div id="footer">Copyright </div>

</div>

</body>
</html>