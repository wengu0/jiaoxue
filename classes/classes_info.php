<?php
$pindex=0;   //页数
$psize=5;    //页笔数
$uname="";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(isset($_GET["uname"])){
        $uname=$_GET["uname"];
    }
    if(isset($_GET["pindex"])){
        $pindex=$_GET["pindex"];
    }  
}
include "../conn_db.php"; //调用Fun.php文件

$sql_count="select count(*) cnt from classes WHERE cls_name like '%".$uname."%'";
$result_count=mysqli_query($conn,$sql_count);
$row_count=mysqli_fetch_array($result_count);
$pcount= ceil(intval($row_count["cnt"])/$psize);

$begin=$pindex*$psize;
$sql=" SELECT `cls_id`, `cls_name`, `cls_count`, `enrollment_year`,`specialty_name` ";
$sql.=" FROM classes ";
$sql.=" WHERE cls_name like '%".$uname."%'";
$sql.=" limit $begin,$psize";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$tab="<table aling='center' border='1' width='730'>";
$tab.="<tr><th>编号</th><th>名称</th><th>人数</th><th>入学年份</th><th>专业名称</th><th>操作</th></tr>";
while($row){
    $tab.="<tr><td>".$row["cls_id"]."</td><td>".$row["cls_name"]."</td><td>".$row["cls_count"]."</td><td>".$row["enrollment_year"];
    $tab.="</td><td>".$row["specialty_name"];
    $tab.="</td><td>";
    $tab.="<div class='divOper'>";
    $tab.="<a class='btn btn-sm btn-primary' href='classes_update.php?cls_id=".$row["cls_id"]."'>修改</a>&nbsp;&nbsp; ";       
    $tab.="<a class='btn btn-sm btn-danger' href='javascript:del(".$row["cls_id"].")'>删除</a>";
    $tab.="</div>";
    $tab.="</td></tr>";

    $row=mysqli_fetch_array($result);
    } 
    $tab.="</table>";
    mysqli_free_result($result);
    mysqli_close($conn);

    echo $pcount."#";
    echo $tab;
