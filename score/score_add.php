<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成绩新增</title>
    <script src="../js/axios.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/info.css">
</head>


<body>
<?php
include "../conn_db.php"; //调用Fun.php文件
//班级
$cls_sql="select cls_id,cls_name from classes";

$cls_result=mysqli_query($conn,$cls_sql);
//课程
$course_sql="select course_id,course_name from course";
$course_result=mysqli_query($conn,$course_sql);
?>
<form action="score_add_handler.php" method="post">
    <table width="500" border="1" height="400" align="center">
        <h3 align="center">成绩新增</h3>
        <tr><td align="center">班级：</td>
        <td>           
             <select name="cls_id" id="cls_id" onchange="get_stu()" class="btn btn-primary dropdown-toggle" >
             <?php
                while($cls_row=mysqli_fetch_array($cls_result)){
                ?>
                <option value='<?php echo $cls_row["cls_id"]; ?>'><?php echo $cls_row["cls_name"]; ?></option>
                <?php
                }              
                ?>
             </select>          
        </td></tr>
    <tr><td align="center">学生：</td>
        <td>
            <script>
                window.onload=function(){
                    get_stu();
                }
                async function get_stu(){
                    var cls_id=document.getElementById("cls_id").value;
                    var result=await axios.get("stu_ajax.php?cls_id="+cls_id);  //ajax异步操作

                    var list=eval(result.data);  //将json字符串转换为json对象模式                    
                    var option="";
                    for(var key in list){                   
                        option+="<option value='"+key+"'>"+list[key]+"</option>";
                    }
                    document.getElementById("stu_id").innerHTML=option;
                }
                
            </script>
            <select name="stu_id" id="stu_id" class="btn btn-primary dropdown-toggle">
                <!--<option value="1">1</option>
                <option value="2">2</option>-->
            </select>
        </td></tr>
    <tr><td align="center">课程：</td>
        <td><select name="course_id" id="course_id" class="btn btn-primary dropdown-toggle" >
             <?php
                while($course_row=mysqli_fetch_array($course_result)){
                ?>
                <option value='<?php echo $course_row["course_id"]; ?>'><?php echo $course_row["course_name"]; ?></option>
                <?php
                }
                mysqli_close($conn);
                ?>
             </select>   </td></tr>   
    <tr><td align="center">分数：</td>
        <td><input type="number" name="score_val" ></td></tr>
    
    <tr><td align="center" colspan="2">
        <input class="btn btn-sm btn-primary" type="submit" value="保存">&nbsp;&nbsp;
        <input class="btn btn-sm btn-secondary" type="button" value="返回" onclick="location.href='score_info.html'">
    </td></tr>
    </table>
</form>
</body>
</html>