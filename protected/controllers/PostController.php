<?php
class PostController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'weixin';
    }

    public function filters()
    {
        return array(
            'postOnly + viewstats, backstats, sharestats, follow',
            'ajaxOnly + viewstats, backstats, sharestats, follow',
        );
    }
    
    public function actionShow($id, $back='')
    {
        $id = (int)$id;
        if ($id <= 0)
            $this->forward('weixin/error');
    
        $post = Post::model()->with('weixin', 'adweixin')->findByPk($id);
        if ($post === null)
            $this->forward('weixin/error');
    
        $this->pageTitle = $post->title;
        
        $viewStatsUrl = $back ? aurl('post/backstats') : aurl('post/viewstats');
        $view = $post->type_id == POST_TYPE_GROUP ? 'show_group' : 'show_one';
        $this->render($view, array(
            'post' => $post,
            'viewUrl' => $viewStatsUrl,
        ));
    }

    
    public function actionError()
    {
        echo '出现错误';
        exit(0);
    }
    
    public function actionViewstats($callback)
    {
        $postid = (int)$_POST['postid'];
        $counters = array('view_count' => 1);
        $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $postid));
        $data = array(
            'errno' => (int)!$count
        );
        CDBase::jsonp($callback, $data);
        exit(0);
    }
    
    public function actionBackstats($callback)
    {
        $postid = (int)$_POST['postid'];
        $counters = array('view_count' => 1, 'back_count'=>1);
        $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $postid));
        $data = array(
            'errno' => (int)!$count
        );
        CDBase::jsonp($callback, $data);
        exit(0);
    }
    
    public function actionSharestats($callback)
    {
        $postid = (int)$_POST['postid'];
        $msg = strtolower(trim($_POST['msg']));
        if ($msg == 'share_timeline:confirm') {
            $counters = array('share_count' => 1);
            $count = Post::model()->updateCounters($counters, 'id = :postid', array(':postid' => $postid));
            $data = array(
                'errno' => (int)!$count
            );
        }
        else
            $data = array('errno' => 1);
        
        CDBase::jsonp($callback, $data);
        exit(0);
    }
    
    public function actionFollow($callback)
    {
        $postid = (int)$_POST['postid'];
        $wxid = (int)$_POST['wxid'];
        $msg = strtolower(trim($_POST['msg']));
        if ($msg == 'add_contact:ok') {
            $counters = array('follow_success' => 1);
            $params = array(':postid' => $postid, ':wxid' => $wxid);
            $count = PostWeixin::model()->updateCounters($counters, 'post_id = :postid and wx_id = :wxid', $params);
            $data = array(
                'errno' => (int)!$count
            );
        }
        elseif ($msg == 'add_contact:cancel' || $msg == 'add_contact:fail') {
            $counters = array('follow_fail' => 1);
            $params = array(':postid' => $postid, ':wxid' => $wxid);
            $count = PostWeixin::model()->updateCounters($counters, 'post_id = :postid and wx_id = :wxid', $params);
            $data = array(
                'errno' => (int)!$count
            );
        }
        else
            $data = array('errno' => 1);
        
        CDBase::jsonp($callback, $data);
        exit(0);
    }
}


