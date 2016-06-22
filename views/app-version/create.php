<?php

use yii\helpers\Html;

/* @var $this yii\web\view */
/* @var $model app\models\AppVersion */
/* @var $items[] */

$this->title = 'Create Version';

$this->params['breadcrumbs'][] = ['label' => 'Version', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="version-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items
    ]) ?>

</div>
