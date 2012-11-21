<?php

class DefaultController extends AdminController
{
	public function actionIndex()
	{
	    $this->breadcrumbs[] = '系统首页';
		$this->render('index');
	}

	public function actionError()
	{
	    $error = app()->errorHandler->error;
	    if ($error) {
	        $this->render('/system/error', $error);
	    }
	}
	
	
    public function actionTest()
    {
        $this->render('test');
    }
}