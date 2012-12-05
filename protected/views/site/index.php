<?php foreach ($models as $model):?>
<a class="cd-post-item" href="<?php echo $model->url;?>">
    <dl>
        <dt><?php echo $model->title;?></dt>
        <dd><?php echo $model->summary;?></dd>
    </dl>
</a>
<?php endforeach;?>
<div class="cd-load-more ac"><input type="button" class="btn btn-large" value="载入更多内容" /></div>