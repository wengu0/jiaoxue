<?php
	//session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {
		 $course_name=trim($_POST["course_name"]);
		 $course_period=trim($_POST["course_period"]); 
		 $course_credit=trim($_POST["course_credit"]);  
          
		 if(empty($course_name)||empty($course_period)||empty($course_credit)){
			echo "<script>alert('请输入完整');window.location.href='course_info.php';</script>"; 
		 }
		 
		 else{
			$check_sql= "select * from course where course_name='$course_name' ";
			$check_sql.="and course_period='".$course_period."' ";
			$check_sql.="and course_credit='".$course_credit."' ";
			$check=mysqli_query($conn,$check_sql);
			if($check->num_rows>0){
				echo "<script>alert('已有课程，请重新输入');window.location.href='course_info.html';</script>"; 
			}
			else{
			$sql="INSERT INTO `course`(`course_id`, `course_name`, `course_period`, `course_credit`) ";
			$sql.=" VALUES (null,'".$course_name."','".$course_period."','".$course_credit."')";		
			
			$result=mysqli_query($conn,$sql);				 
			//php中，非0值，默认为true
			if($result>0)  
			{		 	
				echo "<script>alert('保存成功');window.location.href='course_info.html';</script>"; 
			}
			else
			{
				echo "<script>alert('保存失败');window.location.href='course_add.html';</script>";  
			} 
		} 
    
}
	}mysqli_close($conn);
?>
