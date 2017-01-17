<!DOCTYPE html>
<html>

<head>
	<title>Funny New World</title>
	<meta charset="utf-8" />
</head>
<body>

<?php 

 require_once('./toolkit.php');
CCToolkit::outLine("一 json");
/*

*/
CCToolkit::out("1 最简单的json：数组");
echo "php数组：array(4.1, 3, NULL, true, false, 'hello', new stdClass(), array())<br />";
$arr = array(4.1, 3, NULL, true, false, 'hello', new stdClass(), array());
$json = json_encode($arr);
echo "json_encode(): $json<br />这种形式不通用，因为其他强类型语言不推荐在list中放多种类型的元素";

CCToolkit::out("2 通用json：关联数组");
echo 'php数组：array("浮点"=>4.1, "整数"=>3, "NULL"=>$a, "布尔"=>true, "布尔2"=>false, "字符串"=>"hello"", "对象"=>new stdClass(), "数组"=>array())<br />';
$a = NULL;
class A{
    public $aa = "123";
    private $bb = "abc";
    public function __get($prop){
        if($prop === "bb"){
            return $this->bb;
        }
    }
}
$arr = array("浮点"=>4.1, "整数"=>3, "NULL"=>$a, "布尔"=>true, "布尔2"=>false, "字符串"=>'hello', "obj"=>new A(), "数组"=>array());
$json = json_encode($arr);
echo "json_encode(): <pre>$json</pre>";

CCToolkit::out("3 反序列化：{}反序列化出来的是stdClass Object，[]反序列化出来是array");
$arr2 = json_decode($json);
echo "<pre>";
print_r($arr2);
echo "<br />";
var_dump($arr2->obj);
echo "可以看出，json encode出来实际上丢失了类型信息，所以，decode回来之后只能是stdclass（对应关联数组）和array（对应普通数组）";
echo "</pre>";

CCToolkit::outLine("二 xml：内置SimpleXMLElement");
error_reporting(E_ALL ^ E_NOTICE);
/*
 simplexml_load_string得到的SimpleXMLElement对象，对应根节点
 */
$xml = <<<THE_XML
<animal>
    <type id="123">dog</type>
    <name>snoopy</name>
</animal>
THE_XML;

$xml_object = simplexml_load_string($xml);
//遍历访问
foreach ($xml_object as $element=>$value){
    print $element . ": " . $value . "<br />";
}
//作为对象访问：xml标签作为成员属性
echo $xml_object->type->getName() . "==>" . $xml_object->type;  //dog
echo "<br />";

//xml标签里的属性的访问
echo $xml_object->type->attributes()->id;  //123
echo "<br />";

CCToolkit::outLine("三 xml：内置SimpleXMLElement.xpath()");
//找到所有type标签
echo "<br />xpath('type')<br />";
$type = $xml_object->xpath("type");
foreach ($type as $t){
    echo $t->getName() . "==>" . $t . "<br />";
}
echo "<br />xpath('/animal/*')<br />";
//找到animal下的所有子标签
$children = $xml_object->xpath("/animal/*");
foreach ($children as $ele){
    echo $ele->getName() . "==>" . $ele . "<br />";
}

CCToolkit::outLine("三 xml：复杂点的xml");
$xml = <<<THE_XML
<animal>
    <dog>
        <type id="123">dog</type>
        <name>dog123</name>
    </dog>
    <cat>
        <type id="2">cat</type>
        <name>cat2</name>
    </cat>
    <dog>
        <type id="124">dog</type>
        <name>dog124</name>
    </dog>
</animal>
THE_XML;
$xml_object = simplexml_load_string($xml);
$names = $xml_object->xpath("*/name");
foreach ($names as $ele){
    echo "当前节点：" . $ele->getName() . "=>" . $ele . "<br />";
    $parent = $ele->xpath("..");
    $type = $parent[0]->getName();  //第一个子元素
    echo "$ele($type)<br />";
}

?>
</body>