<?php
	//session_destroy();	//删除会话所占空间。
	session_start();       //启动会话
		
	include "../conn_db.php"; //调用Fun.php文件

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {   
         $score_id = trim($_POST["score_id"]);
		 $stu_id= $_POST["stu_id"];
		 $cls_id=trim($_POST["cls_id"]); 
		 $score_val=trim($_POST["score_val"]);
		 $course_id=trim($_POST["course_id"]);  
         if(empty($score_id)||empty($stu_id)||empty($cls_id)||empty($course_id)||empty($score_val)){
			echo "<script>alert('请输入完整');window.location.href='score_info.html';</script>"; 
		 }	 
		 else{
         $sql="update score set course_id='$course_id',score_val='$score_val' where score_id='$score_id'";
		 $sql2="update student set cls_id='$cls_id' where stu_id='$stu_id'";
         printf($sql2);
		 $result=mysqli_query($conn,$sql);
         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('修改成功');window.location.href='score_info.html';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('修改失败');window.location.href='score_info.html';</script>";  
		 } 
		 $result2=mysqli_query($conn,$sql2);
		 if($result2>0)  
		 {		 	
			echo "<script>alert('修改成功');window.location.href='score_info.html';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('修改失败');window.location.href='score_info.html';</script>";  
		 } 
	} 
}mysqli_close($conn);
?>
