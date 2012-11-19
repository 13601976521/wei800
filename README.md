##微信800 [http://www.weixin800.com]##

##微信运营平台 微信运营工具 微信运营系统##

##开源程序部署方法##

    docs里是mysql数据模型文件，需要使用mysql workbench打开
    修改protected/data/db.config.php中的mysql连接参数
    修改protected/setting.php中的uploadBaseUrl和resourceBaseUrl为自己对应的url路径
    测试访问正常后，将public/index.php中的YII_DEBUG修改为false