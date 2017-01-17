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
CCToolkit::outLine("六 函数");
CCToolkit::out("1、定义");
	
// 	function func($param1="defaultvalue")
// 	{
// 		return "OK";
// 	}
//	func($xx);
/*
 	函数引入的概念：
 	1、变量的作用于范围，局部，全局，静态
 	2、参数列表，返回值
 	3、传值，传引用
 	4、返回值，返回引用，这个真没什么用，当对象都是堆中堆对象句柄时，返回引用就没用了
 	5、默认参数，或者重载
 	6、可变个数的参数
 	7、回调函数：函数作为参数传入
 	8、用call_user_func_array()函数自定义回调函数
 	9、递归
 	
 */

CCToolkit::out("2、传值，传引用");
/**
 * --基本类型默认都是传值，在函数定义时，要传引用就：function func(&$xx); 调用时还是func($xx)
 * --自定义对象好像在某版本之后就总是传引用，除非显式的clone()
 * 
 */
CCToolkit::out("3、参数默认值或者函数重载");
//默认值必须从右到左

CCToolkit::out("4、变量的作用域范围和生命周期");
//配合函数的概念，才能开始引入局部变量，全局变量，静态变量
/**
 * ----在函数中访问全局变量，怎么跟局部变量区分？
 * 方法1：
 * $val = 100;
 * function ff(){
 * 		global $val; //已经不推荐这么用了，而是$GLOBALS["val"] = 120;
 * 		$val = 120;
 * 
 * 		static count = 0; //只定义一次，在第一次调用时？还是在某种加载机制运行时？
 * 		count++; //每次调用ff函数都会++一次
 * 
 * }
 * echo $val; //输出120
 * 如果去掉global那一行，则输出100
 * 
 * 方法2：使用GLOBALS数组，里面存了所有全局变量
 * 
 * ----静态变量的使用看上面，注意如果页面被重新加载了，就会从头开始
 * 问题是：什么时候会重新加载页面？
 * 
 */

CCToolkit::out("5、递归");

CCToolkit::out("6、函数指针");
// 	switch ($from)
// 	{
// 		case "Nanjing":
// 			$function_will_be_used = "func1";//函数指针赋值
// 			break;
// 		case "Beijing":
// 			$function_will_be_used = "func2";
// 			break;
// 	}
// 	$function_will_be_used($URL); //调用函数指针

CCToolkit::out("7、关于函数的函数");
/*
 1、function_exists(函数名字符串)：判断函数是否存在
 2、
 */

CCToolkit::out("8、返回值和返回引用");
/*
 function &get_global($name){
 	return $GLOBALS[$name];
 }
 get_global("name") = "zhangsan"; //可以影响全局name，因为返回的是引用
 */

CCToolkit::out("9、类加载函数__aotoload()");
/*
 
 function _autoload($class_name){
 	require_once($SERVER["DOCUMENT_ROOT"] . "/classes/" . $class_name . ".class.php");
 }
 
 $p = new Person();
 如果不认识Person这个类，会首先去看_autoload()函数，去包含/classes/Person.class.php文件，如果
 还找不到，那才报错
 
 */

CCToolkit::out("10、函数名反射");
/*
 函数：call_user_func_array($arr_callback, $arr_args)
 对于普通函数：call_user_func_array("func", array(参数1, 参数2));
 对于成员函数：call_user_func_array(array($person, "func"), array(参数1, 参数2))
 对于静态函数：call_user_func_array(array("Person", "func"), array(参数1, 参数2))
 */

CCToolkit::out("11、闭包--匿名函数");
/*
注意下面的sum函数
php旧版本也支持通过create_function来创建匿名函数
 */
$y = 0;
$arr = range(1, 100);

$sum = create_function('$x, $y', 'return $x + $y;');
$sum = function($x, $y){
    return $x + $y;
};

$sigma = array_reduce($arr, $sum);
echo "1 + 2 + ... + 100 = " . $sigma;
echo "<br />";
/*
外部函数变量的是外部作用域
内部匿名函数的变量是内部作用域
外部作用域对外是不可见的，要想可见，就得全局
 */
function func($a){
    global $y;
    $y = $a;
    return function($x){
        global $y;
        return $y + $x;
    };
}

$f = func(10);
echo $f(2); //12


CCToolkit::out("12、eval函数：运行php脚本");

CCToolkit::out("13、函数里的静态变量");
function do_sth(){
    static $first_time = true;
    if($first_time){
        ///只在第一次调用函数时执行
        //do sth
        $first_time = false;
    }
    
    //alwayse do
}

?>

</body>