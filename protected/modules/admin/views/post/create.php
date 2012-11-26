<?php if (user()->hasFlash('post_create_result')):?>
<div class="alert alert-success fade in" data-dismiss="alert">
    <a href="javascript:void(0);" data-dismiss="alert" class="close">&times;</a>
    <?php echo user()->getFlash('post_create_result');?>
</div>
<?php endif;?>

<?php echo CHtml::form('', 'post', array('class'=>'form-horizontal post-form', 'enctype'=>'multipart/form-data'));?>
<?php echo CHtml::activeHiddenField($model, 'type_id');?>
<fieldset>
    <legend><?php echo $this->title;?></legend>
    <div class="control-group <?php if($model->hasErrors('weixin_id')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'weixin_id', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeDropDownList($model, 'weixin_id', $weixinData, array('prompt'=>'请选择绑定的微信号', 'id'=>'bind-weixin'));?>
            <?php if($model->hasErrors('weixin_id')):?><span class="help-inline"><?php echo $model->getError('weixin_id');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('title')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'title', array('class'=>'control-label', 'id'=>'post-title'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'title', array('class'=>'span5', 'placeholder'=>'文章标题，尽量文字简洁'));?>
            <?php if($model->hasErrors('title')):?><span class="help-inline"><?php echo $model->getError('title');?></span><?php endif;?>
        </div>
    </div>
    <?php foreach ($model->getContents() as $index => $content):?>
    <div class="contents-box control-group <?php if($model->hasErrors('content') && $index == 0) echo 'error';?>">
        <label class="control-label">内容</label>
        <div class="controls">
            <?php if($model->hasErrors('content') && $index == 0):?>
                <p class="help-block"><?php echo $model->getError('content');?></p>
            <?php endif;?>
            <p class="help-block">第&nbsp;<em><?php echo $index + 1;?></em>&nbsp;段内容</p>
            <?php echo CHtml::textArea('content[]', $content, array('class'=>'post-content', 'id'=>'content' . $index));?>
        </div>
    </div>
    <?php endforeach;?>
    <div class="form-actions">
        <a class="btn" href="<?php echo $model->listUrl;?>">返回列表</a>
        <input type="button" value="再添加一段内容" class="btn btn-danger" id="new-content" />
        <input type="submit" value="提交保存" class="btn btn-primary" />
    </div>
    <div class="control-group <?php if($model->hasErrors('ad_accounts')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'ad_accounts', array('class'=>'control-label'));?>
        <div class="controls" id="adweixin-choices">
            <?php echo CHtml::activeDropDownList($model, 'ad_accounts', $adWeixinData, array('class'=>'span6', 'prompt'=>'请选择绑定的微信号', 'multiple'=>'multiple', 'id'=>'_adaccounts', 'data-rel'=>'chosen'));?>
            <?php if($model->hasErrors('ad_accounts')):?><span class="help-inline"><?php echo $model->getError('ad_accounts');?></span><?php endif;?>
        </div>
    </div>
    <div class="control-group <?php if($model->hasErrors('ad_line_count')) echo 'error';?>">
        <?php echo CHtml::activeLabel($model, 'ad_line_count', array('class'=>'control-label'));?>
        <div class="controls">
            <?php echo CHtml::activeTextField($model, 'ad_line_count', array('class'=>'span2', 'placeholder'=>'单行展示数量'));?>
            <?php if($model->hasErrors('ad_line_count')):?><span class="help-inline"><?php echo $model->getError('ad_line_count');?></span><?php endif;?>
            <p class="help-block alert alert-block">此行数是指以并列4个为一行方式显示的行数，并不是一行显示一个的行数。<br /><span class="cred">注：此项设置只有在推广账号数大于4的时候才会有效，小于4个会全部以单行方式显示</span></p>
        </div>
    </div>
    <div class="form-actions">
        <a class="btn" href="<?php echo $model->listUrl;?>">返回列表</a>
        <input type="submit" value="提交保存" class="btn btn-primary" />
    </div>
</fieldset>
<?php echo CHtml::hiddenField('adaccounts', $model->adWeixinText, array('id'=>'adaccounts'));?>
<?php echo CHtml::endForm();?>


<script type="text/javascript">
$(function(){
	$('#post-title').focus();
	$('#bind-weixin').chosen({
    	'no_results_text': '没有找到匹配的内容'
	});
	$('#_adaccounts').chosen({
		'placeholder_text': '可以选择多个微信号',
		'no_results_text': '没有找到匹配的微信号'
	});

	$(document).on('submit', 'form', function(){
	    var options = $('#_adaccounts option');
	    var ids = [];
	    for (var i=0; i<options.length; i++)
		    ids[i] = $(options[i]).val();
	    var choices = $('#adweixin-choices').find('.search-choice a.search-choice-close');
	    var selectedIds = [];
	    for (var i=0; i<choices.length; i++) {
		    var adid = $(choices[i]).attr('rel');
		    selectedIds.push(ids[adid]);
	    }

	    var adaccounts = selectedIds.join(',');
	    $('#adaccounts').val(adaccounts);
	});

	$(document).on('click', '.delete-content', function(){
		$(this).parents('.contents-box').slideUp('fast', function(){$(this).remove();});
	});
	
    KindEditor.ready(function(K) {
    	KEConfig.weixin.cssPath = ['<?php echo sbu('css/cd-weixin.css');?>'];
    	KEConfig.weixin.uploadJson = '<?php echo aurl('upload/image');?>';
    	K.create('.post-content', KEConfig.weixin);

    	$('#new-content').on('click', function(){
        	var count = $('.contents-box').length + 1;
    		var html = '<div class="contents-box control-group"><label class="control-label" for="AdminPost_content">内容<br /></label><div class="controls"><p class="help-block">第&nbsp;<em>' + count + '</em>&nbsp;段内容</p><textarea class="post-content" name="content[]" id="new-content"></textarea><p class="help-block"><input type="button" class="btn btn-mini btn-danger delete-content" value="删除此段内容" /></div></div></div>';
    		$('.contents-box:last').after(html);
    		KindEditor.create('#new-content', KEConfig.weixin);
    		$('#new-content').removeAttr('id');
    	});
    });
});
</script>


<?php
cs()->registerScriptFile(sbu('libs/chosen/chosen.jquery.min.js'), CClientScript::POS_END);
cs()->registerCssFile(sbu('libs/chosen/chosen.css'));
cs()->registerScriptFile(sbu('libs/kindeditor/kindeditor-min.js'), CClientScript::POS_END);
cs()->registerScriptFile(sbu('libs/kindeditor/config.js'), CClientScript::POS_END);
?>


