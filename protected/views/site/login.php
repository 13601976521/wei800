<div class="beta-content">
    <h2>欢迎加入&nbsp;<?php echo app()->name;?></h2>
    <?php echo CHtml::form($submitUrl, 'post', array('class'=>'login-form'));?>
    <?php echo CHtml::activeHiddenField($form, 'returnUrl');?>
    <div class="beta-control-group <?php echo $form->hasErrors('email') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'email');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activeTextField($form, 'email', array('class'=>'beta-text', 'tabindex'=>1));?>
            <?php if ($form->hasErrors('email')):?><span class="beta-help-inline"><?php echo $form->getError('email');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="beta-control-group <?php echo $form->hasErrors('password') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'password');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activePasswordField($form, 'password', array('class'=>'beta-text', 'tabindex'=>2));?>
            <?php if ($form->hasErrors('password')):?><span class="beta-help-inline"><?php echo $form->getError('password');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <?php if ($form->getEnableCaptcha()):?>
    <div class="beta-control-group <?php echo $form->hasErrors('captcha') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'captcha');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activeTextField($form, 'captcha', array('class'=>'beta-captcha beta-text', 'tabindex'=>3));?>
            <?php $this->widget('CCaptcha');?>
            <?php if ($form->hasErrors('captcha')):?><span class="beta-help-inline"><?php echo $form->getError('captcha');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <?php endif;?>
    <div class="beta-control-group">
        <label class="beta-control-label">&nbsp;</label>
        <div class="beta-controls rememberme">
            <?php echo CHtml::activeCheckBox($form, 'rememberMe', array('id'=>'rememberme', 'tabindex'=>4));?><label for="rememberme">下次自动登录</label>
            <?php if ($form->hasErrors('rememberMe')):?><span class="beta-help-inline"><?php echo $form->getError('rememberMe');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="action-buttons">
        <input type="submit" class="beta-btn btn-primary" tabindex="6" value="登录" />
    </div>
    <?php echo chtml::endForm();?>
</div>
<div class="beta-sidebar">
    <p class="quick-login-signup">&gt;&nbsp;还没有<?php echo app()->name;?>帐号?&nbsp;<a href="<?php echo CDBase::signupUrl()?>">立即注册</a></p>
</div>
<div class="clear"></div>