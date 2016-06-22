<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AppOutputKey;

/* @var $this yii\web\view */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\AppOutputKeySearch */
/* @var $model app\models\AppOutputKey */

$this->title = 'Output Key';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-version-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'app_output_key_id',
            'key',
            [
                'attribute' => 'comparison',
                'filter' => AppOutputKey::getComparisonCollection()
            ],
            'measure',
            [
                'label' => 'Structure',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(
                        Html::encode($model->appOutputStructure->name),
                        ['app-output-structure/view', 'id' => $model->app_output_structure_id]);
                }
            ],
            ['class' => '\yii\grid\ActionColumn']
        ]
    ]) ?>

</div>