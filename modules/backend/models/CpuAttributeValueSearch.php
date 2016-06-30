<?php

namespace app\modules\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\backend\models\CpuAttributeValue;

/**
 * CpuAttributeValueSearch represents the model behind the search form about `app\models\CpuAttributeValue`.
 */
class CpuAttributeValueSearch extends CpuAttributeValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpu_attribute_value_id', 'cpu_id', 'cpu_attribute_id'], 'integer'],
            [['value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CpuAttributeValue::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cpu_attribute_value_id' => $this->cpu_attribute_value_id,
            'cpu_id' => $this->cpu_id,
            'cpu_attribute_id' => $this->cpu_attribute_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
