<?php
//session_destroy();	//删除会话所占空间。
session_start();       //启动会话

include "../conn_db.php"; //调用Fun.php文件

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$tch_id = trim($_POST["tch_id"]);
	$tch_name = $_POST["tch_name"];
	$tch_pwd = trim($_POST["tch_pwd"]);
	$tch_level = trim($_POST["tch_level"]);
	$tch_tel = trim($_POST["tch_tel"]);
	if (empty($tch_name) || empty($tch_pwd) || empty($tch_level) || empty($tch_tel)) {
		echo "<script>alert('请输入完整');window.location.href='teacher_info.html';</script>";
	} else {
		$sql = "update teacher set tch_name='$tch_name',tch_level='$tch_level',tch_tel='$tch_tel' where tch_id='$tch_id'";

		$result = mysqli_query($conn, $sql);


		//php中，非0值，默认为true
		if ($result > 0) {
			echo "<script>alert('修改成功');window.location.href='teacher_info.html';</script>";
		} else {
			echo "<script>alert('修改失败');window.location.href='teacher_info.html';</script>";
		}
	}
}
mysqli_close($conn);
