<?php
include('check.php');

if ($input->get('do') == 'delete' ) {
	$id = $input->get('id');

	if ($id == $session_id){
		die("不能删除当前用户");
	}
	$sql = "DELETE FROM admin WHERE id='{$id}'";
	$is = $db->query($sql);
	if ($is) {
		header("Location:auser.php");
	}else{
		echo "删除失败";
	}

}


$sql = "select * from admin";
$result = $db->query($sql);
$rows = array();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$rows[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员管理</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.li.php');?>
	<div class="container">
		<h1>管理员管理<small class="pull-right"><a href="adduser.php" class="btn btn-default">添加管理员</a></small></h1>
		<div class="rows">
			<div class="col-md-8 col-md-offset-2">		
			    <table class="table table-striped">
			      <thead>
			        <tr>
			          <th>ID</th>
			          <th>用户名</th>
			          <th>管理</th>
			        </tr>
			      </thead>
			      <tbody>
			       <?php foreach($rows as $row):?>
			        <tr>
			          <th scope="row"><?php echo $row['id'];?></th>
			          <td><?php echo $row['username'];?></td>
			          <td>
			          	<a href="adduser.php?id=<?php echo $row['id'];?>">修改</a>
			          	<a href="auser.php?do=delete&id=<?php echo $row['id'];?>">删除</a>
			          </td>
			        </tr>
			    <?php endforeach?>
			      </tbody>
			    </table>
			</div>	    
		</div>
	</div>

</body>
</html>