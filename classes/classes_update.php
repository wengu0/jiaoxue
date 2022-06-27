<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>课程修改</title>
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
    
    $cls_id=$_GET["cls_id"];   //收到了tch_id，存在，

    include "../conn_db.php"; //调用Fun.php文件

    $sql="select * from classes where cls_id='".$cls_id."'";

    $result=mysqli_query($conn,$sql);

    if($row=mysqli_fetch_array($result)){
?>
<form action="classes_update_handler.php" method="post">
    <table width="500" border="1" height="400" align="center">
        <caption><h3>教师新增</h3></caption>
    <tr><td align="center">编号：</td>
        <td><input type="text" readonly name="cls_id" value='<?php echo $cls_id; ?>' ></td></tr>
    <tr><td align="center">姓名：</td>
        <td><input type="text" name="cls_name" value='<?php echo $row["cls_name"]; ?>' ></td></tr>
    <tr><td align="center">密码：</td>
        <td><input type="text" name="cls_count" value='<?php echo $row["cls_count"]; ?>' ></td></tr>
        <tr><td align="center">班级：</td>
        <td>
           <select name="enrollment_year" >
            <?php 
                $arrLevel=array("2019","2020","2021","2022");
                $current_level=$row["enrollment_year"];
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
    <tr><td align="center">专业名称：</td>
        <td><input type="text" name="specialty_name" value='<?php echo $row["specialty_name"]; ?>' ></td></tr>
    <tr><td align="center" colspan="2">
        <input type="submit" value="保存">&nbsp;&nbsp;
        <input type="button" value="返回" onclick="location.href='classes_info.php'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>