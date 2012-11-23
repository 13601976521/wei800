<?php if (user()->hasFlash('flush_theme_cache_success')):?>
<div class="alert alert-success fade in">
    <button type="button" data-dismiss="alert" class="close">&times;</button>
    <?php echo user()->getFlash('flush_theme_cache_success');?>
</div>
<?php endif;?>

<?php echo CHtml::form('', 'post');?>
<div class="alert alert-block">
<p>刷新模板缓存</p>
<div class="btn-toolbar">
<input class="btn btn-primary" type="submit" value="更新模板缓存" /></div>
</div>
<?php echo CHtml::endForm();?>