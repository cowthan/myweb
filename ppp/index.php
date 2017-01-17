<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>热补丁版本管理系统：安卓</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center text-muted">
				热补丁版本管理系统：安卓
			</h3>
			<div class="row">
				<div class="col-md-6">
					<h3>
						简介
					</h3>
					<p class="text-info text-left">
						热补丁版本管理系统，每个应用的每个版本，都对应一个补丁包，不一定有，但肯定不大于一个，手机端请求热补丁的接口是：patchCheck.php<br />
						post请求<br />
						参数：<br />
						——包名：packageName，如com.iwo.daogou<br />
						——apk版本号：apkVersion，如2.7.1<br />
						——已经加载的补丁编号：patchVersion，如1<br />
						<br />
						返回：<br />
						如果没有补丁包，返回{code:1}<br />
						如果有补丁包，返回{code:0, result:{appName, package,apkVersion,patchVersion,downloadUrl}}
						<br />
						<br />
						

部署：<br />
CREATE database if not exists patches CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';<br />
use patches;<br />

create table if not exists patch(<br />
	id int primary key auto_increment,<br />
	appName varchar(200) default '',<br />
	packageName varchar(200) default '',<br />
	apkVersion varchar(200) default '',<br />
	patchVersion int default 0,<br />
	downloadUrl varchar(200) default ''<br />
)engine=innodb default charset=utf8 auto_increment=1;<br />
<br />
<br />
<br />
教程：发布新补丁<br />
1 补丁文件的jar包命名，规则在下面<br />
2 上传补丁文件，复制返回结果中的key值<br />
3 在补全新补丁的表单里，替换掉下载链接中的key，其他对应填好<br />
4 点发布<br />
<br />
补丁文件命名：<br />
包名_版本号_patch_补丁编号.jar<br />

com.iwomedia.zhaoyang.modify_2.7.0_patch_1.jar<br />
<br /><br />

教程：安卓端下载新补丁<br />
1 拿到当前版本的补丁编号，按照接口要求发起请求<br />
2 拿到响应结果，下载文件，文件命名是随机的，你需要改文件名，命名规则如上所述<br />
3 在代码里加载补丁<br />
4 注意，安卓中补丁文件存在哪儿？存在sd/工作目录/版本号/patch.jar

<br />
<br />
<br />

教程：安卓端补丁版本管理<br />
1 nuwa框架的配置请参考：https://github.com/jasonross/Nuwa  <br />
2 使用nuwa必须在debug和release时都打开混淆，可能会有麻烦 <br />
3 Nuwa.init()一定要放在其他所有类被使用之前，问题涉及到hack.apk <br />
4 安卓补丁放在：sd卡/工作目录/版本号/com.iwomedia.zhaoyang.modify_2.7.0_patch_1.jar.jar <br />
5 相关的工具类：<br />
<a href="./SimpleDownloader.java">下载SimpleDownloader.java</a><br />
<a href="./NuwaUtils.java">NuwaUtils.java</a><br />
注意这段代码：
<pre>
ZYHttp.getSBRequest().flag("检查是否有补丁")
                .url("http://172.16.12.101/www/android-hotfix/patchCheck.php")
                .method("post")
                .param("packageName", packageName)
                .param("apkVersion", apkVersion)
                .param("patchVersion", patchVersion)
                .go(new JsonResponseHandler<PatchInfo>(PatchInfo.class), new BaseHttpCallback<PatchInfo>() {
                    @Override
                    public void onFinish(boolean isSuccess, HttpProblem problem, ResponseModel resp, PatchInfo patchInfo) {
                        if(isSuccess){
                            //有新补丁
                            SimpleDownloader.download(patchInfo.downloadUrl, getPatchSaveDir(), patchInfo.patch_file_name, c);
                        }else{
                            //没有新补丁
                        }
                    }
                });
</pre>
替换成你项目里的http框架来实现就行<br />
请求接口，检查是否有新补丁，如果有新补丁，就去下载<br />
<br />
6 使用：<br />
在Application里：<br />
super.onCreate();<br />
Nuwa.init(this); // 这句一定要在super.onCreate()的下面第一句，nuwa官方的sample是，作者是将这句放在了attachBaseContext里，目的都是保证第一行调用这个<br />
<br />
然后找个地方，调下面这个方法：<br />
<pre>
protected void considerPatch() {
		try{
			NuwaUtils.loadPatch(new SimpleDownloader.Callback(){
				@Override
				public void onOk(String savePath) {
					Toast.makeText(App.app, "yes---有补丁包啊", Toast.LENGTH_LONG).show();
					//Nuwa.loadPatch(App.app, savePath);
				}

				@Override
				public void onFuck(String fuckReason) {
					//do nothing
					Toast.makeText(App.app, "no---没有补丁包", Toast.LENGTH_LONG).show();
				}
			});
		}catch (Exception e){
			JLog.i("补丁", "打补丁出错了--" + e.getLocalizedMessage());
			e.printStackTrace();
		}
	}
</pre>
7 最后再说这个不友好的地方：必须开启混淆<br />
开启之后，就没法调试代码了，所以开发时还是关了比较好，打包上线时，再打开<br />
nuwa设计到以下几个地方：<br />
（1）模块gradle里，去掉引库<br />
（2）模块gradle里，去掉apply plugin: "cn.jiajixin.nuwa"<br />
（3）模块gradle里，关掉混淆
（4）根gradle里，去掉classpath 'cn.jiajixin.nuwa:gradle:1.2.2'<br />
（5）代码里：注掉Nuwa.init(this);<br />
（6）代码里：注掉loadPatch方法的实现<br />
<br />
基本流程是：<br />
1 先用nuwa加载当前最新的补丁包<br />
2 然后检查更新<br />
3 如果有更新，就下载下来，作为最新补丁保存<br />
4 下回重启应用时，回到第1步

					</p>
<h3 class="text-left">
						上传补丁文件
					</h3>
	<form method="post" action="http://up.qiniu.com" enctype="multipart/form-data">
          <input name="token" type="hidden" value="uNaQ_NGIZurU3OMxikyGpk-t4v8tIbP8ct5VQs_f:AM6XGfArmAlRekKqbPk-teMuBoU=:eyJzY29wZSI6ImNvd3RoYW4xMTAzIiwiZGVhZGxpbmUiOjE3NjIwMjA4NDB9">
          <input name="file" type="file" />
          <input type="submit" value="上传"/>
        </form>  
					<br />
					<br />

					<h3 class="text-left">
						补全新补丁
					</h3>
					
					<form class="form-horizontal" role="form" action="./submit.php" method="post">
						<div class="form-group">
							 
							<label for="inputEmail3" class="col-sm-2 control-label">
								应用名
							</label>
							<div class="col-sm-10">
								<input type="text" name="appName" aclass="form-control" id="inputEmail3" />
							</div>
						</div>
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								应用包名
							</label>
							<div class="col-sm-10">
								<input type="text" name="packageName" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								版本号
							</label>
							<div class="col-sm-10">
								<input type="text" name="apkVersion" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								补丁编号
							</label>
							<div class="col-sm-10">
								<input type="text" name="patchVersion" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								下载链接
							</label>
							<div class="col-sm-10">
								<input type="text" name="downloadUrl" class="form-control" id="inputPassword3" value="http://7xo0ny.com1.z0.glb.clouddn.com/[请填写上传补丁文件的key]"/>
							</div>
						</div>
						
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								 
								<button type="submit" class="btn btn-primary">
									发布
								</button>
							</div>
						</div>
					</form>

<br />
					<br /><br />

					<h3 class="text-left">
						查找最新补丁
					</h3>
					
					<form class="form-horizontal" role="form" action="./patchCheck.php" method="post">
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								应用包名
							</label>
							<div class="col-sm-10">
								<input type="text" name="packageName" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								版本号
							</label>
							<div class="col-sm-10">
								<input type="text" name="apkVersion" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						<div class="form-group">
							 
							<label for="inputPassword3" class="col-sm-2 control-label">
								手机端最新补丁编号
							</label>
							<div class="col-sm-10">
								<input type="text" name="patchVersion" class="form-control" id="inputPassword3" />
							</div>
						</div>
						
						
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								 
								<button type="submit" class="btn btn-primary">
									查询
								</button>
							</div>
						</div>
					</form>

				</div>
				<div class="col-md-6">
					<h3 class="text-left">
						补丁列表
					</h3>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th>
									应用
								</th>
								<th>
									包名
								</th>
								<th>
									版本号
								</th>
								<th>
									下载
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
//
$sql = "select * from patch;";

require_once("./config.php");
$mysqli=new mysqli();
$mysqli->connect($db_host,$db_user,$db_psw,$db_name);
/////
$result=$mysqli->query($sql);
if ($result){
	 if($result->num_rows>0){
	 	$count = 0;
	 	
	 	while($row =$result->fetch_array()){                        
	 		$c = "";
	 		if($count % 2 == 0){
	 			$c = "active";
	 		}else{
	 			$c = "success";
	 		}
	 		echo "<tr class='$c'>";
	 		//循环输出结果集中的记录
	 		echo ("<td>$count</td>");
            echo ("<td>$row[1]</td>");
            echo ("<td>$row[2]</td>");
            echo ("<td>$row[3]--$row[4]</td>");
            echo ("<td><a href='$row[5]' target='_blank'>下载</a></td>"); //$row[5]
            echo '</tr>';

            $count++;
        }
        
	 }
}
							?>
							<!-- <tr class="active">
								<td>
									1
								</td>
								<td>
									TB - Monthly
								</td>
								<td>
									01/04/2012
								</td>
								<td>
									Approved
								</td>
							</tr>
							<tr class="success">
								<td>
									2
								</td>
								<td>
									TB - Monthly
								</td>
								<td>
									02/04/2012
								</td>
								<td>
									Declined
								</td>
							</tr> --?
							<?php

/////
$mysqli->close();
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>