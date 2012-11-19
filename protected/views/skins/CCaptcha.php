<?php
return array(
    'default' => array(
	    'captchaAction' => 'captcha',
        'clickableImage' => true,
        'buttonLabel' => '换一张',
        'imageOptions' => array('alt'=>'验证码', 'align'=>'top', 'class'=>'beta-captcha-img'),
        'buttonOptions' => array('class'=>'refresh-captcha'),
    ),
    'big' => array(
	    'captchaAction' => 'bigcaptcha',
        'clickableImage' => true,
        'buttonLabel' => t('refresh_captcha'),
        'imageOptions' => array('alt'=>t('captcha'), 'align'=>'top', 'class'=>'beta-captcha-img'),
        'buttonOptions' => array('class'=>'refresh-captcha'),
    ),
);