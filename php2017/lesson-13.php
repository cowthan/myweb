<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php 

 require_once('./toolkit.php');
CCToolkit::outLine("一 散列算法");
/*
散列是不可逆转的加密，只能通过散列后的结果来比对
——散列是单向的，计算结果称为彩虹表，md5有一个已知的彩虹表，可以被反向查询到明文
——所以散列应该掺杂，也就是加盐
——如何加盐：对第一次md5结果追加字符串，再md5一次（注意，加的盐是需要存储的）
——sha1比md5更强
——sha2比sha1更强

盐从何来？
——不应该是固定的
——应该是安全的随机数，由服务器生成
——客户端的盐也需要来自服务器
——服务器端存储盐不应该和用户表在一块

原则：
——原则就是就算别人拿到数据库和代码，也无法反推出密码

 */

$salt = uniqid(mt_rand());
$pwd = "adadfads";

///md5
$md5_simple = md5($pwd);
$stronger_pwd_md5 = md5($md5_simple.$salt);
echo "md5:<br />原文：$pwd<br/>md5再加盐md5：$stronger_pwd_md5<br/>salt = $salt<br />";
echo "<br />";

///sha1
$stronger_pwd_sha1 = sha1($md5_simple.$salt);
echo "sha1:<br />原文：$pwd<br/>md5再加盐sha1：$stronger_pwd_sha1<br/>salt = $salt<br />";
echo "<br />";

///sha2
$sha2_32bit = hash("sha256", $pwd);
$sha2_64bit = hash("sha512", $pwd);
echo "sha2-32位: $sha2_32bit<br />";
echo "sha2-64位: $sha2_64bit<br />";


echo "<br /><pre>所有散列算法<br />";
print_r(hash_algos());
echo "</pre>"

?>
</body>