<?php
$uname="";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(isset($_GET["uname"])){
        $uname=$_GET["uname"];
    }
}
include "../conn_db.php"; //调用Fun.php文件
$sql=" SELECT `cls_id`, `cls_name`, `enrollment_year`, `specialty_name`, `cls_count` ";
$sql.=" FROM classes cc ";
$sql.=" WHERE cls_name like '%".$uname."%'";
$result=mysqli_query($conn,$sql);
$tab="<table aling='center' border='1' width='730'>";
$tab.="<tr><th>编号</th><th>名称</th><th>年份</th><th>专业</th><th>人数</th><th>&nbsp;</th></tr>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $tab.="<tr><td>".$row["cls_id"]."</td><td>".$row["cls_name"]."</td><td>".$row["enrollment_year"];
    $tab.="</td><td>".$row["specialty_name"]."</td><td>".$row["cls_count"];
    $tab.="</td><td>";
    $tab.="<div class='divOper'>";
    $tab.="<a href='classes_update.php?cls_id=".$row["cls_id"]."'>修改</a>&nbsp;&nbsp; ";       
    $tab.="<a href='classes_delete.php?cls_id=".$row["cls_id"]."'>删除</a>";
    $tab.="</div>";
    $tab.="</td></tr>";

    } 
    
    mysqli_close($conn);

    echo $tab;
?>