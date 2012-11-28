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
    
    protected function getConfigFile()
    {
        return $this->getBasePath() . DIRECTORY_SEPARATOR . 'config.php';
    }
}
