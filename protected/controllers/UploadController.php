<?php
class UploadController extends Controller
{
    public function actionImage()
    {
        
        if (!user()->getIsGuest() && request()->getIsPostRequest()) {
            $upload = CUploadedFile::getInstanceByName('imgFile');
            if ($upload->hasError) {
                $data = array(
                    'error' => 1,
                    'message' => 'upload file error: ' . $upload->error,
                );
            }
            else
                $data = $this->uploadImage($upload, UPLOAD_TYPE_PICTURE, 'images');
        }
        else {
            $data = array(
                'error' => 1,
                'message' => '您没有上传文件的权限',
            );
        }
        
        echo CJSON::encode($data);
        exit(0);
    }
    
    private function uploadImage(CUploadedFile $upload, $fileType = UPLOAD_TYPE_UNKNOWN, $additional = 'images')
    {
        $filename = CDBase::uploadImage($upload, $additional);
        if ($filename === false || !$this->afterUploaded($upload, $filename['url'], $fileType)) {
            $data = array(
                'error' => 1,
                'message' => '上传图片出错',
            );
        }
        else {
            @unlink(realpath(fbp($filename['path'])));
            $data = array(
                'error' => 0,
                'url' => fbu($filename['url']),
            );
        }
        return $data;
    }
    
    private function uploadFile(CUploadedFile $upload, $fileType = UPLOAD_TYPE_UNKNOWN, $additional = 'files')
    {
        $filename = CDBase::uploadFile($upload, $additional);
        if ($filename === false || !$this->afterUploaded($upload, $filename['url'], $fileType)) {
            $data = array(
                'error' => 1,
                'message' => '上传文件出错',
            );
        }
        else {
            @unlink(realpath(fbp($filename['path'])));
            $data = array(
                'error' => 0,
                'url' => fbu($filename['url']),
            );
        }
        return $data;
    }
    
    private function afterUploaded(CUploadedFile $upload, $fileUrl, $fileType = UPLOAD_TYPE_UNKNOWN)
    {
        return true;
    }
}

