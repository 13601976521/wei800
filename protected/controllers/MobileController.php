<?php
class MobileController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'mobile';
    }
    
    public function actionIntro()
    {
        $this->pageTitle = app()->name;
        $this->render('intro');
    }
}