<?php
	// session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {
		 $role=$_POST["role"];          //获取用户类别
		 printf($role);
		 $uname=trim($_POST["uname"]);//获取用户名
		 $upwd=trim($_POST["upwd"]); //密码
		 $sql="";
		 switch($role){
			case 1:$sql= "select * from admin where admin_id='$uname' and admin_pwd='$upwd'";break;
			case 2:$sql= "select * from teacher where tch_name='$uname' and tch_pwd='$upwd'";break;
			case 3:$sql= "select * from student where stu_name='$uname' and stu_pwd='$upwd'";break;
		 }
        
		 $result=mysqli_query($conn,$sql);
		 if (!$result) {
			echo"<script>alert('登陆失败，用户名或密码错误');location='login.html'</script>";
		}
		//判断result里有没有查到数据
		if ($result->num_rows>0) {
			$_SESSION["role"]=$role;
			$_SESSION["uname"]=$uname;
			$_SESSION['pwd']=$upwd;
			echo "<script>location.href='index.php';</script>"; 
		} else {
			echo"<script>alert('登陆失败，用户名或密码错误');location='login.html'</script>";
		}
		
	} 
?>
