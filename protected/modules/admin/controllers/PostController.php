<?php
class PostController extends AdminController
{
    public function actionCreate($id = 0, $type = POST_TYPE_ONE)
    {
        $id = (int)$id;
        if ($id > 0)
            $model = AdminPost::model()->findByPk($id, 'user_id = :userid', array(':userid'=>$this->userID));
        else
            $model = new AdminPost();
        
        if ($model->getIsNewRecord()) {
            $model->ad_line_count = param('ad_weixin_default_line_show_count');
            $model->weixin_id = CDCache::fetchLastCreatePostWxid();
            $model->type_id = $type;
        }
        else
            $model->ad_accounts AND $model->ad_accounts = $model->getAdWeixinIDArray();
        
        if (request()->getIsPostRequest() and isset($_POST['AdminPost'])) {
            $model->attributes = $_POST['AdminPost'];
            $model->user_id = user()->id;
            $contents = array_filter($_POST['content']);
            $model->content = join(POST_CONTENT_MULTIPLE_DIVIDER, $contents);
            
            if ($model->getIsNewRecord())
                CDCache::saveLastCreatePostWxid($model->weixin_id);
            
            $model->ad_accounts = $_POST['adaccounts'];
            
            if ($model->save()) {
                user()->setFlash('post_create_result', '保存内容成功');
                $this->redirect(request()->getUrl());
            }
        }
        
        $this->channel = $type == POST_TYPE_ONE ? 'post_create_one' : 'post_create_group';
        $this->title = '添加内容';
        $this->render('create', array(
            'model' => $model,
            'weixinData' => CHtml::listData($this->user->weixins, 'id', 'wxname'),
            'adWeixinData' => $this->fetchSortAdweixins($model),
        ));
    }
    
    private function fetchSortAdweixins(Post $model)
    {
        $array = CHtml::listData($this->user->adweixins, 'id', 'wxname');
        $selected = $model->getAdWeixinIDArray();
        $data = array();
        foreach ($selected as $sid) {
             foreach ($array as $id => $name) {
                if ($sid == $id) {
                    $data[$sid] = $name;
                    unset($array[$sid]);
                }
             }
        }
//         print_r($data);exit;
        return $data + $array;
    }
    
    public function actionList($wxid = 0)
    {
        $wxid = (int)$wxid;
        $data = AdminPost::fetchList($this->user->id, $wxid);
        
        $weixinModels = AdminWeixin::fetchList($this->user->id, false, false);
        $data['weixins'] = CHtml::listData($weixinModels, 'id', 'wxname');
        $data['wxid'] = $wxid;
        
        $this->channel = 'post_list';
        $this->title = '我的内容列表';
        $this->render('list', $data);
    }
    
    public function actionStats($id = 0, $wxid = 0)
    {
        $id = (int)$id;
        if ($id > 0)
            $this->onePostStats($id);
        else
            $this->allPostStats($wxid);
    }
    
    private function onePostStats($id)
    {
        $post = AdminPost::model()->findByPk($id, 'user_id = :userid', array(':userid'=>$this->userID));
        if ($post === null)
            throw new CHttpException(404, '此文章内容不存在');
        
        $this->title = '文章推广数据统计：' . $post->title;
        $this->channel = 'post_stats';
        $this->render('one_stats', array(
            'post' => $post,
        ));
    }
    
    private function allPostStats($wxid = 0)
    {
        $wxid = (int)$wxid;
        $data = AdminPost::fetchList($this->user->id, $wxid);
        $weixinModels = AdminWeixin::fetchList($this->user->id, false, false);
        $data['weixins'] = CHtml::listData($weixinModels, 'id', 'wxname');
        $data['wxid'] = $wxid;
        
        $this->channel = 'post_stats';
        $this->title = '内容访问统计';
        $this->render('list_stats', $data);
    }

}