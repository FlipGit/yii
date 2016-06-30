<?php

namespace app\controllers;

use yii;
use app\modules\backend\models\Cpu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CpuController extends Controller
{
    public function actionIndex()
    {
        $query = Cpu::find();

        $dataProvider = new yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'totalCount' => $query->count(),
                'pageSize' => 20
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = self::findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    protected static function findModel($id)
    {
        if (($model = Cpu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page not found.');
    }
}