<html>
<head>
    <meta charset="utf-8" />
</head>

<body>
<?php

require_once("./Parsedown.php");

$doc = <<<EOT
测试接口：都是假接口
---------------------

##域名

http://127.0.0.1/

##get

```
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
```

##post 1

```
post请求 post1.php

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
```


##post 2

```
post请求 post2.php

参数：
需要传入一个stringEntity

响应：
直接返回你传入的字符串


```

##上传文件

```
post 上传文件   www/php/web/story.php?functionCode=headerImgage

参数：
name：post参数
任意个文件，name自定，但必须有name

响应：
成功或者失败提示
```

##下载文件

get  www/php/web/test.jpg

##PUT
##DELETE
##HEAD
##OPTIONS
##TRACE
##PATCH
##仿验证码请求
EOT;

$Parsedown = new Parsedown();
echo $Parsedown->text($doc);

?>

</body>

</html>