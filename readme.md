## 顽兔多媒体jssdk

* 顽兔html5 js上传组件

## 使用方法

    window.uploadJSSDK({
        file: File,   //文件，必填,html5 file类型，不需要读数据流
        token: 'test',  //鉴权token，必填
        dir: '',  //目录，选填，默认根目录''
        retries: 0,  //重试次数，选填，默认0不重试
        maxSize: 0,  //上传大小限制，选填，默认0没有限制
        chunkSize: 4*1024*1024,  //分片上传每片大小，选填，默认4M
        name: "test",  //文件名称，选填，默认为文件名称
        callback: function (percent, result) {
            //percent（上传百分比）：-1失败；0-100上传的百分比；100即完成上传
            //result(服务端返回的responseText，json格式)
        }
    });