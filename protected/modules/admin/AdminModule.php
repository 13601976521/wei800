<?php

class AdminModule extends CWebModule
{
	public function init()
	{
	    if (user()->getIsGuest()) {
	        $url = url('site/login', array('url'=>abu(request()->getUrl())));
	        request()->redirect($url);
	        exit(0);
	    }
	    
	    app()->errorHandler->errorAction = 'admin/default/error';
	    
	    $params = require(dirname(__FILE__) . DS . 'config' . DS . 'params.php');
	    Yii::app()->params->mergeWith($params);
	    
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		}
		else
			return false;
	}
}
