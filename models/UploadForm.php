<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class UploadForm extends Model
{
    public $file;

    public $fileNamePath;

    public $fileName;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $dir = 'uploads/' . date("Y-m-d") . '/';
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $this->fileName = uniqid() .'_'.$this->file->baseName.'.'. $this->file->extension;

            $this->fileNamePath = $dir. uniqid() .'_'.$this->file->baseName.'.'. $this->file->extension;

            $this->file->saveAs($this->fileNamePath);
            return true;
        } else {
            return false;
        }
    }

}