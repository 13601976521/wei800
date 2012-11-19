<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo app()->charset;?>" />
    <title><?php echo $this->pageTitle;?></title>
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="author" content="weixin800.com" />
    <meta name="generator" content="<?php echo CDBase::powered();?>" />
    <meta name="copyright" content="Copyright (c) 2009-2012 weixin800.com All Rights Reserved." />
    <meta name="robots" content="all" />
    <link rel="start" href="<?php echo CDBase::siteHomeUrl();?>" title="Home" />
    <link rel="home" href="<?php echo CDBase::siteHomeUrl();?>" title="Home" />
    <link media="screen" rel="stylesheet" type="text/css" href="<?php echo tbu('styles/beta-common.css');?>" />
    <link media="screen" rel="stylesheet" type="text/css" href="<?php echo tbu('styles/beta-all.css?t=20121114002');?>" />
    <?php echo param('header_html');?>
</head>
<body>
<div class="beta-container">
    <div class="beta-header">
        <div class="beta-logo fleft">
            <a href="<?php echo CDBase::siteHomeUrl();?>"><?php echo app()->name;?></a>
        </div>
        <div class="fright short-desc"><?php echo param('shortdesc');?></div>
        <div class="clear"></div>
    </div>
    <div class="beta-nav">
        <ul class="channel-nav fleft">
            <li><a <?php if (empty($this->channel)) echo 'class="active"';?> href="<?php echo CDBase::siteHomeUrl();?>">首页</a></li>
            <li class="separator"></li>
            <li><a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=UjE2MTE6NzwSJDsifCMjfDE9Pw">开发服务</a></li>
        </ul>
        <ul class="user-mini-bar fright">
            <li><?php echo l('提交微信', aurl('admin/weixin/create'), array('class'=>($this->channel == 'contribute') ? 'active' : 'green'));?></li>
            <?php $this->renderDynamic('userMiniToolbar');?>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="beta-entry">
        <?php echo $content;?>
    </div>
</div>
<?php echo param('footer_before_html');?>
<div class="beta-footer">
    <div class="beta-container">
        <div>&copy;2012&nbsp;<?php echo l(app()->name, CDBase::siteHomeUrl());?>&nbsp;<?php echo param('beian_code');?></div>
    </div>
</div>
<a class="beta-backtop" href="#top">返回顶部 ^</a>
<?php echo param('footer_after_html');?>
<?php echo param('tongji_code');?>
</body>
</html>

<?php
cs()->registerCoreScript('jquery');
cs()->registerScriptFile(sbu('libs/bootstrap/js/bootstrap.min.js'), CClientScript::POS_END);
cs()->registerScriptFile(tbu('scripts/beta-main.js?t=20121113001'), CClientScript::POS_END);
?>

