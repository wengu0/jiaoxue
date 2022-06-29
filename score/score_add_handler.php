<?php
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {
		 $cls_id=$_POST["cls_id"];         
		 $stu_id=trim($_POST["stu_id"]); 
		 $course_id=trim($_POST["course_id"]);  
         $score_val=trim($_POST["score_val"]);
		 
		 $sql="INSERT INTO `score`(`score_id`, `stu_id`, `course_id`, `score_val`) ";
         $sql.=" VALUES (null,'".$stu_id."','".$course_id."','".$score_val."')";		
        
		 $result=mysqli_query($conn,$sql);				 
		
         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('保存成功');location.href='score_info.html';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('保存失败');location.href='score_add.php';</script>";  
		 } 
	} 
    mysqli_close($conn);
?>
