<?php
class WeixinController extends Controller
{
    public function actionIndex($id)
    {
        $id = (int)$id;
        if ($id <= 0)
            throw new CHttpException(503, '非法请求');
        
        $weixin = Weixin::model()->findByPk($id);
        if ($weixin === null)
            throw new CHttpException(403, '此微信号不存在');
        
        $this->setPageKeyWords(array($weixin->wxname, app()->name, '微信运营平台', '微信互推'));
        $this->setSiteTitle($weixin->wxname);
        $this->setPageDescription($weixin->desc);
        $this->render('index', array(
            'weixin' => $weixin,
        ));
    }
    
    
}