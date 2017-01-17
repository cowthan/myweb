<?php

$packageName = $_POST["packageName"];
$apkVersion = $_POST["apkVersion"];
$patchVersion = $_POST["patchVersion"];

$sql = "select * from patch where packageName='$packageName' and apkVersion='$apkVersion' and patchVersion>$patchVersion order by patchVersion asc;";
echo $sql . "<br/><br/><br/><br/>";
//

require_once("./config.php");
$mysqli=new mysqli();
$mysqli->connect($db_host,$db_user,$db_psw,$db_name);
/////
$result=$mysqli->query($sql);
$arr = array();
if ($result){
	 if($result->num_rows>0){
	 	$count = 0;
	 	$row = "";
	 	while($row =$result->fetch_array()){                        
	 		 $arr["code"] = 0;
	        $res = array();
	        $res["appName"] = $row[1];
	        $res["packageName"] = $row[2];
	        $res["apkVersion"] = $row[3];
	        $res["patchVersion"] = $row[4];
	        $res["downloadUrl"] = $row[5];
	        $res["patch_file_name"] = "$row[2]_$row[3]_patch_$row[4].jar";
	        $arr["result"] = $res; 
        }

       
        
	 }else{
	 	$arr["code"] = 1;
	 }
}else{
	$arr["code"] = 1; 
}
echo json_encode($arr);
/////
$mysqli->close();
//

exit;

?>