<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo app()->charset;?>" />
<title><?php echo $this->pageTitle;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="robots" content="all" />
<style type="text/css">
body {margin:0; padding:10px;}
.alert{padding:8px 35px 8px 14px;margin-bottom:20px;text-shadow:0 1px 0 rgba(255, 255, 255, 0.5);background-color:#fcf8e3;border:1px solid #fbeed5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;color:#c09853;}
.alert-block{padding-top:14px;padding-bottom:14px;}
.alert-error{background-color:#f2dede;border-color:#eed3d7;color:#b94a48;}
</style>
</head>
<body>
<div class="alert alert-block alert-error">
<p><?php echo $code;?></p>
<p><?php echo $message;?></p>
</div>
</body>
</html>
