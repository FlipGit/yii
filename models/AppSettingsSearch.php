<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AppSettingsSearch extends AppSettings
{

    public function rules()
    {
        return [
            [['app_settings_id'], 'integer'],
            [['app_version_id'], 'integer'],
            [['app_output_structure_id'], 'integer'],
            [['name'], 'string'],
            [['details'], 'string']
        ];
    }

    public function search($params)
    {
        $query = AppSettings::find()->with('appVersion')->with('appOutputStructure');

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
            'app_settings_id' => $this->app_settings_id
        ]);

        $query->andFilterWhere([
            'app_version_id' => $this->app_version_id
        ]);

        $query->andFilterWhere([
            'app_output_structure_id' => $this->app_output_structure_id
        ]);

        $query->andFilterWhere([
            'like', 'name', $this->name
        ]);

        $query->andFilterWhere([
            'like', 'details', $this->details
        ]);

        return $dataProvider;
    }

}