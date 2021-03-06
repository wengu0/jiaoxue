<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教师修改</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/info.css">
</head>


<body>
    <?php

    $tch_id = $_GET["tch_id"];   //收到了tch_id，存在，

    include "../conn_db.php"; //调用Fun.php文件

    $sql = "select * from teacher where tch_id='" . $tch_id . "'";

    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)) {
    ?>
        <form action="teacher_update_handler.php" method="post">
            <table width="500" border="1" height="400" align="center">
                <h3 align="center">教师修改</h3>
                <tr>
                    <td align="center">编号：</td>
                    <td><input type="text" readonly name="tch_id" value='<?php echo $tch_id; ?>'></td>
                </tr>
                <tr>
                    <td align="center">姓名：</td>
                    <td><input type="text" name="tch_name" value='<?php echo $row["tch_name"]; ?>'></td>
                </tr>
                <tr>
                    <td align="center">密码：</td>
                    <td><input type="text" name="tch_pwd" value='<?php echo $row["tch_pwd"]; ?>'></td>
                </tr>
                <tr>
                    <td align="center">职称：</td>
                    <td>
                        <select name="tch_level" class="btn btn-primary dropdown-toggle">
                            <?php
                            $arrLevel = array("助教", "讲师", "副教授", "教授");
                            $current_level = $row["tch_level"];
                            for ($i = 0; $i < count($arrLevel); $i++) {
                                if ($current_level == $arrLevel[$i]) {
                                    echo "<option value='" . $arrLevel[$i] . "' selected>" . $arrLevel[$i] . "</option>";
                                    continue;
                                }
                                echo "<option value='" . $arrLevel[$i] . "'>" . $arrLevel[$i] . "</option>";
                            }
                            ?>
                            <!--
                <option value="助教">助教</option>
                <option value="讲师" selected>讲师</option>
                <option value="副教授">副教授</option>
                <option value="教授">教授</option>     
            -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center">电话：</td>
                    <td><input type="text" name="tch_tel" value='<?php echo $row["tch_tel"]; ?>'></td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <input class="btn btn-sm btn-primary" type="submit" value="保存">&nbsp;&nbsp;
                        <input class="btn btn-sm btn-secondary" type="button" value="返回" onclick="location.href='teacher_info.html'">
                    </td>
                </tr>
            </table>
        </form>
    <?php }
    mysqli_close($conn);
    ?>
</body>

</html>