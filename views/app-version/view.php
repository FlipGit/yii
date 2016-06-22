<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\view */
/* @var $model app\models\AppVersion */

$this->title = $model->app->name . ' v' . $model->version;

$this->params['breadcrumbs'][] = ['label' => 'Version', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-version-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->app_version_id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->app_version_id], [
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
            'app_version_id',
            [
                'label' => 'Application',
                'format' => 'raw',
                'value' => Html::a($model->app->name, ['app/view', 'id' => $model->app_id])
            ],
            'version'
        ]
    ]); ?>

</div>
