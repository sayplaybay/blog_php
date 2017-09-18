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


	 	//检查是否重复
	 $sql = "select * from page where content='{$content}' and pid<>'{$pid}'";
	 	$search = $db->query($sql);
	 	if ($search->fetch_array()) {
	 		die('内容不能重复');
	 	}

 		if ($pid>0) {
 			$uptime = time();
 		$sql = "UPDATE page SET title='{$title}',author='{$author}',content='{$content}',uptime='{$uptime}' where pid='{$pid}'";
 			
 		}else{
 				$time = time();
 			//插入数据
		$sql = "INSERT INTO page (`title`,`author`,`content`,`time`,`uptime`) values ('{$title}','{$author}','{$content}','{$time}',0)";
 		}
	 	$is = $db->query($sql);
	if ($is) {
		//header("location:blog.php");
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


<link rel="stylesheet" type="text/css" href="../thems/simditor-2.3.6/styles/simditor.css" />
<script type="text/javascript" src="../thems/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="../thems/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="../thems/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="../thems/simditor-2.3.6/scripts/simditor.js"></script>
</head>
<body>
	<?php include(PATH.'/nav.li.php');?>
	<div class="container">
		<h1>添加博客<small class="pull-right"><a href="blog.php" class="btn btn-default">返回</a></small></h1>
		<hr/>
		<div class="rows">
			<div class="col-md-8 col-md-offset-2">
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
			
				    <textarea id="content" name="content" class="form-control">
						<?php echo $page['content'];?>
				    </textarea>

				    <script type="text/javascript">
						var editor = new Simditor({
							textarea: $('#content'),
							upload: {
								url: 'blog_save.php',
								fileKey: 'upload_file'
							}
						});
				    </script>
				  </div>
				  <button type="submit" class="btn btn-default">提交</button>
				</form>
			</div>	    
		</div>
	</div>

</body>
</html>