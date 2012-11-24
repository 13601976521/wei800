<div class="cd-container fleft">
    <ul class="weixin-info">
        <li><label>账号名称：</label><?php echo $weixin->wxname;?></li>
        <li><label>原始微号：</label><?php echo $weixin->original_wxid;?></li>
        <li><label>修改微号：</label><?php echo $weixin->custom_wxid;?></li>
        <li class="weixin-intro"><label>账号介绍：</label><p><?php echo $weixin->desc;?></p></li>
    </ul>
</div>
<div class="cd-sidebar fright">
    <div class="avatar-box">
        <?php echo $weixin->rectAvatarImage;?>
        <?php echo $weixin->circleAvatarImage;?>
    </div>
    <div><?php echo $weixin->qrcodeImage;?></div>
</div>