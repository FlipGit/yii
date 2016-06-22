<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AppSearch extends App
{
    public function rules()
    {
        return [
            [['app_id'], 'integer'],
            [['name'], 'string'],
            [['description'], 'string']
        ];
    }

    public function search($params)
    {
        $query = App::find()->with('versionCollection');

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
            'app_id' => $this->app_id
        ]);

        $query->andFilterWhere([
            'like', 'name', $this->name
        ]);

        $query->andFilterWhere([
            'like', 'description', $this->description
        ]);

        return $dataProvider;
    }
}