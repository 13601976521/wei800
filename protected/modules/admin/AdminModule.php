<?php

define('ADMIN_MODULE_ROOT', dirname(__FILE__) . DS);

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
	    
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
		
		$params = require(ADMIN_MODULE_ROOT . 'config' . DS . 'params.php');

		$userID = (int)user()->id;
		$userCachefile = AdminUserConfig::cacheFilename($userID);
		if (file_exists($userCachefile)) {
		    $customSetting = require($userCachefile);
		    $params = array_merge($params, $customSetting);
		}
		app()->params->mergeWith($params);
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
