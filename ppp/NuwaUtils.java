package com.iwomedia.zhaoyang.util;

import com.iwomedia.zhaoyang.App;
import com.iwomedia.zhaoyang.http.ZYHttp;

import org.ayo.Ayo;
import org.ayo.http.HttpProblem;
import org.ayo.http.callback.BaseHttpCallback;
import org.ayo.http.callback.JsonResponseHandler;
import org.ayo.http.callback.ResponseModel;
import org.ayo.http.download.SimpleDownloader;
import org.ayo.lang.TheApp;

import java.io.File;
import java.io.FileFilter;

import cn.jiajixin.nuwa.Nuwa;

/**
 * 热补丁工具类，通过Url下载补丁包
 * Created by Administrator on 2016/3/1.
 */
public class NuwaUtils {

    public static class PatchInfo{
        public String appName;
        public String packageName;
        public String apkVersion;
        public String patchVersion;
        public String downloadUrl;
        public String patch_file_name;
    }

    public static void loadPatch(final SimpleDownloader.Callback c){

        //先加载上回的补丁
        Nuwa.loadPatch(App.app, new File(getPatchSaveDir(), generatePatchFileName(getCurrentPatchNumber())).getAbsolutePath());

        //下载最新补丁
        String packageName = App.app.getPackageName();
        String apkVersion = TheApp.getAppVersionName();
        String patchVersion = getCurrentPatchNumber() + "";

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

    }

    private static int getCurrentPatchNumber(){
        File patchDir = getPatchSaveDir();
        File[] patches = patchDir.listFiles(new FileFilter() {
            @Override
            public boolean accept(File file) {
                return file.exists() && file.getAbsolutePath().endsWith(".jar");
            }
        });
        if(patches == null || patches.length == 0) return 0;
        int latestPatchNumber = 0;
        for(int i = 0; i < patches.length; i++){
            //com.iwomedia.zhaoyang.modify_2.7.0_patch_1.jar
            String patchNum = patches[i].getName()
                    .replace(".jar", "")
                    .replace(App.app.getPackageName()+"_", "")
                    .replace(TheApp.getAppVersionName()+"_patch_", "");
            int patchNumber = Integer.parseInt(patchNum);
            if(patchNumber > latestPatchNumber){
                latestPatchNumber = patchNumber;
            }
        }
        return latestPatchNumber;
    }

    private static File getPatchSaveDir(){
        String path = Ayo.ROOT + TheApp.getAppVersionName() + "/";
        File f = new File(path);
        if(f.exists()){

        }else{
            f.mkdirs();
        }
        return f;
    }

    private static String generatePatchFileName(int patchVersion){
        return App.app.getPackageName() + "_" + TheApp.getAppVersionName() + "_patch_" + patchVersion + ".jar";
    }
}
