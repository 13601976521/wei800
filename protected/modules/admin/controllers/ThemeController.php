<?php
class ThemeController extends AdminController
{
    public function actionSelect()
    {
        if (request()->getIsPostRequest() && isset($_POST['theme'])) {
            $themeName = $_POST['theme'];
            $theme = tm()->getTheme($themeName);
            if ($theme === null)
                throw new CException($themeName . '&nbsp;不存在');
            $result = AdminConfig::saveConfig('theme', $themeName);

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

