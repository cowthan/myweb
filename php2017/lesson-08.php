<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

 require_once('./toolkit.php');

CCToolkit::outLine("一 异常处理");

CCToolkit::out("1、异常的抛出和捕捉语法");
/*

注意：try..catch的用法和Java中是一样的

php的异常都继承自Exception，类的定义如下：

class MyException{
    
    protected string $message;
    protected int $code;
    protected string $file;
    protected int $line;
    
    public __construct($message = "", int $code = 0, Exception $previous = NULL);
    final public string getMessage();
    final public Exception getPrevious();
    final public int getCode();
    final public String getFile();
    final public int getLine();
    final public array getTrace();
    final public string getTraceAsString();
    public String __toString();
    final public void __clone();
    
}

 */

$a = 10;
$b = 0;

try {
    throw new Exception("出了什么异常"); 
} catch (Exception $e) {
    echo $e->getMessage() . "<br/>";  //出了什么异常
    echo $e->getCode() . "<br/>";     //0
    echo $e->getFile() . "<br/>";     //C:\wamp\laravel\public\www\php\lesson8.php
    echo $e->getLine() . "<br/>";     //44
    echo $e->getTraceAsString() . "<br/>"; //#0 {main}
}

CCToolkit::out("2、全局异常处理器");
/*
默认异常处理器：
通过set_exception_handler来设置
相当于在整个脚本的最外层包里一层try..catch，所以抛出异常会导致脚本运行结束，转而来执行异常处理程序
 */
function default_exception_handler(Exception $e){
    print "出异常了<br/>";
    $code = $e->getCode();
    if(!empty($code)){
        printf("Error code: %d<br/>", $code);
    }
    print $e->getMessage() . "<br />";
    print "File: " . $e->getFile() . "<br />";
    print "Line: " . $e->getLine() . "<br />";
    exit(-1);
}
set_exception_handler("default_exception_handler");

//throw new Exception("出了什么异常");
//echo "看看这句会不会输出..."


CCToolkit::outLine("二 错误处理");

CCToolkit::out("1、错误和异常的区别");
/*

1 10/0，不会抛出异常，而是触发个错误
2 错误不会导致脚本运行结束，接下来的代码还会继续运行
3 抛出异常用throw，触发错误用trigger_error
4 全局处理：异常的全局处理通过set_exception_handler设置，错误的全局处理通过set_error_handler设置

关于set_error_handler("func-name", error_types)：
参数1：方法名
参数2：可选。规定在哪个错误报告级别会显示用户定义的错误。默认是 "E_ALL"

值            常量
1	    E_ERROR	            致命的运行时错误。错误无法恢复。脚本的执行被中断。	 
2	    E_WARNING	   非致命的运行时错误。脚本的执行不会中断。	 
4	    E_PARSE	           编译时语法解析错误。解析错误只应该由解析器生成。	 
8	    E_NOTICE	    运行时提示。可能是错误，也可能在正常运行脚本时发生。	 
16	    E_CORE_ERROR	由 PHP 内部生成的错误。	4
32	    E_CORE_WARNING	由 PHP 内部生成的警告。	4
64	    E_COMPILE_ERROR	由 Zend 脚本引擎内部生成的错误。	4
128	    E_COMPILE_WARNING	由 Zend 脚本引擎内部生成的警告。	4

256	    E_USER_ERROR	由于调用 trigger_error() 函数生成的运行时错误。	4----------------
512	    E_USER_WARNING	由于调用 trigger_error() 函数生成的运行时警告。	4---------------
1024	E_USER_NOTICE	由于调用 trigger_error() 函数生成的运行时提示。	4

2048	E_STRICT	     运行时提示。对增强代码的互用性和兼容性有益。	5
4096	E_RECOVERABLE_ERROR	可捕获的致命错误。（参阅 set_error_handler()）	5
8191	E_ALL	             所有的错误和警告，除了 E_STRICT。	5


关于trigger_error("最长1024的错误提示串", error_types)：
参数2：
可选。规定错误消息的错误类型。 可能的值：
E_USER_ERROR
E_USER_WARNING
E_USER_NOTICE

抑制错误提示：
error_reporting(E_ALL);

 */
trigger_error("自定义错误1：应该被php默认错误处理器捕捉到。。。");

function customError($errno, $errstr, $errfile, $errline)
{
    echo "<br/>----------------<br/><b>自定义错误处理: </b> [$errno] $errstr<br />";
    echo " Error on line $errline in $errfile<br />";
    echo "Ending Script";
    echo "<br/>----------------<br/>";
    //die();
 }
 
set_error_handler("customError");
trigger_error("自定义错误2：应该被自定义的错误处理器捕捉到。。。");










CCToolkit::outLine("二 日志");

?>

</body>