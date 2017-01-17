<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

 require_once('./toolkit.php');
//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("N 服务器编程语言特性：");
CCToolkit::out('1、表单验证');
/*
 * 
有一组filter函数，是php提供的净化器和验证器，如对于函数
filter_var('email@eg.com', FILTER_VALIDATE_EMAIL))
这个是验证，是邮箱地址就返回true
而对于filter_var('email@eg.com', FILTER_SANITIZE_EMAIL)
这个是净化，会净化输入的字符串，返回符合邮箱地址格式的字符串

 */
var_dump(filter_var('email@eg.com', FILTER_SANITIZE_EMAIL));

CCToolkit::out("2、请求参数，get，post，head等--全局数组");

/*
---表单对应数组：
for(){
	echo <input name="names[]" type="text" />
}
提交之后，得到了一个$names，是个数组，对应所有name为names[]的表单的值

1、$_SERVER：
UNIQUE_ID => VC@1z8CoAQcAAALfnuwAAAAD
HTTP_HOST => localhost
HTTP_ACCEPT => text/html,application/xhtml+xml,application/xml;q=0.9,星号/星号;q=0.8
HTTP_CONNECTION => keep-alive
HTTP_COOKIE => CNZZDATA155540=cnzz_eid%3D1434001831-1412241949-http%253A%252F%252Flocalhost%252F%26ntime%3D1412241949
HTTP_USER_AGENT => Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/600.1.17 (KHTML, like Gecko) Version/7.1 Safari/537.85.10
HTTP_ACCEPT_LANGUAGE => en-us
HTTP_REFERER => http://localhost/cowthan-php/joke.php
HTTP_ACCEPT_ENCODING => gzip, deflate
PATH => /usr/bin:/bin:/usr/sbin:/sbin
DYLD_LIBRARY_PATH => /Applications/XAMPP/xamppfiles/lib:/Applications/XAMPP/xamppfiles/lib
SERVER_SIGNATURE => 
SERVER_SOFTWARE => Apache/2.4.7 (Unix) PHP/5.5.9 OpenSSL/1.0.1f mod_perl/2.0.8-dev Perl/v5.16.3
SERVER_NAME => localhost
SERVER_ADDR => ::1
SERVER_PORT => 80
REMOTE_ADDR => ::1
DOCUMENT_ROOT => /Applications/XAMPP/xamppfiles/htdocs
REQUEST_SCHEME => http
CONTEXT_PREFIX => 
CONTEXT_DOCUMENT_ROOT => /Applications/XAMPP/xamppfiles/htdocs
SERVER_ADMIN => you@example.com
SCRIPT_FILENAME => /Applications/XAMPP/xamppfiles/htdocs/cowthan-php/joke.php
REMOTE_PORT => 53486
GATEWAY_INTERFACE => CGI/1.1
SERVER_PROTOCOL => HTTP/1.1
REQUEST_METHOD => GET
QUERY_STRING => code=function+sysou%28%24arr%29%7B%0D%0A%09%09if%28%21is_array%28%24arr%29%29%7B%0D%0A%09%09%09echo+%24arr+.+%22%3Cbr+%2F%3E%22%3B%0D%0A%09%09%7Delse%7B%0D%0A%09%09%09foreach%28%24arr+as+%24k%3D%3E%24v%29%7B%0D%0A%09%09%09%09echo+%24k+.+%22+%3D%3E+%22%3B%0D%0A%09%09%09%09sysou%28%24v%29%3B%0D%0A%09%09%09%7D%0D%0A%09%09%7D%0D%0A%09%7D%0D%0A%0D%0Asysou%28%24_SERVER%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B%0D%0Asysou%28%24_GET%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B%0D%0Asysou%28%24_POST%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B
REQUEST_URI => /cowthan-php/joke.php?code=function+sysou%28%24arr%29%7B%0D%0A%09%09if%28%21is_array%28%24arr%29%29%7B%0D%0A%09%09%09echo+%24arr+.+%22%3Cbr+%2F%3E%22%3B%0D%0A%09%09%7Delse%7B%0D%0A%09%09%09foreach%28%24arr+as+%24k%3D%3E%24v%29%7B%0D%0A%09%09%09%09echo+%24k+.+%22+%3D%3E+%22%3B%0D%0A%09%09%09%09sysou%28%24v%29%3B%0D%0A%09%09%09%7D%0D%0A%09%09%7D%0D%0A%09%7D%0D%0A%0D%0Asysou%28%24_SERVER%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B%0D%0Asysou%28%24_GET%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B%0D%0Asysou%28%24_POST%29%3B%0D%0Aecho+%22%3Chr+%2F%3E%22%3B
SCRIPT_NAME => /cowthan-php/joke.php
PHP_SELF => /cowthan-php/joke.php
REQUEST_TIME_FLOAT => 1412412879.907
REQUEST_TIME => 1412412879

2、$_GET, $_POST, $_REQUEST, $_FILES

提交的参数

3、$_COOKIE, $_SESSION

会话相关

4、$_ENV

5、$GLOBALS

 */

CCToolkit::out("3、重定向");
CCToolkit::out("4、上传和下载文件");



CCToolkit::out("5、url编码");
CCToolkit::out("6、Cookie，Session：参考高级编程130多页，面向对象的实例Session类");
CCToolkit::out("7、购物车：参考高级编程134");

CCToolkit::out("8、常用函数");
/*避免复杂的，或者恶意的用户输入
 
 1、urlencode()
 拼url参数时，?n1=urlencode($v)&n2=urlencode($v2)...
 
 2、nl2br()：用户输入的多行文本是回车换行的，你读过来，nl2br一下，都换成br换行，这对于地址来说可能不重要，但是如果是批量数据，或有特定格式的数据，就得这么干了
 
 3、htmlspecialchars()：用户可以输入html标记，不管以什么方式，这里面的<, >, &, *等都可以通过这个方法被转成html实体$lt;等，以后可以直接拿出来显示
    htmlentities()：转换更多实体
    
    

 4、下面这两个对数据库，脚本，电子邮件来说提高了安全
 addslashes()：添加反斜线，给', ",反斜线本身
 quotemeta()
 发送电子邮件时，
 $body="\nName:".quotemeta($name).
 		"\nE-mail:".addslashes($email)
 
 5、stripslashes删除反斜线：
 表单中提交的数据中的', ", 反斜线本身等都被自动加上类反斜线
 
 echo "转换实体：" . htmlspecialchars($_POST[]);
 echo "删掉斜线：" . stripslashes($_POST[]);
 echo "转换实体并删掉斜线：" . html2Text($_POST[]);
 
 function html2Text($str){
 	return htmlspecialchars(stripslashes($str));
 }
 
 6、strip_tags()：删除字符串中所有html标签，参数2是所有允许保留都标签
 strip_tags($str, "<b><u><i>")
 
 */
CCToolkit::out("9、Http返回消息");
/*
 
 200：成功
 301:网页已永久移动到新位置，服务器返回此响应时，会自动重定向到新位置
 304:未修改，自从上次请求后，网页从未修改过，服务器返回此响应时，不会返回网页内容
 400：错误请求，服务器不理解请求到语法
 404:未找到
 500:服务器内部错误，无法完成请求
 502:错误网关，服务器作为网关或代理，从上游服务器收到无效响应
 505:HTTP版本不受支持，服务器不支持请求中所用到http协议版本
 
 一个典型到HTTP响应头到头部消息：
 HTTP/1.1 200 OK            ----    状态行
 Connectlon:close           －－－－ 表示服务器发送完本消息后会关闭TCP连接
 Date:Thu, 13 Oct 2011 03:17:33 GMT －－头部行，服务器发送本消息到时间，是发送时间哦
 Server:Apache/2.2.9(Unix)  －－－服务器是Apache，类似于请求头中到User-agent
 Last-Nodified:Mon, 22 Jun 2008 09;23;24 GMT  ---本消息本身到最后修改时间
 Content-Length:6821
 Content-Type:text/html      －－－附属体
 <HTML><HEAD><TITLE></HTML>
 
 
 */
?>

</body>