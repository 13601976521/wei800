<?php if (user()->hasFlash('flush_theme_cache_success')):?>
<div class="alert alert-success fade in">
    <button type="button" data-dismiss="alert" class="close">&times;</button>
    <?php echo user()->getFlash('flush_theme_cache_success');?>
</div>
<?php endif;?>
<?php if (user()->hasFlash('flush_theme_cache_fail')):?>
<div class="alert alert-error fade in">
    <button type="button" data-dismiss="alert" class="close">&times;</button>
    <?php echo user()->getFlash('flush_theme_cache_fail');?>
</div>
<?php endif;?>

<?php echo CHtml::form('', 'post');?>
<div class="alert alert-block">
<p>此操作将会刷新当前选择模板的所有缓存数据，包括资源文件(css, js, images)，以及缓存数据。</p>
<p>如此当前未使用模板而使用的系统默认模板，则不需要此操作。</p>
<div class="btn-toolbar">
    <input class="btn btn-primary" type="submit" value="更新模板缓存" /></div>
</div>
<?php echo CHtml::endForm();?>