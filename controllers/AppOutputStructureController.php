<?php

namespace app\controllers;

use yii;
use app\models\AppOutputStructureSearch;
use yii\web\Controller;
use app\models\AppOutputStructure;
use yii\web\NotFoundHttpException;

class AppOutputStructureController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AppOutputStructureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new AppOutputStructure();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_output_structure_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => self::findModel($id)
        ]);
    }

    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_output_structure_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        self::findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id integer
     * @return AppOutputStructure
     * @throws NotFoundHttpException
     */
    protected static function findModel($id)
    {
        if (($model = AppOutputStructure::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Requested page not found.');
    }
}