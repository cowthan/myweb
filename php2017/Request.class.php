<?php

class Request{
	
	//-------------------------请求参数-------------------//
	/**
	 * 获取请求参数，先从GET请求中获取，再从POST请求中获取
	 * @param unknown $name
	 * @return unknown|NULL
	 */
	public function getParam($name){
		if(isset($_GET[$name])){
			return $_GET[$name];
		}else if(isset($_POST[$name])){
			return $_POST[$name];
		}else{
			return NULL;
		}
	}
	
	//-------------------------Cookie-------------------//
	public function hasCookie($name){
		return isset($_COOKIE[$name]);
	}
	
	public function getCookie($name){
		return $_COOKIE[$name];
	}
	
	/**
	 * 
	 * @param unknown $name
	 * @param unknown $val
	 * @param unknown $expire time()+60毫秒
	 */
	public function setCookie($name, $val, $expire){
		//$_COOKIE[$name] = $val;
		setcookie($name, $val, $expire);
	}
	
	public function removeCookie($name){
		setcookie($name, "", time()-1);
	}
	/*
	 1、Cookie可以使用多维数组的形式
	 setcookie("user[username]", "sss"); //对应于：$_COOKIE[user][username] = sss
	 
	 2、使用Cookie跟踪登录信息
	 login时：
	 if(验证通过){
	 	setcookie('username', username, time()+60*60*24*7); //一个周
	 	setcookie('islogin', time()+60*60*24*7);
	 }
	 
	 if(注销){
	 	removeCookie(username);
	 	removeCookie(islogin);
	 }
	 
	 所有请求都需要传username
	 
	 */
	//-------------------------Session-------------------//
	public function hasSession($name){
		return isset($_SESSION[$name]);
	}
	
	public function getSession($name){
		return $_SESSION[$name];
	}
	
	public function setSession($name, $val){
		$_SESSION[$name] = $val;
	}
	
	public function removeSession($name){
		unset($_SESSION[$name]);
	}
	
	public function clearSession(){
		$_SESSION = array();
	}
	
	//---
	public function beginSession(){
		session_start();
	}
	
	public function endSession(){
		session_destroy();
	}
	
	//----
	public function getSessionName(){
		return session_name();
	}
	
	public function getSessionID(){
		return session_id();
	}
	
	/*
	 session id：作为cookie存在客户端，每次请求传过来之后，服务器根据这个id拿出一个map，就是给这个客户端存的session，这么理解就行了
	 类似于：setcookie(session_name(), session_id(), 0, '/');
	 如果cookie被禁用，对于php5，会自动检测客户端cookie被禁用，从而提醒用户打开，但仅限于Linux系统
	 如果cookie被禁用，session ID没法传递，每次session_start()都会新建一个id，从而失去了会话跟踪功能，所以就得通过URL传递session ID
	 
	 session_start();
	 <a href='demo.php?'.session_name().'='.session_id() />
	 
	 剩下的问题就是服务器端session存取的问题
	 另外：这一个map是怎么存的，一直放在服务器内存也不行，所以可能当作文件存，每次读写
	 －－sess_04398493484934934就是文件名，后面是id
	 －－内容是：username|s:6:"skygao";uid|i:1:"1"  －－格式是：key|类型:字节数:值
	 
	 */
	//-------------------------运行上下文信息-------------------//
	public function getPhpOS(){
		return PHP_OS;
	}
	
	public function getPhpVersion(){
		return PHP_VERSION;
	}
	
	public function getDirSeparator(){
		return DIRECTORY_SEPARATOR;
	}
	
	/**
	 * path系统变量里路径的分隔符，分号或逗号
	 * @return string
	 */
	public function getPathSeparator(){
		return PATH_SEPARATOR;
	}
	
	/**
	 * 获得根目录，/Applications/XAMPP/xamppfiles/htdocs
	 * @return unknown
	 */
	public function getRootDir(){
		return $_SERVER["DOCUMENT_ROOT"];
	}
}
/*
 	$_SERVER
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
 */
?>