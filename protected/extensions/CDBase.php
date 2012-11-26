<?php
class CDBase
{
    const VERSION = '1.0';
    
    const FILE_NO_EXIST = -1; // '目录不存在并且无法创建';
    const FILE_NO_WRITABLE = -2; // '目录不可写';
    
    public static function powered()
    {
        return '24blog ' . self::VERSION;
    }
    
    /**
     * 获取客户端IP地址
     * @return string 客户端IP地址
     */
    public static function getClientIp()
    {
        if ($_SERVER['HTTP_CLIENT_IP']) {
	      $ip = $_SERVER['HTTP_CLIENT_IP'];
	 	} elseif ($_SERVER['HTTP_X_FORWARDED_FOR']) {
	      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	 	} else {
	      $ip = $_SERVER['REMOTE_ADDR'];
	 	}

        return $ip;
    }


    public static function jsonp($callback, $data, $exit = true)
    {
        if (empty($callback))
            throw new CException('callback is not allowed empty');
    
        echo $callback . '(' . CJSON::encode($data) . ')';
        if ($exit) exit(0);
    }
    
    /************* user functions ******************/
    
    public static function encryptPassword($password)
    {
        $pwd = '';
        if (!empty($password))
            $pwd = md5($password);
    
        return $pwd;
    }
    
    /************* upload functions ******************/
    
    /**
     * 返回上传后的文件路径
     * @return string|Array 如果成功则返回路径地址，如果失败则返回错误号和错误信息
     * -1 目录不存在并且无法创建
     * -2 目录不可写
     */
    public static function makeUploadPath($additional = null, $basePath = null)
    {
        $relativeUrl = (($additional === null) ? '' : $additional . '/') . date('Y/m/d/', $_SERVER['REQUEST_TIME']);
        $relativePath = (($additional === null) ? '' : $additional . DS) . date(addslashes(sprintf('Y%sm%sd%s', DS, DS, DS)), $_SERVER['REQUEST_TIME']);

        if (empty($basePath))
            $basePath = param('uploadBasePath');
        $path = $basePath . $relativePath;

        if ((file_exists($path) || mkdir($path, 0755, true)) && is_writable($path))
            return array(
            	'path' => realpath($path) . DS,
                'url' => $relativeUrl,
            );
        else
            throw new Exception('path not exist or not writable', 0);
    }

    /**
     * 生成文件名
     * @param string $filename 软件名
     * @return string 转化之后的名称
     */
    public static function makeUploadFileName($extension)
    {
        $extension = strtolower($extension);
        $file =  date('YmdHis_', $_SERVER['REQUEST_TIME'])
            . uniqid()
            . ($extension ? '.' . $extension : '');
        
        return $file;
    }
    
    public static function makeUploadFilePath($extension, $additional = null, $basePath = null)
    {
        $path = self::makeUploadPath($additional, $basePath);
        $file = self::makeUploadFileName($extension);
        
        $data = array(
            'path' => $path['path'] . $file,
            'url' => $path['url'] . $file,
        );
        
        return $data;
    }

    public static function uploadImage(CUploadedFile $upload, $additional = null, $compress = true, $deleteTempFile = true)
    {
        if (!$compress) {
            $result = self::uploadFile($upload, $additional, $deleteTempFile);
            return $result;
        }
        
        $path = self::makeUploadPath($additional, $basePath = null);
        $file = self::makeUploadFileName(null);
        $filename = $path['path'] . $file;
        $im = new CDImage();
        $im->load($upload->tempName);
        $result = $im->save($filename);
        $newFilename = $im->filename();
        unset($im);
        if ($result === false)
            return false;
        else {
            $filename = array(
                'path' => $path['path'] . $newFilename,
                'url' => $path['url'] . $newFilename
            );
            return $filename;
        }
    }
    
    public static function uploadFile(CUploadedFile $upload, $additional = null, $deleteTempFile = true)
    {
        $filename = self::makeUploadFilePath($upload->extensionName, $additional, $basePath = null);
        $result = $upload->saveAs($filename['path'], $deleteTempFile);
        if ($result)
            return $filename;
        else
            return false;
    }

    public static function mergeHttpUrl($baseurl, $relativeUrl)
    {
        $baseurl = trim($baseurl, ' \'\"');
        $relativeUrl = trim($relativeUrl, ' \'\"');
        
        // $baseurl and $relativeUrl is null
        if (empty($baseurl) || empty($relativeUrl))
            return false;
        
        if (filter_var($relativeUrl, FILTER_VALIDATE_URL) !== false && stripos($relativeUrl, 'http://') === 0)
            return $relativeUrl;
        
        // $baseurl is not a valid url
        $result = filter_var($baseurl, FILTER_VALIDATE_URL);
        if ($result === false) return false;
        
        // $baseurl is not a valid http protocol url
        $pos = stripos($baseurl, 'http://');
        if ($pos !== 0) return false;
        
        $parts = parse_url($baseurl);
        unset($parts['query'], $parts['fragment']);
        $pos = stripos($relativeUrl, '/');
        if ($pos === 0)
            $parts['path'] = $relativeUrl;
        else
            $parts['path'] = dirname($parts['path']) . '/' . ltrim($relativeUrl, './');
        
        $url = function_exists('http_build_url') ? http_build_url($url, $parts) : self::httpBuildUrl($parts);
        
        return $url;
    }
    
    public function httpBuildUrl(array $parts)
    {
        if (array_key_exists('scheme', $parts))
            $url = $parts['scheme'] . '://';
        
        if (array_key_exists('user', $parts))
            $url .= $parts['user'] . ':' . $parts['pass'] . '@';
        
        $url .= $parts['host'];
        if (array_key_exists('port', $parts))
            $url .= ':' . $parts['port'];
        
        if (array_key_exists('path', $parts))
            $url .= $parts['path'];
        
        return $url;
    }

    public static function userIsMobileBrower()
    {
        $browers = array('iPhone', 'Android', 'hpwOS', 'Windows Phone OS', 'BlackBerry');
        $agent = $_SERVER['HTTP_USER_AGENT'];
        foreach ($browers as $brower) {
            $pos = stripos($agent, $brower);
            if ($pos !== false) return true;
        }
        
        return false;
    }

    public static function isHttpUrl($url)
    {
        $url = trim($url);
        $pos = stripos($url, 'http://');
        return $pos === 0;
    }

    /************* global url functions ******************/
	
    public static function siteHomeUrl()
    {
        return aurl('site/index');
    }

    public static function adminHomeUrl()
    {
        return aurl('admin/default/index');
    }

    public static function loginUrl()
    {
        return aurl('site/login');
    }

    public static function logoutUrl()
    {
        return aurl('site/logout');
    }

    public static function signupUrl()
    {
        return aurl('site/signup');
    }


    /**************** keyword filter ***********************/
    
    public static function filterText($text)
    {
        static $keywords = null;
        if ($keywords === null) {
            $filename = dp('filter_keywords.php');
            if (file_exists($filename) && is_readable($filename)) {
                $keywords = require($filename);
            }
            else
                return $text;
        }
        //         var_dump($keywords);exit;
        if (empty($keywords)) return $text;
    
        try {
            $patterns = array_keys($keywords);
            foreach ($patterns as $index => $pattern) {
                $patterns[$index] = '/' . $pattern . '/is';
            }
    
            $replacement = array_values($keywords);
            foreach ($replacement as $index => $word)
                $replacement[$index] = empty($word) ? param('filterKeywordReplacement') : $word;
    
            $result = preg_replace($patterns, $replacement, $text);
            $newText = ($result === null) ? $text : $result;
        }
        catch (Exception $e) {
            $newText = $text;
        }
    
        return $newText;
    }
    
    
    /*************************** theme functions *****************************/

    public static function publishAllThemeResources($focreCopy = false)
    {
        $names = tm()->getThemeNames();
        foreach ($names as $name) {
            $theme = tm()->getTheme($name);
            if ($theme !== null) {
                if ($focreCopy)
                    $theme->forcePublishResources();
                else
                    $theme->publishResources();
            }
        }
    }
    
    public static function themeScreens()
    {
        $data = array();
        $names = tm()->getThemeNames();
        foreach ($names as $name) {
            $theme = tm()->getTheme($name);
            if ($theme !== null) {
                $data[$name] = $theme->getConfig('screen_shoot');
            }
        }
        return $data;
    }

}

