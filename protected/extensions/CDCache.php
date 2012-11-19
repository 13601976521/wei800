<?php
class CDCache
{
    public static function saveLastCreatePostWxid($wxid)
    {
        $wxid = (int)$wxid;
        if (app()->cache === null || $wxid <= 0) return false;
        
        $cacheID = param('cacheid_last_post_wxid');
        return app()->cache->set($cacheID, $wxid);
        
    }
    
    public static function fetchLastCreatePostWxid()
    {
        if (app()->cache === null) return false;
        
        $cacheID = param('cacheid_last_post_wxid');
        return app()->cache->get($cacheID);
    }
}