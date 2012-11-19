<?php
return array(
    'default' => array(
        'homeLink' => '<li>' . l('开始', CDBase::adminHomeUrl()) . '<span class="divider">/</span></li>',
        'separator' => '&nbsp;',
        'tagName' => 'ul',
        'htmlOptions' => array('class'=>'breadcrumb'),
        'activeLinkTemplate' => '<li><a href="{url}">{label}</a><span class="divider">/</span></li>',
        'inactiveLinkTemplate' => '<li>{label}</li>',
    ),
);