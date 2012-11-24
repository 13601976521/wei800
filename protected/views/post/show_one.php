<div class="wx-container">
    <h1 class="title"><?php echo $post->title;?></h1>
    <a data-action="wxfollow" class="btn-focus" href="javascript:void(0);" data-wxid="<?php echo $weixin->original_wxid;?>" data-id="<?php echo $post->id;?>">
        <div class="avatar"><?php echo $weixin->circleAvatarImage;?></div>
        <div class="wxname"><?php echo $weixin->wxname;?></div>
        <div class="wxid">微信号：<?php echo $weixin->original_wxid;?></div>
        <b>&gt;</b>
    </a>
    
    <?php foreach ($post->filterContents as $content):?>
    <div class="cd-post-content"><?php echo $content;?></div>
    <?php endforeach;?>
    
    <div class="button-row">
        <button type="button" data-action="wxshare" class="btn btn-block btn-large" type="button">分享至朋友圈</button>
    </div>
    <?php if ($adweixinCount > 0):?>
    <div class="more-weixin">
        <div class="more-title">更多精彩更多微信<span>(欢迎点击添加关注)</span></div>
        <?php foreach ($lineShowWeixin as $adwx):?>
        <dl data-action="wxfollow" class="clearfix" data-wxid="<?php echo $adwx->original_wxid;?>" data-id="<?php echo $adwx->id;?>">
            <dt class="fleft avatar"><?php echo $adwx->avatarImage;?></dt>
            <dt class="wxname"><?php echo $adwx->wxname;?></dt>
            <dd><?php echo $adwx->getFilterDesc(70);?></dd>
        </dl>
        <?php endforeach;?>
        <ul class="clearfix">
            <?php foreach ($gridShowWeixin as $adwx):?>
            <li data-action="wxfollow" data-wxid="<?php echo $adwx->original_wxid;?>" data-id="<?php echo $adwx->id;?>">
                <div class="avatar"><?php echo $adwx->avatarImage;?></div>
                <h4><?php echo $adwx->wxname;?></h4>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
</div>

