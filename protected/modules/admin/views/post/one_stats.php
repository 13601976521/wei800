<div class="table-title"><?php echo $this->title;?></div>
<div class="btn-toolbar">
    <a class="btn" href="javascript:history.back();"><i class="icon-chevron-left"></i>返回</a>
    <a class="btn btn-primary" href="">刷新</a>
</div>
<table class="table table-striped table-bordered cd-list-table">
    <tbody>
        <tr>
            <td class="column-label"><?php echo CHtml::activeLabel($post, 'title');?></td>
            <td><?php echo l($post->title, $post->weixinUrl, array('target'=>'_blank'));?></td>
        </tr>
        <tr>
            <td class="column-label"><?php echo CHtml::activeLabel($post, 'view_count');?></td>
            <td><?php echo $post->view_count;?></td>
        </tr>
        <tr>
            <td class="column-label"><?php echo CHtml::activeLabel($post, 'back_count');?></td>
            <td><?php echo $post->back_count;?></td>
        </tr>
        <tr>
            <td class="column-label"><?php echo CHtml::activeLabel($post, 'share_count');?></td>
            <td><?php echo $post->share_count;?></td>
        </tr>
    </tbody>
</table>

<div class="table-title">推广账号数据统计</div>
<table class="table table-striped table-bordered cd-list-table">
    <thead>
        <tr>
            <th class="span3">推广账号</th>
            <th class="span2">原始微信号</th>
            <th class="span2">关注成功</th>
            <th class="span2">关注失败</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($post->adweixin as $adwx):?>
        <tr>
            <td><?php echo $adwx->wxname;?></td>
            <td><?php echo $adwx->original_wxid;?></td>
            <td><?php echo $post->getPostWeixin($adwx->id, 'follow_success');?></td>
            <td><?php echo $post->getPostWeixin($adwx->id, 'follow_fail');?></td>
            <td>&nbsp;</td>
        </tr>
        <?php endforeach;?>
        <?php if (empty($post->adweixin)):?>
        <tr><td class="ac" colspan="4">此文章没有推广账号</td><td>&nbsp;</td></tr>
        <?php endif;?>
    </tbody>
</table>

