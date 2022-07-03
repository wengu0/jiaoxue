<?php
include "../conn_db.php"; //调用Fun.php文件

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cls_id = $_POST["cls_id"];
	$stu_id = trim($_POST["stu_id"]);
	$course_id = trim($_POST["course_id"]);
	$score_val = trim($_POST["score_val"]);
	if (empty($stu_id) || empty($course_id) || empty($score_val)) {
		echo "<script>alert('请输入完整');window.location.href='score_add.php';</script>";
	} else {
		$check_sql = "select * from score where stu_id='$stu_id' ";
		$check_sql .= "and course_id='" . $course_id . "' ";
		$check = mysqli_query($conn, $check_sql);
		if ($check->num_rows > 0) {
			echo "<script>alert('该同学已有课程，请重新输入');window.location.href='score_info.html';</script>";
		} else {
			$sql = "INSERT INTO `score`(`score_id`, `stu_id`, `course_id`, `score_val`) ";
			$sql .= " VALUES (null,'" . $stu_id . "','" . $course_id . "','" . $score_val . "')";

			$result = mysqli_query($conn, $sql);

			//php中，非0值，默认为true
			if ($result > 0) {
				echo "<script>alert('保存成功');location.href='score_info.html';</script>";
			} else {
				echo "<script>alert('保存失败');location.href='score_add.php';</script>";
			}
		}
	}
}
mysqli_close($conn);
