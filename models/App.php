<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $app_id
 * @property string $name
 * @property integer $description
 * @property AppVersion[] $versionCollection
 */
class App extends ActiveRecord
{

    public static function tableName()
    {
        return 'app';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 65536]
        ];
    }

    public function attributeLabels()
    {
        return [
            'app_id' => 'ID',
            'name' => 'Name',
            'description' => 'Description'
        ];
    }

    public function getVersionCollection()
    {
        return $this->hasMany(AppVersion::className(), [
            'app_id' => 'app_id'
        ]);
    }

}