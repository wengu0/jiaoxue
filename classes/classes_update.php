<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>班级修改</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/info.css">
</head>

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
        <h3 align="center">班级修改</h3>
    <tr><td align="center">编号：</td>
        <td><input type="text" readonly name="cls_id" value='<?php echo $cls_id; ?>' ></td></tr>
    <tr><td align="center">名称：</td>
        <td><input type="text" name="cls_name" value='<?php echo $row["cls_name"]; ?>' ></td></tr>
    <tr><td align="center">入学时间：</td>
        <td><input type="text" name="cls_count" value='<?php echo $row["cls_count"]; ?>' ></td></tr>
        <tr><td align="center">班级：</td>
        <td>
           <select name="enrollment_year" class="btn btn-primary dropdown-toggle" >
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
        <input class="btn btn-sm btn-primary" type="submit" value="保存">&nbsp;&nbsp;
        <input class="btn btn-sm btn-secondary" type="button" value="返回" onclick="location.href='classes_info.html'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>