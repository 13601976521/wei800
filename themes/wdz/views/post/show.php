<div class="wx-container">
    <div class="wx-header box-shadow">
        <h1 class="title"><?php echo $post->title;?></h1>
        <a data-action="wxfollow" class="btn-focus" href="javascript:void(0);" data-wxid="<?php echo $weixin->original_wxid;?>" data-id="<?php echo $post->id;?>">
            <div class="avatar"><?php echo $weixin->circleAvatarImage;?></div>
            <div class="wxname"><?php echo $weixin->wxname;?></div>
            <div class="wxid">微信号：<?php echo $weixin->original_wxid;?></div>
            <b>&gt;</b>
        </a>
     </div>
</div>

