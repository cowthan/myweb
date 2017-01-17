<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php
include 'header.php';

require_once 'UserInfo.class.php';
require '../UploadProcessor.class.php';
require '../UploadUtils.class.php';


/*
 接口：
 
 1、注册：
 functionCode: regist
 username
 passwd
 passwd2
 
 返回：code=0为成功， code=1为失败，msg为失败理由
 
 2、登陆
  
 */

$req = new Request();

$functionCode = $req->getParam("functionCode");
//echo $functionCode . "<br />";
if($functionCode == "regist"){
	regist($req->getParam("username"), 
			$req->getParam("passwd"),
			$req->getParam("passwd2"));
}elseif($functionCode == "login"){
	login();
}elseif($functionCode == "headerImgage"){
	upload();
}elseif($functionCode == "download"){
	download();
}elseif($functionCode == "queryAllStory"){
	regist();
}else{
	echo generateErrorJson("错误的Function Code");
}

function generateErrorJson($errorReason){
	return "{\"code\":1;\"msg\":\"{$errorReason}\"}";
}

function generateOKJson($msg){
	return "{\"code\":0;\"msg\":\"{$msg}\"}";
}

//http://localhost/php-cowthan/mobile-interface/story.php?functionCode=regist&username=user4&passwd=111$passwd2=111
function regist($username, $passwd, $passwd2){
	echo $passwd . "---" . $passwd2;
	if($passwd != $passwd2){
		echo generateErrorJson("两次密码不一致");
	}else{
		$user = new UserInfo();
		$user->username = $username;
		$user->passwd = $passwd;
		
		$mysql = new Mysql();
		$result = $mysql->insert($user->getInsertSQL());
		$mysql->close();
		
		if($result == 1){
			//echo generateOKJson("注册成功");
			echo json_encode($user);
		}else{
			echo generateErrorJson("注册失败：" . $mysql->getDBError());
		}
	}
}

function login($username, $passwd){
	
	$mysql = new Mysql();
	$result = $mysql->query("select id from userinfo where username='{$username}' and passwd='{$passwd}'");
	$mysql->close();
	
	if($result->rows == 1){
		
	}
	
}

function upload(){

	if(!empty($_FILES)){
		//$oUp=new UploadProcessor($_FILES['upfile'], 1024*1204, './tmp/',$name);
		$uu = new UploadUtils();
		$uu->setAllowMime(array ('image/jpg', 'image/gif', 'image/bmp', 'image/png', 'image/jpeg' ))
			->setMaxSize(1000*1000)
			->setSaveDir("./upload/")
			->setUseRandomFilename(true);
		$uu->processUploads();
		$uu->print_result();
	}
}

function download(){
	/*
	 ----下载文件方式1：
	 <a href="http://localhost/11.rar" />
	 这个方式只能下载浏览器不能默认处理的文件类型，对于图片，html等浏览器可以直接打开的文件，就是直接打开，不会激活下载框
	 
	 ----下载方式2：
	 就是这个函数里的
	 */
	$filename = "test.jpg";
	
	header("Content-Type: image/jpg");
	header("Content-Disposition: attachment; filename='{$filename}'");
	header("Content-Lentgh: ".filesize("J:/test.jpg"));
	
	readfile("J:/test.jpg");
	
}

?>

</body>
</html>