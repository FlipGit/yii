<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AppOutputStructureSearch extends AppOutputStructure
{
    public function rules()
    {
        return [
            [['app_output_structure_id'], 'integer'],
            [['name'], 'string'],
            [['note'], 'string']
        ];
    }

    public function search($params)
    {
        $query = AppOutputStructure::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'app_output_structure_id' => $this->app_output_structure_id
        ]);

        $query->andFilterWhere([
            'like', 'name', $this->name
        ]);

        $query->andFilterWhere([
            'like', 'note', $this->note
        ]);

        return $dataProvider;
    }
}