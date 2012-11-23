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
            if ($result)
                $theme->forcePublishResources();
            
            if ($result) {
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
    
    public function actionFlush()
    {
        if (request()->getIsPostRequest()) {
            CDBase::publishAllThemeResources(true);
            user()->setFlash('flush_theme_cache_success', '所有模板缓存更新完毕');
            $this->redirect(request()->getUrl());
        }
        
        $this->breadcrumbs[] = '更新缓存';
        $this->channel = 'flushtheme';
        $this->render('flush');
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

