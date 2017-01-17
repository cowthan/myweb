<?php
class UploadProcessor {
	private $fileName; // 文件名
	private $fileType; // 文件类型
	private $fileSize; // 文件的大小
	private $fileTemp; // 临时文件
	private $error; // 上传是否有错误
	private $maxSize; // 允许的最大上传文件尺寸
	private $directory; // 文件最终存储目录
	private $newName; // 规定存储在数据库的文件名
	private $arrType = array (); // 构造允许上传的文件类型
	private $sMsg; // 文件上传状态信息
	public function __construct($fileField, $maxSize, $directory, $name = '') {
		$this->maxSize = $maxSize;
		$this->directory = $directory;
		$this->setArray ();
		foreach ( $fileField ['name'] as $key => $filename ) {
			$this->newName = empty ( $name [$key] ) ? time () : $name [$key];
			$this->fileName = $filename;
			$this->fileTemp = $fileField ['tmp_name'] [$key];
			$this->error = $fileField ['error'] [$key];
			$this->fileSize = $fileField ['size'] [$key];
			$this->fileType = $fileField ['type'] [$key];
			$msg = $this->uploading ();
			$this->sMsg .= $msg ? "{$filename}{$msg}" : "{$filename}上传成功";
			$this->sMsg .= "<br/>";
		}
		echo $this->sMsg;
	}
	
	
	
	public function uploading() {
		if ($this->error == 0) {
			if ($this->fileSize <= $this->maxSize) {
				if (in_array ( $this->fileType, $this->arrType )) {
					if (file_exists ( $this->directory )) {
						return $this->moveuploadedfile ();
					} else {
						if (mkdir ( $this->directory, 0775 )) {
							return $this->moveuploadedfile ();
						} else {
							return '无法找到' . $this->directory . '目录';
						}
					}
				} else {
					return '上传不支持' . $this->fileType . '类型';
				}
			} else {
				return '上传图片失败，请确认你的上传文件不超过 ' . $this->maxSize;
			}
		} else if ($this->error == 1) {
			return '上传文件过大PHP';
		} else if ($this->error == 2) {
			return '上传文件过大HTML';
		} else if ($this->error == 3) {
			return '文件只有部分被上传';
		} else if ($this->error == 4) {
			return '没有文件被上传';
		} else if ($this->error == 5) {
			return '找不到临时文件夹';
		} else if ($this->error == 7) {
			return '文件写入失败';
		} else {
			return '未知错误，请重新上传文件';
		}
	}
	private function moveuploadedfile() {
		$ext = substr ( $this->fileName, strrpos ( $this->fileName, '.' ) );
		$name = $this->newName . $ext;
		$dir = str_replace ( '//', '/', $this->directory . '/' . $name );
		$dir = str_replace ( '\\', '/', $this->directory . '/' . $name );
		if (move_uploaded_file ( $this->fileTemp, $dir )) {
			return false;
		} else {
			return '上传图片失败，请确认你的上传文件不超过 ' . $this->maxSize . 'k或上传时间超时';
		}
	}
	private function setArray() {
		$this->arrType = array ('image/jpg', 'image/gif', 'image/bmp', 'image/png', 'image/jpeg' );
	}
	
	///===教材里提供的上传文件的处理代码===///
	/*<input type="file" name="myfile1[]"><br />
	 <input type="file" name="myfile1[]"><br />
	<input type="file" name="myfile2"><br />
	*/
	public function processUploads(){
		foreach ($_FILES as $param_name=>$value){
			$this->processUpload($param_name);
		}
	}
	
	private function processUpload($param_name){
		$file_count = 0;
		if(is_array($_FILES[$param_name]["name"])){
			//说明是name="myfile1[]"的情况
			$file_count = count($_FILES[$param_name]["name"]);
			for($i = 0; i < $file_count; $i++){
				$name = $_FILES[$param_name]["name"][i];
				$type = $_FILES[$param_name]["type"][i];
				$tmp_name = $_FILES[$param_name]["tmp_name"][i];
				$error = $_FILES[$param_name]["error"][i];
				$size = $_FILES[$param_name]["size"][i];
				
				$this->processSingleFile($name, $size, $type, $error, $tmp_name);
			}
		
		}else{
			$name = $_FILES[$param_name]["name"][i];
			$type = $_FILES[$param_name]["type"][i];
			$tmp_name = $_FILES[$param_name]["tmp_name"][i];
			$error = $_FILES[$param_name]["error"][i];
			$size = $_FILES[$param_name]["size"][i];
			$this->processSingleFile($name, $size, $type, $error, $tmp_name);
		}
	}
	
	private function processSingleFile($raw_name, $size, $type, $error, $tmp_name){
		echo "----文件上传：{$raw_name}，大小为{$size}，类型为{$type}，临时存储在:{$tmp_name}，错误码是：{$error}<br />";
		
		$allowtype = array("gif", "png", "jps");
		$limit_size = 1000 * 1000;  //byte，1000Byte是1K，1000个1K是1M
		$path = "./upload/";  //上传文件的存储路径

		//判断是否成功上传
		$error_infos = array("上传成功", "超出上传文件大小限制", "超出post参数大小限制", "文件只被部分上传", "没有上传文件");
		if($error > 0){
			echo $error_infos[$error];
			return;
		}
		
		//判断文件类型是否允许
		$suffix = array_pop(explode(".", $raw_name));
		if(!in_array($suffix, $allowtype)){
			echo "不是允许的类型！";
			return;
		}
		//或者：
		list($maintype, $subtype) = explode("/", $type);
		if($maintype == "text"){
			echo "不允许上传文本文件!";
			return;
		}
		
		//判断大小是否超限
		if($size > $limit_size){
			echo "超出了文件限制大小！";
			return;
		}

		//判断输出目录在不在
		if(!file_exists ( $path )){
			if (!mkdir($path, 0775 )){
				echo "存储目录不存在，且无法创建！";
				return;
			}
		}
		
		//拼新文件名：即为了系统安全，又为了同名文件不被覆盖：
		$filename = date(YmsHis).rand(100, 999)."."."$suffix";
		$out_path = $path.$filename;
		
		//判断是否上传的文件
		if(is_uploaded_file($tmp_name)){
			echo "非法文件！";
			return;
		}
		
		if(!move_uploaded_file($tmp_name, $out_path)){
			echo "无法处理上传文件！";
			return;
		}else{
			echo "上传文件成功：" + $out_path;
		}
	}
}

/*
 --------------php关于文件上传的配置：
 1、file_uploads：默认ON，是否接受文件上传
 2、upload_max_filesize：默认2M，上传文件大小限制，必须小于post_max_size
 3、post_max_size：默认8M，通过post方式提交参数的最大值，包括参数和文件上传的总大小
 4、upload_tmp_dir：上传文件的临时路径，默认NULL，即你能通过php代码处理之前，文件必须被确实的上传到服务器某个位置，然后你才能判断大小，类型，移动到指定目录
 
 ---------------php上传文件的全局数组：$_FILES
 $_FILES["myfile"]["name"]：客户端文件的原名，包括扩展名
 $_FILES["myfile"]["size"]：已上传文件的大小
 $_FILES["myfile"]["tmp_name"]：上传到服务器之后在服务器的临时文件名，存储在临时目录里
 $_FILES["myfile"]["error"]：错误码，0-成功； 1-文件过大，超出upload_max_filesize；2-post参数总大小太大；3-文件只被部分上载；4-没有上传任何文件
 $_FILES["myfile"]["type"]：上传文件的MIME类型
 其中：myfile是
 <inout type="file" name="myfile" />中的name
 
 -----对于html：
 <input type="file" name="myfile[]"><br />
 <input type="file" name="myfile[]"><br />
 <input type="file" name="myfile[]"><br />
 
 ------print_r($_FILES)结果是：
 Array(
 
 	[myfile] =>(
 		 [name]  =>Array(0=>11.jpg,  1=>22.jpg,  2=>33.jpg) 表示上传的三个文件
 		 [type]    =>Array(0=>img/jpg, 1=>img/jpg, 2=>img/jpg) 表示三个文件的类型
 		 [tmp_name]=>Array(0=>临时路径，绝对路径, 1=>xx, 2=>xx) 上传到服务器后的临时路径：C:/windows/temp/phpad.tmp
		 [error]   =>Array(0=>0, 1=>0, 2=>0)
		 [size]    =>Array(0=>64, 1=>1350, 2=>66560)	 		
 	)
 )
 仔细一研究，这是所有html控件的name都是myfile，要是不一样，则：
 Array(
 	
 	[file1]=>Array(
 		name => xx.jpg
 		type =>ddd
 		..
 	)
 	[file2]=>Array(
 		name => yy.jpg
 		type =>ddd
 		..
 	)
 	...
 
 )
 这样你就知道怎么写上传文件的代码了
 
 ----------------php关于文件上传的函数：
 1、is_upload_file(filename)：true表示是通过http上传的，可以用于防止非法途径上传
 2、move_uploaded_file(filename, destination)：将文件移动到指定位置
 	——copy和move函数也可以，但是这个函数提供了额外的检查
 
 */
?>