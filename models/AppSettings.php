<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $app_settings_id
 * @property integer $app_version_id
 * @property integer $app_output_structure_id
 * @property string $name
 * @property string $details
 * @property AppVersion $appVersion
 * @property AppOutputStructure $appOutputStructure
 */
class AppSettings extends ActiveRecord
{

    public static function tableName()
    {
        return 'app_settings';
    }

    public function rules()
    {
        return [
            [['app_version_id', 'app_output_structure_id', 'name'], 'required'],
            [['app_settings_id'], 'integer'],
            [['app_version_id'], 'integer'],
            [['app_output_structure_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['details'], 'string', 'max' => 65536]
        ];
    }

    public function attributeLabels()
    {
        return [
            'app_settings_id' => 'ID',
            'app_version_id' => 'App Version ID',
            'app_output_structure_id' => 'App Output Structure ID',
            'name' => 'Name',
            'details' => 'Details'
        ];
    }

    public function getAppVersion()
    {
        return $this->hasOne(AppVersion::className(), [
            'app_version_id' => 'app_version_id'
        ]);
    }

    public function getAppOutputStructure()
    {
        return $this->hasOne(AppOutputStructure::className(), [
            'app_output_structure_id' => 'app_output_structure_id'
        ]);
    }
}