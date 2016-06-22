<?php

namespace app\controllers;

use app\models\App;
use yii;
use app\models\AppVersion;
use app\models\AppVersionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class AppVersionController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AppVersionSearch();
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
        $model = new AppVersion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_version_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'items' => ArrayHelper::map(App::find()->all(), 'app_id', 'name')
        ]);
    }

    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_version_id]);
        }

        return $this->render('update', [
            'model' => self::findModel($id),
            'items' => ArrayHelper::map(App::find()->all(), 'app_id', 'name')
        ]);
    }

    public function actionDelete($id)
    {
        self::findModel($id)->delete();

        $this->redirect(['index']);
    }

    public function actionList($app_id)
    {
        return $this->renderPartial('list', [
            'items' => AppVersion::find()->where('app_id = :app_id', [':app_id' => $app_id])->all()
        ]);
    }

    protected static function findModel($id)
    {
        if (($model = AppVersion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page not found.');
    }
}