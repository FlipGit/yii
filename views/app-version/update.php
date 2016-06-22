<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppVersion */
/* @var $items[] */

$this->title = 'Update Version: ' . $model->app->name . ' v' . $model->version;

$this->params['breadcrumbs'][] = ['label' => 'Version', 'url' => 'index'];
$this->params['breadcrumbs'][] = [
    'label' => $model->app->name . ' v' . $model->version,
    'url' => ['view', 'id' => $model->app_version_id]
];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="app-version-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]); ?>

</div>
