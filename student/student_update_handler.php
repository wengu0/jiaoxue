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
		 if(empty($stu_name)||empty($stu_pwd)||empty($cls_id)||empty($stu_tel)){
			echo "<script>alert('请输入完整');window.location.href='student_info.html';</script>"; 
		 }
		 else{
         $sql="update student set stu_name='$stu_name',cls_id='$cls_id',stu_tel='$stu_tel' where stu_id='$stu_id'";
        
		 $result=mysqli_query($conn,$sql);


         //php中，非0值，默认为true
		 if($result>0)  
		 {		 	
			echo "<script>alert('修改成功');window.location.href='student_info.html';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('修改失败');window.location.href='student_info.html';</script>";  
		 } 
	} }
    mysqli_close($conn);
?>
