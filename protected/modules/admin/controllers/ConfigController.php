<?php
class ConfigController extends AdminController
{
    public function actionView($cid)
    {
        $cid = (int)$cid;
        $cmd = app()->getDb()->createCommand()
            ->from(TABLE_CONFIG)
            ->order('id asc')
            ->where('category_id = :cid', array(':cid' => $cid));
        $rows = $cmd->queryAll();
        
        $labels = AdminConfig::categoryLabels();
        $this->title = '查看配置参数&nbsp;-&nbsp;' . $labels[$cid];
        $this->render('list', array(
            'models' => $rows,
            'categoryid' => $cid,
        ));
    }
    
    public function actionEdit($cid)
    {
        $cid = (int)$cid;
        
        if (request()->getIsPostRequest() && isset($_POST['AdminConfig'])) {
            $params = $_POST['AdminConfig'];
            $result = self::saveConfigParams($params);
            if ($result === true) {
                user()->setFlash('save_config_success', '参数保存成功');
                self::afterSaveConfig();
            }
            else
                $errorNames = $result;
        }
        
        $cmd = app()->getDb()->createCommand()
            ->from(AdminConfig::model()->tableName())
            ->order('id asc')
            ->where('category_id = :cid', array(':cid' => $cid));
        $rows = $cmd->queryAll();
        
        $labels = AdminConfig::categoryLabels();
        $this->title = '查看配置参数&nbsp;-&nbsp;' . $labels[$cid];
        $this->render('edit', array(
            'models'=>$rows,
            'categoryid' => $cid,
            'errorNames' => $errorNames,
        ));
    }
    
    public static function saveConfigParams(array $params)
    {
        $names = array();
        foreach ($params as $name => $value) {
            try {
                $result = app()->getDb()->createCommand()
                    ->update(TABLE_CONFIG, array('config_value'=>$value), 'config_name = :configname', array(':configname'=>$name));
            }
            catch (Exception $e) {
                array_push($names, $name);
            }
        }
        return empty($names) ? true : $names;
    }
    
    public function afterSaveConfig()
    {
        AdminConfig::flushAllConfig();
    }
    
    public function actionCreate($id = 0)
    {
        $id = (int)$id;
        $model = ($id > 0) ? AdminConfig::model()->findByPk($id) : new AdminConfig();
        
        if (request()->getIsPostRequest() && isset($_POST['AdminConfig'])) {
            $model->attributes = $_POST['AdminConfig'];
            if ($model->save()) {
                $this->afterSaveConfig();
                user()->setFlash('save_config_success', '参数保存成功');
                request()->redirect(url('admin/config/view', array('categoryid'=>$model->category_id)));
            }
        }
        
        $this->title = '新建自定义参数';
        $this->render('create', array(
            'model' => $model,
        ));
    }

}

