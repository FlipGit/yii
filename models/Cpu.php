<?php

namespace app\models;

use yii;
use yii\helpers\Html;
use DateTime;
use DateTimeZone;

/**
 * This is the model class for table "cpu".
 *
 * @property integer $cpu_id
 * @property string $name
 * @property string $created_date
 * @property string $updated_date
 * @property string $attribute_json
 * @property integer $performance_rank
 * @property double $performance_per_watt
 * @property double $performance_per_dollar
 *
 * @property CpuAttributeValue[] $cpuAttributeValues
 * @property CpuTest[] $cpuTests
 */
class Cpu extends \yii\db\ActiveRecord
{
    /* @var $attributes \app\models\CpuAttribute[] */
    /* @var $attributeValuesForForm \app\models\CpuAttributeValue[] */
    protected $attributeValuesForForm = -1; // -1 for GET update, see [[getAttributeValuesForForm]]

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
            [['name'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['attribute_json'], 'string'],
            [['performance_rank'], 'integer'],
            [['performance_per_watt', 'performance_per_dollar'], 'number'],
            [['name'], 'string', 'max' => 128]
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

    // this one for create/update use only
    /* @return \app\models\CpuAttributeValue[] */
    public function getAttributeValuesForForm()
    {
        // -1 mean GET update (need to load all attributes and their values from db)
        // otherwise, return already extracted data
        if ($this->attributeValuesForForm !== -1) {
            return $this->attributeValuesForForm;
        }

        $result = [];
        $cpuAttributeCollection = $this->getCpuAttributesWithExistingValues();

        foreach ($cpuAttributeCollection as $cpuAttribute) {
            $push = new CpuAttributeValue();
            $push->cpu_id = $this->cpu_id;
            $push->cpu_attribute_id = $cpuAttribute->cpu_attribute_id;

            if (isset($cpuAttribute->cpuAttributeValues[0])) {
                $push = $cpuAttribute->cpuAttributeValues[0];
            }

            $result[] = $push;
        }

        return $this->attributeValuesForForm = $result;
    }

    // in [[$data]] should be data for BOTH models (Cpu and their attributes)
    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);
        $formNameForAttributes = (new CpuAttributeValue())->formName();

        // for example, if attributes is not exist
        // POST does not contain [[formNameForAttributes]]
        if (!isset($data[$formNameForAttributes])) {
            return $result;
        }

        $this->attributeValuesForForm = [];
        $cpuAttributeCollection = $this->getCpuAttributesWithExistingValues();

        foreach ($data[$formNameForAttributes] as $i => $arr) {

            $itemToSave = new CpuAttributeValue();

            if ($this->isNewRecord) {
                $itemToSave->scenario = CpuAttributeValue::SCENARIO_CPU_NOT_CREATED;
            }

            if (!$itemToSave->load([$formNameForAttributes => $arr])) {
                $result = false;
            }

            // if record from db have the same [[id]] as POST record, then overwrite [[$itemToSave]]
            // by already founded obj (later, will be called update instead of insert)
            foreach ($cpuAttributeCollection as $cpuAttribute) {

                if (isset($cpuAttribute->cpuAttributeValues[0]) && $cpuAttribute->cpuAttributeValues[0]->cpu_attribute_value_id == $arr['cpu_attribute_value_id']) {
                    $itemToSave = $cpuAttribute->cpuAttributeValues[0];
                    if (!$itemToSave->load([$formNameForAttributes => $arr])) {
                        $result = false;
                    }
                    break;
                }
            }

            $this->attributeValuesForForm[] = $itemToSave;
        }

        return $result;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        $result =  parent::validate($attributeNames, $clearErrors);

        if (!is_array($this->attributeValuesForForm)) {
            return $result;
        }

        return self::validateMultiple($this->attributeValuesForForm) && $result;
    }

    public function validateAjax()
    {
        $result = [];
        $this->validate();

        foreach ($this->getErrors() as $attribute => $errors) {
            $result[Html::getInputId($this, $attribute)] = $errors;
        }

        if (!is_array($this->attributeValuesForForm)) {
            return $result;
        }

        foreach ($this->attributeValuesForForm as $i => $attributeValue) {
            foreach ($attributeValue->getErrors() as $attribute => $errors) {
                $inputId = mb_strtolower($attributeValue->formName() . '-' . $i . '-' . "$attribute", 'utf-8');
                $result[$inputId] = $errors;
            }
        }

        return $result;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {

            $result = parent::save($runValidation, $attributeNames);

            if ($result == false) {
                $transaction->rollBack();
                return $result;
            }

            foreach ($this->attributeValuesForForm as $attributeValue) {
                if (!empty($attributeValue->value)) {
                    // [[cpu_id]] property not set at [[actionCreate]]
                    $attributeValue->cpu_id = $this->cpu_id;
                    // set scenario to default, cause [[cpu_id]] property already set
                    // that important for [[actionCreate]] only, in other cases
                    // scenario continue to be default - behavior not changed
                    $attributeValue->scenario = CpuAttributeValue::SCENARIO_DEFAULT;
                    $result = $attributeValue->save() ? $result : false;
                } else if ($attributeValue->cpu_attribute_value_id !== null) {
                    $attributeValue->delete();
                }
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }

        if ($result == false) {
            $transaction->rollBack();
            return $result;
        }

        $transaction->commit();
        return $result;
    }

    public function beforeSave($insert)
    {
        $result = parent::beforeSave($insert);

        $dateTime = new DateTime('now', new DateTimeZone('UTC'));

        if ($this->isNewRecord) {
            $this->created_date = $dateTime->format('Y-m-d H:i:s');
        } else {
            $this->updated_date = $dateTime->format('Y-m-d H:i:s');
        }

        return $result;
    }

    /* @return \app\models\CpuAttribute[] */
    public function getCpuAttributesWithExistingValues()
    {
        $cpu_id = $this->cpu_id;

        // populate all attributes from db and join existing value to attribute
        // (instead of tons queries for each attribute)
        /* @var $cpuAttributeCollection \app\models\CpuAttribute[] */
        return CpuAttribute::find()->joinWith([
            'cpuAttributeValues' => function (yii\db\ActiveQuery $query) use ($cpu_id) {
                return $query->andOnCondition('cpu_id=:cpu_id', [':cpu_id' => $cpu_id]);
            }
        ])->orderBy('name ASC')->all();
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