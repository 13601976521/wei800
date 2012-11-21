<?php

class ProfileController extends AdminController
{
    public function init()
    {
        parent::init();
        $this->breadcrumbs['个人资料'] = array('profile/info');
        
        $this->channel = 'profile';
    }
    
    public function actionIndex()
    {
        $this->forward('profile/info');
    }
    
    public function actionEdit($id)
    {
        $id = (int)$id;
        $model = AdminUser::model()->findByPk($id);
        $this->title = '编辑用户 - ' . $model->name;
         
        if (request()->getIsPostRequest() && isset($_POST['AdminUser'])) {
            $model->attributes = $_POST['AdminUser'];
             
            $attributes = $model->getAttributes();
            $model->state = (bool)$model->state ? USER_STATE_ENABLED : USER_STATE_FORBIDDEN;
            if ($model->getIsNewRecord()) {
                $model->encryptPassword();
            }
            else
                unset($attributes['password']);
             
            if ($model->save()) {
                user()->setFlash('user_create_result', $model->name . '&nbsp;保存成功');
                $this->redirect(request()->getUrl());
            }
        }

        $this->breadcrumbs[] = '更新信息';
        $this->render('edit', array(
            'model' => $model,
        ));
    }
    
	public function actionResetPassword($id)
	{
	    $id = (int)$id;
	    if ($id <= 0)
	        throw new CHttpException(500);
	    
	    $criteria = new CDbCriteria();
	    $criteria->select = array('id', 'email', 'name', 'password');
	    $user = AdminUser::model()->findByPk($id, $criteria);
	    if ($user === null)
	        throw new CHttpException(404, '用户不存在');
	    
	    if (request()->getIsPostRequest() && isset($_POST['AdminUser'])) {
	        $user->attributes = $_POST['AdminUser'];
	        $user->encryptPassword();
	        if ($user->save(true, array('password'))) {
	            user()->setFlash('user_create_result', "修改&nbsp;{$user->name}&nbsp;密码成功");
	            $this->redirect(request()->getUrl());
	        }
	    }
	    
	    $this->breadcrumbs[] = '重设密码';
	    $user->password = '';
	    $this->title = '重设用户密码 - ' . $user->name;
	    $this->render('resetpwd', array('model'=>$user));
	}

    public function actionInfo()
    {
        $model = AdminUser::model()->findByPk($this->userID);
        if ($model === null)
            throw new CHttpException(404, '用户不存在');
        
        $this->breadcrumbs[] = '我的信息';
        $this->title = sprintf('%s&nbsp;(%s)', $model->name, $model->email);
        $this->render('info', array('model' => $model));
    }

}