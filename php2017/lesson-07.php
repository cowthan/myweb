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
CCToolkit::outLine("十一 数据库操作mysql");
CCToolkit::out('1、基本操作');
/*
命令行：
1、 进入mysql：
mysql -h localhost -u root -p然后输入密码

2、创建数据库：
create database if not exists dbname;
drop database if exists dbname;
show databases;
use dbname;

3、创建新用户并授权
grant 权限 on 数据库.表 to 用户名@登陆主机 identified by "密码"
例子：grant select,insert,update,delete on *.* to username@"%" indentified by "123"

4、创建表：
create table tbname (
	id int not null auto_increment,
	name varchar(50) not null default '',
	price double not null default 0.00,
	detail text,
	publishdate date,
	primary key(id),
	index book_name(name),
	index price(price)
)engine=innodb default charset=utf8 auto_increment=1;;
查看表结构：desc tbname;
删除表：drop table tbname;
修改表结构：alter table tbname 字段名  新字段名 int not null; 新字段名后面的就是字段描述了

数据类型：
数值：int（4字节）, tinyint（1字节）, smallint（2字节），mediumint（3字节），bigint（8字节）
数值：float，double，decimal
——1.234存入float(6.1)，被截断成1.2
——decimal(M,D)，占M+2个字节，作为字符串存储，所以不会因四舍五入引入误差，但计算就慢了

文本：varchar(len), char(len)
大文本：text, blob, tinytext, tinyblob, mediumblob, medumtext, longblob, longtext
枚举：enum('A','B','C')
集合：set('A','B','C')

日期：
date：3字节，yyyy-mm-dd  1000-01-01到9999-12-31
time：3字节，hh:mm:ss
datetime: 8字节，yyyy-mm-dd: hh:mm:ss
timestamp: 4字节，YYYYMMDDhhmmss
year: 1字节，YYYY
date_format()函数可以以任何形式显示日期

NULL：没有值，空值

约束：

unsigned：数值类型，不能出现负数，-128到127的范围变成0到255
zerofill：数值类型，int(3) zerofill的字段，5查出来就是005，用0填充
auto_increment：
not null
default
unique

索引：
主键索引：primary key
唯一索引：unique
常规索引：index，别太多
全文索引：fulltext

主键：

外键：

注意：
——不定长表需要经常运行optimize table来保持性能，定长表就不用
——定长占空间多，空也占，但效率高
——变长表到定长表的转换，需要用一个alter语句同时转换，不能一个一个来，否则没用
——定长最长是255
——对于没法使用定长的部分，可以将表拆分，定长和变长分开

5、增，删，改：
insert into book values(null, '', 12);
insert into book(字段1，字段2，字段3) values(值1， 值2， 值3);

update book set 字段1=值1, 字段2=值2 where id = 2;

delete from book where id='1';

6、查询：

select f1, f2 from tbname where id=1;
select distinct age from tbname;
select price*0.8 '打折价' from tbname;

select a.id, b.name from t1 a, t2 b;

select bookid, bookname, price from books
	where bookid in (select bookid from carts where userid='1')

where子句：
and, or, xor, not
<>就是!=
is null
is not null
between 1 and 10
not between
like '%dd%'： %表示0或任意个字符，下划线表示一个字符
not like
in (v1,v2,v3)

order子句：排序
desc：降序
asc：升序，默认

limit子句：限定行数
limit 0,5表示从第一行开始算，取5条，相当于limit 5
参数是起始行， 从0开始算，参数2是限定条数

统计函数：
count(f)：行数
sum()：和
avg()：平均
max()
min()
select count(*) from books;

group子句：分组
——group by f1, f2：先根据字段1进行分组，再在分好的组内根据字段2分组
——统计函数根据分组来，有几组就返回几列值

php的mysql操作：

1、连接：
$link = mysql_connect("主机名","账号","密码");
if(!$link){
    die("连接失败：".mysql_error());
}

mysql_select_db("bookstore", $link) or die("不能连接数据库bookstore：".mysql_error());

//--可以执行所有sql语句
$result = mysql_query($sql, $link);

//--如果是增删改，感兴趣的是影响行数
if($result && mysql_affected_rows($link) > 0){
	
}else{

}

//--如果是查询，就要解析返回结果


mysql_close($link);

--------------------------------------------------------
查询结果$result解析：
$result = mysql_query("select * from table");
$rows = mysql_num_rows($result);


 */
?>

</body>