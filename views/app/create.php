<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\App */

$this->title = 'Create Application';

$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="app-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model
    ]); ?>

</div>
