<?php

class DBResult
{
	
	public $rows;
	public $cols;
	public $result;
	
	/**
	 * 
	 * @param $result  就是mysql_query返回的结果
	 * @param $link 就是数据库连接，通过mysql_connect得到的
	 */
	public static function parse($result){
		$res = new DBResult();
		$res->rows = mysql_num_rows($result);
		$res->cols = mysql_num_fields($result);
		
		$res->result; // = array();
		$count = 0;
		while($row = mysql_fetch_assoc($result)){
			$res->result[$count] = $row;
			$count++;
		}
		
		//----------
// 		while(list($key, $value) = each($res->result)){
// 			foreach ($value as $v){
// 				echo $v."   ";
// 			}
// 			echo "<br />";
// 		}
		
		return $res;
	}
}

?>