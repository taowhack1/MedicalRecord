<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SearchForm extends Model
{
    public $key;

    public function rules()
    {
        return [
            [['key'], 'required'],
        ];
    }
}