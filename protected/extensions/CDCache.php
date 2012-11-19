<?php
class CDCache
{
    public static function saveLastCreatePostWxid($wxid)
    {
        $wxid = (int)$wxid;
        if ($wxid <= 0) return false;
        
        $cacheID = param('cacheid_last_post_wxid');
        return app()->cache->set($cacheID, $wxid);
        
    }
    
    public static function fetchLastCreatePostWxid()
    {
        $cacheID = param('cacheid_last_post_wxid');
        return app()->cache->get($cacheID);
    }
}