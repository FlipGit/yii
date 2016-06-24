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
    /* @var $attributes \app\models\CpuAttribute[] */
    //protected $cpuAttributes = -1; // if -1, need to call [[getCpuAttributesWithExistingValues()]]
    /* @var $attributes \app\models\CpuAttributeValue[] */
    protected $itemsToSave = [];

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

    /* @return \app\models\CpuAttribute[] */
/*    public function getCpuAttributes()
    {
        if ($this->cpuAttributes === -1) {
            $this->cpuAttributes = $this->getCpuAttributesWithExistingValues();
        }

        return $this->cpuAttributes;
    }*/

    // @TODO rename
    /* @return \app\models\CpuAttributeValue[] */
    public function getItemsToSave()
    {
        return $this->itemsToSave;
    }

    // in [[$data]] should be data for BOTH models
    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);
        $formNameForAttributes = (new CpuAttributeValue())->formName();

        if (!isset($data[$formNameForAttributes])) {
            return false;
        }

        $this->itemsToSave = [];
        $cpuAttributeCollection = $this->getCpuAttributesWithExistingValues();

        foreach ($data[$formNameForAttributes] as $i => $arr) {

            $itemToSave = new CpuAttributeValue();

            foreach ($cpuAttributeCollection as $cpuAttribute) {
                // if record from db have the same [[id]] as post record, then overwrite [[$itemToSave]]
                // by already founded (later, will be called update instead of insert)
                if (isset($cpuAttribute->cpuAttributeValues[0]) && $cpuAttribute->cpuAttributeValues[0]->cpu_attribute_value_id == $arr['cpu_attribute_value_id']) {
                    $itemToSave = $cpuAttribute->cpuAttributeValues[0];
                    break;
                }
            }

            if (!$itemToSave->load([$formNameForAttributes => $arr])) {
                $result = false;
            }

            $this->itemsToSave[] = $itemToSave;
        }

        return $result;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        // begin transaction (it should also work for [[actionCreate]])

        $result = parent::save($runValidation, $attributeNames);

        // if result == false => roll back => return false

        // for [[actionCreate]] implementation, don't forget
        // to set [[cpu_id]] attribute for [[$attributes]] here

        foreach ($this->itemsToSave as $attribute) {
            if (!empty($attribute->value)) {
                $result = $attribute->save() ? $result : false;
            } else if ($attribute->cpu_attribute_value_id !== null) {
                $attribute->delete();
            }
        }

        // if result == false => roll back

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttributeValues()
    {
        return $this->hasMany(CpuAttributeValue::className(), ['cpu_id' => 'cpu_id']);
    }

    /* @return \app\models\CpuAttribute[] */
    public function getCpuAttributesWithExistingValues()
    {
        $cpu_id = $this->cpu_id;

        // populate all attributes from db and join existing value to attribute
        // (instead of tons queries for each attribute)
        /* @var $cpuAttributeCollection \app\models\CpuAttribute[] */
        $x = CpuAttribute::find()->joinWith([
            'cpuAttributeValues' => function (\yii\db\ActiveQuery $query) use ($cpu_id) {
                return $query->andOnCondition('cpu_id=:cpu_id', [':cpu_id' => $cpu_id]);
            }
        ])->all();

        return $x;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuTests()
    {
        return $this->hasMany(CpuTest::className(), ['cpu_id' => 'cpu_id']);
    }
}
