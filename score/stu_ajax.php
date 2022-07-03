<?php
include "../conn_db.php"; //调用Fun.php文件

$cls_id = 1;
if (isset($_GET["cls_id"])) {
    $cls_id = $_GET["cls_id"];
}

$stu_sql = "select stu_id,stu_name from student where cls_id=" . $cls_id;

$stu_result = mysqli_query($conn, $stu_sql);

$arrLevel = array();

while ($stu_row = mysqli_fetch_array($stu_result)) {
    $arrLevel[$stu_row["stu_id"]] = $stu_row["stu_name"];
}

$str_json = json_encode($arrLevel, JSON_UNESCAPED_UNICODE); //json字符串
echo $str_json;

mysqli_close($conn);
