<?php
require 'DBResult.class.php';

class Mysql
{
	public $conn;
	public $error;
	
	public function Mysql(){
		$this->open("localhost", "root", "123", "cowthan_test1");
	}
	
	public function getMysqlConnection(){
		return $this->conn;
	}
	
	public function createDB($dbname){
		$sql = "create database if not exists " . $dbname;
		mysql_query($sql, $this->conn) or die("不能创建数据库{$dbname}：".mysql_error());
	}
	
	public function open($host, $user, $passwd, $dbname){
		$this->conn = mysql_connect($host, $user, $passwd);
		if(!$this->conn){
			die("连接失败：".mysql_error());
		}
		
		$this->createDB($dbname);
		mysql_select_db($dbname, $this->conn) or die("不能连接数据库{$dbname}：".mysql_error());
	}
	
	public function close(){
		mysql_close($this->conn);
	}
	
	public function createTable($sql){
		return mysql_query($sql) or die("不能创建表：".mysql_error());
		//echo $result;
	}
	public function dropTable($dbname){
		return mysql_query("drop table ".$dbname.";") or die("不能创建表：".mysql_error());
		//echo $result;
	}
	
	public function insert($sql){
		if(mysql_query($sql)){
			return mysql_affected_rows();	
		}// or die("不能插入：".mysql_error());
		else{
			$this->error = mysql_error();
			return NULL;
		}
	}
	
	public function update($sql){
		if(mysql_query($sql)){
			return mysql_affected_rows();
		}// or die("不能修改：".mysql_error());
		else{
			$this->error = mysql_error();
			return NULL;
		}
	}
	
	public function delete($sql){
		if(mysql_query($sql)){
			return mysql_affected_rows();
		}// or die("不能删除：".mysql_error());
		else{
			$this->error = mysql_error();
			return NULL;
		}
	}
	
	public function query($sql){
		$res = mysql_query($sql); // or die("不能查询：".mysql_error());
		if($res){
			$dbResult = DBResult::parse($res, $this->conn);
			return $dbResult;
		}else{
			$this->error = mysql_error();
			return NULL;
		}
		
	}
	
	public function getDBError(){
		return $this->error;
	}
	
}

?>