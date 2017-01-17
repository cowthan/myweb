<?php

class CCToolkit
{
	//-----------------------------------输出：纯打印log，调试时用--------------------------------//
	/**
	 * 打印
	 * @param unknown_type $msg
	 */
	public static function out($msg)
	{
		echo "<br /><span style='color:red;font-family:Consolas;font-size:24px;'>";
		if(is_bool($msg))
		{
			$msg = $msg == true ? "true" : "false";
			echo $msg;
		}
		elseif(is_array($msg))
		{
			print_r($msg);
		}
		else
		{
			echo $msg;
		}
		echo "</span>";
		echo("<br />");
// 		print $msg;
// 		print($msg);
// 		print_r($msg);
// 		printf($msg);	
	}
	
	public static function outLine($msg = "I Am Sep")
	{
		$new_msg = "//====================="."$msg"."=====================//";
		echo("<br />");
		echo "<span style='color:blue;font-family:Consolas;font-size:24px;'>".$new_msg."</span>";
		echo("<br />");
	}
	
	
	public static function sysou($arr){
		if(!is_array($arr)){
			echo $arr . "<br />";
		}else{
			foreach($arr as $k=>$v){
				echo $k . " => ";
				CCToolkit::sysou($v);
			}
		}
	}
	
	//--------------------------------判空-------------------------//
	public static function isEmpty($variable)
	{
		if(!isset($variable)) return false;
		if($variable == NULL) return false;
		
		if(is_string($variable))
		{
			if($variable == "") return false;	
		}
		else if(is_array($variable))
		{
			if(count($variable) == 0) return false;
		}
		
		
		return true;
	}
	
	public static function isNotEmpty($variable)
	{
		return !CCToolkit::isEmpty($variable);
	}
	
}


class CCType
{
	//-----打印类型信息------//
	public static function outTypeInfo($variable)
	{
		var_dump($variable);
	}
	
	
	//-----判断所属基本类型-------//
	
	/**
	 * “boolean”（从 PHP 4 起） 
		“integer” 
		“double”（如果是 float 则返回“double”，而不是“float”） 
		“string” 
		“array” 
		“object” 
		“resource”（从 PHP 4 起） 
		“NULL”（从 PHP 4 起） 
		“unknown type” 

	 * @param unknown_type $variable
	 */
	public static function getType($variable)
	{
		return gettype($variable);
	}
	
	public static function isInteger($variable)
	{
		return is_integer($variable);
		//别名是：is_int($variable), is_long($var)
	}
	
	public static function isFloatOrDouble($variable){
		return is_float($variable);
		//一样的：is_real($var)， is_double($variable)
	}
	
	public static function isBoolean($variable){
		return is_bool($variable);
	}
	
	/**
	 * 标量都包括哪几种类型？integer，float，bool？？
	 * @param unknown_type $variable
	 */
	public static function isScalar($variable)
	{
		return is_scalar($variable);
	}
	
	public static function isString($variable)
	{
		return is_string($variable);
	}
	
	public static function isArray($variable)
	{
		return is_array($variable);
	}
	
	public static function isNull($variable)
	{
		return is_null($variable);
	}
	
	public static function isResource($variable)
	{
		return is_resource($variable);
	}
	
	public static function isObject($variable)
	{
		return is_object($variable);
		
// 		is_a($object, $class_name)
// 		is_subclass_of($object, $class_name)

// 		is_callable($name)
		
// 		is_dir($filename)
// 		is_file($filename)
// 		is_executable($filename)
// 		is_link($filename)
// 		is_readable($filename)
// 		is_writeable($filename)
// 		is_writable($filename)
// 		is_uploaded_file($filename)
		
// 		is_finite($variable)
// 		is_infinite($val)
// 		is_nan($val)
		
// 		is_soap_fault($object)		
		
	}
	
	//-----判断所属class------------//
}

class CCFormat
{
	//---------对格式的判断：数字，邮箱格式，什么的-----------------//
	public static function isNumeric($variable)
	{
		return is_numeric($variable);
	}
	
	public static function isEmail($variable)
	{
		throw new Exception("没实现的函数");
	}
}

class CCArray
{
	public static function count($arr)
	{
		return count($arr);
	}
}

?>