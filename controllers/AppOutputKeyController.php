<?php

namespace app\controllers;

use app\models\AppOutputKeySearch;
use app\models\AppOutputStructure;
use yii;
use app\models\AppOutputKey;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class AppOutputKeyController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AppOutputKeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => self::findModel($id)
        ]);
    }

    public function actionCreate()
    {
        $model = new AppOutputKey();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_output_key_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'items' => ArrayHelper::map(
                AppOutputStructure::find()->all(),
                'app_output_structure_id',
                'name'
            )
        ]);
    }

    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_output_key_id]);
        }

        return $this->render('update', [
            'model' => self::findModel($id),
            'items' => ArrayHelper::map(
                AppOutputStructure::find()->all(),
                'app_output_structure_id',
                'name'
            )
        ]);
    }

    public function actionDelete($id)
    {
        self::findModel($id)->delete();

        $this->redirect(['index']);
    }

    protected static function findModel($id)
    {
        if (($model = AppOutputKey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page not found.');
    }
}