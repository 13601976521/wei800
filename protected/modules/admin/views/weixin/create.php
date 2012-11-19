<?php if (user()->hasFlash('weixin_create_result')):?>
<div class="alert alert-success fade in" data-dismiss="alert">
    <a href="javascript:void(0);" data-dismiss="alert" class="close">&times;</a>
    <?php echo user()->getFlash('weixin_create_result');?>
</div>
<?php endif;?>

<?php echo CHtml::form('', 'post', array('class'=>'form-horizontal weixin-form', 'enctype'=>'multipart/form-data'));?>
<fieldset>
    <legend><?php echo $this->title;?></legend>
    <div class="control-group <?php if($model->hasErrors('wxname')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'wxname', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'wxname', array('class'=>'span4', 'placeholder'=>'微信名称', 'id'=>'wxname'));?>
            <?php if($model->hasErrors('wxname')):?><span class="help-inline"><?php echo $model->getError('wxname');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('original_wxid')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'original_wxid', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'original_wxid', array('class'=>'span4', 'placeholder'=>'格式：gh_xxxxxxxx，从微信二维码图片名称中找'));?>
            <?php if($model->hasErrors('original_wxid')):?><span class="help-inline"><?php echo $model->getError('original_wxid');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('custom_wxid')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'custom_wxid', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'custom_wxid', array('class'=>'span4', 'placeholder'=>'修改后的微信ID，未修改填原始微信ID'));?>
            <?php if($model->hasErrors('custom_wxid')):?><span class="help-inline"><?php echo $model->getError('custom_wxid');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('desc')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'desc', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextArea($model, 'desc', array('class'=>'span6', 'rows'=>4, 'placeholder'=>'简单介绍下你的微信公众号吧'));?>
            <?php if($model->hasErrors('desc')):?><p class="help-block"><?php echo $model->getError('desc');?></p><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('rect_avatar')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'rect_avatar', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeFileField($model, 'rect_avatar');?>
            <?php if($model->hasErrors('rect_avatar')):?><span class="help-inline"><?php echo $model->getError('rect_avatar');?></span><?php endif;?>
            <?php echo $model->rectAvatarImage;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('circle_avatar')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'circle_avatar', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeFileField($model, 'circle_avatar');?>
            <?php if($model->hasErrors('circle_avatar')):?><span class="help-inline"><?php echo $model->getError('circle_avatar');?></span><?php endif;?>
            <?php echo $model->circleAvatarImage;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('qrcode')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'qrcode', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeFileField($model, 'qrcode');?>
            <?php if($model->hasErrors('qrcode')):?><span class="help-inline"><?php echo $model->getError('qrcode');?></span><?php endif;?>
            <?php echo $model->qrcodeImage;?>
        </div>
    </div>
    <div class="alert alert-warning input-tip">头像、二维码图片请确保图片大小不超过1M，图片宽度和高度都不超过1024px，推荐使用公众平台上现有的图片。</div>
    <div class="form-actions">
        <a class="btn" href="<?php echo $model->listUrl;?>">返回列表</a>
        <input type="submit" value="提交" class="btn btn-primary" />
    </div>
    <div class="control-group <?php if($model->hasErrors('fans_count')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'fans_count', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'fans_count', array('class'=>'input-small', 'placeholder'=>'微信公众号粉丝数量'));?>
            <?php if($model->hasErrors('fans_count')):?><span class="help-inline"><?php echo $model->getError('fans_count');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('tags')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'tags', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'tags', array('class'=>'input-xlarge', 'placeholder'=>'以逗号,分隔 最多5个'));?>
            <?php if($model->hasErrors('tags')):?><span class="help-inline"><?php echo $model->getError('tags');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('contact')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'contact', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'contact', array('class'=>'input-large', 'placeholder'=>'您的姓名'));?>
            <?php if($model->hasErrors('contact')):?><span class="help-inline"><?php echo $model->getError('contact');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('phone')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'phone', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'phone', array('class'=>'input-large', 'placeholder'=>'您的手机或固定电话'));?>
            <?php if($model->hasErrors('phone')):?><span class="help-inline"><?php echo $model->getError('phone');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('qq')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'qq', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'qq', array('class'=>'input-large', 'placeholder'=>'您的QQ号'));?>
            <?php if($model->hasErrors('qq')):?><span class="help-inline"><?php echo $model->getError('qq');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('email')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'email', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'email', array('class'=>'input-xlarge', 'placeholder'=>'您的电子邮箱'));?>
            <?php if($model->hasErrors('email')):?><span class="help-inline"><?php echo $model->getError('email');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('site')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'site', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'site', array('class'=>'input-xlarge', 'placeholder'=>'您的网站或博客地址'));?>
            <?php if($model->hasErrors('site')):?><span class="help-inline"><?php echo $model->getError('site');?></span><?php endif;?>
        </div>
    </div>
    <div class="form-actions">
        <a class="btn" href="<?php echo $model->listUrl;?>">返回列表</a>
        <input type="submit" value="提交" class="btn btn-primary" />
    </div>
</fieldset>
<?php echo CHtml::endForm();?>

<?php
cs()->registerScriptFile(sbu('libs/chosen/chosen.jquery.min.js'), CClientScript::POS_END);
cs()->registerCssFile(sbu('libs/chosen/chosen.css'));
?>

<script type="text/javascript">
$(function(){
	var categories = <?php echo $categoriesJsonData;?>;
	$('#wxname').focus();
	$('#parent_categories').chosen({
    	'no_results_text': '没有找到匹配的分类'
	}).change(function(){
		var pid = parseInt($(this).val());
		var subs = categories[pid] || [];
		console.log(subs);
		var subSelect = document.getElementById('sub_categories');
		subSelect.options.length = 1;
		for (var i=0; i<subs.length; i++) {
			var sub = subs[i];
			var option = document.createElement('option');
			option.text = sub.name;
			option.value = sub.id;
			subSelect.add(option);
		}
		$('#sub_categories').trigger("liszt:updated");
	});
	
	$('#sub_categories').chosen({
		'no_results_text': '没有找到匹配的分类'
	});
});
</script>


