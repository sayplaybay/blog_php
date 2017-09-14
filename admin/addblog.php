<?php
include('check.php');

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
				<form action="addblog.php?do=add&id=<?php echo $auser['id'];?>" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">标题</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入标题" name="title" value="<?php echo $auser['username'];?>">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">作者</label>
				    <input type="text" class="form-control" placeholder="请输入作者名" name="author" value="<?php echo $auser['password'];?>">
				  </div>
				  <button type="submit" class="btn btn-default">提交</button>
				</form>
			</div>	    
		</div>
	</div>

</body>
</html>