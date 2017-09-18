<?php
include('check.php');


$id= $input->get('id');
$auser = array(
	'username'=>'',
	'password'=>''

	);
if ($id>0) {
	$sql = "select * from admin where id='{$id}'";
	$is = $db->query($sql);
	$auser = $is->fetch_array(MYSQLI_ASSOC);
	
}
 
if ($input->get('do') == 'add') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)) {
		die("账号或密码不能为空");
	}
		
	//检查是否重复
	 	$sql = "select * from admin where username='{$username}' and id<>'{$id}'";
	 	$search = $db->query($sql);
	 	if ($search->fetch_array()) {
	 		die('账号不能重复');
	 	}

 		if ($id<1) {
 			//插入数据
		$sql = "insert into admin (username,password) values ('{$username}','{$password}')";
 		}else{
 		$sql = "UPDATE admin SET username='{$username}',password='{$password}' where id='{$id}'";	
 		}
	 	$is = $db->query($sql);
	if ($is) {
		header("location:auser.php");
	}else{
		echo "执行失败";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加管理员</title>
	<?php include(PATH.'/header.inc.php');?>

</head>
<body>
	<?php include(PATH.'/nav.li.php');?>
	<div class="container">
		<h1>添加管理员<small class="pull-right"><a href="auser.php" class="btn btn-default">返回</a></small></h1>
		<hr/>
		<div class="rows">
			<div class="col-md-6 col-md-offset-3">
				<form action="adduser.php?do=add&id=<?php echo $auser['id'];?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">账号</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请填写注册用户名" name="username" value="<?php echo $auser['username'];?>">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">密码</label>
				    <input type="password" class="form-control" placeholder="请填写密码" name="password" value="<?php echo $auser['password'];?>">
				  </div>
				  <button type="submit" class="btn btn-default">提交</button>
				</form>
			</div>	    
		</div>
	</div>

</body>
</html>