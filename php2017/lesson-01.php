<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>
<?php



echo phpversion();
function customError($errno, $errstr, $errfile, $errline)
{
	echo "<p style=\"border:1px solid red;color:red;\">";
    echo "----------------<b>自定义错误处理: </b><br /> [$errno] $errstr<br />";
    echo " Error on line $errline in $errfile<br />";
    echo "----------------<br/>";
	echo "</p>";
    //die();
}

set_error_handler("customError");
trigger_error("自定义错误2：应该被自定义的错误处理器捕捉到。。。");


try {
    require_once('./toolkit.php');
} catch (Exception $e) {
    echo $e->getMessage();
}

function echoLine($msg){
	echo $msg . "<br />";
}
//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("一 基本知识");
CCToolkit::out("1、运行环境和安装");
CCToolkit::out("2、花括号，分号，注释");
/*
嵌入到html页面的语言：
<?php
echo "hello";
?>
 */

//---退出当前脚本
//die("可以带一段输出到网页的提示文本");
//exit(-1)

CCToolkit::out("3、调试：打印log");
/*
echo msg;    参数只接受字符串类型，所有其他类型都会被强转为字符串
print msg;   参数只接受字符串类型，所有其他类型都会被强转为字符串 
printf(format, arg1..);  和C语言中的一样
var_dump();

*/

$a = 123;
$arr = array(1,2,3,'4');

echo "<br/>=====echo输出====<br/>";
echo "echo \$aa;  //echo只认识string" . "<br/>";
echo $a . "<br/>";    //123
echo $arr . "<br/>";  //Notice: Array to string conversion，输出--Array

echo "<br/>=====print输出====<br/>";
echo "print \$aa;  //print只认识string" . "<br/>";
print $a . "<br/>";
print($arr . "<br/>");

echo "<br/>=====printf输出====<br/>";
echo "printf(\"\$aa = %s\", \$aa);  //printf格式化输出" . "<br/>";
printf('$a = %s<br/>', $a);
printf('第一个元素：%s<br/>', $arr[0]);


class A_ClassName{
	public $a = "23234";

	function s(){}
}

echo "<br/>=====print_r输出====<br/>";
print_r($a);
echo "<br/>";
print_r($arr);
echo "<br/>";
print_r(new A_ClassName());


echo "<br/>";
echo "<br/>=====var_dump输出====<br/>";
var_dump($a);
echo "<br/>";

var_dump($arr);
echo "<br/>";

var_dump(new A_ClassName());
echo "<br/>";

CCToolkit::out("4、错误抑制");
/*

默认错误处理：
ini_set("display_errors", "off");  //on开启，off关闭 --- 默认是on
error_reporting(E_ALL | E_STRICT);
//对应的Php.ini里的display_errors = On

并且这个设置只会影响后面的代码

on时，如果有错误，输出如下：
Notice: Array to string conversion in F:\tools\xampp\htdocs\myweb\php2017\lesson-01.php on line 68

关于报错级别：
1 E_ERROR 致命的运行错误。错误无法恢复，暂停执行脚本。
2 E_WARNING 运行时警告(非致命性错误)。非致命的运行错误，脚本执行不会停止。
4 E_PARSE 编译时解析错误。解析错误只由分析器产生。
8 E_NOTICE 运行时提醒(这些经常是你代码中的bug引起的，也可能是有意的行为造成的。)
16 E_CORE_ERROR PHP启动时初始化过程中的致命错误。
32 E_CORE_WARNING PHP启动时初始化过程中的警告(非致命性错)。
64 E_COMPILE_ERROR 编译时致命性错。这就像由Zend脚本引擎生成了一个E_ERROR。
128 E_COMPILE_WARNING 编译时警告(非致命性错)。这就像由Zend脚本引擎生成了一个E_WARNING警告。
256 E_USER_ERROR 用户自定义的错误消息。这就像由使用PHP函数trigger_error（程序员设置E_ERROR）
512 E_USER_WARNING 用户自定义的警告消息。这就像由使用PHP函数trigger_error（程序员设定的一个E_WARNING警告）
1024 E_USER_NOTICE 用户自定义的提醒消息。这就像一个由使用PHP函数trigger_error（程序员一个E_NOTICE集）
2048 E_STRICT 编码标准化警告。允许PHP建议如何修改代码以确保最佳的互操作性向前兼容性。
4096 E_RECOVERABLE_ERROR 开捕致命错误。这就像一个E_ERROR，但可以通过用户定义的处理捕获（又见set_error_handler（））
8191 E_ALL 所有的错误和警告(不包括 E_STRICT) (E_STRICT will be part of E_ALL as of PHP 6.0)

//禁用错误报告
error_reporting(0);

//报告运行时错误
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//报告所有错误
error_reporting(E_ALL);


自定义错误报告：
- 不受ini_set控制
- 会绕过标准 PHP 错误处理程序，同时如果必要，用户定义错误程序通过 die() 终止脚本
- 也可以把错误存到文件里，不输出到页面
function customError($errno, $errstr, $errfile, $errline)
{
	echo "<p style=\"border:1px solid red;color:red;\">";
    echo "----------------<b>自定义错误处理: </b><br /> [$errno] $errstr<br />";
    echo " Error on line $errline in $errfile<br />";
    echo "----------------<br/>";
	echo "</p>";
    //die();
}

set_error_handler("customError");
//trigger_error("自定义错误2：应该被自定义的错误处理器捕捉到。。。");


 */

CCToolkit::out("5、命名空间");
echo "命名空间生效版本：(PHP 5 >= 5.3.0, PHP 7)， 默认命名空间： __NAMESPACE__ = " . __NAMESPACE__ . "<br/>";

/*


专业术语：
- 非限定名称：Unqualified name， 如Foo， 是个相对路径，会在当前ns里寻找
- 限定名：Qualified name，如Foo\Bar，也是个相对路径，会在当前ns里寻找
- 完全限定名： Fully，如\Foo\Bar， 注意namespace\Foo也是一个完全限定名（namespace关键字在这里代表当前命名空间的全名）


```
<?php
namespace my\name; // 参考 "定义命名空间" 小节

class MyClass {}
function myfunction() {}
const MYCONST = 1;

$a = new MyClass;
$c = new \my\name\MyClass; // 参考 "全局空间" 小节

$a = strlen('hi'); // 参考 "使用命名空间：后备全局函数/常量" 小节

$d = namespace\MYCONST; // 参考 "namespace操作符和__NAMESPACE__常量” 小节

$d = __NAMESPACE__ . '\MYCONST';
echo constant($d); // 参考 "命名空间和动态语言特征" 小节
?>
```

都谁可以放在命名空间里：
- 类（包括抽象类和traits）、接口、函数和常量

基本使用：
```
<?php
namespace MyNamespace;

const CONNECT_OK = 1;
class Connection { ...  }
function connect() { ... }

define('MESSAGE', 'Hello world!'); ///这个定义在了全局空间里！！！！
define('MyNamespace\HELLO', 'Hello world!');  ///这个定义在了MyNamespace里！！！！
define(__NAMESPACE__ . '\GOODBYE', 'Goodbye cruel world!'); ///这个定义在了MyNamespace里！！！！



?>

<?php
    namespace NS;

    define(__NAMESPACE__ .'\foo','111');
    define('foo','222');

    echo foo;  // 111 --- 访问的是当前namespace里的foo
    echo \foo;  // 222 --- 访问的是全局namespace的foo，全局namespace就是\
    echo \NS\foo  // 111 --- 显式指定了，访问的是\NS
    echo NS\foo  // fatal error. assumes \NS\NS\foo  -- 不加斜杠，就会以当前namespace为根，即\NS，然后在里面找\NS\NS\foo
?>

-------------------命名空间必须是第一条语句，包括html在内
<html>
<?php
namespace MyProject; // 致命错误 -　命名空间必须是程序脚本的第一条语句
?>
```


子命名空间
```
<?php
namespace MyProject\Sub\Level;

const CONNECT_OK = 1;
class Connection {  ...  }
function connect() {  ...  }

?>

常量 MyProject\Sub\Level\CONNECT_OK
类   MyProject\Sub\Level\Connection
函数 MyProject\Sub\Level\connect
```

同一个文件声明多个namespace
```
<?php
declare(encoding='UTF-8');  //除了开始的declare语句外，命名空间的括号外不得有任何PHP代码。
namespace MyProject {

	const CONNECT_OK = 1;
	class Connection {  ...  }
	function connect() {  ...   }
}

namespace AnotherProject {

	const CONNECT_OK = 1;
	class Connection {  ...  }
	function connect() {  ...   }
}

namespace { // global code
	session_start();
	$a = MyProject\connect();
	echo MyProject\Connection::start();
}
?>

注意，namespace后不带名字的，其实就是全局空间
- 全局空间的声明：namespace { }
- 全局空间的使用：
	- 如果是在全局空间里，new Klass()，表示Klass就是全局空间的
	- 如果是在其他空间里，new \Klass()，表示去全局空间找Klass
```

命名空间的使用：
- 其实可以和文件路径做一个类比
- 注意，任何代码都有个当前目录（也就是当前namespace）
	- new Foo()：Foo在这里是一个相对路径，则会寻找currentNamespace\Foo
	- new subDir\Foo()：这也是个相对路径，会寻找currentNamespace\subDir\Foo
	- new \home\foo\Foo()：这是个绝对路径
	- 全局空间就代表根目录
	- 所有namespace，都是声明在当前namespace下，大多数情况下，就是全局空间

在任意命名空间里访问全局函数：
```
<?php
namespace Foo;

function strlen() {}
const INI_ALL = 3;
class Exception {}

$a = \strlen('hi'); // 调用全局函数strlen
$b = \INI_ALL; // 访问全局常量 INI_ALL
$c = new \Exception('error'); // 实例化全局类 Exception
?>
```


php的动态语言特性和namespace的关系：

先来一个不用namespace的例子，很好理解：
```
<?php
class classname
{
    function __construct()
    {
        echo __METHOD__,"\n";
    }
}
function funcname()
{
    echo __FUNCTION__,"\n";
}
const constname = "global";

$a = 'classname';
$obj = new $a; // prints classname::__construct
$b = 'funcname';
$b(); // prints funcname
echo constant('constname'), "\n"; // prints global
?>
```

如果在某一个namespace里使用这段代码:
<?php
namespace namespacename;
class classname
{
    function __construct()
    {
        echo __METHOD__,"\n";
    }
}
function funcname()
{
    echo __FUNCTION__,"\n";
}
const constname = "namespaced";

include 'example1.php';

$a = 'classname';
$obj = new $a; // prints classname::__construct
$b = 'funcname';
$b(); // prints funcname
echo constant('constname'), "\n"; // prints global

// note that if using double quotes, "\\namespacename\\classname" must be used
$a = '\namespacename\classname';
$obj = new $a; // prints namespacename\classname::__construct
$a = 'namespacename\classname';
$obj = new $a; // also prints namespacename\classname::__construct
$b = 'namespacename\funcname';
$b(); // prints namespacename\funcname
$b = '\namespacename\funcname';
$b(); // also prints namespacename\funcname
echo constant('\namespacename\constname'), "\n"; // prints namespaced
echo constant('namespacename\constname'), "\n"; // also prints namespaced
?>

动态特征的其他用法：
```
<?php
class myClass
{
    public static function myMethod()
    {
      return "You did it!\n";
    }
}

$foo = "myClass";
$bar = "myMethod";

echo $foo::$bar(); // prints "You did it!";
?>

```


在代码里写太多\太难看了，就像java代码你不会在代码里写一堆包名，而是用import，在php里，有use关键字，
而且use还可以指定别名
- 注意，use是将别的空间里的类，函数，常量引入到当前命名空间
- use My\Full; 这里是从全局空间开始走，而不是从当前空间开始走
	- 前导的反斜杠是不必要的也不推荐的，因为导入的名称必须是完全限定的，不会根据当前的命名空间作相对解析
- 导入操作是在编译执行的，而动态机制是运行时的，所以动态代码（类名，函数名，常量名）不会受use影响！！
- use不会影响include里的文件，因为use是基于file的--per file basis
- use只能用于全局位置，不能位于类，函数内
- 不能给全局空间起别名，use \ as test; 不会生效

```
<?php
namespace foo;
use My\Full\Classname as Another;

// 下面的例子与 use My\Full\NSname as NSname 相同
use My\Full\NSname;

// 导入一个全局类
use ArrayObject;

// importing a function (PHP 5.6+)
use function My\Full\functionName;

// aliasing a function (PHP 5.6+)
use function My\Full\functionName as func;

// importing a constant (PHP 5.6+)
use const My\Full\CONSTANT;

$obj = new namespace\Another; // 实例化 foo\Another 对象
$obj = new Another; // 实例化 My\Full\Classname　对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func
$a = new ArrayObject(array(1)); // 实例化 ArrayObject 对象
// 如果不使用 "use \ArrayObject" ，则实例化一个 foo\ArrayObject 对象
func(); // calls function My\Full\functionName
echo CONSTANT; // echoes the value of My\Full\CONSTANT
?>

一个use，引入多个：
<?php
use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化 My\Full\Classname 对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func
?>

<?php
use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化一个 My\Full\Classname 对象
$a = 'Another';
$obj = new $a;      // 实际化一个 Another 对象
?>

<?php
use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // instantiates object of class My\Full\Classname
$obj = new \Another; // instantiates object of class Another
$obj = new Another\thing; // instantiates object of class My\Full\Classname\thing  --- 内部类？？
$obj = new \Another\thing; // instantiates object of class Another\thing
?>
```

在namespace里include，则被include的文件里的代码都位于namespace里了！！
```
<?php
//test.php
namespace test {
  include 'test1.inc';
  echo '-',__NAMESPACE__,'-<br />';
}
?>

<?php
//test1.inc
  echo '-',__NAMESPACE__,'-<br />';
?>

Results of test.php:

--
-test-
```

namespace优先级
- new Klass()，总是只在当前ns里寻找Klass，所以全局空间的class必须使用全限定名
- 函数和常量，总是先在当前ns里找，找不到，则跑到全局空间里找（或者是跑到上层空间里找？？）
```
<?php
namespace A\B\C;

const E_ERROR = 45;
function strlen($str)
{
    return \strlen($str) - 1;
}

echo E_ERROR, "\n"; // 输出 "45"
echo INI_ALL, "\n"; // 输出 "7" - 使用全局常量 INI_ALL

echo strlen('hi'), "\n"; // 输出 "1"
if (is_array('hi')) { // 输出 "is not array"
    echo "is array\n";
} else {
    echo "is not array\n";
}
?>
```


 */

CCToolkit::out("5、文件包含");
/*

include：
- 运行时包含，参数可以是变量，被包含的文件可以返回一个值
- 只生成警告（E_WARNING），并且脚本会继续

require：
- 编译时包含，参数不能是变量，因为这个是在编译时替换，一般用于库函数等
- 会生成致命错误（E_COMPILE_ERROR）并停止脚本

include_once
require_once

get_included_files()和get_required_files()能知道当前文件包含了哪些文件

自动加载类：调用全局方法__autoload($类名)
function __autoload($class){
	//前提是你的class都统一命名，统一存放
	//这样当你$obj = new User()时，如果当前没有包含User类，则去包含User.class.php
	include($class . ".class.php");
}

注意：被包含的文件不应该以?>结尾，应该省略，具体原因不详，书上这样说：
类定义文件不应该以?>结尾，因为在组合页之前，他们经常自动加载或包含在一个头文件里，并且?>和EOF之间
的任何额外空白将被注入在页面开头的html输出流，php最好不以?>结尾，省略它是最佳实践。当使用header()
函数发送HTTP头到浏览器时，?>可能是导致“输出已开始（output already started）”错误的主要原因，并且它是
一个不易察觉的致命陷阱

require_once('./toolkit.php');

关于autoload：
这是php提供的自动寻找class的机制，要注意class文件名的拼写和路径的指定

下面是一个不太好的例子：
function __autoload($class_name) {
	$path = str_replace('_', '/', $class_name);
	require_once $path . '.php';
}
// 这里会自动加载Http/File/Interface.php 文件
$a = new Http_File_Interface();
当你访问Http_File_Interface这个类时，会去Http/File/Http_File_Interface.php里找类Http_File_Interface
缺点很明显了，类名必须和路径（目录层级）绑定


例子2：
$map = array(
	'Http_File_Interface' => 'C:/PHP/HTTP/FILE/Interface.php'
);
function __autoload($class_name) {
	if (isset($map[$class_name])) {
		require_once $map[$class_name];
	}
}
// 这里会自动加载C:/PHP/HTTP/FILE/Interface.php 文件
$a = new Http_File_Interface();
缺点就是你得维护一个map，或者维护一个json文件，总之要手动记住类名和路径的映射

版本问题：
- （PHP 5 >= 5.1.2, PHP 7）spl_autoload_register() 提供了一种更加灵活的方式来实现类的自动加载。因此，不再建议使用 __autoload() 函数，在以后的版本中它可能被弃用。
- 在 5.3.0 版之前，__autoload 函数抛出的异常不能被 catch 语句块捕获并会导致一个致命错误
- 5.3.0+ 之后，__autoload 函数抛出的异常可以被 catch 语句块捕获，但需要遵循一个条件。如果抛出的是一个自定义异常，那么必须存在相应的自定义异常类。__autoload 函数可以递归的自动加载自定义异常类
- 自动加载不可用于 PHP 的 CLI 交互模式。

关于spl_autoload_register：
- 如果有多个autoload函数（比如来自你引用的别的框架），但php本身只允许一个autoload函数存在
- 这时就需要一个autoload函数的堆栈，让所有autoload函数都生效
- 所以有了spl系列

spl_autoload：
- 是_autoload()的默认实现，它会去include_path中寻找$class_name(.php/.inc)
- spl_autoload实现自动加载
```
http.php
<?php
class http
{
	public function callname(){
		echo "this is http";
	}
}

test.php
<?php
set_include_path("/home/yejianfeng/handcode/"); //这里需要将路径放入include
spl_autoload("http"); //寻找/home/yejianfeng/handcode/http.php
$a = new http();
$a->callname();
```

spl_autoload_register的使用：
```
http.php
<?php
class http
{
	public function callname(){
		echo "this is http";
	}
}

test.php
<?php
spl_autoload_register(function($class){
	if($class == 'http'){
		require_once("/home/yejianfeng/handcode/http.php");
	}
});

$a = new http();
$a->callname();
```


spl_autoload_call：
- 调用通过spl_autoload_register注册的函数
- spl_auto_call('http2')，我们可以自己传入一个类名（其实不一定是类名）
看下面的例子，http.php和http2.php都定义了http类，如果直接new http()，会找到http.php，但是我们想用http2.php，
这时就可以通过spl_autoload_call显式的加载
```
http.php
<?php
class http
{
	public function callname(){
		echo "this is http";
	}
}

http2.php
<?php
class http
{
	public function callname(){
		echo "this is http2";
	}
}

test.php
<?php
spl_autoload_register(function($class){
	if($class == 'http'){
		require_once("/home/yejianfeng/handcode/http.php");
	}
	if($class == 'http2'){
		require_once("/home/yejianfeng/handcode/http2.php");
	}
});
spl_auto_call('http2');
$a = new http();
$a->callname(); //这个时候会输出"this is http2"
```

spl_autoload_register的高级用法：
- 5.3有效
- 参数2：throw，boolean类型， 此参数设置了 autoload_function 无法成功注册时， spl_autoload_register()是否抛出异常。
	- 如果找不到类，会抛出fatal error:Fatal error: Class 'Foobar\InexistentClass' not found in ...
- 参数3：prepend 如果是 true，spl_autoload_register() 会添加函数到队列之首，而不是队列尾部

看下面的例子，模拟了找不到类的情况
```
<?php

namespace Foobar;

class Foo {
    static public function test($name) {
        print '[['. $name .']]';
    }
}

spl_autoload_register(__NAMESPACE__ .'\Foo::test'); // 自 PHP 5.3.0 起

new InexistentClass;

?>

输出：
[[Foobar\InexistentClass]]
Fatal error: Class 'Foobar\InexistentClass' not found in ...
```



异常处理：
```
<?php

namespace Foo;

try {
    // Something awful here
    // That will throw a new exception from SPL
}
catch (Exception as $ex) {
    // We will never get here
    // This is because we are catchin Foo\Exception
}


namespace Foo;

try {
    // something awful here
    // That will throw a new exception from SPL
}
catch (\Exception as $ex) {
    // Now we can get here at last
}
?>
```

 */



CCToolkit::out("6、退出程序：die(reason)");
//exit()和die()相比就是die允许输出一段文本提示

/**
 * php有3种注释：
 * //
 * #
 * 
 */
//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("二 变量，常量和类型");
CCToolkit::out("1、类型");
// 	$aa = false;
// 	var_dump($aa);
// 	CCToolkit::out($aa);
/*
 ---------四种标量类型：
 布尔型（boolean）：true和false，var_dump输出bool(false)，echo的输出是true为1，false为空，啥都没
 整型（integer）：4字节，32位
 浮点型（float）（浮点数，也就是double）,您可能还会读到一些关于“双精度（double）”类型的参考。实际上 double 和 float 是相同的，由于一些历史的原因，这两个名称同时存在。
 字符串（string）

 ---------两种复合类型：
 数组（array）
 对象（object）

 ---------最后是两种特殊类型：
 资源（resource）
 NULL

 ---------为了确保代码的易读性，本手册还介绍了一些伪类型：
 混和（mixed）
 数字（number）
 回馈（callback）

 ----------
 */
$a = "aaa";
var_dump($a);   //string 'aaa' (length=3)

$a = 1;
var_dump($a);   //int 1

$a = 1e-3;
var_dump($a);   //float 0.001

$a = true;
var_dump($a);  //boolean true

$a = array(1,2,"3");
var_dump($a);
/*
array (size=3)
  0 => int 1
  1 => int 2
  2 => string '3' (length=1)
*/

class AA{
	public $aa = "1";
}

$a = new AA();
var_dump($a);
/*
object(AA)[1]
  public 'aa' => string '1' (length=1)
*/

$a = NULL;
var_dump($a);  //null


CCToolkit::out("2、变量的定义，在字符串中的解析");
/*
$a;就是个变量声明和定义，这里的定义是给了默认值，undefined，即没类型，也没值
此时var_dump($a)输出的是NULL，并且给了一个Notice警告，未定义的变量

$a=10;是个即给了值，也给了类型的过程，注意了
在双引号中能直接解析，只要变量名是纯粹的变量名，例如对于变量$msg，'$msg1'就不被认为是变量
单引号可以防止变量展开，即单引号中的都是字符串
"${msg}1"可以展开
"{$msg}1"可以展开

	$a = 10;
	var_dump($a);
*/
CCToolkit::out("3、类型转换");
/*
 每次赋值都是一次类型转换，可以这么认为
因为不存在编译时类型检查，所以也不存在截断和提升

----字符串转变：如果一个字符串是numeric或以字符串开头，则在加减乘除中会自动提取出一个数字类型
（1）$a = "25ddd"; $a + 2的结果是27，但$a还是原来的字符串值，还是字符串类型
（2）还有双字节数的问题，这个估计是翻译的不好听，其实就是纯double值的字符串，才会被当做double进行

字符串转换，否则就是当做整数，即"25.1dd"是25，"25.1"是25.1
----算数运算时的提升：int和double的运算结果是double
----强制类型转换：$a = (int)$b;
----intval(参数1是要被转换的字符串，参数2是进制), doubleval(), strval()


----强制类型转换：
(int) (integer)
(float) (real) (double)
(string)
(bool) (Boolean)
(array)
(object)



*/
CCToolkit::out("4、类型相关函数");
//参考CCType这个类
//外加：gettype(), settype()
//外加：isset()和unset()
//empty($variable)：未定义，未赋值，0，NULL，""都返回true

CCToolkit::out("5、常量");
/*
 	define函数定义常量，访问时不用$符号
 	define("CCNAME", "cowthan", true);  参数3：常量名是否大小写敏感，默认true
 	if(defined("CCNAME"))
 	{
 		echo CCNAME;
 	}
 	else
 	{
 		echo "没定义CCNAME这个常量";
 	}
        
        内置常量
 	define("BR", "<br />");
 	echo "TRUE = " . TRUE . BR;   ------TRUE = 1
 	echo "FALSE = " . FALSE . BR; ------FALSE = 
 	echo "PHP_VERSION = " . PHP_VERSION . BR ;  -----PHP_VERSION = 5.4.16
 	echo "PHP_VERSION_ID = " .+ PHP_VERSION_ID . BR;  -----PHP_VERSION_ID = 50416
 	echo "PHP_OS = " . PHP_OS . BR;  ------PHP_OS = WINNT
 	echo "__FILE__ = " . __FILE__ . BR;  ------__FILE__ = E:\xampp\htdocs\php-cowthan\cowthan.php
 	echo "__FUNCTION__ = " . __FUNCTION__ . BR;  ----__FUNCTION__ = 
 	echo "__LINE__ = " . __LINE__ . BR;   ----__LINE__ = 78
	echo "__CLASS__";
	echo "__METHOD__";

     上面基本就输出：
    
	还有很多内置常量，可以通过phpinfo()函数查看，里面显示了一些php环境相关的常量

 */

CCToolkit::out("6、isset, unset, empty方法");
/*
	isset方法：检测变量是否设置 ，只能传入一个变量，即传入的参数必须能作为左值
	——如果没有定义，或者为NULL，则返回FALSE
	——否则返回TRUE

	unset方法：将一个变量变为非isset的

	empty：检查一个变量是否为空 
	——若变量不存在则返回 TRUE 
	——若变量存在，但其值为""、0、"0"、NULL、、FALSE、array()、var $var; 以及没有任何属性的对象，则返回 TURE
	——否则返回FALSE

	特别注意：
	使用isset和empty来判断对象的成员属性时，会忽略__set和__get，所以如果没有重写__isset方法，则只对public成员
	起作用

	所以如果只重写了__set和__get，而没有重写__isset，会导致属性的访问和判断产生歧义


*/
unset($a);
unset($b);
$a = 123;
if(isset($a)){
	echo "a是isset的<br/>";  //输出这句
}else{
	echo "a不是isset的<br/>";
}

$a = NULL;
if(isset($a)){
	echo "a是isset的<br/>";  
}else{
	echo "a不是isset的<br/>"; //输出这句
}

if(isset($b)){
	echo "b是isset的<br/>";  
}else{
	echo "b不是isset的<br/>"; //输出这句
}

echo "==========<br/>";
$a = "dd";
if(empty($a)){
	echo "a没有定义或者值为空（相对于其类型的空，或NULL）<br/>";    
}else{
	echo "a已定义，并且有非空值<br/>";  //输出这句
}

$a = array();
if(empty($a)){
	echo "a没有定义或者值为空（相对于其类型的空，或NULL）<br/>";  //输出这句
}else{
	echo "a已定义，并且有非空值<br/>";  
}

if(empty($b)){
	echo "b没有定义或者值为空（相对于其类型的空，或NULL）<br/>";   //输出这句 
}else{
	echo "b已定义，并且有非空值<br/>";  
}

CCToolkit::out("6、php：变量的变量（可变变量）");
//还不知道能有什么用，当反射来用？在配置文件中来用？有什么意思？
// 	$field = "varName";
// 	$$field = "250"; //相当于：$varName = "250";
// 	echo $varName;  //相当于访问$varName，所以输出250
	
	
CCToolkit::out("7、引用复制");
/*
php其实是通过复制来传递参数的，函数的参数都是传值，=赋值也都是传值，复制了一份
1 对于基本类型：就是创建了一个完全相同的对象实例
2 对于对象类型：也是传值，但是复制的其实是对象的引用，或者说是别名，所以还是指向同一个对象
——这句话深入一点解释就是：既然参数是通过复制传递的，所以你没法改变形参的指向

如果要传引用：

例子1：
$x = 1;
$y = &$x;
$y++; //连$x也跟着变了

例子2：
$arr =range(1, 5);
foreach($arr as &$a){
    $a *= 2;  //连数组里的元素值也变了
}

例子3：
function f(&$x){
    $x += 3;
}

$a = 2;
f($a); //$a变成了5

例子4：
class A{
    private $x = 10;
    
    function &get_x(){
        return $this->x;
    }
}
$a = new A();
$x = $a->get_x();
$x = 15;   //绕过了private，改变了成员属性的值
echo $a->get_x(); //15


*/
	
//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("四 运算符，表达式");
CCToolkit::out("1、算数运算：+ - * / %");
CCToolkit::out("2、比较运算：== 大于 小于 大于等于 小于等于 != 还有<>");
/*
问题：$a="7"; $b=7.00;  $a==$b返回true，问题是只比较值，不比较类型，
需要：$a === $b，才返回false，三个等于号比较的是类型和值

==：比较的是值，无关乎类型
但是，对于对象来说，
$x == $y：
	类型相同
	所有成员相同
其实对象的类型，也是值的一部分

===：比较的是类型和值
但是，对于对象来说，
$x === $y :
	必须是同一个对象


看下面的例子：
class M1{
	public $a = 1;

	public function __toString(){
		///echo "saaa";
		return "1";
	}
}

class M2{
	public $a = 1;

	public function __toString(){
		///echo "saaa";
		return "1";
	}
}
$mm = new M1();
$mmm = new M2();
if($mm == $mmm){    /// 这里无论是==还是===，都不成立
	echoLine("111111相等");
}else{
	echoLine("111111不相等");  // 输出这句
}

if($mm === $mmm){    /// 这里无论是==还是===，都不成立
	echoLine("222222相等");
}else{
	echoLine("222222不相等");  // 输出这句
}

if($mm == "1"){   
	echoLine("333333相等"); // 输出这句------------注意，这里隐式调用了M1的__toString()
}else{
	echoLine("333333不相等");  
}

if($mm === "1"){   
	echoLine("444444相等"); 
}else{
	echoLine("444444不相等");   // 输出这句
}



上面说的还不全面，实际上，可以这样总结一下：
1 对于值类型的相等比较，用=== （因为==会忽略类型，这样的代码注定是不严谨的）
2 对于对象的相等比较，如果要知道是否同一个对象，用===
3 对于对象的相等比较，如果知道是两个对象，但想知道其本质是否同一对象，如订单编号相同的订单，id相同的学生，则自己写比较方法


*/

$a = 1;
$b = '1';

if($a == $b){
	echoLine("a == b");  // 输出这句
}else{
	echoLine("a != b");
}

if($a === $b){
	echoLine("a === b");  
}else{
	echoLine("a !== b");// 输出这句
}


CCToolkit::out("3、逻辑运算");
//与：&& and
//或：|| or
//非：!
//异或：xor
CCToolkit::out("4、字符串连接符：点号");
CCToolkit::out("5、三元操作符：?:");
CCToolkit::out("5、位运算符：");
//按位与：&
//按位或：|
//按位非：~
//按位异或：^
//左移：<<
//右移：>>

CCToolkit::out("6、简捷运算符");
//+=, -=, *=, /=, %=, &=, |=, ^=, >>=, <<=, .=

CCToolkit::out("7、递增++，递减--");
CCToolkit::out("8、变量操作符：&， 对象操作符：new和->");
//@print(5/0)：加上@就会在出错时什么也不干
CCToolkit::out("9、执行运算符反引号对");
$output = `ls -al`;

CCToolkit::out("10、错误抑制符：@");
//抑制错误信息，不触发错误

//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("五 分支和循环");
CCToolkit::out("1、if..elseif..else");
CCToolkit::out("2、switch..case");
CCToolkit::out("3、while");
CCToolkit::out("4、do..while");
CCToolkit::out("5、for");
CCToolkit::out("6、foreach");
CCToolkit::out("7、do..while");
CCToolkit::out("8、break, continue");

CCToolkit::out('9、foreach($list as $key=>$value)');

/*
只要实现了Iterator接口，都可以用foreach来遍历，参考lesson5里的FileIterator


*/

CCToolkit::outLine("五 命名空间");
/*

防止命名冲突
默认命名空间就是\，可以省略

1 声明命名空间，使用命名空间

----wild.php-----
<?php
namespace wild;
class animal{
    function f(){}
}
?>
-----------------

----my.php----
<?php
require_once('wild.php');
$a = new wild\animal();

use wild\animal as beast;
$b = new beast();

?>
--------------

2 子命名空间

<?php
namespace animal\mine{
    class animal{
        function f(){echo "mine";}
    }
}

namespace animal\yours{
    class animal{
        function f(){echo "yours";}
    }
}
?>


3 常量__NAMESPACE__：
当前命名空间名称


 */

print phpversion();
print "<br />";
print \phpversion();

?>



</body>