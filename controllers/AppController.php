<?php

namespace app\controllers;

use app\models\AppSearch;
use yii;
use app\models\App;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AppController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AppSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDataGridJquery()
    {
        $sort = Yii::$app->request->getQueryParam('sort');

        $sortOrder = [
            'id' => ['app_id' => SORT_ASC],
            '-id' => ['app_id' => SORT_DESC],
            'name' => ['name' => SORT_ASC],
            '-name' => ['name' => SORT_DESC]
        ];

        $order_by = isset($sortOrder[$sort])
            ? $sortOrder[$sort]
            : [];

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return json_encode(App::find()->orderBy($order_by)->with('versionCollection')->asArray()->all());
        }

        return $this->render('data_grid_jquery', [
            'sort' => $sort,
            'appCollection' => App::find()->orderBy($order_by)->with('versionCollection')->all()
        ]);
    }

    public function actionDataGridAngular()
    {
        $sort = Yii::$app->request->getQueryParam('sort');

        $sortOrder = [
            'id' => ['app_id' => SORT_ASC],
            '-id' => ['app_id' => SORT_DESC],
            'name' => ['name' => SORT_ASC],
            '-name' => ['name' => SORT_DESC]
        ];

        $order_by = isset($sortOrder[$sort])
            ? $sortOrder[$sort]
            : [];

        if (Yii::$app->request->isPost) {
            //Yii::$app->response->format = 'json'; this one also escape response, angular is shocked)
            return json_encode(App::find()->orderBy($order_by)->with('versionCollection')->asArray()->all());
        }

        return $this->render('data_grid_angular', [
            'sort' => $sort,
            'appCollection' => App::find()->orderBy($order_by)->with('versionCollection')->all()
        ]);
    }

    public function actionView($id)
    {
        $model = self::findModel($id);

        return $this->render('view', [
           'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new App();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        self::findModel($id)->delete();

        return $this->redirect('index');
    }

    public function actionUpdate($id)
    {
        $model = self::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->app_id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    protected static function findModel($id)
    {
        if (($model = App::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page not found.');
    }
}