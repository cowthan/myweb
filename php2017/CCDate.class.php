<?php

class CCDate
{
	#----------------时区－－－－－－－－－－－－－－＃
	public static function setDefaultTimeZone($tz = "Etc/GMT-8"){
		date_default_timezone_set($tz);
	}
	
	public static function getDefaultTimeZone(){
		return date_default_timezone_get();
	}
	
	public static function test(){
		
		$br = "<br/>";
		
		$datetime = date_create();
		//echo $datetime;
		
		//----时间戳
		echo time() . $br; //当前对时间戳，例如1412425900
		echo mktime(8,0,0,10,1,2000). $br;//2000-10-01 08:00:00对时间戳
		echo date("Y-m-d H:i:s") . $br;
		echo date("Y-m-d H:i:s", strtotime("2014-10-03 08:00:01")) . $br;
		echo date("Y-m-d H:i:s", strtotime("10:38pm April 15 2015")) . $br;
		echo date("Y-m-d H:i:s", strtotime("tomorrow")) . $br;
		echo date("Y-m-d H:i:s", strtotime("next Saturday")) . $br;
		echo date("Y-m-d H:i:s", strtotime("+3 Months")) . $br;
		echo date("Y-m-d H:i:s", strtotime("+3 Months", time())) . $br;
		
		//----格式化时间戳，默认为当前时间
		echo $showtime=date("Y-m-d H:i:s", time()-2000000). $br;//2014-10-04 14:28:51
		
		//----日期运算
		//date_add($datetime, 1);
		//$datetime->add(1, DateInterval::);
		/*
		显示的格式: 年-月-日 小时:分钟:妙   
		相关时间参数:   
		a - "am" 或是 "pm"   
		A - "AM" 或是 "PM"   
		
		d - 几日，二位数字，若不足二位则前面补零; 如: "01" 至 "31"   
		D - 星期几，三个英文字母; 如: "Fri"   
		
		h - 12 小时制的小时; 如: "01" 至 "12"   
		H - 24 小时制的小时; 如: "00" 至 "23"   
		g - 12 小时制的小时，不足二位不补零; 如: "1" 至 12"   
		G - 24 小时制的小时，不足二位不补零; 如: "0" 至 "23"   
		
		i - 分钟; 如: "00" 至 "59"   
		
		j - 几日，二位数字，若不足二位不补零; 如: "1" 至 "31"  
		 
		l - 星期几，英文全名; 如: "Friday"   
		
		F - 月份，英文全名; 如: "January"   
		m - 月份，二位数字，若不足二位则在前面补零; 如: "01" 至 "12"   
		n - 月份，二位数字，若不足二位则不补零; 如: "1" 至 "12"   
		M - 月份，三个英文字母; 如: "Jan"   
		
		s - 秒; 如: "00" 至 "59"   
		S - 字尾加英文序数，二个英文字母; 如: "th"，"nd"   
		t - 指定月份的天数; 如: "28" 至 "31"   
		U - 总秒数   
		w - 数字型的星期几，如: "0" (星期日) 至 "6" (星期六)   
		Y - 年，四位数字; 如: "1999"   
		y - 年，二位数字; 如: "99"   
		z - 一年中的第几天; 如: "0" 至 "365"  
		*/
		//date_create_from_format($format, $time, $object);
	}
	
}

CCDate::test();

?>