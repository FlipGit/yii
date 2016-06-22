<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\view */
/* @var $model app\models\AppSettings */

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-settings-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->app_settings_id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->app_settings_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure?',
                'method' => 'post'
            ]
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'app_settings_id',
            [
                'label' => 'Application',
                'format' => 'raw',
                'value' => Html::a(
                    $model->appVersion->app->name,
                    ['app/view', 'id' => $model->appVersion->app_id]
                )
            ],
            [
                'label' => 'Application version',
                'format' => 'raw',
                'value' => Html::a(
                    $model->appVersion->version,
                    ['app-version/view', 'id' => $model->app_version_id]
                )
            ],
            'name',
            [
                'label' => 'Output Structure',
                'format' => 'raw',
                'value' => Html::a(
                    $model->appOutputStructure->name,
                    ['app-output-structure/view', 'id' => $model->app_output_structure_id]
                )
            ],
            'details'
        ]
    ]); ?>

</div>
