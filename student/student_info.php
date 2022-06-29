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

$sql_count="select count(*) cnt from student WHERE stu_name like '%".$uname."%'";
$result_count=mysqli_query($conn,$sql_count);
$row_count=mysqli_fetch_array($result_count);
$pcount= ceil(intval($row_count["cnt"])/$psize);

$begin=$pindex*$psize;
$sql=" SELECT `stu_id`, `stu_name`, `stu_tel`,`cls_name` ";
$sql.=" FROM student,classes ";
$sql.=" WHERE stu_name like '%".$uname."%'";
$sql.=" and classes.cls_id=student.cls_id";
$sql.=" limit $begin,$psize";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$tab="<table aling='center' border='1' width='730'>";
$tab.="<tr><th>编号</th><th>姓名</th><th>班级</th><th>电话</th><th>操作</th></tr>";
while($row){
    $tab.="<tr><td>".$row["stu_id"]."</td><td>".$row["stu_name"]."</td><td>".$row["cls_name"];
    $tab.="</td><td>".$row["stu_tel"];
    $tab.="</td><td>";
    $tab.="<div class='divOper'>";
    $tab.="<a class='btn btn-sm btn-primary' href='student_update.php?stu_id=".$row["stu_id"]."'>修改</a>&nbsp;&nbsp; ";       
    $tab.="<a class='btn btn-sm btn-danger' href='javascript:del(".$row["stu_id"].")'>删除</a>";
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