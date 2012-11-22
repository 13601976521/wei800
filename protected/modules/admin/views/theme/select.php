<?php if (user()->hasFlash('save_theme_success')):?>
<div class="alert alert-success fade in">
    <button type="button" data-dismiss="alert" class="close">&times;</button>
    <?php echo user()->getFlash('save_theme_success');?>
</div>
<?php endif;?>

<ul class="thumbnails theme-thumbnails">
    <?php foreach ($themes as $name => $theme):?>
    <li class="span3">
        <div class="thumbnail">
            <a href="<?php echo $theme;?>" target="_blank">
                <img src="<?php echo $theme;?>" alt="<?php echo $name;?>" />
            </a>
            <div class="caption">
                <?php echo CHtml::form('', 'post');?>
                <?php echo CHtml::hiddenField('theme', $name);?>
                <p class="ac"><?php echo $name;?></p>
                <p>
                    <?php if ($name == param('theme')):?>
                    <input type="button" class="btn btn-danger btn-block" value="当前模板" />
                    <?php else:?>
                    <input type="submit" class="btn btn-inverse btn-block" value="选择" />
                    <?php endif;?>
                </p>
                <?php echo CHtml::endForm();?>
            </div>
        </div>
    </li>
    <?php endforeach;?>
</ul>
