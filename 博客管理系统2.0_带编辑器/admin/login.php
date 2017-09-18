<?php
session_start();
include('../config.php');
if ($input->get('do') == 'check') {
	$username = $input->post('username');
	$password = $input->post('password');
	$sql = "SELECT * FROM admin WHERE username='{$username}' and password='{$password}'";
	$mysqli_result = $db->query($sql);
	$row = $mysqli_result->fetch_array(MYSQLI_ASSOC);
	if (is_array($row)) {
		$_SESSION['id'] = $row['id'];
		header("Location:home.php");
	}else{
		echo "账号或密码错误";
	}
}
?>


<html>
<head>
	<title>管理员登录界面</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-4"></div>
			<div class="col-md-4" style="margin-top:100px">
				<div class="panel panel-primary">
					<div class="panel-heading">管理员登录</div>
					<div class="panel-body">
						<form action="login.php?do=check" method="POST">
							<div class="form-group">
							<label for="exampleInputEmail1">账号：</label>
							<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="请输入用户名">
							</div>
							<div class="form-group">
							<label for="exampleInputPassword1">密码</label>
							<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="请输入密码">
							</div>
							<button type="submit" class="btn btn-primary" style="margin-left:70%">确认登录</button>
						</form>
					</div>
					<div class="panel-footer text-right">没有密码 别瞎登录</div>
				</div>
			</div>
        <div class="col-md-4"></div>
	</div>
</body>
</html>