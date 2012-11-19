<?php
class SiteController extends Controller
{
    public function filters()
    {
        return array(
            array(
                'COutputCache + index',
                'duration' => 3600,
            ),
        );
    }
    
    public function actionIndex()
    {
        $this->setSiteTitle();
        $this->setPageKeyWords(array('微信公众号助手', '微信运营平台', '微信推广平台', '微信互推平台', '微信公众平台', '微信公众账号', '微信互推', '微信推广', '微信运营', '微信运营平台源码	', '公众平台消息接口', '微信公众平台消息接口开发'));
        $this->setPageDescription('微800 最专业最权威功能最强大的微信公众账号运营及互推平台，集微信公众平台推广、营销及运营功能于一体，是商家官方微信公众账号运营的最佳助手。');
        $this->render('index');
    }

    public function actionLogin($url = '')
    {
        if (!user()->getIsGuest()) {
            $returnUrl = strip_tags(trim($url));
            if (empty($returnUrl)) $returnUrl = CDBase::memberHomeUrl();
            request()->redirect($returnUrl);
            exit(0);
        }
        
        $model = new LoginForm('login');
        if (request()->getIsPostRequest() && isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
                ;
            else
                $model->captcha = '';
        }
        else {
            $returnUrl = strip_tags(trim($url));
            if (empty($returnUrl))
                $returnUrl = request()->getUrlReferrer();
            if (empty($returnUrl))
                $returnUrl = CDBase::memberHomeUrl();
            $model->returnUrl = urlencode($returnUrl);
        }
        
        cs()->registerMetaTag('noindex, follow', 'robots');
        $this->setSiteTitle('用户登录');
        
        $this->render('login', array('form'=>$model));
    }
    
    public function actionSignup()
    {
        if (!user()->getIsGuest()) {
            $this->redirect(CDBase::memberHomeUrl());
            exit(0);
        }
        
        
        $model = new LoginForm('signup');
        if (request()->getIsPostRequest() && isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->signup())
                ;
            else
                $model->captcha = '';
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

