<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $app_output_structure_id
 * @property string $name
 * @property string $note
 */
class AppOutputStructure extends ActiveRecord
{
    public static function tableName()
    {
        return 'app_output_structure';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['note'], 'string', 'max' => 256]
        ];
    }

    public function attributeLabels()
    {
        return [
            'app_output_structure_id' => 'ID',
            'name' => 'Name',
            'note' => 'Note'
        ];
    }
}