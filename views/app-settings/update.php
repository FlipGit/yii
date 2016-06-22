<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppSettings */
/* @var $app_items[] */
/* @var $app_version_items[] */
/* @var $app_output_structure_items[] */

$this->title = 'Update Settings: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => 'index'];
$this->params['breadcrumbs'][] = [
    'label' => $model->name,
    'url' => ['view', 'id' => $model->app_settings_id]
];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="app-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'app_items' => $app_items,
        'app_version_items' => $app_version_items,
        'app_output_structure_items' => $app_output_structure_items
    ]); ?>

</div>
