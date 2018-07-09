<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $lastname;
    public $email;
    public $mobile;

    public function rules()
    {
        return [
            [['name','lastname','email' , 'mobile'], 'required'],
            ['email', 'email'],
            ['mobile', 'string' , 'max' => 10],
            ['mobile', 'match', 'pattern' => '/^0\d{9}$/'],
        ];
    }
}