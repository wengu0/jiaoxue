<?php
session_start();       //启动会话
		
include "../conn_db.php"; //调用Fun.php文件
$course_id = $_GET['course_id'];
//删除指定数据  
//编写删除sql语句
$sql = "DELETE FROM course WHERE course_id={$course_id}";
//执行查询操作、处理结果集
$result = mysqli_query($conn, $sql);
if (!$result) {
    exit('sql语句执行失败。');  // 获取错误信息
}

// 删除完跳转到首页
header("Location:course_info.php");
?>