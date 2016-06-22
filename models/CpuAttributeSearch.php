<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CpuAttribute;

/**
 * CpuAttributeSearch represents the model behind the search form about `app\models\CpuAttribute`.
 */
class CpuAttributeSearch extends CpuAttribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpu_attribute_id', 'order', 'cpu_attribute_group_id'], 'integer'],
            [['name', 'description', 'type', 'comparison'], 'safe'],
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
        $query = CpuAttribute::find();

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
            'cpu_attribute_id' => $this->cpu_attribute_id,
            'order' => $this->order,
            'cpu_attribute_group_id' => $this->cpu_attribute_group_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'comparison', $this->comparison]);

        return $dataProvider;
    }
}
