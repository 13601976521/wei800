<div class="cd-container">
    <div class="cd-header cd-box-shadow">
        <h1 class="cd-title"><?php echo $post->title;?></h1>
        <a data-action="cd-follow" class="btn-focus" href="javascript:void(0);" data-wxid="<?php echo $weixin->original_wxid;?>" data-id="<?php echo $post->id;?>">
            <div class="cd-avatar"><?php echo $weixin->circleAvatarImage;?></div>
            <div class="cd-wxname"><?php echo $weixin->wxname;?></div>
            <div class="cd-wxid">微信号：<?php echo $weixin->original_wxid;?></div>
            <b>&gt;</b>
        </a>
     </div>
    
    <?php foreach ($post->filterContents as $content):?>
    <div class="cd-content-box cd-box-shadow">
        <div class="cd-post-content"><?php echo $content;?></div>
        <div class="cd-button-row">
            <button type="button" data-action="wxshare" class="btn btn-block btn-large" type="button">分享至朋友圈</button>
        </div>
    </div>
    <?php endforeach;?>
    
    <?php if ($adweixinCount > 0):?>
    <div class="cd-more-weixin cd-box-shadow">
        <div class="cd-more-title">更多精彩更多微信<span>(欢迎点击添加关注)</span></div>
        <?php foreach ($lineShowWeixin as $adwx):?>
        <dl data-action="cd-follow" class="clearfix" data-wxid="<?php echo $adwx->original_wxid;?>" data-id="<?php echo $adwx->id;?>">
            <dt class="fleft cd-avatar"><?php echo $adwx->avatarImage;?></dt>
            <dt class="cd-wxname"><?php echo $adwx->wxname;?></dt>
            <dd><?php echo $adwx->getFilterDesc(70);?></dd>
        </dl>
        <?php endforeach;?>
        <?php if (count($gridShowWeixin) > 0):?>
        <ul class="clearfix">
            <?php foreach ($gridShowWeixin as $adwx):?>
            <li data-action="cd-follow" data-wxid="<?php echo $adwx->original_wxid;?>" data-id="<?php echo $adwx->id;?>">
                <div class="cd-avatar"><?php echo $adwx->avatarImage;?></div>
                <h4><?php echo $adwx->wxname;?></h4>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div>
    <?php endif;?>
</div>

