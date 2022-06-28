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

$sql_count="select count(*) cnt from course WHERE course_name like '%".$uname."%'";
$result_count=mysqli_query($conn,$sql_count);
$row_count=mysqli_fetch_array($result_count);
$pcount= ceil(intval($row_count["cnt"])/$psize);

$begin=$pindex*$psize;
$sql=" SELECT `course_id`, `course_name`, `course_period`, `course_credit` ";
$sql.=" FROM course ";
$sql.=" WHERE course_name like '%".$uname."%'";
$sql.=" limit $begin,$psize";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$tab="<table aling='center' border='1' width='730'>";
$tab.="<tr><th>编号</th><th>名称</th><th>学期</th><th>学分</th><th>&nbsp;</th></tr>";
while($row){
    $tab.="<tr><td>".$row["course_id"]."</td><td>".$row["course_name"]."</td><td>".$row["course_period"];
    $tab.="</td><td>".$row["course_credit"];
    $tab.="</td><td>";
    $tab.="<div class='divOper'>";
    $tab.="<a class='btn btn-sm btn-primary' href='course_update.php?course_id=".$row["course_id"]."'>修改</a>&nbsp;&nbsp; ";       
    $tab.="<a class='btn btn-sm btn-danger' href='javascript:del(".$row["course_id"].")'>删除</a>";
    $tab.="</div>";
    $tab.="</td></tr>";

    $row=mysqli_fetch_array($result);
    } 
    $tab.="</table>";
    mysqli_free_result($result);
    mysqli_close($conn);

    echo $pcount."#";
    echo $tab;
?>