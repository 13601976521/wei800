<?php
class AdweixinController extends AdminController
{
    public function actionCreate($id = 0)
    {
        $id = (int)$id;
        $id = (int)$id;
        if ($id > 0) {
            $model = AdminAdWeixin::model()->findByPk($id, 'user_id = :userid', array(':userid'=>$this->userID));
            $this->title = '修改推广微信账号：' . $model->wxname;
        }
        else {
            $model = new AdminAdWeixin();
            $this->title = '添加推广微信账号';
        }
        
        if ($model === null)
            throw new CHttpException(404, '该推广账号不存在');
        
        if ($model->getIsNewRecord())
            $model->state = WEIXIN_STATE_ENABLED;
        
        if (request()->getIsPostRequest() && isset($_POST['AdminAdWeixin'])) {
            $model->attributes = $_POST['AdminAdWeixin'];
            $model->user_id = user()->id;
            if ($model->save()) {
                $model->upload();
                user()->setFlash('weixin_create_result', '保存微信号成功');
                $this->redirect(request()->getUrl());
            }
        }

        $this->channel = 'adweixin_create';
        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionList($all=0)
    {
        $data = AdminAdWeixin::fetchList($this->user->id, $all);
        $listAllLink = l($all ? '显示有效账号' : '显示全部账号', url($this->route, array('all'=>(int)!$all)), array('class'=>'btn btn-mini'));
        $data['listAllLink'] = $listAllLink;
        
        $this->channel = 'adweixin_list';
        $this->title = '推广账号号列表';
        $this->render('list', $data);
    }
    
    public function actionChangeState($callback, $id)
    {
        $id = (int)$id;
        if ($id > 0)
            $model = AdminAdWeixin::model()->findByPk($id, 'user_id = :userid', array(':userid'=>$this->userID));
        
        if ($model === null)
            throw new CHttpException(500, '非法请求');
        
        $model->state = $model->state ? ADWEIXIN_STATE_DISABLED : ADWEIXIN_STATE_ENABLED;
        $result = $model->save(true, array('state'));
        $data = array(
            'errno' => (int)!$result,
            'text' => $model->getStateText(),
            'label' => $model->getStateLabel(),
        );
        CDBase::jsonp($callback, $data);
    }
}