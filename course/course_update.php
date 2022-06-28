<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生修改</title>
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
        </style>
<body>

 <?php
    
    $course_id=$_GET["course_id"];   //收到了tch_id，存在，

    include "../conn_db.php"; //调用Fun.php文件

    $sql="select * from course where course_id='".$course_id."'";

    $result=mysqli_query($conn,$sql);

    if($row=mysqli_fetch_array($result)){
?>
<form action="course_update_handler.php" method="post">
    <table width="500" border="1" height="400" align="center">
        <caption><h3>课程修改</h3></caption>
    <tr><td align="center">课程编号：</td>
        <td><input type="text" readonly name="course_id" value='<?php echo $course_id; ?>' ></td></tr>
    <tr><td align="center">课程名称：</td>
        <td><input type="text" name="course_name" value='<?php echo $row["course_name"]; ?>' ></td></tr>
    <tr><td align="center">学期：</td>
    <td>
           <select name="course_period" >
            <?php 
                $arrLevel=array("1","2");
                $current_level=$row["course_period"];
                for($i=0;$i<count($arrLevel);$i++){
                    if($current_level==$arrLevel[$i]){
                        echo "<option value='".$arrLevel[$i]."' selected>".$arrLevel[$i]."</option>";
                        continue;
                    }                    
                    echo "<option value='".$arrLevel[$i]."'>".$arrLevel[$i]."</option>";
                }
            ?>         
           </select> </td></tr>
        <tr><td align="center">学分：</td>
        <td>
           <select name="course_credit" >
            <?php 
                $arrLevel=array("2","4");
                $current_level=$row["course_credit"];
                for($i=0;$i<count($arrLevel);$i++){
                    if($current_level==$arrLevel[$i]){
                        echo "<option value='".$arrLevel[$i]."' selected>".$arrLevel[$i]."</option>";
                        continue;
                    }                    
                    echo "<option value='".$arrLevel[$i]."'>".$arrLevel[$i]."</option>";
                }
            ?>         
           </select>       
        </td></tr>
   
    <tr><td align="center" colspan="2">
        <input type="submit" value="保存">&nbsp;&nbsp;
        <input type="button" value="返回" onclick="location.href='course_info.html'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>