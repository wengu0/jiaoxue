<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改密码</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/info.css">
</head>
<?php 
	      session_start();
          $role=$uname="";
          if(isset($_SESSION["role"])&&$_SESSION["uname"])
          {
		        $role=$_SESSION["role"];          
                $uname=trim($_SESSION["uname"]);//获取用户名
                $pwd = $_SESSION["pwd"];
          }
          else{
            echo "<script>alert('用户登录过期，请重新登录!');location.href='login.html';</script>";
          }

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $new_pwd=trim($_POST["new_pwd"]); //密码
            $comfirm_pwd=trim($_POST["comfirm_pwd"]); //密码
   
            if($new_pwd!=$comfirm_pwd){
                echo "<script>alert('两次密码输入不一致，请重新输入!');location.href='update_pwd.php';</script>";
                return;
            }
            
            else{   
                include "conn_db.php"; //调用Fun.php文件
                
                $role=trim($_POST["role"]);//获取用户名
                $uname=trim($_POST["uname"]);//获取用户名
                $old_pwd=trim($_POST["old_pwd"]); //密码   
                if($old_pwd!=$pwd){
                    echo "<script>alert('旧密码输入错误，请重新输入!');location.href='update_pwd.php';</script>";
                    return;
                }
                else{
                    $sql="";
                switch($role){
                    case 1:$sql= "update admin set admin_pwd='$new_pwd' where admin_id='$uname' and admin_pwd='$old_pwd'";break;
                    case 2:$sql= "update teacher set tch_pwd='$new_pwd' where tch_name='$uname' and tch_pwd='$old_pwd'";break;
                    case 3:$sql= "update student set stu_pwd='$new_pwd' where stu_name='$uname' and stu_pwd='$old_pwd'";break;
                }
                $result=mysqli_query($conn,$sql);				 
                
                if($result>0)  
                {		 	
                   echo "<script>alert('修改成功，需重新登录!');top.location.href='login.html';</script>";
                }
                else
                {
                    echo "<script>alert('修改失败!');location.href='upate_pwd.php';</script>"; 
                } 
	            mysqli_close($conn);
                }
                
	        } 
        }   
	?>
<body>
    <form action="update_pwd.php" method="post">
        <table width="500" border="1" height="300" align="center">
            <h3 align="center">修改密码</h3>
            <tr><td>用户名:</td><td><input type="text" name="uname" readonly value='<?php echo $uname; ?>'>
                <input type="hidden" name="role" value='<?php echo $role; ?>'></td></tr>
            <tr><td>原密码:</td><td><input type="text" name="old_pwd"></input></td></tr>
            <tr><td>新密码:</td><td><input type="text" name="new_pwd"></input></td></tr>
            <tr><td>确认密码:</td><td><input type="text" name="comfirm_pwd"></input></td></tr>
            <tr><td></td><td id="td1"><input class="btn btn-sm btn-success" type="submit"></input>&nbsp;&nbsp;&nbsp;<input class="btn btn-sm btn-secondary" type="button" value="返回" onclick="top.location.href='index.php'"></input></td></tr>
        </table>
    </form>
</body>
</html>