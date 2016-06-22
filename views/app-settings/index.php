<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\view */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\AppSettingsSearch */

$this->title = 'Settings';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'app_settings_id',
            'name',
            [
                'label' => 'Application',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(
                        Html::encode($model->appVersion->app->name),
                        ['app/view', 'id' => $model->appVersion->app_id]
                    );
                }
            ],
            [
                'label' => 'Version',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(
                        Html::encode($model->appVersion->version),
                        ['app-version/view', 'id' => $model->app_version_id]
                    );
                }
            ],
            [
                'label' => 'Output Structure',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(
                        Html::encode($model->appOutputStructure->name),
                        ['app-output-structure/view', 'id' => $model->app_output_structure_id]
                    );
                }
            ],
            ['class' => '\yii\grid\ActionColumn']
        ]
    ]) ?>

</div>