<?php
$pindex=0;   //页数
$psize=5;    //页笔数

$course_name="";
$cls_name="";
$stu_name="";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(isset($_GET["course_name"])){
        $course_name=$_GET["course_name"];
    }
    if(isset($_GET["cls_name"])){
        $cls_name=$_GET["cls_name"];
    }
    if(isset($_GET["stu_name"])){
        $stu_name=$_GET["stu_name"];
    }

    if(isset($_GET["pindex"])){
        $pindex=$_GET["pindex"];
    }  
}
include "../conn_db.php"; //调用Fun.php文件

$sql_count="select count(*) cnt ";
$sql_count.="FROM `score` sc,student ss,course cc,classes cls ";
$sql_count.="WHERE sc.stu_id=ss.stu_id and sc.course_id=cc.course_id and ss.cls_id=cls.cls_id ";
$sql_count.="and course_name like '%".$course_name."%'";
$sql_count.="and cls_name like '%".$cls_name."%'";
$sql_count.="and stu_name like '%".$stu_name."%'";

$result_count=mysqli_query($conn,$sql_count);
$row_count=mysqli_fetch_array($result_count);
$pcount= ceil(intval($row_count["cnt"])/$psize);

$begin=$pindex*$psize;
$sql=" SELECT score_id, stu_name, course_name, score_val ,cls_name ";
$sql.="FROM `score` sc,student ss,course cc,classes cls ";
$sql.="WHERE sc.stu_id=ss.stu_id and sc.course_id=cc.course_id and ss.cls_id=cls.cls_id ";
$sql.="and course_name like '%".$course_name."%'";
$sql.="and cls_name like '%".$cls_name."%'";
$sql.="and stu_name like '%".$stu_name."%'";

$sql.=" limit $begin,$psize";
//print_r($sql);
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$tab="<table aling='center' border='1' width='730'>";
$tab.="<tr><th>编号</th><th>学生</th><th>课程</th><th>分数</th><th>班级</th><th>操作</th></tr>";
while($row){
    $tab.="<tr><td>".$row["score_id"]."</td><td>".$row["stu_name"]."</td><td>".$row["course_name"];
    $tab.="</td><td>".$row["score_val"]."</td><td>".$row["cls_name"];
    $tab.="</td><td>";
    $tab.="<div class='divOper'>";
    $tab.="<a class='btn btn-sm btn-primary' href='score_update.php?score_id=".$row["score_id"]."'>修改</a>&nbsp;&nbsp; ";       
    $tab.="<a class='btn btn-sm btn-danger' href='javascript:del(".$row["score_id"].")'>删除</a>";
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