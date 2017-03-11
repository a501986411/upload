<?php
getToken();
function getToken()
{
    $ak = "23679857";                          //用户控制台的AccessKey
    $sk = "7c4282121c87b1747f1e3364c57fbe2b";                       //用户控制台的AccessSecret
    $namespace = "dir1";                    //用户的空间名namespace
    list($s1, $s2) = explode(' ', microtime());
    //上传策略，开发者可以根据需要，参考文档进行扩展
    $uploadPolicy = array(
        "detectMime" => "1",
        "insertOnly" => "0",
        "namespace"  => $namespace,
        "expiration" => -1,
    );
    $encodedPolicy = encodeWithURLSafeBase64(json_encode($uploadPolicy));//进行安全的Base64编码
    $signed = hash_hmac( 'sha1', $encodedPolicy, $sk);      //计算HMAC-SHA1签名
    $data = $ak . ":" . $encodedPolicy . ":" . $signed;    //拼接ak、上传策略、HMAC-SHA1签名
    $token = "UPLOAD_AK_TOP " . encodeWithURLSafeBase64($data);   //再进行URL安全的Base64编码
    return $token;
}
/**URL安全的Base64编码*/
function encodeWithURLSafeBase64($arg)
{
    if ($arg === null || empty($arg)) {
        return null;
    }
    $data = rtrim(base64_encode($arg), '=' );
    return preg_replace( array("/\r/", "/\n/"), "", $data );
}
try{
    $result = array('state' => 'success' , 'token' => getToken() );
} catch( Exception $e) {
    $result = array('state' => 'failed' , 'message' => $e->getMessage() );
}
echo json_encode($result);
?>