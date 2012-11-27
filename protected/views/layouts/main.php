<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo app()->charset;?>" />
<title><?php echo $this->pageTitle;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="robots" content="all" />
<link rel="stylesheet" type="text/css" href="<?php echo sbu('libs/bootstrap/css/bootstrap.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo sbu('css/cd-main.css?t=20121121001');?>" />
</head>
<body>
<div id="header" class="clearfix">
    <div class="cd-wrapper">
        <h2><?php echo app()->name;?> - <?php echo param('shortdesc');?></h2>
    </div>
</div>

<div class="cd-wrapper clearfix">
<?php echo $content;?>
</div>

<div id="footer" class="ac clearfix">
    <a href="http://www.weixin800.com/static/intro">Powered by 微800 专业微信运营平台</a>&nbsp;&nbsp;
    <?php if (param('beian_code')) echo param('beian_code');?>
</div>
</body>
</html>

<?php
cs()->registerCoreScript('jquery');
cs()->registerScriptFile(sbu('js/cd-basic.js?t=20121121001'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('js/cd-main.js?t=20121121001'), CClientScript::POS_END);
?>