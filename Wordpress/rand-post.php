<?php
//对文章发布顺序重新进行随机排序
header('content-type:text/html;charset=utf-8');
require 'wp-config.php';
$conn=@new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//$conn=@new mysqli("localhost","root","","wordpress");
if(!$conn){
	echo $conn->connect_error;
	exit();
}
$sql="SELECT ID FROM wp_posts";
$res=$conn->query($sql);
while($row=$res->fetch_row()){
	$rows[]=$row[0];
}
$ids=implode(',',array_values($rows));
$sql="update wp_posts set post_date= CASE ID ";
foreach($rows as $k=>$v){
	$now=date('y-m-d h:i:s',time());
	$date=rand_time("2016-03-10 00:00:00",$now); //随机获取2015-12-10 0点至当前系统时间的任意一个时间点
	$sql.="WHEN '$v' THEN '$date' ";
}
$sql.= "END";	//若11行加限制条件，改为 $sql.= "END where ID in ($ids)";
	$result=$conn->query($sql);
	if($result){
		$c=$conn->affected_rows;
	}else{
		echo "Error:".$conn->error."<br>";
		
	}
$sql="update wp_posts set post_date_gmt=post_date,post_modified=post_date,post_modified_gmt=post_date where ID in ($ids)";
$re=$conn->query($sql);
if(!re){
	echo $conn->error;
}

function rand_time($start_time,$end_time){

$start_time = strtotime($start_time);
$end_time = strtotime($end_time);
return date('Y-m-d H:i:s', mt_rand($start_time,$end_time));
}
echo "成功修改".$c."条。";
$conn->close();
