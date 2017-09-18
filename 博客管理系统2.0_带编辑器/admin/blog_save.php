<?php
include('check.php');
var_dump($_FILES);//获取传输文件


$key = 'upload_file'; // 将文件所在目录定为$key
$dir = '../saveimgs/'; //定义文件上传的目录和上传后的名字

if (isset($_FILES[$key])) {  //检测变量是否存在
	$file = $_FILES[$key];   //将文件数据传递给$file
	if ($file['error'] == 0) {
		$fileName= $dir.$file['name']; //保持原来的名字
		$urlname = 'http://blog.com/saveimgs/'.$file['name'];
		$is= move_uploaded_file($file['tmp_name'], $fileName);//move方法将数组中我们之前看到的图片的对应的键值数据移动到我们定义的../saveimgs/a.jpg
		if (!$is) {
			die('上传失败'); //如果$is执行失败 则为输出提示
		}

		$josn = array(   //虽然上传成功，但是编辑器不知道，告诉编辑器上传成功

			'success'=>true,
			'msg'=>"", 
			'file_path'=> $urlname
			)
		echo json_encode($josn); //数组以json输出

	}
}

?>