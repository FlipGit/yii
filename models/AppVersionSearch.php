<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class AppVersionSearch extends AppVersion
{

    public function rules()
    {
        return [
            [['app_version_id'], 'integer'],
            [['version'], 'string']
        ];
    }

    public function search($params)
    {
        $query = AppVersion::find()->with('app');

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
            self::tableName() . '.app_version_id' => $this->app_version_id
        ]);

        $query->andFilterWhere([
            'like', self::tableName() . '.version', $this->version
        ]);

        return $dataProvider;
    }

}