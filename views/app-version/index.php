<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\view */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\AppVersionSearch */

$this->title = 'Version';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-version-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'app_version_id',
            'version',
            [
                'label' => 'Application',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(Html::encode($model->app->name), ['app/view', 'id' => $model->app_id]);
                }
            ],
            ['class' => '\yii\grid\ActionColumn']
        ]
    ]) ?>

</div>