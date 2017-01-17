<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>
<?php

if(isset($_GET["code"])){
	echo $_GET["code"] . "<br /><br />运算结果：<br />";
	echo eval($_GET["code"]);
}else{
	?>
输入代码：
<form action="joke.php" method="get">
<textarea rows="30" cols="60" name="code">

</textarea>
<br/>
<input type="submit" value="run" />
</form>
<?php
}
?>
</body>
</html>
