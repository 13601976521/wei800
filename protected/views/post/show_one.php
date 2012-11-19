<script type="text/javascript">
var postid = <?php echo $post->id;?>;
var viewUrl = '<?php echo $viewUrl;?>';
var shareUrl = '<?php echo aurl('post/sharestats');?>';
var backUrl = '<?php echo $post->backUrl;?>';
var followUrl = '<?php echo aurl('post/follow');?>';
</script>

<div class="wx-container">
    <h1 class="title"><?php echo $post->title;?></h1>
    <a class="btn-focus" href="javascript:void(0);" data-wxid="<?php echo $post->weixin->original_wxid;?>">
        <div class="avatar"><?php echo $post->weixin->circleAvatarImage;?></div>
        <div class="wxname"><?php echo $post->weixin->wxname;?></div>
        <div class="wxid">微信号：<?php echo $post->weixin->original_wxid;?></div>
        <b>&gt;</b>
    </a>
    
    <div class="cd-post-content"><?php echo $post->filterContent;?></div>
    <div class="button-row">
        <button type="button" id="share-friend" class="btn btn-block btn-large" type="button">分享至朋友圈</button>
    </div>
    <?php if ($post->getAdWeixinIDArray()):?>
    <div class="more-weixin">
        <div class="more-title">更多精彩更多微信<span>(欢迎点击添加关注)</span></div>
        <?php foreach ($post->getLineShowWeixin() as $weixin):?>
        <dl class="clearfix" data-wxid="<?php echo $weixin->original_wxid;?>" data-id="<?php echo $weixin->id;?>">
            <dt class="pull-left avatar"><?php echo $weixin->avatarImage;?></dt>
            <dt class="wxname"><?php echo $weixin->wxname;?></dt>
            <dd><?php echo $weixin->getFilterDesc(70);?></dd>
        </dl>
        <?php endforeach;?>
        <ul class="clearfix">
            <?php foreach ($post->getGridShowWeixin() as $weixin):?>
            <li data-wxid="<?php echo $weixin->original_wxid;?>" data-id="<?php echo $weixin->id;?>">
                <div class="avatar"><?php echo $weixin->avatarImage;?></div>
                <h4><?php echo $weixin->wxname;?></h4>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
</div>

<script type="text/javascript">
$(function(){
	CDWeixin.sendViewStats(postid, viewUrl);
	
	$(document).on('click', 'li, dl, .btn-focus', function(event){
		event.preventDefault();
    	var originalWxid = $(this).attr('data-wxid');
    	var wxid = $(this).attr('data-id');
    	if (typeof originalWxid != 'undefined' && originalWxid.length > 0)
    	    CDWeixin.addContact(originalWxid, function(msg){
        	    CDWeixin.sendFollowStats(postid, wxid, followUrl, msg);
    	    });
	});
	
	$(document).on('click', '#share-friend', function(event){
		event.preventDefault();
		var data = {
			img_url: '<?php echo $post->weixinShareImgUrl;?>',
			title: '<?php echo $post->title;?>',
			desc: '<?php echo $post->title;?>',
			link: backUrl
		};
	    CDWeixin.shareToWeixinFriend(data, function(msg){
	    	CDWeixin.sendShareFriendStats(postid, shareUrl, msg);
	    });
	});
});
</script>


