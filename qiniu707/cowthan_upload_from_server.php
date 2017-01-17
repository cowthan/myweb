<?php

require_once __DIR__ . '/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;




/*
filePath：本地文件路径
qiniuKey：存在服务器的文件名，唯一

返回：
成功；返回下载url
失败：返回错误信息
*/
function upload2Qiniu($filePath, $qiniuKey){

	$accessKey = 'uNaQ_NGIZurU3OMxikyGpk-t4v8tIbP8ct5VQs_f';
	$secretKey = 'FbtNKEzCGbIFccnX14M9iKwQsGcX9YZUyiJylh-9';

	$bucket = 'cowthan1103';
	$token = 'uNaQ_NGIZurU3OMxikyGpk-t4v8tIbP8ct5VQs_f:AM6XGfArmAlRekKqbPk-teMuBoU=:eyJzY29wZSI6ImNvd3RoYW4xMTAzIiwiZGVhZGxpbmUiOjE3NjIwMjA4NDB9';
	$domain = "http://7xo0ny.com1.z0.glb.clouddn.com/";

	$auth = new Auth($accessKey, $secretKey);
	// 要上传文件的本地路径
	$filePath = $filePath;

	// 上传到七牛后保存的文件名
	$key = $qiniuKey;

	// 初始化 UploadManager 对象并进行文件的上传。
	$uploadMgr = new UploadManager();
	list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
	//echo "\n====> putFile result: \n";
	if ($err !== null) {
	    //var_dump($err);
	    return $err;
	} else {
	    //var_dump($ret);
	    return $domain . $ret["key"];
	}
}


// 生成上传 Token
//$token = $auth->uploadToken($bucket);


$res = upload2Qiniu("D:/wamp/yii207/webroot/www/test.jpg", "xxx.jpg");
var_dump($res);
