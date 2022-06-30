<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>课程修改</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/info.css">
</head>

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
        <h3 align="center">课程修改</h3>
    <tr><td align="center">课程编号：</td>
        <td><input type="text" readonly name="course_id" value='<?php echo $course_id; ?>' ></td></tr>
    <tr><td align="center">课程名称：</td>
        <td><input type="text" name="course_name" value='<?php echo $row["course_name"]; ?>' ></td></tr>
    <tr><td align="center">学期：</td>
    <td>
           <select name="course_period" class="btn btn-primary dropdown-toggle" >
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
           <select name="course_credit" class="btn btn-primary dropdown-toggle" >
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
        <input class="btn btn-sm btn-primary" type="submit" value="保存">&nbsp;&nbsp;
        <input class="btn btn-sm btn-secondary" type="button" value="返回" onclick="location.href='course_info.html'">
    </td></tr>
    </table>
</form>
<?php } 
 mysqli_close($conn);
?>
</body>
</html>