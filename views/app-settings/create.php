<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppSettings */
/* @var $app_items[] */
/* @var $app_version_items[] */
/* @var $app_output_structure_items[] */

$this->title = 'Create Settings';

$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'app_items' => $app_items,
        'app_version_items' => $app_version_items,
        'app_output_structure_items' => $app_output_structure_items
    ]) ?>

</div>
