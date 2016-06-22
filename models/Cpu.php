<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpu".
 *
 * @property integer $cpu_id
 * @property string $name
 * @property string $created_date
 * @property string $updated_date
 * @property string $attribute_json
 * @property integer $performance_rank
 * @property double $performance_per_vat
 * @property double $performance_per_dollar
 *
 * @property CpuAttributeValue[] $cpuAttributeValues
 * @property CpuTest[] $cpuTests
 */
class Cpu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'updated_date'], 'safe'],
            [['attribute_json'], 'string'],
            [['performance_rank'], 'integer'],
            [['performance_per_vat', 'performance_per_dollar'], 'number'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpu_id' => Yii::t('app', 'Cpu ID'),
            'name' => Yii::t('app', 'Name'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'attribute_json' => Yii::t('app', 'Attribute Json'),
            'performance_rank' => Yii::t('app', 'Performance Rank'),
            'performance_per_vat' => Yii::t('app', 'Performance Per Vat'),
            'performance_per_dollar' => Yii::t('app', 'Performance Per Dollar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributeValues()
    {
        return $this->hasMany(CpuAttributeValue::className(), ['cpu_id' => 'cpu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuTests()
    {
        return $this->hasMany(CpuTest::className(), ['cpu_id' => 'cpu_id']);
    }
}
