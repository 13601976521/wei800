<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo app()->charset;?>" />
<title><?php echo $this->pageTitle;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="robots" content="all" />
<link rel="stylesheet" type="text/css" href="<?php echo sbu('styles/cd-wx.css?t=20121119001');?>" />
</head>
<body class="wx-mobile">
<div class="wx-wrapper">
<?php echo $content;?>
</div>
<footer>
    <a href="<?php echo aurl('mobile/intro');?>">本页面由&nbsp;<?php echo app()->name;?>&nbsp;运营平台生成</a>
</footer>
</body>
</html>

<?php
cs()->registerCoreScript('jquery');
cs()->registerScriptFile(sbu('scripts/cd-wx.js?t=20121119001'), CClientScript::POS_END);
?>