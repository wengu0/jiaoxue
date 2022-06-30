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
    
    $stu_id=$_GET["stu_id"];   //收到了tch_id，存在，

    include "../conn_db.php"; //调用Fun.php文件
    
     //----------班级表的操作-----------------
     $cls_sql="select cls_id,cls_name from classes";

     $cls_result=mysqli_query($conn,$cls_sql);

     $arrLevel=array();
    
     while($cls_row=mysqli_fetch_array($cls_result)){
         $arrLevel[$cls_row["cls_id"]]=$cls_row["cls_name"];           
     }       
    $sql="select * from student where stu_id='".$stu_id."'";

    $result=mysqli_query($conn,$sql);

    if($row=mysqli_fetch_array($result)){
?>
<form action="student_update_handler.php" method="post">
    <table width="500" border="1" height="400" align="center">
        <h3 align="center">学生修改</h3>
    <tr><td align="center">编号：</td>
        <td><input type="text" readonly name="stu_id" value='<?php echo $stu_id; ?>' ></td></tr>
    <tr><td align="center">姓名：</td>
        <td><input type="text" name="stu_name" value='<?php echo $row["stu_name"]; ?>' ></td></tr>
    <tr><td align="center">密码：</td>
        <td><input type="text" name="stu_pwd" value='<?php echo $row["stu_pwd"]; ?>' ></td></tr>
        <tr><td align="center">班级：</td>
        <td>
        <select name="cls_id" class="btn btn-primary dropdown-toggle" >
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
    <tr><td align="center">电话：</td>
        <td><input type="text" name="stu_tel" value='<?php echo $row["stu_tel"]; ?>' ></td></tr>
    <tr><td align="center" colspan="2">
        <input type="submit" value="保存">&nbsp;&nbsp;
        <input type="button" value="返回" onclick="location.href='student_info.html'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>