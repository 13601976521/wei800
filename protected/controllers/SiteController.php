<?php
class SiteController extends Controller
{
    public function actionIndex()
    {
//         $this->render('index');
        $this->redirect(CDBase::loginUrl());
    }

    public function actionLogin($url = '')
    {
        if (!user()->getIsGuest()) {
            $returnUrl = strip_tags(trim($url));
            if (empty($returnUrl)) $returnUrl = CDBase::adminHomeUrl();
            request()->redirect($returnUrl);
            exit(0);
        }
        
        $model = new LoginForm('login');
        if (request()->getIsPostRequest() && isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            $model->validate() && $model->login();
        }
        else {
            $returnUrl = strip_tags(trim($url));
            if (empty($returnUrl))
                $returnUrl = request()->getUrlReferrer();
            if (empty($returnUrl))
                $returnUrl = CDBase::adminHomeUrl();
            $model->returnUrl = urlencode($returnUrl);
        }
        
        cs()->registerMetaTag('noindex, follow', 'robots');
        $this->setSiteTitle('用户登录');
        
        $this->render('login', array('form'=>$model));
    }
    
    public function actionSignup()
    {
        $this->redirect(CDBase::loginUrl());
        
        if (!user()->getIsGuest()) {
            $this->redirect(CDBase::adminHomeUrl());
            exit(0);
        }
        
        $model = new LoginForm('signup');
        if (request()->getIsPostRequest() && isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            $model->validate() && $model->signup();
        }
        
        cs()->registerMetaTag('noindex, follow', 'robots');
        $this->setSiteTitle('用户注册');
        
        $this->render('signup', array('form'=>$model));
    }
    
    public function actionLogout()
    {
        user()->logout();
        user()->clearStates();
        app()->session->clear();
        app()->session->destroy();
        $this->redirect(app()->homeUrl);
    }

    public function actionError()
    {
        $error = app()->errorHandler->error;
        if ($error) {
            $this->setPageTitle('Error ' . $error['code']);
            $this->render('/system/error', $error);
        }
    }

}

