<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php 

function getPostParam($name){
    if(isset($_POST[$name])){
        return htmlentities($_POST[$name]);  //如果提交的值中有html标签，这个可以转义，防止原文输出时，html被解析
    }else{
        return "未设置$name";
    }
}

if(isset($_GET["hasField"])){
    ///提交了表单
    echo "文本框：" . getPostParam("username") . "<br />";
    echo "密码框：" . getPostParam("password") . "<br />";
    echo "单选按钮：" . getPostParam("sex") . "<br />";
    echo "复选按钮1：" . getPostParam("bike") . "<br />";
    echo "复选按钮2：" . getPostParam("car") . "<br />";
    echo "下拉列表：" . getPostParam("cars") . "<br />";
    echo "文本域：" .  getPostParam("intro") . "<br />";
    die();
    
}else{
    ///没提交表单
}
?>

<form action="./lesson-12.php?hasField=true" method="post">
<fieldset>
    <legend>表单集合</legend>

文本框：
<input type="text" name="username" />


<br /><br />
密码框：
<input type="password" name="password" />

<br /><br />
单选按钮：
<input type="radio" name="sex" value="male" /> Male
<input type="radio" name="sex" value="female" /> Female

<br /><br />
复选按钮：<br />
<input type="checkbox" name="bike" />
I have a bike
<br />
<input type="checkbox" name="car" />
I have a car

<br /><br />
下拉列表：
<select name="cars">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat" selected="selected">Fiat</option>
<option value="audi">Audi</option>
</select>

<br /><br />
文本域：<br />
<textarea name="intro" rows="10" cols="30">
个人简介写在这里。。
</textarea>

<br /><br />
<input type="file" name="upfile[]" value="以同样的name上传多个文件" />
<input type="file" name="upfile1" value="一个文件一个name" />

<br /><br />
<input type="button" value="button按钮">

<br /><br />
<input type="submit" value="submit提交" />

<br /><br />
<input type="reset" value="reset重置">


</fieldset>
</form>

</body>