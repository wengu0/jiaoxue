<?php
	//session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {   
         $cls_id = trim($_POST["cls_id"]);
		 $cls_name= $_POST["cls_name"];
		 $cls_count=trim($_POST["cls_count"]); 
		 $enrollment_year=trim($_POST["enrollment_year"]);  
         $specialty_name=trim($_POST["specialty_name"]);
		 
         $sql="update classes set cls_name='$cls_name',cls_count='$cls_count',enrollment_year='$enrollment_year',specialty_name='$specialty_name' where cls_id='$cls_id'";
        
		 $result=mysqli_query($conn,$sql);


         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('修改成功');window.location.href='classes_info.php';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('修改失败');window.location.href='classes_info.php';</script>";  
		 } 
	} 
    mysqli_close($conn);
?>
