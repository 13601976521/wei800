<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo app()->charset;?>" />
<title><?php echo $this->pageTitle;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="robots" content="all" />
</head>
<body>
<header>
    <a href="<?php echo CDBase::siteHomeUrl();?>"><strong><?php echo app()->name;?></strong></a>
</header>
<div class="cd-wrapper">
<?php echo $content;?>
<footer>
    <a href="http://www.weixin800.com/static/intro" target="_blank">本页面由&nbsp;微800&nbsp;运营平台生成</a>
</footer>
</div>
</body>
</html>

<?php
cs()->registerScriptFile(sbu('libs/zepto.min.js'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('js/weixinapi.js'), CClientScript::POS_END);
cs()->registerCssFile(sbu('css/cd-weixin.css'));
?>