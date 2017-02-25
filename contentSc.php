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
div#content {background-color:#FEEEEE; height:480px; width:1000px; float:left;} 
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
<td><h2><a href ="post.php?menuID=<?php echo $_GET['menuID'] ?>">发帖</a></h2></td>
<?php }else{}?>


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

<div id="content">
<h2>Content</h2>
<table width="700" height="70" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC"> 
<tr> 
<th width="80" height="38" bgcolor="#E3E3E3" scope="col">Name</th> 
<th width="100" height="38" bgcolor="#E3E3E3" scope="col">Time</th>
<th width="500" bgcolor="#E3E3E3" scope="col">文章标题</th> 
</tr> 
<?php 
$link=MySQL_connect('127.0.0.1','alan','secret'); 
mysql_select_db('test',$link); 
$id =$_GET['id'];
$sql="select * from bbs where id=".$id; 
$res=mysql_query($sql,$link); 
while ($row=mysql_fetch_array($res)) { 
?> 
<tr> 
<td bgcolor="#E0EEE" height="25px" width="80px"><div align="center"> 
<?php echo $row['name']?> 
</div></td> 
<td bgcolor="#E0EEE" height="25px" width ="100px"><div align="center"> 
<?php echo $row['time']?> 
</div></td>
<td bgcolor="#E0EEE" width="500px"><div align="center"> 
<?php echo $row['title']?> 
</div></td> 
</tr> 
<tr>
<td colspan="3" bgcolor="#E0EEE0" height="100px" ><div align="center">
<?php echo $row['content'];} ?>
</div></td>
</tr>
</table> 


<h2>评论</h2>

<a href ="reply.php?id=<?php echo $id?>&menuID=<?php echo $menuID?>">发表评论</a>  


<table width="700" height="70" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC"> 
<tr> 
<th width="80" height="38" bgcolor="#E3E3E3" scope="col">Name</th> 
<th width="100" height="38" bgcolor="#E3E3E3" scope="col">Time</th>
<th width="500" bgcolor="#E3E3E3" scope="col">评论</th> 
</tr> 

<?php 
$Page_size=1; //每页显示多少行
$sl = "select * from bbs where parent=".$id;
$result=mysql_query($sl); 
$count = mysql_num_rows($result); 
$page_count = ceil($count/$Page_size); 

$init=1; 
       
$max_p=$page_count; 
$pages=$page_count; 
$page=empty($_GET['page'])?1:$_GET['page']; //当前页数
$offset=$Page_size*($page-1); //当前页的起始索引号 与 $page有联系
$parent = $id;
$sql="select * from bbs "."where parent=".$parent." order by time desc limit $offset,$Page_size"; 
$res=mysql_query($sql,$link); 
while ($row=mysql_fetch_array($res)) { 
?> 
<tr> 
<td bgcolor="#E0EEE" height="25px" width="80px"><div align="center"> 
<?php echo $row['name']?> 
</div></td> 
<td bgcolor="#E0EEE" height="25px" width ="100px"><div align="center"> 
<?php echo $row['time']?> 
</div></td>
<td bgcolor="#E0EEE" width="500px"><div align="center"> 
<?php echo "评论"; ?>
</div></td> 
</tr> 
<tr>
<td colspan="3" bgcolor="#E0EEE0" height="100px" ><div align="center">
<?php echo $row['content']?>
</div></td>
</tr>
<?php
}

$key='<div class="page">'; 
$key.="<span>$page/$pages</span> "; //第几页,共几页 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?menuID={$menuID}&page=1"."&id=".$id."\">第一页</a> "; //第一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?menuID={$menuID}&page=".($page-1)."&id=".$id."\">上一页</a>"; //上一页 
}else { 
$key.="第一页 ";//第一页 
$key.="上一页"; //上一页 
} 
 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <span id = "page">'.$i.'</span>'; //当输出当前页时，在当前页数上加下划线，<span>用于小模块的样式内联到html中，<div>
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?menuID={$menuID}&page=".$i."&id=".$id."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?menuID={$menuID}&page=".($page+1)."&id=".$id."\">下一页</a> ";//下一页 <a href = "contentSC.php?page=newpage">下页</a>
$key.="<a href=\"".$_SERVER['PHP_SELF']."?menuID={$menuID}&page=".$pages."&id=".$id."\">最后一页</a>"; //最后一页 
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