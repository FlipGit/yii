<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['email'], 'email', 'message' => '"{value}" is not valid email address.']
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate() == false) {
            return false;
        }

        if ($this->email == '2@mail.ru') {
            $this->addError('email', 'This email address already in use.');
            return false;
            
        }

        return true;
    }
}