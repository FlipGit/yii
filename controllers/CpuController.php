<?php

namespace app\controllers;

use app\models\CpuAttribute;
use app\models\CpuAttributeGroup;
use app\models\CpuAttributeValue;
use Yii;
use app\models\Cpu;
use app\models\CpuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CpuController implements the CRUD actions for Cpu model.
 */
class CpuController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cpu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CpuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cpu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cpu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cpu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            /*$cpuAttributeValueCollection = [];

            for ($i = 0, $length = count(Yii::$app->request->post()['CpuAttributeValue']); $i < $length; $i++) {
                $cpuAttributeValueCollection[] = new CpuAttributeValue();
                $obj = new CpuAttributeValue();

                $obj->cpu_id = $model->cpu_id;
                $obj->cpu_attribute_id = Yii::$app->request->post()['CpuAttributeValue'][$i]['cpu_attribute_id'];
                $obj->value = Yii::$app->request->post()['CpuAttributeValue'][$i]['value'];

                if ($obj->validate()) {
                    $obj->save();
                }
            }

            if (CpuAttributeValue::loadMultiple($cpuAttributeValueCollection, Yii::$app->request->post()) && CpuAttributeValue::validateMultiple($cpuAttributeValueCollection)) {
                foreach ($cpuAttributeValueCollection as $cpuAttributeValue) {
                    $cpuAttributeValue->save();
                }
                die('ok');
            } else {
                die('!ok');
            }*/

            return $this->redirect(['update', 'id' => $model->cpu_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'attributeGroupCollection' => CpuAttributeGroup::find()->with('cpuAttributes')->all()
            ]);
        }
    }

    /**
     * Updates an existing Cpu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /* @var $cpuAttributeCollection \app\models\CpuAttribute[] */
        $cpuAttributeCollection = CpuAttribute::find()->joinWith([
            'cpuAttributeValues' => function (\yii\db\ActiveQuery $query) use ($model) {
                return $query->andOnCondition('cpu_id=:cpu_id', [':cpu_id' => $model->cpu_id]);
            }
        ])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $itemsToSave = [];

            foreach (Yii::$app->request->post()['CpuAttributeValue'] as $i => $arr) {

                $itemToSave = new CpuAttributeValue();

                foreach ($cpuAttributeCollection as $cpuAttribute) {

                    if (isset($cpuAttribute->cpuAttributeValues[0]) && $cpuAttribute->cpuAttributeValues[0]->cpu_attribute_value_id == $arr['cpu_attribute_value_id']) {
                        $itemToSave = $cpuAttribute->cpuAttributeValues[0];
                        break;
                    }
                }

                $itemToSave->load(['CpuAttributeValue' => $arr]);

                if (!empty($itemToSave->value)) {
                    $itemsToSave[] = $itemToSave;
                } else if ($itemToSave->cpu_attribute_value_id !== null) {
                    $itemToSave->delete();
                }
            }

            foreach ($itemsToSave as $itemToSave) {
                $itemToSave->save();
            }

            return $this->redirect(['view', 'id' => $model->cpu_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cpuAttributeCollection' => $cpuAttributeCollection
            ]);
        }
    }

    /**
     * Deletes an existing Cpu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cpu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cpu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cpu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
