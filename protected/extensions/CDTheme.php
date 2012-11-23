<?php
/**
 * CDTheme
 * @author chendong
 *
 * @property array $config
 * @property string $resourcePath
 * @property string $assetPath
 * @property string $assetUrl
 */
class CDTheme extends CTheme
{
    public function getConfig($name = null)
    {
        $filename = $this->getConfigFile();
        $config = array();
        if (file_exists($filename) && is_readable($filename)) {
            $config = @require($filename);
        }
        
        if (empty($name))
            return $config;
        elseif (array_key_exists($name, $config))
            return $config[$name];
    }
    
    public function getResourcePath()
    {
        return $this->getBasePath() . DIRECTORY_SEPARATOR . 'resources';
    }
    
    public function getAssetPath($file = null, $hashByName = false)
    {
        static $basePath = array();
        if ($basePath[$this->name] === null)
            $basePath[$this->name] = Yii::app()->getAssetManager()->getPublishedPath($this->getResourcePath(), $hashByName);
        
        if (empty($basePath[$this->name])) return false;
        
        if (empty($file))
            return $basePath[$this->name];
        else
            return $basePath[$this->name] . DS . ltrim($file, DS);
        
    }
    
    public function getAssetUrl($file = null, $hashByName = false)
    {
        static $baseUrl = array();
        if ($baseUrl[$this->name] === null)
            $baseUrl[$this->name] = Yii::app()->getAssetManager()->getPublishedUrl($this->getResourcePath(), $hashByName);
        
        if (empty($baseUrl[$this->name])) return false;
        
        if (empty($file))
            return $baseUrl[$this->name];
        else
            return $baseUrl[$this->name] . '/' . ltrim($file, '/');
    }
    
    public function publishResources($hashByName = false, $level = -1, $forceCopy = false)
    {
        return Yii::app()->getAssetManager()->publish($this->getResourcePath(), $hashByName, $level, $forceCopy);
    }
    
    public function forcePublishResources()
    {
        return $this->publishResources(false, -1, true);
    }
    
    protected function getConfigFile()
    {
        return $this->getBasePath() . DIRECTORY_SEPARATOR . 'config.php';
    }
    
}



