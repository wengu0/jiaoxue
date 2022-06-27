<?php
include "../conn_db.php"; //调用Fun.php文件

$cls_sql="select cls_id,cls_name from classes";

$cls_result=mysqli_query($conn,$cls_sql);

$arrLevel=array();

while($cls_row=mysqli_fetch_array($cls_result,MYSQLI_ASSOC)){
    $arrLevel[$cls_row["cls_id"]]=$cls_row["cls_name"];           
}       

$str_json=json_encode($arrLevel,JSON_UNESCAPED_UNICODE); //json字符串
echo $str_json;

mysqli_close($conn);
?>