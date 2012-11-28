<?php
class WeixinController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'weixin';
    }
    
    public function filters()
    {
        return array(
            array(
                'COutputCache + post',
                'duration' => (int)param('weixin_post_cache_time'),
                'varyByParam' => array('id', 'back'),
            ),
        );
    }
    
    public function actionPost($id, $back='')
    {
        $id = (int)$id;
        if ($id <= 0)
            throw new Exception('非法请求');
    
        $post = Post::model()->with('weixin', 'adweixin')->findByPk($id);
        if ($post === null)
            throw new Exception('请求的内容不存在');
    
        if ($post->theme !== null)
            app()->setTheme($post->theme_name);
    
        $route = $back ? 'weixin/backstats' : 'weixin/viewstats';
        $viewStatsUrl = aurl($route, array('pid'=>$post->id));
        $shareData = array(
            'image_url' => $post->weixinShareImgUrl,
            'title' => h($post->title),
            'desc' => h($post->title),
            'link' => $post->backUrl,
            'viewStatsUrl' => $viewStatsUrl,
            'shareUrl' => aurl('weixin/sharestats', array('pid'=>$post->id)),
            'backUrl' => $post->backUrl,
            'followUrl' => aurl('weixin/follow', array('pid'=>$post->id)),
        );
    
        $datajs = sprintf('var wxdata = %s;', json_encode($shareData));
        cs()->registerScript('data_jscode', $datajs, CClientScript::POS_END);
    
        self::outputStaticCode($post->theme);
    
        $this->pageTitle = $post->title;
        $this->render('post', array(
            'post' => $post,
            'weixin' => $post->weixin,
            'adweixinCount' => count($post->getAdWeixinIDArray()),
            'lineShowWeixin' => $post->getLineShowWeixin(),
            'gridShowWeixin' => $post->getGridShowWeixin(),
        ));
    }
    
    public static function outputStaticCode($theme = null)
    {
        $cssfile = sbp('css/cd-weixin.css');
        if (file_exists($cssfile) && is_readable($cssfile) && $css = file_get_contents($cssfile))
            cs()->registerCss('wxcss', $css);
    
        $themeCssfile = tbp('css/weixin.css', false, $theme);
        if (file_exists($themeCssfile) && is_readable($themeCssfile) && $themecss = file_get_contents($themeCssfile))
            cs()->registerCss('themecss', $themecss);
    
        $zeptofile = sbp('libs/zepto.min.js');
        if (file_exists($zeptofile) && is_readable($zeptofile) && $zeptojs = file_get_contents($zeptofile))
            cs()->registerScript('zeptojs', $zeptojs, CClientScript::POS_END);
    
        $wxfile = sbp('js/weixinapi.js');
        if (file_exists($wxfile) && is_readable($wxfile) && $wxjs = file_get_contents($wxfile))
            cs()->registerScript('wxjs', $wxjs, CClientScript::POS_END);
    
        $themeJsfile = tbp('js/cweixin.js', false, $theme);
        if (file_exists($themeJsfile) && is_readable($themeJsfile) && $themejs = file_get_contents($themeJsfile))
            cs()->registerScript('themejs', $themejs, CClientScript::POS_END);
    }
    
    public function actionViewstats($pid)
    {
        header('Content-Type: image/png');
        $pid = (int)$pid;
        $counters = array('view_count' => 1);
        $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $pid));
        exit(0);
    }
    
    public function actionBackstats($pid)
    {
        header('Content-Type: image/png');
        $postid = (int)$pid;
        $counters = array('view_count' => 1, 'back_count'=>1);
        $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $pid));
        exit(0);
    }
    
    public function actionSharestats($pid, $msg)
    {
        header('Content-Type: image/png');
        $pid = (int)$pid;
        $msg = strtolower(trim($msg));
        if ($msg == 'share_timeline:confirm') {
            $counters = array('share_count' => 1);
            $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $pid));
        }
        exit(0);
    }
    
    public function actionFollow($pid, $wxid, $msg)
    {
        header('Content-Type: image/png');
        $pid = (int)$pid;
        $wxid = (int)$wxid;
        $msg = strtolower(trim($msg));
        if ($msg == 'add_contact:ok') {
            $counters = array('follow_success' => 1);
            $params = array(':postid' => $pid, ':wxid' => $wxid);
            $count = PostWeixin::model()->updateCounters($counters, 'post_id = :postid and wx_id = :wxid', $params);
        }
        elseif ($msg == 'add_contact:cancel' || $msg == 'add_contact:fail') {
            $counters = array('follow_fail' => 1);
            $params = array(':postid' => $pid, ':wxid' => $wxid);
            $count = PostWeixin::model()->updateCounters($counters, 'post_id = :postid and wx_id = :wxid', $params);
        }
        exit(0);
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

