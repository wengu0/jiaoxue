<?php
	//session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {
		 $cls_name=$_POST["cls_name"];         
		 $cls_count=trim($_POST["cls_count"]); 
		 $enrollment_year=trim($_POST["enrollment_year"]);  
         $specialty_name=trim($_POST["specialty_name"]);
		 
		 $sql="INSERT INTO `classes`(`cls_id`, `cls_name`, `cls_count`, `enrollment_year`, `specialty_name`) ";
         $sql.=" VALUES (null,'".$cls_name."','".$cls_count."','".$enrollment_year."','".$specialty_name."')";		
        
		 $result=mysqli_query($conn,$sql);				 

         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('保存成功');window.location.href='classes_info.php';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('保存失败');window.location.href='classes_add.html';</script>";  
		 } 
	} 
    mysqli_close($conn);
?>
