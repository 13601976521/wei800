<div class="cd-container fleft">
    <?php echo CHtml::form('', 'post', array('class'=>'form-horizontal login-form'));?>
    <fieldset>
        <legend>欢迎登录 <?php echo app()->name;?></legend>
        <?php echo CHtml::activeHiddenField($form, 'returnUrl');?>
        
        <div class="control-group <?php if ($form->getError('email')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'email', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activeTextField($form, 'email', array('class'=>'input-large', 'tabindex'=>1));?>
                <?php if ($form->hasErrors('email')):?><span class="help-inline"><?php echo $form->getError('email');?></span><?php endif;?>
            </div>
        </div>
        
        <div class="control-group <?php if ($form->getError('password')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'password', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activePasswordField($form, 'password', array('class'=>'input-large', 'tabindex'=>3));?>
                <?php if ($form->hasErrors('password')):?><span class="help-inline"><?php echo $form->getError('password');?></span><?php endif;?>
            </div>
        </div>
        
        <?php if ($form->getEnableCaptcha()):?>
        <div class="control-group <?php if ($form->getError('captcha')) echo 'error';?>">
            <?php echo CHtml::activeLabel($form, 'captcha', array('class'=>'control-label'));?>
            <div class="controls">
                <?php echo CHtml::activeTextField($form, 'captcha', array('class'=>'input-mini', 'tabindex'=>4));?>
                <?php $this->widget('CCaptcha');?>
                <?php if ($form->hasErrors('captcha')):?><span class="help-inline"><?php echo $form->getError('captcha');?></span><?php endif;?>
            </div>
        </div>
        <?php endif;?>
    
        <div class="control-group">
            <div class="controls">
                <label class="checkbox">
                    <?php echo CHtml::activeCheckBox($form, 'rememberMe', array('id'=>'rememberme', 'tabindex'=>4));?>下次自动登录
                </label>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="btn btn-primary" tabindex="6" value="登录" />
        </div>
    </fieldset>
    <?php echo chtml::endForm();?>
</div>
<div class="cd-sidebar fright">
    <p class="quick-login-signup">&gt;&nbsp;我还没有<strong><?php echo app()->name;?></strong>帐号?&nbsp;<a href="<?php echo CDBase::signupUrl();?>">马上注册</a></p>
</div>
<div class="clear"></div>