<?php
//Wordpress 删除重复文章
//删重程序，重复刷新删重，直至提示“恭喜，没有重复记录！！”。
header('content-type:text/html;charset=utf-8');
require 'wp-config.php';
$conn=@new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$sql="select ID from wp_posts where post_type='post' group by post_title having count(post_title)>1";
$res=$conn->query($sql);
while($row=$res->fetch_assoc()){
	$rows[]=$row;
}
if(count($rows)==0){
	echo "恭喜，没有重复记录！！";
	exit();
}
foreach($rows as $v){
	$id.=$v['ID'].",";
}
$id=rtrim($id,",");
$del="delete from wp_posts where ID in (".$id.")";
$resdel=$conn->query($del);

echo "<br/>删除".$conn->affected_rows."条记录";
