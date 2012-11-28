<?php
/**
 * 此文件为默认配置文件，请勿修改
 */
$path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
$path = dirname($path);
$path = rtrim($path, '/') . '/';

return array(
    // 站点名称
    'site_name' => '微800',
    // 网站短描述
    'shortdesc' => '最专业的微信运营互推平台',
    'site_keywords' => '',
    'site_description' => '',

    // 缓存数据目录
    'dataPath' => BETA_CONFIG_ROOT . DS . '..' . DS . 'data' . DS,
    // 上传文件保存目录及基本url地址，url后面要带/
    'uploadBasePath' => BETA_WEBROOT . DS . 'uploads' . DS,
    'uploadBaseUrl' => $path . 'uploads/',
    // 静态资源文件保存目录及基本url地址，url后面要带/
    'resourceBasePath' => BETA_WEBROOT . DS . 'resources' . DS,
    'resourceBaseUrl' => $path . 'resources/',
    // theme静态资源文件保存目录及基本url地址，url后面要带/
    'theme_name' => null,
    'themeResourceBasePath' => BETA_WEBROOT . DS . 'themes' . DS,
    'themeResourceBaseUrl' => $path . 'themes/',
    // assets资源文件保存目录及基本url地址，url后面要带/
    'assetsBasePath' => BETA_WEBROOT . DS . 'assets' . DS,
    'assetsBaseUrl' => $path . 'assets/',

    /*
     * datetime format
    */
    'formatDateTime' => 'Y-m-d H:i:s',
    'formatShortDateTime' => 'm-d H:i',
    'formatDate' => 'Y-m-d',
    'formatShortDate' => 'm-d',
    'formatTime' => 'H:i:s',
    'formatShortTime' => 'H:i',
        
    'url_format' => 'path',
    'wx_post_show_format' => 'p/<id:\d+>',
        
    'cache_enable' => 0,

    // 推广账号默认单行显示数量
    'ad_weixin_default_line_show_count' => 0,
    // 记住用户登录状态的cookie时间
    'auto_login_duration' => 3600 * 24 * 7,
    
    // default param and value
    'beian_code' => '',
    'tongji_code' => '',
    'header_html' => '',
    'footer_after_html' => '',
    'footer_before_html' => '',
    'user_required_email_verfiy' => 0,
    'user_required_admin_verfiy' => 0,
    'auto_remote_image_local' => 0,
);



