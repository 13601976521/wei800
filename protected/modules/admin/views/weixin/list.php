<div class="table-title"><?php echo $this->title;?></div>
<table class="table table-striped table-bordered cd-list-table">
    <thead>
        <tr>
            <th class="span3"><?php echo $sort->link('wxname');?></th>
            <th class="span2"><?php echo $sort->link('custom_wxid');?></th>
            <th class="span2"><?php echo $sort->link('original_wxid');?></th>
            <th class="span2">内容</th>
            <!-- <th class="span1"><?php echo $sort->link('state');?></th> -->
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $model):?>
        <tr>
            <td><a href="<?php echo $model->editUrl;?>"><?php echo $model->wxname;?></a></td>
            <td><?php echo $model->custom_wxid;?></td>
            <td><?php echo $model->original_wxid;?></td>
            <td><a href="<?php echo $model->postsUrl;?>"><span class="badge badge-info">查看&nbsp;<?php echo $model->post_count;?></span></a></td>
            <!-- <td class="state-label"><?php echo $model->stateText;?></td> -->
            <td>
                <a class="btn btn-mini" href="<?php echo $model->homeUrl;?>" target="_blank">主页</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php if ($pages):?>
<div class="pagination"><?php $this->widget('CLinkPager', array('pages'=>$pages, 'skin'=>'admin'));?></div>
<?php endif;?>
