<?php
class PostController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'weixin';
    }
    
    public function actionShow($id, $back='')
    {
        $id = (int)$id;
        if ($id <= 0)
            $this->forward('weixin/error');
    
        $post = Post::model()->with('weixin', 'adweixin')->findByPk($id);
        if ($post === null)
            $this->forward('weixin/error');
        
        $route = $back ? 'post/backstats' : 'post/viewstats';
        $viewStatsUrl = aurl($route, array('pid'=>$post->id));
        $shareData = array(
            'image_url' => $post->weixinShareImgUrl,
            'title' => h($post->title),
            'desc' => h($post->title),
            'link' => $post->backUrl,
            'viewStatsUrl' => $viewStatsUrl,
            'shareUrl' => aurl('post/sharestats', array('pid'=>$post->id)),
            'backUrl' => $post->backUrl,
            'followUrl' => aurl('post/follow', array('pid'=>$post->id)),
        );
    
        $datajs = sprintf('var wxdata = %s;', json_encode($shareData));
        cs()->registerScript('data_jscode', $datajs, CClientScript::POS_END);
        
        self::outputStaticCode();
        
        $this->pageTitle = $post->title;
        
        $this->render('show', array(
            'post' => $post,
            'weixin' => $post->weixin,
            'adweixinCount' => count($post->getAdWeixinIDArray()),
            'lineShowWeixin' => $post->getLineShowWeixin(),
            'gridShowWeixin' => $post->getGridShowWeixin(),
        ));
    }
    
    public static function outputStaticCode($theme = null)
    {
        $cssfile = tbp('css/cd-weixin.css', true, $theme);
        if (file_exists($cssfile) && is_readable($cssfile) && $css = file_get_contents($cssfile))
            cs()->registerCss('wxcss', $css);
        
        $zeptofile = sbp('libs/zepto.min.js');
        if (file_exists($zeptofile) && is_readable($zeptofile) && $zeptojs = file_get_contents($zeptofile))
            cs()->registerScript('zeptojs', $zeptojs, CClientScript::POS_END);
        
        $wxfile = sbp('js/weixinapi.js');
        if (file_exists($wxfile) && is_readable($wxfile) && $wxjs = file_get_contents($wxfile))
            cs()->registerScript('wxjs', $wxjs, CClientScript::POS_END);
        
        $themefile = tbp('js/cd-weixin.js', false, $theme);
        if (file_exists($themefile) && is_readable($themefile) && $themejs = file_get_contents($themefile))
            cs()->registerScript('themejs', $themejs, CClientScript::POS_END);
    }

    
    public function actionError()
    {
        echo '出现错误';
        exit(0);
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
}


