<?php
//连接数据库
error_reporting(E_ALL ^ E_DEPRECATED);              //错误控制
header("Content-type:text/html;charset=utf-8");     //客户端发送原始的 HTTP 报	
$conn=mysqli_connect('localhost','root','','jiaoxue');         //连接MySQL服务器         //选择数据库	
$conn->set_charset("utf8");                    //设置字符集为utf8 
?>