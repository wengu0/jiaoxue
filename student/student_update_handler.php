<?php
	//session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {   
         $stu_id = trim($_POST["stu_id"]);
		 $stu_name= $_POST["stu_name"];
		 $stu_pwd=trim($_POST["stu_pwd"]); 
		 $cls_id=trim($_POST["cls_id"]);  
         $stu_tel=trim($_POST["stu_tel"]);
		 
         $sql="update student set stu_name='$stu_name',cls_id='$cls_id',stu_tel='$stu_tel' where stu_id='$stu_id'";
        
		 $result=mysqli_query($conn,$sql);


         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('修改成功');window.location.href='student_info.php';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('修改失败');window.location.href='student_info.php';</script>";  
		 } 
	} 
    mysqli_close($conn);
?>
