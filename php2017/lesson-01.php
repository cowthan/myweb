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
    echo "<br/>----------------<br/><b>自定义错误处理: </b> [$errno] $errstr<br />";
    echo " Error on line $errline in $errfile<br />";
    echo "Ending Script";
    echo "<br/>----------------<br/>";
    //die();
}

set_error_handler("customError");
//trigger_error("自定义错误2：应该被自定义的错误处理器捕捉到。。。");


try {
    require_once('./toolkit.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
echo "fuck over";

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
echo $a . "<br/>";    //123
echo $arr . "<br/>";  //Notice: Array to string conversion，输出--Array

echo "<br/>=====print输出====<br/>";
print $a . "<br/>";
print($arr . "<br/>");

echo "<br/>=====printf输出====<br/>";
printf('变量%s<br/>', $a);
printf('第一个元素：%s<br/>', $arr[0]);

echo "<br/>=====print_r输出====<br/>";
print_r($a);
echo "<br/>";
print_r($arr);

echo "<br/>=====var_dump输出====<br/>";
var_dump($a);
var_dump($arr);
class A{
	public $a = "23234";

	function s(){}
}
var_dump(new A());
echo "<br/>";

CCToolkit::out("4、错误抑制");

CCToolkit::out("5、文件包含");
/**
 * include：参数可以是变量，被包含的文件可以返回一个值
 * require：参数不能是变量，因为这个是在编译时替换，一般用于库函数等
 * 
 * include_once
 * require_once
 * 
 * get_included_files()和get_required_files()能知道当前文件包含了哪些文件
 * 
 * 自动加载类：调用全局方法__autoload($类名)
 *  function __autoload($class){
 *  	//前提是你的class都统一命名，统一存放
 *  	//这样当你$obj = new User()时，如果当前没有包含User类，则去包含User.class.php
 *  	include($class . ".class.php");
 *  }

注意：被包含的文件不应该以?>结尾，应该省略，具体原因不详，书上这样说：
类定义文件不应该以?>结尾，因为在组合页之前，他们经常自动加载或包含在一个头文件里，并且?>和EOF之间
的任何额外空白将被注入在页面开头的html输出流，php最好不以?>结尾，省略它是最佳实践。当使用header()
函数发送HTTP头到浏览器时，?>可能是导致“输出已开始（output already started）”错误的主要原因，并且它是
一个不易察觉的致命陷阱


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
/*define函数定义常量，访问时不用$符号
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