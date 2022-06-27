<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生信息页</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
</head>
<body>
    <?php 
    $uname='';
    if($_SERVER['REQUEST_METHOD']=="GET")
    {   if(isset($_GET["uname"])){
            $uname = $_GET["uname"];
       }
           
        include "../conn_db.php";
        $sql=" SELECT `stu_id`, `stu_name`, `stu_pwd`, `stu_tel`, `cls_name` ";
        $sql.=" FROM `student` ss,classes cc ";
        $sql.=" WHERE ss.cls_id=cc.cls_id ";
        $sql.=" and stu_name like '%".$uname."%'";
        // $sql = "select * from student where stu_name like '%".$uname."%'";
        $result=mysqli_query($conn,$sql);
        ?>
    <fieldset class="fset">
        
        <legend>查询</legend>
        <form action="student_info.php" method=""GET>
        姓名：<input type="text" name="uname" id="uname">
        <input class='btn btn-sm btn-primary' type="submit" value="查询">&nbsp;&nbsp;
        <input class='btn btn-sm btn-primary' type="button" value="新增" onclick="location.href='student_add.html'">
        </form>
    </fieldset>
    <br>
    <fieldset class="fset">
        <legend>结果</legend>
    <table aling="center" border="1" width="730">
        <tr>
            <th>学号</th>
            <th>姓名</th>
            <th>班级</th>
            <th>电话</th>
            <th>操作</th>
        </tr>
        <?php 
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            ?>
            <tr>
            <td><?php echo $row['stu_id'];?></td>
            <td><?php echo $row['stu_name'];?></td>
            <td><?php echo $row['cls_name'];?></td>
            <td><?php echo $row['stu_tel'];?></td>        
            <td>
            <a class='btn btn-sm btn-primary' href="student_update.php?stu_id=<?php echo $row["stu_id"]?>">修改</a>&nbsp;&nbsp;
            <a class='btn btn-sm btn-danger' href="javascript:del(<?php echo $row["stu_id"]?>)">删除</a>
        </td>
        </tr> 
        <?php 
        }
    }
    ?>
       
    </table>
    </fieldset>
    <script type="text/javascript">
            function del(id) {
                if (confirm("确定删除用户"+id+"吗？")) {
                    window.location = "student_delete.php?stu_id=" + id;
                }
            }
    </script>
           
</body>
</html>