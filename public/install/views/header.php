<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>微800 安装向导</title>
    <link media="screen" rel="stylesheet" type="text/css" href="./res/bootstrap/css/bootstrap.min.css" />
    <link media="screen" rel="stylesheet" type="text/css" href="./res/cd-install.css" />
</head>
<body>
<div class="beta-container">
    <div class="beta-header">
        <h2>微800 安装向导</h2>
    </div>
    <ul class="beta-nav">
        <li <?php echo $step == 0 ? 'class="active"' : '';?>>微800安装向导</li>
        <li <?php echo $step == 1 ? 'class="active"' : '';?>>第一步：检测系统环境</li>
        <li <?php echo $step == 2 ? 'class="active"' : '';?>>第二步：填写网站基本信息</li>
        <li <?php echo $step == 3 ? 'class="active"' : '';?>>第三步：安装数据库</li>
        <li <?php echo $step == 4 ? 'class="active"' : '';?>>第四步：安装完成</li>
        <div class="clear"></div>
    </ul>
    <div class="beta-entry">