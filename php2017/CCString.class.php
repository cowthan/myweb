<?php

class CCString
{
	public static function test(){
		$str = "123ABCabc";
		echo strtok($str, "11");
		CCString::br();
		
		echo strstr($str, "ABC"); //找到str中出现的第一个ABC
		CCString::br();
		
		echo substr($str, 2, 4); //从下标为2开始，取长度为4
		CCString::br();
		
		echo strlen($str); //字符串长度
		CCString::br();
		
		/*
		//--去除空格,填充空格
		ltrim, rtrim, trim：不光可以去除空格，还能去除参数2指定到其他字符，默认会去掉"","\0",\t, \n,\r
		str_pad($str，填充到到总长度，要用什么填充，STR_PAD_LEFT或RIGHT或BOTH):用参数3填充参数1到参数2指定到长度，在参数4指定到方向填充
		
		//--大小写
		strtolower, strtoupper：全部变成大写，小写
		ucfirst：首单词的首字母大写
		ucwords：所有单词的首字母大写
		
		//--字符串翻转：strrev()，倒序输出
		
		//--加密: md5()
		
		//--格式化：
		number_format()
		sprintf()
		
		//--字符串比较：
		strcmp(str1, str2)：返回int，区分大小写，比较ascii码
		strcasecmp(s1, s2)：不区分大小写的比较
		strnatcmp(s1, s2)：按照自然排序进行比较，比如字符串4和33，自然排序是33大，上面的比较是4大
		
		
		//----正则表达式？？？？？？？？？？？？？
		
		*/
	}

	public static function br(){
		echo "<br/>";
	}


}

CCString::test();

?>