<?php

namespace app\controllers;

use app\models\App;
use app\models\AppVersion;
use app\models\AppOutputStructure;
use yii;
use app\models\AppSettings;
use app\models\AppSettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class AppSettingsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AppSettingsSearch();
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
        $model = new AppSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_settings_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'app_items' => ArrayHelper::map(App::find()->all(), 'app_id', 'name'),
            'app_version_items' => ArrayHelper::map(AppVersion::find()->all(), 'app_version_id', 'version'),
            'app_output_structure_items' => ArrayHelper::map(
                AppOutputStructure::find()->all(), 'app_output_structure_id', 'name'
            )
        ]);
    }

    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_settings_id]);
        }

        return $this->render('update', [
            'model' => self::findModel($id),
            'app_items' => ArrayHelper::map(App::find()->all(), 'app_id', 'name'),
            'app_version_items' => ArrayHelper::map(AppVersion::find()->all(), 'app_version_id', 'version'),
            'app_output_structure_items' => ArrayHelper::map(
                AppOutputStructure::find()->all(), 'app_output_structure_id', 'name'
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
        if (($model = AppSettings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page not found.');
    }
}