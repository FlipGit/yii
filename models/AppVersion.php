<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $app_version_id
 * @property integer $app_id
 * @property string $version
 * @property App $app
 */
class AppVersion extends ActiveRecord
{

    public static function tableName()
    {
        return 'app_version';
    }

    public function rules()
    {
        return [
            [['version', 'app_id'], 'required'],
            [['app_id'], 'integer'],
            [['version'], 'string', 'max' => 32]
        ];
    }

    public function attributeLabels()
    {
        return [
            'version' => 'Version',
            'app_version_id' => 'ID',
            'app_id' => 'App ID'
        ];
    }

    public function getApp()
    {
        return $this->hasOne(App::className(), [
            'app_id' => 'app_id'
        ]);
    }
}