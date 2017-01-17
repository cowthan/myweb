<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

 require_once('./toolkit.php');

$path = "j:/aa.txt";


CCToolkit::outLine("十 文件操作");
CCToolkit::outLine("要运行本页面，请在J盘创建个aa.txt，放个几行内容");
/*

1 打开文件：
fopen($filename, "r");
参数1是路径，参数2是打开模式
r是只读
w是写，有则覆盖，无则创建
a是追加，无则创建

一般可以：
$fp = fopen("webdictionary.txt", "r") or die("Unable to open file!");
var_dump($fp);  ///resource(4, stream)

打开模式：
读模式：
r	打开文件为只读， 文件指针在文件的开头开始。

写模式：
w	打开文件为只写。删除文件的内容或创建一个新的文件，如果它不存在。文件指针在文件的开头开始。
a	打开文件为只写。文件中的现有数据会被保留。文件指针在文件结尾开始。创建新的文件，如果文件不存在。
x	创建新文件为只写。返回 FALSE 和错误，如果文件已存在。

混合模式：
r+	打开文件为读/写、文件指针在文件开头开始。
w+	打开文件为读/写。删除文件内容或创建新文件，如果它不存在。文件指针在文件开头开始。
a+	打开文件为读/写。文件中已有的数据会被保留。文件指针在文件结尾开始。创建新文件，如果它不存在。
x+	创建新文件为读/写。返回 FALSE 和错误，如果文件已存在。

 */
CCToolkit::out("1、打开文件，和fp类型");
$fp = fopen($path, "r") or die("Unable to open file!");
var_dump($fp);  ///resource(4, stream)
fclose($fp);

CCToolkit::out("2、fread方法：读取指定字节数的内容");
$fp = fopen($path, "r") or die("Unable to open file!");
$s = fread($fp, filesize($path));
echo $s . "<br/>";  ///换行被自动去掉了？当然也可能是\n在网页没换行
fclose($fp);

CCToolkit::out("3、fgets，feof，rewind：获取单行，需要配合内部指针");
$fp = fopen($path, "r") or die("Unable to open file!");
while(!feof($fp)){
    echo fgets($fp) . "<br />"; //没有读出最后的换行符？当然也可能是\n在网页没换行
}
CCToolkit::out("第二遍");
rewind($fp);
while(!feof($fp)){
    echo fgets($fp) . "<br />"; //没有读出最后的换行符？当然也可能是\n在网页没换行
}
echo  "<br />";
fclose($fp);

CCToolkit::out("4、readfile：直接读取文件，不需要显式open和close");
echo readfile($path);
echo  "<br />";

CCToolkit::out("5、fgetc：获取单个字符");
$fp = fopen($path, "r") or die("Unable to open file!");
while(!feof($fp)){
    $c = fgetc($fp);
    if($c === "\n"){
        $c = "--n--";
    }elseif($c === "\r"){
        $c = "--r--";
    }elseif($c === "\r\n"){
        $c = "--rn--";  ///windows换行是\r\n，但是一个一个读出来的，不会直接出来个\r\n
    }elseif($c === "\n\r"){
        $c = "--nr--";
    }
    echo $c; //没有读出最后的换行符？当然也可能是\n在网页没换行
}
echo  "<br />";

CCToolkit::out("6、file_get_contents：直接读取文件，不需要显式open和close");
echo file_get_contents($path);
echo  "<br />";

/*
下面是实现Iterator接口，通过foreach逐行读文件的一个例子：
*/
class FileIterator implements Iterator{
	private $fp;
	private $index = 0;
	private $line;

	function __construct($filename){
        $fp = fopen($filename, "r");
        if(!$fp){
            die("Cannot open $filename for reading!<br/>");
        }
        $this->fp = $fp;
        $this->line = rtrim(fgets($this->fp), "\n");
	}
	/* (non-PHPdoc)
     * @see Iterator::current()
     */
    public function current()
    {
        echo "----current";
        return $this->line;        
    }

	/* (non-PHPdoc)
     * @see Iterator::next()
     */
    public function next()
    {
        echo "----next";
        if(feof($this->fp)){
            return NULL;
        }
        
        $this->index++;
        $this->line = rtrim(fgets($this->fp), "\n");
        return $this->line;
    }

	/* (non-PHPdoc)
     * @see Iterator::key()
     */
    public function key()
    {
        echo "----key--";
        return $this->index;        
    }

	/* (non-PHPdoc)
     * @see Iterator::valid()
     */
    private $already_be_eof = false;
    public function valid()
    {
        echo "----valid";
        if($this->already_be_eof){
            return false;
        }else{
            if(feof($this->fp)){
                $this->already_be_eof = true;
            }
            return true;
        }
//         return feof($this->fp) ? false: true;        
    }

	/* (non-PHPdoc)
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        echo "----rewind";
        $this->index = 0;
        rewind($this->fp);
        $this->line = rtrim(fgets($this->fp), "\n");
    }
    
    

}

CCToolkit::out("7、自定义的文件内容遍历类");
$x = new FileIterator($path);
foreach ($x as $lineno => $val){
    print "$lineno:\t$val<br/>";
}

CCToolkit::out("8、其他读文件的方式");
/*
fgetcsv()	从打开的文件中解析一行，校验 CSV 字段。	
fgetss()	从打开的文件中读取一行并过滤掉 HTML 和 PHP 标记。	
file()	把文件读入一个数组中。	
fpassthru()	从打开的文件中读数据，直到 EOF，并向输出缓冲写结果。
 */

CCToolkit::out("9、写文件");
/*
fflush()	向打开的文件输出缓冲内容。	4
file_put_contents()	将字符串写入文件。	5
fputcsv()	将行格式化为 CSV 并写入一个打开的文件中。	5
fputs()	fwrite() 的别名。	3
fwrite()	写入文件。
 */

CCToolkit::out("10、文件指针");
/*
fseek()	在打开的文件中定位。	3
ftell()	返回文件指针的读/写位置	3
rewind()	倒回文件指针的位置。	3
*/

CCToolkit::out("11、路径相关");
/*
basename()	返回路径中的文件名部分。	3
dirname()	返回路径中的目录名称部分
pathinfo()	返回关于文件路径的信息。
realpath()	返回绝对路径名。	4
*/
echo basename("J:/aa.txt");   //aa.txt
echo dirname("J:/aa.txt");   //J:\
echo realpath("J:/aa.txt");   //J:\aa.txt
print_r(pathinfo("J:/aa.txt"));   //Array ( [dirname] => J:\ [basename] => aa.txt [extension] => txt [filename] => aa ) 

CCToolkit::out("12、文件操作");
/*
copy()	复制文件。	3
delete()	参见 unlink() 或 unset()。
tempnam()	创建唯一的临时文件。	3
tmpfile()	建立临时文件。	3
rename()	重名名文件或目录。	3
*/

CCToolkit::out("13、目录操作");
/*
disk_free_space()	返回目录的可用空间。	4
disk_total_space()	返回一个目录的磁盘总容量。	4
diskfreespace()	disk_free_space() 的别名。	3
mkdir()	创建目录。
rename()	重名名文件或目录。	3
rmdir()	删除空的目录。	3
*/

CCToolkit::out("14、文件属性");
/*
fileatime()	返回文件的上次访问时间。	3
filectime()	返回文件的上次改变时间。	3
filegroup()	返回文件的组 ID。	3
fileinode()	返回文件的 inode 编号。	3
filemtime()	返回文件的上次修改时间。	3
fileowner()	文件的 user ID （所有者）。	3
fileperms()	返回文件的权限。	3
filesize()	返回文件大小。	3
filetype()	返回文件类型。	3
file_exists()	检查文件或目录是否存在。	3
fstat()	返回关于一个打开的文件的信息。
stat()	返回关于文件的信息。	3

touch()	设置文件的访问和修改时间。	3

is_dir()	判断指定的文件名是否是一个目录。	3
is_executable()	判断文件是否可执行。	3
is_file()	判断指定文件是否为常规的文件。	3
is_link()	判断指定的文件是否是连接。	3
is_readable()	判断文件是否可读。	3
is_writable()	判断文件是否可写。	4
is_writeable()	is_writable() 的别名。	3
*/

CCToolkit::out("15、权限管理");
/*
chgrp()	改变文件组。	3
chmod()	改变文件模式。	3
chown()	改变文件所有者。	3
umask()	改变文件的文件权限。	3
*/

CCToolkit::out("16、其他");
/*

其他
clearstatcache()	清除文件状态缓存。	3
set_file_buffer()	设置已打开文件的缓冲大小。	3
flock()	锁定或释放文件。	3
fnmatch()	根据指定的模式来匹配文件名或字符串。	4 
fscanf()	根据指定的格式对输入进行解析。
ftruncate()	将文件截断到指定的长度。
glob()	返回一个包含匹配指定模式的文件名/目录的数组。	4

硬链接，符号连接相关：
link()	创建一个硬连接。	3
linkinfo()	返回有关一个硬连接的信息。	3
lstat()	返回关于文件或符号连接的信息。	3
readlink()	返回符号连接的目标。
symlink()	创建符号连接。	3
unlink()	删除文件。	3

文件上传
is_uploaded_file()	判断文件是否是通过 HTTP POST 上传的。	3
move_uploaded_file()	将上传的文件移动到新位置。	4
parse_ini_file()	解析一个配置文件。	4

进程相关
pclose()	关闭有 popen() 打开的进程。	3
popen()	打开一个进程。	3
 */

CCToolkit::out("17、标准输入流，输出流，错误输出流");
/*

参考：http://www.cnblogs.com/thinksasa/archive/2013/02/27/2935158.html

输入流：从命令行输入
$stdin = fopen('php://stdin', 'r');
$line = trim(fgets($stdin));  //从stdin读取一行
fscanf($stdin, "%d\n", $number); //从stdin读取一个整数

///循环读取
while($line = fopen('php://stdin','r')){
    echo fgets($line);
}

输出到命令行：
$stdout = fopen('php://stdout', 'w');
$stderr = fopen('php://stderr', 'w');

 */
$file = fopen('php://stdout', 'w');
fwrite($file, "1111111111111");
fflush($file);

?>

</body>