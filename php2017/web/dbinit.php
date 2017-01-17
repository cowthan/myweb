<?php

	require "./UserInfo.class.php";
	require '../Mysql.class.php';
	
	$mysql = new Mysql();
	$mysql->open("localhost", "root", "123", "cowthan_test1");
	
	$mysql->dropTable(UserInfo::getTableName());
	$mysql->createTable(UserInfo::getCreateTableSQL());
	
	
	$user1 = new UserInfo();
	$user1->username = "user1";
	$user1->passwd = "111";
	$user1->email = "111@163.com";
	$mysql->insert($user1->getInsertSQL());
	
	$user2 = new UserInfo();
	$user2->username = "user2";
	$user2->passwd = "111";
	$user2->email = "222@163.com";
	$mysql->insert($user2->getInsertSQL());
	
	
	$user3 = new UserInfo();
	$user3->username = "user3";
	$user3->passwd = "111";
	$user3->email = "333@163.com";
	$mysql->insert($user3->getInsertSQL());
	
	$result = $mysql->query("select * from userinfo;");
	$mysql->close();
	
	echo "查询行数：" . $result->rows . "<br />";
	while(list($key, $value) = each($result->result)){
		foreach ($value as $v){
			echo $v."   ";
		}
		echo "<br />";
	}

?>