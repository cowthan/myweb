<?php

/**
get请求 get.php

参数：
username
pwd

返回：
{
    "result": {
        "city_id": "0",
        "id": "100116",
        "sid": "4ec5c0e08bb6ed68df91e72b7fe08064",
        "member_icon": "http://7xnnw8.com1.z0.glb.clouddn.com/questions/1452739095963225.jpg",
        "sex": "1",
        "points_nums": "155",
        "province_id": "32",
        "nickname": "111",
        "msg_unread_nums": "1"
    },
    "code": 0
}
*/


if(!isset($_GET['username'])){
	echo "username required";
	die();
}

if(!isset($_GET['pwd'])){
	echo "pwd required";
	die();
}

$username = $_GET['username'];
$pwd = $_GET['pwd'];

$json = <<<EOT
{
    "result": {
        "city_id": "0",
        "id": "100116",
        "sid": "4ec5c0e08bb6ed68df91e72b7fe08064",
        "member_icon": "http://7xnnw8.com1.z0.glb.clouddn.com/questions/1452739095963225.jpg",
        "sex": "1",
        "points_nums": "155",
        "province_id": "32",
        "nickname": "111",
        "msg_unread_nums": "1"
    },
    "code": 0
}
EOT;

echo $json;
