<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo app()->charset;?>" />
<title><?php echo $this->pageTitle;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo sbu('libs/bootstrap/css/bootstrap.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo sbu('css/cd-admin.css?t=20121106001');?>" />
</head>
<body>
<div class="navbar cd-navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo CDBase::adminHomeUrl();?>">管理平台首页</a>
            <ul class="nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">内容管理<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">内容管理</li>
                        <li <?php if ($this->channel == 'post_create_one') echo 'class="active"';?>><a href="<?php echo url('admin/post/create');?>"><i class="icon-chevron-right"></i>添加图文</a></li>
                        <li <?php if ($this->channel == 'post_list') echo 'class="active"';?>><a href="<?php echo url('admin/post/list');?>"><i class="icon-chevron-right"></i>所有内容</a></li>
                        <li <?php if ($this->channel == 'post_stats') echo 'class="active"';?>><a href="<?php echo url('admin/post/stats');?>"><i class="icon-chevron-right"></i>内容访问统计</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">账号管理<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">互推账号管理</li>
                        <li <?php if ($this->channel == 'adweixin_create') echo 'class="active"';?>><a href="<?php echo url('admin/adweixin/create');?>"><i class="icon-chevron-right"></i>添加互推账号</a></li>
                        <li <?php if ($this->channel == 'adweixin_list') echo 'class="active"';?>><a href="<?php echo url('admin/adweixin/list');?>"><i class="icon-chevron-right"></i>所有互推账号</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">我的公众账号</li>
                        <li <?php if ($this->channel == 'weixin_list') echo 'class="active"';?>><a href="<?php echo url('admin/weixin/list');?>"><i class="icon-chevron-right"></i>我的公号列表</a></li>
                        <li <?php if ($this->channel == 'weixin_create') echo 'class="active"';?>><a href="<?php echo url('admin/weixin/create');?>"><i class="icon-chevron-right"></i>添加我的公号</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">设置<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">系统设置</li>
                        <?php foreach ($labels = AdminUserConfig::categoryLabels() as $id => $text):?>
                        <li <?php if ($this->channel == $id) echo 'class="active"';?>><a href="<?php echo url('admin/config/view', array('cid'=>$id));?>"><i class="icon-chevron-right"></i><?php echo $text;?></a></li>
                        <?php endforeach;?>
                        <li class="nav-header">模板设置</li>
                        <li <?php if ($this->channel == 'selecttheme') echo 'class="active"';?>><a href="<?php echo url('admin/theme/select');?>"><i class="icon-chevron-right"></i>模板选择</a></li>
                        <li class="nav-header">更新缓存</li>
                        <li <?php if ($this->channel == 'flushcache') echo 'class="active"';?>><a href="<?php echo url('admin/config/flush');?>"><i class="icon-chevron-right"></i>更新缓存</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">帮助<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li <?php if ($this->channel == 'guide') echo 'class="active"';?>><a href="http://www.weixin800.com/help/guide" target="_blank">新手入门</a></li>
                        <li <?php if ($this->channel == 'help_skill') echo 'class="active"';?>><a href="http://www.weixin800.com/help/trick" target="_blank">实用技巧</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav pull-right">
                <li><a href="http://mp.weixin.qq.com" target="_blank">腾讯公众平台</a></li>
                <li><?php echo l('网站首页', CDBase::siteHomeUrl(), array('target'=>'_blank'));?></li>
                <li <?php if ($this->channel == 'profile') echo 'class="active"';?>><?php echo l(user()->name, url('admin/profile/info'));?></li>
                <li><?php echo l('退出登录', CDBase::logoutUrl());?></li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid cd-container clearfix">
    <div class="cd-sidebar pull-left">
        <ul class="nav nav-list quick-nav">
            <li class="nav-header">内容管理</li>
            <li <?php if ($this->channel == 'post_create_one') echo 'class="active"';?>><a href="<?php echo url('admin/post/create');?>"><i class="icon-chevron-right"></i>添加图文</a></li>
            <li <?php if ($this->channel == 'post_list') echo 'class="active"';?>><a href="<?php echo url('admin/post/list');?>"><i class="icon-chevron-right"></i>所有内容</a></li>
            <li <?php if ($this->channel == 'post_stats') echo 'class="active"';?>><a href="<?php echo url('admin/post/stats');?>"><i class="icon-chevron-right"></i>内容访问统计</a></li>
            <li class="nav-header">互推账号管理</li>
            <li <?php if ($this->channel == 'adweixin_create') echo 'class="active"';?>><a href="<?php echo url('admin/adweixin/create');?>"><i class="icon-chevron-right"></i>添加互推账号</a></li>
            <li <?php if ($this->channel == 'adweixin_list') echo 'class="active"';?>><a href="<?php echo url('admin/adweixin/list');?>"><i class="icon-chevron-right"></i>所有互推账号</a></li>
            <li class="nav-header">我的公众账号</li>
            <li <?php if ($this->channel == 'weixin_create') echo 'class="active"';?>><a href="<?php echo url('admin/weixin/create');?>"><i class="icon-chevron-right"></i>添加我的公号</a></li>
            <li <?php if ($this->channel == 'weixin_list') echo 'class="active"';?>><a href="<?php echo url('admin/weixin/list');?>"><i class="icon-chevron-right"></i>我的公号列表</a></li>
            <li <?php if ($this->channel == 'weixin_msgapi') echo 'class="active"';?>><a href="<?php echo url('admin/weixin/msgapi');?>"><i class="icon-chevron-right"></i>消息接口</a></li>
            </ul>
    </div>
    <div class="cd-entry">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs));?>
        <?php echo $content;?>
    </div>
</div>
</body>
</html>

<?php
cs()->registerCoreScript('jquery');
cs()->registerScriptFile(sbu('libs/bootstrap/js/bootstrap.min.js'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('js/cd-basic.js'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('js/cd-admin.js'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('libs/chosen/chosen.jquery.min.js'), CClientScript::POS_END);
cs()->registerCssFile(sbu('libs/chosen/chosen.css'));
?>


