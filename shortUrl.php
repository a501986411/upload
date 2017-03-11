<?php
header('Content-Type:text/json;charset=utf-8');
echo getShortUrl($_POST['url']);
function getShortUrl($lUrl){
    $rData = json_decode(CURLQueryString('http://api.t.sina.com.cn/short_url/shorten.json?source=3271760578&url_long='.$lUrl,'get'),true);
    $res['s_url'] = $rData[0]['url_short'];
    //返回json数据
    return json_encode($res);
}


function CURLQueryString($url){
    //设置附加HTTP头
    $addHead=array("Content-type: application/json");
    //初始化curl
    $curl_obj=curl_init();
    //设置网址
    curl_setopt($curl_obj,CURLOPT_URL,$url);
    //附加Head内容
    curl_setopt($curl_obj,CURLOPT_HTTPHEADER,$addHead);
    //是否输出返回头信息
    curl_setopt($curl_obj,CURLOPT_HEADER,0);
    //将curl_exec的结果返回
    curl_setopt($curl_obj,CURLOPT_RETURNTRANSFER,1);
    //设置超时时间
    curl_setopt($curl_obj,CURLOPT_TIMEOUT,120);
    //执行
    $result=curl_exec($curl_obj);
    //关闭curl回话
    curl_close($curl_obj);
    return $result;
}