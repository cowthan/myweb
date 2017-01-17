<?php

$appName = $_POST["appName"];
$packageName = $_POST["packageName"];
$apkVersion = $_POST["apkVersion"];
$patchVersion = $_POST["patchVersion"];
$downloadUrl = $_POST["downloadUrl"];

$sql = "insert into patch (appName, packageName, apkVersion, patchVersion, downloadUrl) values('$appName', '$packageName', '$apkVersion', '$patchVersion', '$downloadUrl');";

//
require_once("./config.php");
$mysqli=new mysqli();
$mysqli->connect($db_host,$db_user,$db_psw,$db_name);
/////
$result=$mysqli->query($sql);
if($result == TRUE){
	header("location: ./index.php");
}else{
	//header("location: ./submit_fail.php");
	echo $result;
	echo "<hr/>";
	echo $sql;
}
/////
$mysqli->close();
//

exit;

?>