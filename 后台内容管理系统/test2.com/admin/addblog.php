<?php
include('check.php');


$pid= $input->get('pid');

if ($add=$input->get('do')) {
	$page = array(
	'title'=>'',
	'author'=>'',
	'content'=>'',

	);
}
if ($pid>0) {
	$sql = "SELECT * From page where pid='{$pid}'";
	$is = $db->query($sql);
	$page = $is->fetch_array(MYSQLI_ASSOC);	
}


if ($input->get('do') == 'add') {
	$title = $input->post('title');
	$author = $input->post('author');
	$content = $input->post('content');
	
	
	if (empty($title) || empty($author) || empty($content)) {
		die("数据不能为空");
	}
	$time = time();

	 	//检查是否重复
	 $sql = "select * from page where content='{$content}' and pid<>'{$pid}'";
	 	$search = $db->query($sql);
	 	if ($search->fetch_array()) {
	 		die('数据不能重复');
	 	}

 		if ($pid<1) {
 			//插入数据
		$sql = "INSERT INTO page (`title`,`author`,`content`,`time`,`uptime`) values ('{$title}','{$author}','{$content}','{$time}',0)";
 		}else{
 		$sql = "UPDATE page SET title='{$title}',author='{$author}',content='{$content}' where pid='{$pid}'";	
 		}
	 	$is = $db->query($sql);
	if ($is) {
		header("location:blog.php");
	}else{
		echo "执行失败";
	}


}

	


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加博客</title>
	<?php include(PATH.'/header.inc.php');?>
</head>
<body>
	<?php include(PATH.'/nav.li.php');?>
	<div class="container">
		<h1>添加博客<small class="pull-right"><a href="blog.php" class="btn btn-default">返回</a></small></h1>
		<hr/>
		<div class="rows">
			<div class="col-md-6 col-md-offset-3">
				<form action="addblog.php?do=add&pid=<?php echo $pid;?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">标题</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入标题" name="title" value="<?php echo $page['title'];?>" /> 
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">作者</label>
				    <input type="text" class="form-control" placeholder="请输入作者名" name="author" value="<?php echo $page['author'];?>" />
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">正文</label>
				    <textarea name="content" class="form-control" style="height: 300px">
						<?php echo $page['content'];?>
				    </textarea>
				  </div>

				  <button type="submit" class="btn btn-default">提交</button>
				</form>
			</div>	    
		</div>
	</div>

</body>
</html>