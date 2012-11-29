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
    <div class="control-group <?php if($model->hasErrors('avatar')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'avatar', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeFileField($model, 'avatar');?>
            <?php if($model->hasErrors('avatar')):?><span class="help-inline"><?php echo $model->getError('avatar');?></span><?php endif;?>
            <?php echo $model->avatarImage;?>
            <p class="alert alert-warning">头像图片大小不超过256K，图片宽度和高度都不超过1024px，推荐使用公众平台上现有的图片。</p>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('desc')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'desc', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextArea($model, 'desc', array('class'=>'span6', 'rows'=>4, 'placeholder'=>'简单介绍下你的微信公众号吧'));?>
            <?php if($model->hasErrors('desc')):?><p class="help-block"><?php echo $model->getError('desc');?></p><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('state')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'state', array('class'=>'control-label'));?>
        <div class="controls">
            <label class="checkbox">
            <?php echo CHtml::activeCheckBox($model, 'state');?>启用
            <?php if($model->hasErrors('avatar')):?><span class="help-inline"><?php echo $model->getError('state');?></span><?php endif;?>
            </label>
        </div>
    </div>
    <div class="form-actions">
        <input type="button" value="更多设置" class="btn btn-info" id="more-items" />
        <a class="btn" href="<?php echo $model->listUrl;?>">返回列表</a>
        <input type="submit" value="提交保存" class="btn btn-primary" />
    </div>
    <div class="control-group hide <?php if($model->hasErrors('contact')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'contact', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'contact', array('class'=>'input-large', 'placeholder'=>'您的姓名'));?>
            <?php if($model->hasErrors('contact')):?><span class="help-inline"><?php echo $model->getError('contact');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group hide <?php if($model->hasErrors('phone')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'phone', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'phone', array('class'=>'input-large', 'placeholder'=>'您的手机或固定电话'));?>
            <?php if($model->hasErrors('phone')):?><span class="help-inline"><?php echo $model->getError('phone');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group hide <?php if($model->hasErrors('qq')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'qq', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'qq', array('class'=>'input-large', 'placeholder'=>'您的QQ号'));?>
            <?php if($model->hasErrors('qq')):?><span class="help-inline"><?php echo $model->getError('qq');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group hide <?php if($model->hasErrors('email')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'email', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'email', array('class'=>'input-xlarge', 'placeholder'=>'您的电子邮箱'));?>
            <?php if($model->hasErrors('email')):?><span class="help-inline"><?php echo $model->getError('email');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group hide <?php if($model->hasErrors('site')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'site', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'site', array('class'=>'input-xlarge', 'placeholder'=>'您的网站或博客地址'));?>
            <?php if($model->hasErrors('site')):?><span class="help-inline"><?php echo $model->getError('site');?></span><?php endif;?>
        </div>
    </div>
    <div class="form-actions hide">
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
	$('#wxname').focus();

	$(document).on('click', '#more-items', function(event){
		var formActions = $(this).parents('.form-actions');
		formActions.nextAll('div').toggle();
	});
});
</script>


