<?php
class WeixinController extends Controller
{
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
            'img_url' => $post->weixinShareImgUrl,
            'title' => h($post->title),
            'desc' => h($post->getSummary(100)),
            'link' => $post->backUrl,
            'viewStatsUrl' => $viewStatsUrl,
            'shareUrl' => aurl('weixin/sharestats', array('pid'=>$post->id)),
            'backUrl' => $post->backUrl,
            'followUrl' => aurl('weixin/follow', array('pid'=>$post->id)),
        );
    
        $datajs = sprintf('var wxdata = %s;', json_encode($shareData));
        cs()->registerScript('data_jscode', $datajs, CClientScript::POS_HEAD);
    
        $this->pageTitle = $post->title;
        $this->render('post', array(
            'post' => $post,
            'weixin' => $post->weixin,
            'adweixinCount' => count($post->getAdWeixinIDArray()),
            'lineShowWeixin' => $post->getLineShowWeixin(),
            'gridShowWeixin' => $post->getGridShowWeixin(),
        ));
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

