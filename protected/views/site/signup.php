<div class="cd-container fleft">
    <?php echo CHtml::form('', 'post', array('class'=>'form-horizontal login-form'));?>
    <fieldset>
        <legend>欢迎加入 <?php echo app()->name;?></legend>
        <?php echo CHtml::activeHiddenField($form, 'returnUrl');?>
        
        <div class="control-group <?php if ($form->getError('email')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'email', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activeTextField($form, 'email', array('class'=>'input-large', 'tabindex'=>1));?>
                <?php if ($form->hasErrors('email')):?><span class="help-inline"><?php echo $form->getError('email');?></span><?php endif;?>
            </div>
        </div>
        
        <div class="control-group <?php if ($form->getError('username')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'username', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activeTextField($form, 'username', array('class'=>'input-large', 'tabindex'=>2));?>
                <?php if ($form->hasErrors('username')):?><span class="help-inline"><?php echo $form->getError('username');?></span><?php endif;?>
                <span class="suggestion">第一印象很重要，起个响亮的名号吧</span>
            </div>
        </div>
        
        <div class="control-group <?php if ($form->getError('password')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'password', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activePasswordField($form, 'password', array('class'=>'input-large', 'tabindex'=>3));?>
                <?php if ($form->hasErrors('password')):?><span class="help-inline"><?php echo $form->getError('password');?></span><?php endif;?>
            </div>
        </div>
        
        <div class="control-group <?php if ($form->getError('captcha')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'captcha', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activeTextField($form, 'captcha', array('class'=>'input-mini', 'tabindex'=>4));?>
                <?php $this->widget('CCaptcha');?>
                <?php if ($form->hasErrors('captcha')):?><span class="help-inline"><?php echo $form->getError('captcha');?></span><?php endif;?>
            </div>
        </div>
        
        <div class="control-group <?php if ($form->getError('agreement')) echo 'error';?>">
            <div class="controls">
                <label class="checkbox">
                    <?php echo CHtml::activeCheckBox($form, 'agreement', array('id'=>'agreement', 'tabindex'=>5));?>我已经认真阅读并同意《使用协议》
                    <?php if ($form->hasErrors('agreement')):?><span class="help-inline"><?php echo $form->getError('agreement');?></span><?php endif;?>
                </label>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="btn btn-primary" tabindex="6" value="注册" />
        </div>
    </fieldset>
    <?php echo chtml::endForm();?>
</div>
<div class="cd-sidebar fright">
    <p class="quick-login-signup">&gt;&nbsp;已经拥有<?php echo app()->name;?>帐号?&nbsp;<a href="<?php echo CDBase::loginUrl();?>">直接登录</a></p>
</div>
<div class="clear"></div>
