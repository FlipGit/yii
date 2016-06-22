<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AppOutputKeySearch extends AppOutputKey
{

    public function rules()
    {
        return [
            [['app_output_key_id'], 'integer'],
            [['key'], 'string'],
            [['comparison'], 'integer'],
            [['comparison'], 'in', 'range' => array_keys(self::getComparisonCollection())],
            [['measure'], 'string']
        ];
    }

    public function search($params)
    {
        $query = AppOutputKey::find()->with('appOutputStructure');

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
            'app_output_key_id' => $this->app_output_key_id
        ]);

        $query->andFilterWhere([
            'key' => $this->key
        ]);

        // enum numeration starts from 1 (null allowed)
        // so, if value not null and not zero, then send int!! value, cause yii create quotes for string val
        $query->andFilterWhere([
            'comparison' => $this->comparison ? (int)$this->comparison : $this->comparison
        ]);

        $query->andFilterWhere([
            'measure' => $this->measure
        ]);

        return $dataProvider;
    }

}