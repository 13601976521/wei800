<?php
class SiteController extends Controller
{
    public function actionIndex($wxid = '')
    {
        $wxid = (int)$wxid;
        if ($wxid > 0) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('weixin_id' => $wxid));
        }
        
        $data = Post::fetchModels($criteria);
        
        $this->render('index', $data);
    }

    public function actionLogin($url = '')
    {
        $this->layout = 'main';
        
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
            if (CDBase::userIsMobileBrower())
                $this->renderPartial('/system/error_mobile', $error);
            else
                $this->render('/system/error', $error);
        }
    }

    public function actionGh($id)
    {
        $this->layout = 'main';
    
        $id = (int)$id;
        if ($id <= 0)
            throw new CHttpException(503, '非法请求');
    
        $weixin = Weixin::model()->findByPk($id);
        if ($weixin === null)
            throw new CHttpException(403, '此微信号不存在');
    
        $this->setPageKeyWords(array($weixin->wxname, app()->name, '微信运营平台', '微信互推'));
        $this->setSiteTitle($weixin->wxname);
        $this->setPageDescription($weixin->desc);
        $this->render('account', array(
                'weixin' => $weixin,
        ));
    }
}

