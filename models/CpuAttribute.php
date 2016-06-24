<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpu_attribute".
 *
 * @property integer $cpu_attribute_id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $comparison
 * @property integer $order
 * @property integer $cpu_attribute_group_id
 *
 * @property CpuAttributeGroup $cpuAttributeGroup
 * @property CpuAttributeValue[] $cpuAttributeValues
 */
class CpuAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpu_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'comparison'], 'string'],
            [['order', 'cpu_attribute_group_id'], 'integer'],
            [['cpu_attribute_group_id'], 'required'],
            [['name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 2048],
            [['cpu_attribute_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CpuAttributeGroup::className(), 'targetAttribute' => ['cpu_attribute_group_id' => 'cpu_attribute_group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpu_attribute_id' => Yii::t('app', 'Cpu Attribute ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'comparison' => Yii::t('app', 'Comparison'),
            'order' => Yii::t('app', 'Order'),
            'cpu_attribute_group_id' => Yii::t('app', 'Cpu Attribute Group ID'),
        ];
    }

    public function validateValueByType($value)
    {
        $types = [
            'integer' => [
                'message' => 'Incorrect input. Integer expected.',
                'callback' => function ($value) {
                    return ctype_digit($value);
                }
            ],
            'string' => [
                'message' => 'Incorrect input. String expected.',
                'callback' => function ($value) {
                    return is_string($value);
                }
            ]
        ];

        if (!isset($types[$this->type])) {
            return ['valid' => false, 'message' => 'Data type: "' . $this->type . '" not supported.'];
        }

        return $types[$this->type]['callback']($value)
            ? ['valid' => true, 'message' => null]
            : ['valid' => false, 'message' => $types[$this->type]['message']];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributeGroup()
    {
        return $this->hasOne(CpuAttributeGroup::className(), ['cpu_attribute_group_id' => 'cpu_attribute_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributeValues()
    {
        return $this->hasMany(CpuAttributeValue::className(), ['cpu_attribute_id' => 'cpu_attribute_id']);
    }
}
