<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpu_attribute_group".
 *
 * @property integer $cpu_attribute_group_id
 * @property string $name
 * @property integer $order
 * @property integer $parent_cpu_attribute_group_id
 *
 * @property CpuAttribute[] $cpuAttributes
 * @property CpuAttributeGroup $parentCpuAttributeGroup
 * @property CpuAttributeGroup[] $cpuAttributeGroups
 */
class CpuAttributeGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpu_attribute_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'parent_cpu_attribute_group_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['parent_cpu_attribute_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CpuAttributeGroup::className(), 'targetAttribute' => ['parent_cpu_attribute_group_id' => 'cpu_attribute_group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpu_attribute_group_id' => Yii::t('app', 'Cpu Attribute Group ID'),
            'name' => Yii::t('app', 'Name'),
            'order' => Yii::t('app', 'Order'),
            'parent_cpu_attribute_group_id' => Yii::t('app', 'Parent Cpu Attribute Group ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributes()
    {
        return $this->hasMany(CpuAttribute::className(), ['cpu_attribute_group_id' => 'cpu_attribute_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentCpuAttributeGroup()
    {
        return $this->hasOne(CpuAttributeGroup::className(), ['cpu_attribute_group_id' => 'parent_cpu_attribute_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributeGroups()
    {
        return $this->hasMany(CpuAttributeGroup::className(), ['parent_cpu_attribute_group_id' => 'cpu_attribute_group_id']);
    }
}
