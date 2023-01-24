<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class RegisterForm extends ActiveRecord
{
    // public $photos;

    public function rules()
    {
        return [
            [['first_name','last_name','mobile_no','email','gender','age','username','password'],'required'],
            [['first_name','last_name','mobile_no','email','gender','age','username','password','subscriptions'],'safe'],
            [['photos'],'file','skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            ['email','email']
        ];
    }

    public function upload()
    {
        if($this->validate()){
            foreach($this->photos as $file) {
                $file->saveAs('../uploads/'.$file->baseName.'.'.$file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    

}