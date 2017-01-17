<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

 require_once('./toolkit.php');

CCToolkit::outLine("一 字符串");
CCToolkit::out("1、字符转义：高级编程3.4.3");


CCToolkit::out("2、Nowdoc, Heredoc");
/*

长文本

Heredoc中的$会被进一步解析成变量
Nowdoc中的$不会进一步解析，5.3才有

这俩开头的空格好像都被忽略了

 */

$a = "haha";

///  Heredoc
$string = <<<EOT
		这里可以放一串非常长的文本，长文本嘛<br/>
--$a
EOT;

echo "Heredoc: <br />$string<br/><br/>";

///  Nowdoc
$string = <<<'EOT'
		这里可以放一串非常长的文本，长文本嘛<br/>
--$a
EOT;

echo "Nowdoc: <br />$string<br /><br/>";


CCToolkit::out('3、常用函数');
/*

1 查找：
（1）查找字符串的首次出现
strstr(src, "要查找的子串", before_search);
stristr() 忽略大小写

参数3：true返回被查找的子串之前的部分，false就返回被查找的子串
echo strstr("I love Shanghai! it's true","Shanghai", false);  //返回：Shanghai! it's true
echo strstr("I love Shanghai! it's true","Shanghai", true);  //返回：I love 
找不到返回空字符串，找到了就返回被查找子串之前的字符串，或者之后的（之后的字符串也会包含被查找的子串）

（2）查找字符串首次出现的位置：strpos

strpos：大小写敏感
stripos：忽略大小写
strrpos：查找最后一次出现的位置

返回下标，或者false
$src = "12345671234567123";
$needle = "7";
echo strpos($src, $needle);  //6
echo strpos($src, $needle, 6); //还是输出6， 参数3是从下标6算起，包含下标6
echo strpos($src, $needle, 7); //13

（3）有没有：startWith, endWith, contains

虽然都可以通过strpos来实现

2 截取：
（1）substr($str, $start, $len)：  截取
 从str的下标为start的位置，截取长度为len的字符串
 参数3可选，默认是截取到末尾
 参数2如果是0，则从头开始截取，如果是负数，则绕着str转，即最后一个字符是-1
 
 关于参数3：可能是负数
 ——如果是负数，则参数3的意思相当于end，但不包含下标是end的字符
 ——如果是正数，就当作长度来理解
 
echo substr("abcdef", 0, -1); // 返回 "abcde"
echo substr("abcdef", 2, -1); // 返回 "cde"
echo substr("abcdef", 2, 4); // 返回 "cdef"
echo substr("abcdef", 4, -4); // 返回 ""
echo substr("abcdef", -3, -1); // 返回 "de"
 
 （2）掐头去尾
 ----trim()：去掉开头和末尾的空白，
 ----rtrim()：去掉右侧空白
 ----ltrim()：去掉左侧空白
    参数1是str
    参数2是去掉哪些个字符，
        默认是
        \0-NULL  
        \t-制表符
        \n-换行
        \x0B-垂直制表符
        \r-回车
        " "-空格  
 
 3 长度：strlen()：字符串长度
 
 4 格式化
 ----sprintf($format_str, $arg1....)：格式化字符串，必须和C一样啊
 ----printf()：格式化占位符参考高级编程152
 ----number_format()：专门格式化数字，比如货币什么的
 
 5 编码
 ----chr(int ascii)：返回ascii码对应的字符,反义词是ord()
  

所有：
addcslashes()	返回在指定的字符前添加反斜杠的字符串。
addslashes()	返回在预定义的字符前添加反斜杠的字符串。
bin2hex()	把 ASCII 字符的字符串转换为十六进制值。
chop()	删除字符串右侧的空白字符或其他字符。
chr()	从指定的 ASCII 值返回字符。
chunk_split()	把字符串分割为一系列更小的部分。
convert_cyr_string()	把字符串由一种 Cyrillic 字符集转换为另一种。
convert_uudecode()	解码 uuencode 编码字符串。
convert_uuencode()	使用 uuencode 算法对字符串进行编码。
count_chars()	返回有关字符串中所用字符的信息。
crc32()	计算字符串的 32 位 CRC。
crypt()	单向的字符串加密法（hashing）。
explode()	把字符串打散为数组。
fprintf()	把格式化的字符串写入到指定的输出流。
get_html_translation_table()	返回由 htmlspecialchars() 和 htmlentities() 使用的翻译表。
hebrev()	把希伯来文本转换为可见文本。
hebrevc()	把希伯来文本转换为可见文本，并把新行（\n）转换为 <br>。
hex2bin()	把十六进制值的字符串转换为 ASCII 字符。
html_entity_decode()	把 HTML 实体转换为字符。
htmlentities()	把字符转换为 HTML 实体。
htmlspecialchars_decode()	把一些预定义的 HTML 实体转换为字符。
htmlspecialchars()	把一些预定义的字符转换为 HTML 实体。
implode()	返回由数组元素组合成的字符串。
join()	implode() 的别名。
lcfirst()	把字符串的首字符转换为小写。
levenshtein()	返回两个字符串之间的 Levenshtein 距离。
localeconv()	返回本地数字及货币格式信息。
ltrim()	移除字符串左侧的空白字符或其他字符。
md5()	计算字符串的 MD5 散列。
md5_file()	计算文件的 MD5 散列。
metaphone()	计算字符串的 metaphone 键。
money_format()	返回格式化为货币字符串的字符串。
nl_langinfo()	返回特定的本地信息。
nl2br()	在字符串中的每个新行之前插入 HTML 换行符。
number_format()	以千位分组来格式化数字。
ord()	返回字符串中第一个字符的 ASCII 值。
parse_str()	把查询字符串解析到变量中。
print()	输出一个或多个字符串。
printf()	输出格式化的字符串。
quoted_printable_decode()	把 quoted-printable 字符串转换为 8 位字符串。
quoted_printable_encode()	把 8 位字符串转换为 quoted-printable 字符串。
quotemeta()	引用元字符。
rtrim()	移除字符串右侧的空白字符或其他字符。
setlocale()	设置地区信息（地域信息）。
sha1()	计算字符串的 SHA-1 散列。
sha1_file()	计算文件的 SHA-1 散列。
similar_text()	计算两个字符串的相似度。
soundex()	计算字符串的 soundex 键。
sprintf()	把格式化的字符串写入变量中。
sscanf()	根据指定的格式解析来自字符串的输入。
str_getcsv()	把 CSV 字符串解析到数组中。
str_ireplace()	替换字符串中的一些字符（对大小写不敏感）。
str_pad()	把字符串填充为新的长度。
str_repeat()	把字符串重复指定的次数。
str_replace()	替换字符串中的一些字符（对大小写敏感）。
str_rot13()	对字符串执行 ROT13 编码。
str_shuffle()	随机地打乱字符串中的所有字符。
str_split()	把字符串分割到数组中。
str_word_count()	计算字符串中的单词数。
strcasecmp()	比较两个字符串（对大小写不敏感）。
strchr()	查找字符串在另一字符串中的第一次出现。（strstr() 的别名。）
strcmp()	比较两个字符串（对大小写敏感）。
strcoll()	比较两个字符串（根据本地设置）。
strcspn()	返回在找到某些指定字符的任何部分之前，在字符串中查找的字符数。
strip_tags()	剥去字符串中的 HTML 和 PHP 标签。
stripcslashes()	删除由 addcslashes() 函数添加的反斜杠。
stripslashes()	删除由 addslashes() 函数添加的反斜杠。
stripos()	返回字符串在另一字符串中第一次出现的位置（对大小写不敏感）。
stristr()	查找字符串在另一字符串中第一次出现的位置（大小写不敏感）。
strlen()	返回字符串的长度。
strnatcasecmp()	使用一种"自然排序"算法来比较两个字符串（对大小写不敏感）。
strnatcmp()	使用一种"自然排序"算法来比较两个字符串（对大小写敏感）。
strncasecmp()	前 n 个字符的字符串比较（对大小写不敏感）。
strncmp()	前 n 个字符的字符串比较（对大小写敏感）。
strpbrk()	在字符串中查找一组字符的任何一个字符。
strpos()	返回字符串在另一字符串中第一次出现的位置（对大小写敏感）。
strrchr()	查找字符串在另一个字符串中最后一次出现。
strrev()	反转字符串。
strripos()	查找字符串在另一字符串中最后一次出现的位置（对大小写不敏感）。
strrpos()	查找字符串在另一字符串中最后一次出现的位置（对大小写敏感）。
strspn()	返回在字符串中包含的特定字符的数目。
strstr()	查找字符串在另一字符串中的第一次出现（对大小写敏感）。
strtok()	把字符串分割为更小的字符串。
strtolower()	把字符串转换为小写字母。
strtoupper()	把字符串转换为大写字母。
strtr()	转换字符串中特定的字符。
substr()	返回字符串的一部分。
substr_compare()	从指定的开始位置（二进制安全和选择性区分大小写）比较两个字符串。
substr_count()	计算子串在字符串中出现的次数。
substr_replace()	把字符串的一部分替换为另一个字符串。
trim()	移除字符串两侧的空白字符和其他字符。
ucfirst()	把字符串中的首字符转换为大写。
ucwords()	把字符串中每个单词的首字符转换为大写。
vfprintf()	把格式化的字符串写到指定的输出流。
vprintf()	输出格式化的字符串。
vsprintf()	把格式化字符串写入变量中。
wordwrap()	打断字符串为指定数量的字串
 
 */

echo "-" . strstr("I love Shanghai! it's true","Shanghai", false) . "-";
echo "<br />";
echo strstr("I love Shanghai! it's true","Shanghai", true) . "-";

echo "<br />";
echo "<br />";

$src = "12345671234567123";
$needle = "7";
echo strpos($src, $needle);  //6
echo strpos($src, $needle, 6); //还是输出6， 参数3是从下标6算起，包含下标6
echo strpos($src, $needle, 7); //13
echo "<br />";
echo strpos($src, "84", 7) === false; //13

echo "<br />";
echo "<br />";

echo substr("abcdef", 0, -1); // 返回 "abcde"
echo "<br />";
echo substr("abcdef", 2, -1); // 返回 "cde"
echo "<br />";
echo substr("abcdef", 4, -4); // 返回 ""
echo "<br />";
echo substr("abcdef", -3, -1); // 返回 "de"
echo "<br />";

CCToolkit::out('4、正则表达式');
/*
相关函数

1 获取匹配次数：preg_match_all

preg_match($pattern, $subject)：获取匹配次数，实际上一次就返回，匹配到了则返回1，否则返回0，怎么就匹配到了？符合正则表达式就匹配到了
preg_match_all($pattern, $subject)：获取匹配次数，会返回所有的匹配
完全版：preg_match($pattern, $subject, array $matches, $flags, $offset) 

其实就是寻找有几个匹配的子串
但是，如果pattern是以^开头，$结尾，也就是指所需要的匹配是字符串开头和结尾也得符合，所以就变成了对全串进行一次匹配
这里就是说要注意^和$改变了一些东西，在这里甚至改变了函数的语义，请注意

$res = preg_match_all("/\d+/", "123d2sdf23423", $matches);

 参数3：$matches, 需要传入一个空数组，不能为null或未定义
这个会存入所有匹配到的子串，对于preg_match来说，最多就一个

此参数的值最后会被参数3的flag所影响，如果不传flag，则返回：
Array ( [0] => Array ( 
    [0] => 123 
    [1] => 2 
    [2] => 23423 
) ) 

如果flag=PREG_OFFSET_CAPTURE，则会将所以匹配子串的下标也返回：
Array ( [0] => Array ( 
    [0] => Array ( [0] => 123   [1] => 0 ) 
    [1] => Array ( [0] => 2     [1] => 4 ) 
    [2] => Array ( [0] => 23423 [1] => 8 
)) ) 


参数4：如上所述，注意，只接受PREG_OFFSET_CAPTURE

参数5：从指定下标开始搜索索匹配的串
问题，如果是pattern中有^和$，那参数5起作用吗？ 
答案是：这种情况如果指定了参数3，则总是返回0
这个答案不是很准确，也可能是错的，看源代码的文档：
Using offset is not equivalent to passing substr($subject, $offset) to preg_match 
in place of the subject string, because pattern can contain assertions such as ^, 
$ or (?<=x). Compare: ]]> &example.outputs; 

while this example 

]]> 
will produce 

Array ( [0] => def [1] => 0 ) ) ]]> 


2 那啥

preg_split($pattern, $subject)   按照正则指定的子串来分割
preg_replace("正则","替换内容","原字符串") 



3 查找：
$phpddt = array("php点点通","php100","呵呵","hahaha","phpchina");
$item = preg_grep("/^php/",$phpddt);
print_r($item);



 */


CCToolkit::out('正则表达式：preg_match_all');
//$pattern = "/^\d+$/";
$pattern = "/\d+/";
$matches = array();

$flags1 = PREG_PATTERN_ORDER;  ///不能传入这个参数
$flags2 = PREG_SET_ORDER;      ///不能传入这个参数
$flags3 = PREG_OFFSET_CAPTURE; ///只接受这个
$res = preg_match_all($pattern, "123d2sdf23423", $matches, $flags3);
echo $res . "<br />";
print_r($matches);

CCToolkit::out('正则表达式：preg_grep');
$phpddt = array("php点点通0","php100","呵呵","hahaha","phpchina");
$item = preg_grep("/^php/",$phpddt);  //   "/^[php].+[0]$/"就只能匹配php100
print_r($item);  //Array ( [0] => php点点通 [1] => php100 [4] => phpchina ) 

/*
正则怎么拼：

正则元字符：

正则元素：也叫子表达式
一个元素可以是一个数字，字母，或者以下各种形式：
数字
字符
. 表示除了新行的任意一个字符

[]表示字符集任一
[a]   匹配a
[a-z]  匹配a到z的任何一个字母 1次
[a-z1-9] 匹配任意一个小写字母，数字，1次

()表示取所有字符集
c(at)：匹配cat
c[at]：匹配ca或者ct


其中，占位符有以下这些：
\d 数字，等价于[0-9]                                \D --- 非数字
\f   \n  \r \t
\s 匹配任何空白字符，如空格，制表符，换页符                     \S --- 非空格
\w 匹配一个单词，字母和下划线，等价于[A-Za-z0-9_]    \W --- 匹配任何非单词字符

注意，正则的一个元素，也就是子表达式，就是一个完整的上面的东西，[]包含了一个单独的元素
"/^[php].+[0]$/"里面就有3个元素，一个[php]，一个.+，一个[0]

子表达式修饰：重复次数
{n}  重复n次
{n,} 至少重复n次
{n,m}重复n到m次，n必须小于m
*    0-n  {0,}
+    1-n  {1,}
?    0-1  {0,1}

子表达式or：|
x|y： 匹配x或y

子表达式取反：[]内的^
[^xyz]：匹配不上[xyz]的

子表达式说明：放在[]外的，^和$，首位说明
——注意，上面的所有子表达式处理方式都返回一个新的子表达式
——但是这里子表达式说明不会返回一个新的子表达式，而是做了说明
——^说明用这个子表达式去匹配开头
——$说明用这个子表达式去匹配结尾
^[xyz]  以xyz开头
[xyz]$  以xyz结尾


 */

//----------------------------------------------------------------
//----------------------------------------------------------------
CCToolkit::outLine("二 数组和容器");

CCToolkit::out("1、数组创建");
//方法1：下标可以是整数和字符串，其他类型都会转为这两种，整数可以不连续，不给下标则从0开始数
$arr[0] = 1;
$arr[1] = 2;
$arr[2] = 3;
$arr[] = 4;//下标是3，从当前已有下标加1
$arr[] = 5;

//方法2：array函数
$arr = array("1", "2", "3"); //当成数组用，下标分别是0,1,2
$arr = array("1"=>"NanJing", "2"=>"Beijing"); //这是字典
$arr = array(1=>"NanJing", "4"=>"Beijing", "Shanghai"); //Shanghai的下标是5了，从当前最小的开始加
//顺便说一下：$arr[4]和$arr["4"]一样

//方法3：range函数
$arr = range(1, 100); //得到一个数组，元素是1到100

CCToolkit::out("2、数组的遍历");
$arr = array("NanJing", "Beijing", "Shanghai");
//----如果是纯数组，即下标从0开始递加
// 	$len = CCArray::count($arr);
// 	for($idx = 0; $idx < $len; $idx++)
// 	{
// 		echo $arr[$idx]."<br />";
// 	}

	
	
	
array_key_exists("4", $arr);  //arr是否含有key为4的元素 

//----如果是字典，或不连续数组，就得用内置函数来遍历数组
/*
 数组有个内置的指针，指向当前的元素
 key()方法取得当前索引
 current()方法取得当前的值
 next()方法移动到下一个元素，如果到底了，就返回false
 
 而while(list($key, $value) = each($arr)){}就是上面三个的综合，但比使用
 上面三个来遍历要专业，因为while(next($arr))时，即使不是最后一个元素，如果当前
 元素的值是0，也会作为false，遍历会停止。
 
 数组指针的移动：
 --next()，prev()，只要到头了，就返回false
 --reset($arr)：把指针恢复到第一个元素，end()将目前指针指向最后一个
 --each()每调用一次，都会首先返回当前元素，再下移一个，返回的值中有四个元素：
 0=>索引，1=>值，"key"=>索引， "value"=>值
 --current()取得目前指针的位置的内容，key()读取目前指针所指的key值
 
 //----array_walk(数组，处理函数)方法，对每个元素进行处理，处理方式由参数2提供的函数决定
 
 //----foreach：
 foreach($arr as $val){
 	$val是值----遍历的是数组的拷贝，不会有任何潜在的危险，但数组较大时，就得考虑效率问题了
 }
 或foreach($arr as $key=>$val){}
 相当于：
 reset($arr);
 while(list($k, $v) = each($arr)){
 	//但是这个是遍历数组本身，有线程同步的危险，但不需要拷贝数组，是轻量级的
 }
 
 */


CCToolkit::out("3、数组的删除：unset()");
//unset方法导致数组长度减1，并且没有了被unset掉的那个索引， array_values()之后会重新建立索引

CCToolkit::out("4、数组的排序");
$arr = array("A", "b", "1", "10", "2");

/*
sort($arr)--rsort()：对值排序，但如果不是纯数组，会改变索引，变成纯数组
asort($arr)--arsort()：对值排序，但不改变索引，当然推荐这个
ksort()：对索引排序，先ksort再arsort，就可以对索引倒序排

usort(参数1是数组，参数2是自定义比较函数)：自己指定排序规则，对值排序，但key也被变纯了
uasort()：自己指定排序规则，但不改变key
uksort()：对索引排序，但规则自己定

shuffle()：打乱数组，使用随机种子，使用时：
srand(time());
shuffle($arr); //把arr打乱，使用srand给的随机种子
 */

CCToolkit::out($arr);
	
// 	CCToolkit::out(count($arr));
// 	unset($arr[1]);
// 	CCToolkit::out(count($arr));
// 	CCToolkit::out($arr[2]);
	
CCToolkit::out("5、数组操作");
/*
 1、array_content()：将数组变成纯数组，值不变，key变为从0开始算（是生成新数组，原数组保持不变）
 2、array_keys()：返回key的array
 3、in_array("one", $arr)：one是否在数组中，值的包含，参数1也可以是数组，寻找子数组
 4、array_flip()：交换键值
 5、array_reverse()：顺序翻转
 
 6、count()：数组长度
 7、array_count_values()：统计各个元素出现的次数，返回结果也是数组，key是元素，值是出现次数
 8、array_unique()：删除重复值，返回一个没有重复值的新数组
 
 9、array_filter($arr, callback): callback参数是数组一个元素，返回值是bool，表示是否保留此元素
 10、array_walk($arr, callback，参数3可选：附加数据)：走一遍,原来的元素被返回的元素替换,回调的参数是参数是元素的value，参数2是key，参数3就是walk的参数3，附加参数
 11、array_map(callback, $arr)：走一遍，返回一个新数组，根据传入的几个数组，参数2之后是可选个数的数组，回调的参数是这几个数组
 的当前元素，所以长度应该相等
 
 12、array_slice($arr, int start, int len)：纯数组切割后，下标就变了，字典的key不会变， start从0开始，如果是负数，则从右往左算，最右边是－1.所以如果是－2.那就是倒数第二个
 13、array_combine($arr, $arr2)：参数1提供key，参数2提供value，就这么合并成一个新的，所以个数应该相同
 14、array_merge($arr1, $arr2, ...)：将所有数组合并成一个，重复的键回后面覆盖前面，对于纯数组，会重新索引
 15、array_intersect($arr1, $arr2, ...)：交集，仅用于值的比较，出现在所有数组中的值
 16、array_diff($arr1, $arr2,...)：差集，在一个数组中，但不在其他所有数组中

 堆栈：
 17、array_push($arr, $val)：入栈，入数组尾
 18、array_pop($arr)：出栈，返回并弹出栈顶元素，弹数组尾
 
 队列：
 19、array_push()：一样，入队，入数组尾
 20、array_shift()：出队，扭掉数组头
 
 其他：
 21、array_rand()：随机选出一个或多个元素并返回
 22、shuffle()：打乱数组顺序
 23、array_sum()：求和
 24、range（起点，终点，步长）:构造数组，用起点到终点之间到数，步长决定了长度
  
 */

CCToolkit::out("6、排序堆：SplMaxHeap(降序), SplMinHeap(升序)");
function echoLine($msg){
	echo $msg . "<br />";
}


$heap = new SplMinHeap();
$heap->insert('Peter');
$heap->insert('Adam');
$heap->insert('Mladen');
$heap->insert('Nelson');

foreach ($heap as $key => $value) {
	print "$key ==> $value, ";
}

echoLine("<br /><br />排序堆类：自定义排序规则");
class A{
    public $x;
    
    public function __construct($x){
        $this->x = $x;
    }
}

class MyMaxHeap extends SplMaxHeap{
    public function compare(A $x1, A $x2){
        return $x1->x - $x2->x;
    }
}

$arr[0] = new A(1);
$arr[1] = new A(5);
$arr[2] = new A(4);
$arr[3] = new A(6);
$arr[4] = new A(8);

$heap = new MyMaxHeap();
echo "<br />插入顺序：<br />";
foreach ($arr as $v){
    echo $v->x . ", ";
    $heap->insert($v);
}

echo "<br /><br />排序堆顺序（max，降序）：<br />";
foreach ($heap as $v){
    echo $v->x . ", ";
}

//print_r($heap);  //MyMaxHeap Object ( [flags:SplHeap:private] => 0 [isCorrupted:SplHeap:private] => [heap:SplHeap:private] => Array ( ) )


//print join(", ", $heap);  //Warning: join(): Invalid arguments passed ，参数2只接收array
?>

</body>