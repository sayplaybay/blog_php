<?php
include('check.php');

$sql = "select * from page";
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
	<title>博客管理</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.li.php');?>
	<div class="container">
		<h1>博客管理<small class="pull-right"><a href="addblog.php?do=chk" class="btn btn-default">添加博客</a></small></h1>
		<div class="rows">
			<div class="col-md-8 col-md-offset-2">		
			    <table class="table table-striped">
			      <thead>
			        <tr>
			          <th>PID</th>
			          <th>标题</th>
			          <th>作者</th>
			          <th>内容</th>
			          <th>插入时间</th>
			          <th>修改时间</th>
			          <th>管理</th>
			        </tr>
			      </thead>
			      <tbody>
			       <?php foreach($rows as $row):?>
			        <tr>
			        <th scope="row"><?php echo $row['pid'];?></th>
			          <td><?php echo $row['title'];?></td>
			          <td><?php echo $row['author'];?></td>
			           <td><?php echo $row['content'];?></td>
			          <td><?php echo date("Y-m-d H:i:s",$row['time'])?></td>
			          <td><?php echo date("Y-m-d H:i:s",$row['uptime'])?></td>

			          
			          <td>
			          	<a href="addblog.php?pid=<?php echo $row['pid'];?>">修改</a>
			          	<a href="auser.php?do=delete&id=<?php echo $row['pid'];?>">删除</a>
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
