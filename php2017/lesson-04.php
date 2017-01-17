<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

 require_once('./toolkit.php');


function echoLine($msg){
	echo $msg . "<br />";
}

function echoLine2($msg){
	echo "<br/><br/>" .$msg . "<br />";
}

//基类
abstract class Employee{
	protected $ename;
	protected $sal;

	function __construct($ename, $sal){
		echoLine("父类的构造方法：" . $ename);
		$this->ename = $ename;
		$this->sal = $sal;
	}

	function __destruct(){
		echoLine("父类的析构方法：" . $this->ename);
	}

	function work(){
		echoLine("work方法必须由子类实现");
	}
}

/*
3.1 接口：
一旦被实现，必须实现里面指定的方法，否则报错：
Fatal error: Class Manager contains 2 abstract methods and must therefore be declared abstract or implement the remaining methods (IObject::toString, IObject2::toString2)
*/
interface IObject{
	function toString();

	/*
	3.2 这个常量，各个接口最好不要重复，如果一个类实现了多个接口，里面有相同的常量，会报错：
	Fatal error: Cannot inherit previously-inherited or override constant CONSTANT from interface IObject2

	3.3 访问方式：
	Manager::CONSTANT
	$m1::CONSTANT
	IObject::CONSTANT

	在类内访问，可以：self::CONTANT

	*/
	const CONSTANT = "CCCC";
}

//接口2
interface IObject2{
	function toString2();
	const CONSTANT2 = "AAA";
}

/*
1 类定义的语法

2 继承：is a的关系

3 实现接口

实现类需要实现接口指定的方法

*/
class Manager extends employee  implements IObject, IObject2{

	/*
	4 成员属性

	（1）权限：3个
	var相当于public

	（2）getter，setter，魔术方法
	在外部直接访问private的成员，报错：PHP Fatal error: Cannot access private property 类名::成员名 in 文件 行数

	__set和__get方法：
	在$p->property_name时，如果不存在名为property_name的成员属性，或者权限不对，会先去调用这两个方法，
	作为左值时，调用set
	作为右值时，调用get

	（3）__isset方法 和 __unset方法
	__isset：会影响到empty()方法和isset()方法，对于重写了__get和__set的类，建议必须重写__isset，
	需要返回的信息是：
	——如果指定属性存在，并且值不为空，则返回TRUE
	——否则返回FALSE

	__unset：会在调用unset()方法时被触发

	注意：这里的空都是相对于各自类型的空值来说的，例如NULL，0， 0.0， FALSE，空数组，未定义的变量等

	*/
	public $job;
	var $name = "Tom";
	protected $dept;
	private $mission = "作为领导的使命";

	 //----属性设置器和访问器
	 //这个魔术方法想让用户直接用：$p->age = 80;
	 public function __set($property_name, $value){
	 	//当用户写：$p->age = 80时，实际是调用__set("age", 80)
	 
	  	if($property_name == "mission"){
	   		//判断$value是否数字
	   		$this->mission = $value;
	  	}else{
	  		echo "<br/><br/>Error: setter访问了不存在的属性$property_name<br/><br/>";
	  	}
	 }

	 public function __get($property_name){
	 	if($property_name == "mission"){
	   		return $this->mission;
	  	}else{
	  		echo "<br/><br/>Error: getter访问了不存在的属性$property_name<br/><br/>";
	  	}
	 }

	 public function __isset($prop_name){
	 	$v = $this->__get($prop_name);
	 	return isset($v);
	 }

	 public function __unset($prop_name){
	 	//$v = $this->__get($prop_name);
	 	//return isset($v);
	 	if($prop_name == "mission"){
			$this->mission = NULL;
		}
	 }
	/*
	5 构造方法和析构方法
	
	5.1 特殊对象：

	$this对象：指向当前对象

	self对象：类中访问静态成员和常量使用，应该是指向类的，self::$kind， self::CONSTANT_KIND

	parent对象：调用父类方法，覆盖父类的方法时，使用
	function work(){
		parent::work();
		echo "hahah";
	}

	5.3 构造方法：$p1 = new Manager(2, 3)时被调用
	
	魔术方法：__construct
	php中的构造方法，子类的__construct会覆盖父类的，也不存在什么默认的构造方法，所以想要调用父类的构造方法，必须显式的调用
	
	也可以有这么个构造方法：
	——构造方法(php4不推荐使用)：只能有一个，通过默认值实现重载，new时会走这个
	function Manager($ename, $sal, $job, $dept){
		echoLine("子类构造方法2：");
		$this->job = $job;
		$this->dept = $dept;
		$this->ename = $ename;
		$this->sal = $sal;
	}
	但__construct的优先级高，只有没有实现__construct，才会调用和类名同名的构造方法
	
	5.4 析构方法：
	
	析构也是一个道理，子类实现了，就不会自动调用父类的，子类没实现，才会去调用父类的

	*/
	function __construct($ename, $sal, $job, $dept){
		echoLine("子类构造方法：" . $this->ename);
		parent::__construct($ename, $sal);
		$this->job = $job;
		$this->dept = $dept;
	}


	/*
	5.4 
	脚本结束时对象会被回收，就会调用析构方法，说是析构方法不怎么用，有人干脆说没有，这两个方法估计是要淘汰的
  	
  	$person = NULL;会激发垃圾回收，从而激发析构，但时间不保证，参考java就知道了，所以还有个软引用之类的？

	*/
	function __destruct(){
		echoLine("<br/><br/><br/>子类的析构：" . $this->ename);
		parent::__destruct();
	}

	/*

	*/
	

	/*
	6 成员方法：

	6.1 权限
	默认不写，就是public
	protected
	private

	
	6.2 覆盖和重写
	
	（1）final的方法无法被重写，否则报错：
	Fatal error: Cannot override final method Employee::work() 
	
	（2）覆盖父类方法，不能降低权限，否则报错：
	Fatal error: Access level to Manager::work() must be public (as in class Employee)

	6.3 call魔术方法

	__call()：调用了不存在的方法，会走到这里，默认就是抛出错误：
	
	*/
	function getMisson(){
		//return (sqrt(pow($this->x - $p->x, 2) + pow($this->y - $p->y, 2)));
		return isset($this->mission) ? $this->mission : "没有秘密任务";
	}

	/*
	注意，不要误会，这是接口的方法，在php中类似于java的toString方法的是个魔术方法：__toString()
	*/
	function toString(){
		echo "实现接口IObject1";
	}

	function toString2(){
		echo "实现接口IObject2";
	}

	public function work(){
		parent::work();
		echo "hahah";
	}

	//调了不存在的方法时会走到这里
  	public function __call($func_name, $args){
   		echo "<br />你调了不存在的成员方法${func_name}，参数是：";
  		var_dump($args);
   		//有关于这个函数的高级用法：连贯操作，就是返回$this，拼sql语句，参考细说php的279
  	}

	/*
	7 类属性和类方法：静态属性和静态方法

	callStatic魔术方法：调用不存在的静态方法时，会先调用这个
	*/
	static $kind = "human"; //类变量，用Person::kind来访问
	const CONSTANT_KIND = "humankind"; //在类内用self::CONTANT访问，类外Person::CONSTANT


	static function getKind(){
		return self::$kind . "--" . self::CONSTANT_KIND;
	}

	public static function __callstatic($func_name, $args){
   		echo "<br />你调了不存在的静态方法${func_name}，参数是：";
  		var_dump($args);
  	}


	/*
	 8 克隆时调用：$p2 = clone $p时调用这个
	
	（1）本来说是：
	自动包含了 $this和$that
	——$this是新对象，要拷贝别人的值，$p2
	——$that是要被拷贝的对象，$p

	但是：php5好像没有$that了
	——全是用$this, 左值的$this是要拷贝的对象，需要被赋值，右值的$this是要被拷贝的对象，需要取其值

	（2）深拷贝和浅拷贝：
	如果成员属性是一个引用对象，则调用引用对象的clone进行深拷贝，否则就只是引用的互相赋值，还是指向同一个对象，
	这就是浅拷贝（拷贝出来的对象和原对象会有耦合，会被互相影响）

	（3）克隆引出的相等判断问题：
	
	$x === $y：
	只有二者是同一对象时，才返回TRUE

	$x == $y：
	类型相同
	所有成员相同

	$m1 = $m2; 这是引用的克隆，指向的是同一个对象，所以$m1 == $m2返回TRUE
	
	
	要实现java里equals的功能，就自己写个工具方法，没有相关的魔术方法
	

	看下面的例子：
	class M1{
		public $a = 1;
	}

	class M2{
		public $a = 1;
	}

	$mm = new M1();
	$mmm = new M2();
	if($mm == $mmm){    /// 这里无论是==还是===，都不成立
		echoLine("相等");
	}else{
		echoLine("不相等");  // 输出这句
	}


	*/
	function __clone(){
		
		echoLine("要拷贝了");
		$this->mission = $this->mission; //？
		$this->ename = $this->ename;
	}

	/*
	9 转为字符串
	在需要强转为字符串的地方，会调用__toString()
	如echo, print等
	*/
	public function __toString(){
   		return "__toString()被调用：".$this->name;
  	}

  	/*
  	10 对象序列化，反序列化

  	（1）串行化：外界会调用$str = serialize($p)，实际上调用了__sleep()方法,
   	sleep会返回一个数组，这个数组会被串行化得到一个类似json串的结果

   	（2）反串行化：外界会调用$p = unserialize($str)的方法，实际上是调用了__wakeup，
   	在此方法中访问左值$this，就是要反串行化出来的对象

   	这两个方法一般不需要被实现，序列化出来的结果是类json的，但是带有类型信息
  	*/
  	 /*
   
   */
  	// function __sleep(){
   // 		$arr = array("name"=>$this->mission);
   // 		return $arr;
  	// }
 
  	// function __wakeup(){
   // 		$this->ename = "jack";
  	// }
}

$m1 = new Manager("Tom", 2333, "分管人事", "人事部主任");
echoLine("<br/>这个领导的秘密任务是：" . $m1->getMisson());

echoLine2("====访问接口常量:");
$s = Manager::CONSTANT2;
echo $s;

echoLine2("====访问__get和__set:");
$m1->mission = "管理部署和打包事务";
echo $m1->mission;
echoLine("<br/><br/>");
echo $m1->dddd;
$m1->dddd = "ddd";

echoLine2("====访问__isset:");
//unset($m1->mission);  //会触发__unset()，导致mission的值被置位NULL
if(isset($m1->mission)){
	echo "成员mission是isset<br/>";
}else{
	echo "成员mission不是isset<br/>";
}

if(empty($m1->mission)){
	echo "成员mission是empty<br/>";
}else{
	echo "成员mission不是empty<br/>";
}

if(empty($m1->aaa)){
	echo "成员aaa是empty的<br/>";
}else{
	echo "成员aaa不是empty的<br/>";
}


echoLine2("====调用重载的方法:");
$m1->work();

echoLine2("====调用不存在的成员方法:");
$m1->work222("11", 22, array(1,2,"3"));

echoLine2("====调用不存在的静态方法:");
Manager::work222("11", 22, array(1,2,"3"));

echoLine2("====访问静态方法:");
echoLine($m1::getKind());

echoLine2("====对象拷贝:");
$m2 = $m1;
if($m2 == $m1){
	echoLine("赋值导致==成立");  // 输出这句
}else{
	echoLine("赋值导致==不成立");
}

if($m2 === $m1){
	echoLine("赋值导致===成立");  // 输出这句
}else{
	echoLine("赋值导致===不成立");
}

$m2 = clone $m1;
if($m2 == $m1){
	echoLine("clone导致==成立");  // 输出这句
}else{
	echoLine("clone导致==不成立");
}

if($m2 === $m1){
	echoLine("clone导致===成立");
}else{
	echoLine("clone导致===不成立");  // 输出这句，因为===比较的是：是否同一个对象
}

echoLine("clone出来的的对象：" . $m2->mission);
$m2->mission = "我是助手";


echoLine("被clone的对象：" . $m1->mission);

$m2 = NULL;

///-------------------------------------
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

///-------------------------------------


echoLine2("====转为字符串__toString():");
echo "$m1<br/>";
print($m1);

echoLine2("====序列化，反序列化");
$json = serialize($m1);
echo $json . "<br/><br/>"; 
/*
O:7:"Manager":6:{s:3:"job";s:12:"分管人事";s:4:"name";s:3:"Tom";s:7:"*dept";s:15:"人事部主任";s:16:"Managermission";s:27:"管理部署和打包事务";s:8:"*ename";s:3:"Tom";s:6:"*sal";i:2333;}
*/
$m2 = unserialize($json);
echo $m2->mission;


/*
11 代理类：
*/
class ManagerProxy{
	private $mgmr;
	public function __construct(Manager $p){
		$this->mgmr = $p;
	}
 
	public function __call($method, $args){
  		echo "要调用Person的方法了--{$method}，这句是代理行为！<br/>";
  		return call_user_func_array(array($this->mgmr, $method), $args);
 	}

}
echoLine2("====代理");
$m3 = new ManagerProxy($m1);
echo $m3->getMisson();


/*
12 魔术方法可以直接被调用：
*/
echoLine2("====魔术方法可以直接被调用");
$m1->__set("mission", "333");
echo $m1->__get("mission");

/*
13 类型判断：instanceof

和java表现一样
if($p instanceof IObject){
	echo "是一个IObject对象<br />";  //输出这个
}
*/
echoLine2("====类型判断");
if($m1 instanceof IObject){
	echo "是一个IObject对象<br />";  //输出这个
}


?>

</body>