<?php

class UserInfo {

	public $id;
	public $username;
	public $passwd;
	public $gender;
	public $birthday;
	public $age;
	public $phone1;
	public $phone2;
	public $phone3;
	public $email;
	public $addr;
	public $qq;
	public $token;
	
	public $createTime;
	public $lastLoginTime;
	public $lastModifyTime;
	
	public $verifyCode;
	public $verifyCodeTime;
	
	public $isActive;
	public $isForbidden = false;
	
	public $arr = array("a"=>1, "b"=>"dddd");
	
	public static function getCreateTableSQL(){
		$sql = "create table if not exists userinfo
		(	
			id int not null auto_increment,
			username varchar(15) not null unique,
			passwd varchar(20) not null,
			email varchar(50),
			primary key(id)
		)engine=innodb default charset=utf8 auto_increment=1;";
		return $sql;
	}
	
	public static function getTableName(){
		return "userinfo";
	} 
	
	public function getInsertSQL(){
		$sql = "insert into userinfo(username, passwd, email) 
			values('{$this->username}', 
			'{$this->passwd}', 
			'{$this->email}');";
		return $sql;
	}
}
/*
create table userinfo
(
	id int,
  	username varchar(15) not null check(username !=''),
  user_Password char(15) not null,
  user_emial varchar(20) not null unique,
  primary key(user_Name)          
 
)engine=innodb default charset=utf8 auto_increment=1;

*/

?>