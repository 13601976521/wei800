<?php
class ThemeController extends AdminController
{
    public function actionSelect()
    {
        if (request()->getIsPostRequest() && isset($_POST['theme_name'])) {
            $themeName = $_POST['theme_name'];
            $theme = tm()->getTheme($themeName);
            if ($theme === null)
                throw new CException($themeName . '&nbsp;不存在');
            $result = AdminConfig::saveThemeName($themeName);
            if ($result) {
                $theme->forcePublishResources();
                user()->setFlash('save_theme_success', '当前选择的模板为：' . $themeName);
                $this->redirect(request()->getUrl());
            }
        }

        $themes = CDBase::themeScreens();
        
        $this->breadcrumbs[] = '选择模板';
        $this->channel = 'selecttheme';
        $this->render('select', array(
            'themes' => $themes,
        ));
    }
    
    public function actionReset()
    {
        if (request()->getIsPostRequest()) {
            $result = AdminConfig::saveThemeName(null);
            user()->setFlash('save_theme_success', '已经将模板重置为系统模板');
        }
        $this->redirect(url('admin/theme/select'));
    }
    
    /**
     * 多用户版
     */
    /*
    public function actionSelect()
    {
        if (request()->getIsPostRequest() && isset($_POST['theme'])) {
            $themeName = $_POST['theme'];
            $theme = tm()->getTheme($themeName);
            if ($theme === null)
                throw new CException($themeName . '&nbsp;不存在');
            $result = AdminUserConfig::saveUserConfig($this->userID, 'theme', $themeName);

            if ($result) {
                user()->setFlash('save_theme_success', '当前选择的模板为：' . $themeName);
                $this->redirect(request()->getUrl());
            }
        }
        
        $themes = self::themeScreens();
        
        $this->breadcrumbs[] = '选择模板';
        $this->channel = 'theme';
        $this->render('select', array(
            'themes' => $themes,
        ));
    }
    */
}

