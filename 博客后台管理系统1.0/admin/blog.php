<?php
include('check.php');

if ($input->get('do') == 'delete' ) {
	$pid = $input->get('pid');

	$sql = "DELETE FROM page WHERE pid='{$pid}'";
	$is = $db->query($sql);
	if ($is) {
		header("Location:blog.php");
	}else{
		echo "删除失败";
	}

}
//查询数据库的条数,AS相当于定义数据库的键值对索引值
//ceil进一法取值，得到总共分的页数
$sql = "SELECT count(*) AS total from page";
$total = $db->query($sql)->fetch_array(MYSQLI_ASSOC)['total'];
$page = (int)$input->get('page');

//数据总共分为多少页
$page = $page < 1 ? 1 : $page;
//每页数据显示

$number = 10;
$pageNum = ceil($total / $number);
//每一页从何处开始
$MaxNum = ($page-1)*10;

$sql = "select * from page limit $MaxNum,{$number}";
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
			<div class="col-md-10 col-md-offset-1">		
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
			          	<a href="blog.php?do=delete&pid=<?php echo $row['pid'];?>">删除</a>
			          </td>
			        </tr>
			    <?php endforeach?>
			      </tbody>
			    </table>
			  
			    <nav aria-label="Page navigation">

  <ul class="pagination">

	<?php
		$hrefTpl ='<li><a href="blog.php?page=%d">%s</a></li>';
		for ($i=1; $i<=$pageNum; $i++) { 
			echo sprintf($hrefTpl,$i,"第{$i}页");
		}

	?>
    
  </ul>
</nav>
			</div>	    
		</div>
	</div>

</body>
</html>
