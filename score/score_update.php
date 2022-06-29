<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生修改</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<style>
        tr:nth-child(odd){
            background-color:#4bb8ee; 
        }
        tr:nth-child(even){
            background-color:rgb(108, 246, 244);
        }
        .fset{
            width:750px;
            margin:0px auto;            
        }
        td{
            text-align: center;
        }
        th{
            text-align: center;
        }
        input{
    background-color:rgb(108, 246, 244);
 }
        </style>
<body>

 <?php
    
    $score_id=$_GET["score_id"];   //收到了tch_id，存在，

    include "../conn_db.php"; //调用Fun.php文件
    
     //----------班级表的操作-----------------
     $c_sql="select classes.cls_id,cls_name,course_id,course_name,student.stu_id,student.stu_name from classes,course,student";

     $c_result=mysqli_query($conn,$c_sql);

     $arrLevel=array();
    
     while($c_row=mysqli_fetch_array($c_result)){
         $arrLevel[$c_row["cls_id"]]=$c_row["cls_name"];
         $arrLevel2[$c_row["course_id"]]=$c_row["course_name"];
         $arrLevel3[$c_row["stu_id"]]=$c_row["stu_name"]; 
     }       
    $sql="select student.stu_id,stu_name,course_id,cls_id,score_val ";
    $sql.="from score,student ";
    $sql.="where score_id='".$score_id."'";
    $sql.= "and score.stu_id = student.stu_id  ";
    $result=mysqli_query($conn,$sql);

    if($row=mysqli_fetch_array($result)){
?>
<form action="score_update_handler.php" method="post">
    <table width="500" border="1" height="400" align="center">
        <h3 align="center">学生修改</h3>
        <input type="text" hidden="true" name="stu_id" value='<?php echo $row["stu_id"];?>'>
    <tr><td align="center">编号：</td>
        <td><input type="text" readonly name="score_id" value='<?php echo $score_id; ?>' ></td></tr>
        <tr><td align="center">班级：</td>
        <td>
        <select name="cls_id">
            <?php 
                
                $cls_id=$row["cls_id"];
                foreach($arrLevel as $key=>$val){
                    if($cls_id==$key){                   
                        echo "<option value='".$key."' selected>".$val."</option>";
                        continue;
                    } 
                    echo "<option value='".$key."'>".$val."</option>";
                }               
            ?>
           </select>       
        </td></tr>
    <tr><td align="center">姓名：</td>
        <td> <select name="stu_id" >
            <?php 
                
                $stu_id=$row["stu_id"];
                foreach($arrLevel3 as $key=>$val){
                    if($stu_id==$key){                   
                        echo "<option value='".$key."' selected>".$val."</option>";
                        continue;
                    } 
                    echo "<option value='".$key."'>".$val."</option>";
                }               
            ?>
           </select>       </td></tr>
    <tr><td align="center">课程：</td>
    <td>
    <select name="course_id" >
            <?php 
                
                $course_id=$row["course_id"];
                foreach($arrLevel2 as $key=>$val){
                    if($course_id==$key){                   
                        echo "<option value='".$key."' selected>".$val."</option>";
                        continue;
                    } 
                    echo "<option value='".$key."'>".$val."</option>";
                }               
            ?>
           </select>       
        </td></tr>
       
    <tr><td align="center">分数：</td>
        <td><input type="text" name="score_val" value='<?php echo $row["score_val"]; ?>' ></td></tr>
        
    <tr><td align="center" colspan="2">
        <input type="submit" value="保存">&nbsp;&nbsp;
        <input type="button" value="返回" onclick="location.href='score_info.html'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>