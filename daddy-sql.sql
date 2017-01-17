-----修改mysql的root密码：
use mysql;
UPDATE user SET Password = PASSWORD('123') WHERE user = 'root';
FLUSH PRIVILEGES;

-----允许root账户从任何主机连接到本mysql
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '123' WITH GRANT OPTION;
FLUSH   PRIVILEGES;

----------涵涵
CREATE database if not exists app_hanhan CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
use app_hanhan;

----------合法美女
CREATE database if not exists app_beauty CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
use app_beauty;

----------违法美女
CREATE database if not exists app_sexy CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
use app_sexy;

----------铁塔
CREATE database if not exists tieta CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
use tieta;



show variables like "%char%";
set names utf8;
SET character_set_client='utf8';
SET character_set_connection='utf8';
SET character_set_results='utf8';
SET character_set_server='utf8';

type--1 静态图 2 gif图 3 视频
create table if not exists qiniu_image(
	id int primary key auto_increment,
	bucket varchar(200) default '',
	qiniuKey char(200) default '',
	url char(200) default '',
	type int default 1, 
	thumbSmall varchar(200) default '',
	thumbMiddle varchar(200) default '',
	thumbBig varchar(200) default ''
)engine=innodb default charset=utf8 auto_increment=1;


--===================================仿微博：废弃
create table if not exists weibo(
	id int primary key auto_increment,
	createDevice varchar(200) default '',
	createTime int default '',
	ownerId int default '',
	content varchar(200) default '',
	detailContent varchar(250) default '',
	isForward int default 0,
	forwardWeiboId int default 0,
	
)engine=innodb default charset=utf8 auto_increment=1;


-- ======================================
create table if not exists tieta(
	id int primary key auto_increment,
	name varchar(200) default '',
	status char(200) default '',
	updateTime char(200) default '',
	addr varchar(200) default '',
	photo varchar(200) default ''
)engine=innodb default charset=utf8 auto_increment=1;

insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');
insert into tieta (name, status, updateTime, addr, photo) values('aaaa','bbb','cccc','dddd','eeeeeeeee');


create table if not exists tieta(
	id int primary key auto_increment,
	gongsi varchar(200) default '',
	name varchar(200) default '',
	stateName varchar(200) default '',
	startTime varchar(200) default '',
	endTime varchar(200) default '',
	city varchar(200) default '',
	lat varchar(200) default '',
	lnt varchar(200) default '',
	status varchar(200) default '',
	addr varchar(200) default '',
	motorType varchar(200) default '',
	photo varchar(200) default '',
	thumb varchar(200) default ''
)engine=innodb default charset=utf8 auto_increment=1;

create table if not exists patch(
	id int primary key auto_increment,
	appName varchar(200) default '',
	packageName varchar(200) default '',
	apkVersion varchar(200) default '',
	patchVersion varchar(200) default '',
	downloadUrl varchar(200) default ''
)engine=innodb default charset=utf8 auto_increment=1;