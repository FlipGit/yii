<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $app_output_key_id
 * @property integer $app_output_structure_id
 * @property string $key
 * @property string $comparison
 * @property string $measure
 * @property AppOutputStructure $appOutputStructure
 */
class AppOutputKey extends ActiveRecord
{
    const COMPARISON_HIGHER_BETTER = 1;
    const COMPARISON_LOWER_BETTER = 2;

    public static function tableName()
    {
        return 'app_output_key';
    }

    public function rules()
    {
        return [
            [['app_output_structure_id', 'key', 'comparison'], 'required'],
            [['app_output_key_id'], 'integer'],
            [['app_output_structure_id'], 'integer'],
            [['key'], 'string', 'max' => 64],
            [['comparison'], 'integer'],
            [['comparison'], 'in', 'range' => array_keys(self::getComparisonCollection())],
            [['measure'], 'string', 'max' => 32]
        ];
    }

    public function attributeLabels()
    {
        return [
            'app_output_key_id' => 'ID',
            'key' => 'Key',
            'comparison' => 'Comparison',
            'measure' => 'Measure'
        ];
    }

    public function getAppOutputStructure()
    {
        return $this->hasOne(AppOutputStructure::className(), [
            'app_output_structure_id' => 'app_output_structure_id'
        ]);
    }

    public static function getComparisonCollection()
    {
        return [
            self::COMPARISON_HIGHER_BETTER => 'Higher better',
            self::COMPARISON_LOWER_BETTER => 'Lower better'
        ];
    }
}