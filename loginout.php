<?php
session_start();
//删除会话
unset($_SESSION['uname']);
//删除所有session
session_destroy(); 
echo "<script>top.location.href='login.html';</script>"; 
?>