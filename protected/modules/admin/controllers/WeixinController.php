<?php
class WeixinController extends AdminController
{
    public function actionCreate($id = 0)
    {
        $id = (int)$id;
        if ($id > 0)
            $model = AdminWeixin::model()->findByPk($id, 'user_id = :userid', array(':userid'=>$this->uid));
        else
            $model = new AdminWeixin();
        
        if ($model === null)
            throw new CHttpException(404, '该公众账号不存在');
        
        if ($model->getIsNewRecord())
            $model->state = WEIXIN_STATE_ENABLED;
        
        if (request()->getIsPostRequest() && isset($_POST['AdminWeixin'])) {
            unset($_POST['AdminWeixin']['state']); // 防止用户修改表单内容，进行注入
            $model->attributes = $_POST['AdminWeixin'];
            $model->user_id = user()->id;
            if ($model->save()) {
                $model->upload();
                user()->setFlash('weixin_create_result', '保存微信号成功');
                $this->redirect(request()->getUrl());
            }
        }

        $this->channel = 'weixin_create';
        $this->title = '提交我的公众账号';
        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionList()
    {
        $data = AdminWeixin::fetchList($this->user->id);
        
        $this->channel = 'weixin_list';
        $this->title = '我的公众账号列表';
        $this->render('list', $data);
    }
}