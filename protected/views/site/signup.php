<div class="beta-content">
    <h2>欢迎加入&nbsp;<?php echo app()->name;?></h2>
    <?php echo CHtml::form('', 'post', array('class'=>'login-form'));?>
    <div class="beta-control-group <?php echo $form->hasErrors('email') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'email');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activeTextField($form, 'email', array('class'=>'beta-text', 'tabindex'=>1));?>
            <?php if ($form->hasErrors('email')):?><span class="beta-help-inline"><?php echo $form->getError('email');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="beta-control-group <?php echo $form->hasErrors('username') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'username');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activeTextField($form, 'username', array('class'=>'beta-text', 'tabindex'=>2));?>
            <?php if ($form->hasErrors('username')):?><span class="beta-help-inline"><?php echo $form->getError('username');?></span><?php endif;?>
            <p class="suggestion">第一印象很重要，起个响亮的名号吧</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="beta-control-group <?php echo $form->hasErrors('password') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'password');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activePasswordField($form, 'password', array('class'=>'beta-text', 'tabindex'=>3));?>
            <?php if ($form->hasErrors('password')):?><span class="beta-help-inline"><?php echo $form->getError('password');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="beta-control-group <?php echo $form->hasErrors('captcha') ? 'error' : '';?>">
        <label class="beta-control-label"><?php echo CHtml::activeLabel($form, 'captcha');?></label>
        <div class="beta-controls">
            <?php echo CHtml::activeTextField($form, 'captcha', array('class'=>'beta-captcha beta-text', 'tabindex'=>4));?>
            <?php $this->widget('CCaptcha');?>
            <?php if ($form->hasErrors('captcha')):?><span class="beta-help-inline"><?php echo $form->getError('captcha');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="beta-control-group <?php echo $form->hasErrors('agreement') ? 'error' : '';?>">
        <label class="beta-control-label">&nbsp;</label>
        <div class="beta-controls beta-agreement">
            <?php echo CHtml::activeCheckBox($form, 'agreement', array('id'=>'agreement', 'tabindex'=>5));?><label for="agreement">我已经认真阅读并同意《使用协议》</label>
            <?php if ($form->hasErrors('agreement')):?><span class="beta-help-inline"><?php echo $form->getError('agreement');?></span><?php endif;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="action-buttons">
        <input type="submit" class="beta-btn btn-primary" tablindex="6" value="注册" />
    </div>
    <?php echo chtml::endForm();?>
</div>
<div class="beta-sidebar">
    <p class="quick-login-signup">&gt;&nbsp;已经拥有<?php echo app()->name;?>帐号?&nbsp;<a href="<?php echo CDBase::loginUrl();?>">直接登录</a></p>
</div>
<div class="clear"></div>

