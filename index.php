<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教学管理系统</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php 
	      session_start();
          if(empty($_SESSION["uname"])){
            echo"<script>alert('用户还没有登录');location='login.html'</script>";
          }
          $welcome="";
		  $role="管理员";
          
		  if($_SESSION["role"]==2) $role="教师";
		  if($_SESSION["role"]==3) $role="学生";
		  $welcome="当前用户类别：".$role."，用户名：".$_SESSION["uname"];
	?>
    
    <table width="100%" border="1">
        <tr><td colspan="2">
            <div id="divTop">
                <div id="divTitle">教学管理系统2022</div>
                <div id="divWelcome"><span><?php echo $welcome; ?></span></div>
            </div>
        </td></tr>
        <tr><td width="20%" height="600">       
            <ul>
                <h3><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    管理菜单</h3>
                <?php         
                    include "conn_db.php";
                    if(isset($_SESSION["role"]))
                    {
                        $sql = "select * from menu where menu_role=".$_SESSION["role"];
                        $result=mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                ?>
                <li><a href='<?php echo @$row["menu_url"] ?>' target="mainWindow">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="14" cy="6" r="2"></circle>
                <line x1="4" y1="6" x2="12" y2="6"></line>
                <line x1="16" y1="6" x2="20" y2="6"></line>
                <circle cx="8" cy="12" r="2"></circle>
                <line x1="4" y1="12" x2="6" y2="12"></line>
                <line x1="10" y1="12" x2="20" y2="12"></line>
                <circle cx="17" cy="18" r="2"></circle>
                <line x1="4" y1="18" x2="15" y2="18"></line>
                <line x1="19" y1="18" x2="20" y2="18"></line>
                </svg>
                <?php echo @$row["menu_name"]; ?></a></li>
                <?php				
                        }                        
                        mysqli_free_result($result);
                        mysqli_close($conn);
                    } 
                ?>
            </ul>
        </td>
        <td>
            <iframe name="mainWindow" width="100%" height="600" src="default.html"></iframe>
        </td></tr>
        <tr><td colspan="2" align="center" height="60" bgcolor="gray"><span>版权所有&copy;苏州工业园区服务外包学院信息工程学院</span></td></tr>
    </table>
</body>
</html>