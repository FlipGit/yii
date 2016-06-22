<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cpu */

$this->title = Yii::t('app', 'Create Cpu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
