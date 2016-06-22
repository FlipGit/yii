<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cpu;

/**
 * CpuSearch represents the model behind the search form about `app\models\Cpu`.
 */
class CpuSearch extends Cpu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpu_id', 'performance_rank'], 'integer'],
            [['name', 'created_date', 'updated_date', 'attribute_json'], 'safe'],
            [['performance_per_vat', 'performance_per_dollar'], 'number'],
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
        $query = Cpu::find();

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
            'cpu_id' => $this->cpu_id,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'performance_rank' => $this->performance_rank,
            'performance_per_vat' => $this->performance_per_vat,
            'performance_per_dollar' => $this->performance_per_dollar,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'attribute_json', $this->attribute_json]);

        return $dataProvider;
    }
}
