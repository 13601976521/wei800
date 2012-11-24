<div class="cd-container fleft">
    <ul class="weixin-info">
        <li>账号名称：<?php echo $weixin->wxname;?></li>
        <li>原始微号：<?php echo $weixin->original_wxid;?></li>
        <li>修改微号：<?php echo $weixin->custom_wxid;?></li>
        <li class="weixin-intro">账号介绍：<?php echo $weixin->desc;?></li>
    </ul>
</div>
<div class="cd-sidebar fright">
    <div class="avatar-box">
        <?php echo $weixin->rectAvatarImage;?>
        <?php echo $weixin->circleAvatarImage;?>
    </div>
    <div><?php echo $weixin->qrcodeImage;?></div>
</div>