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
		  
		 if(empty($cls_name)||empty($cls_count)||empty($enrollment_year)||empty($specialty_name)){
			echo "<script>alert('请输入完整');window.location.href='classes_add.php';</script>"; 
		 }
		 
		 else{
			//检查数据库是否有班级
			$check_sql= "select * from classes where cls_name='$cls_name'";
		 	$check=mysqli_query($conn,$check_sql);
			if($check->num_rows>0){
				echo "<script>alert('已有班级，请重新输入');window.location.href='classes_add.html';</script>"; 
			
			}
			else{
				$sql="INSERT INTO `classes`(`cls_id`, `cls_name`, `cls_count`, `enrollment_year`, `specialty_name`) ";
				$sql.=" VALUES (null,'".$cls_name."','".$cls_count."','".$enrollment_year."','".$specialty_name."')";		
			
				$result=mysqli_query($conn,$sql);				 
	
				//php中，非0值，默认为true
				if($result>0)  
				{		 	
				echo "<script>alert('保存成功');window.location.href='classes_info.html';</script>"; 
				}
				else
				{
				echo "<script>alert('保存失败');window.location.href='classes_add.html';</script>";  
				} 
			}
			
	} 
}
    mysqli_close($conn);
?>
