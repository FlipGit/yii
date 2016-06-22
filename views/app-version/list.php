<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\view */
/* @var $items[] */

foreach ($items as $item)
{
    echo '<option value="' . $item->app_version_id . '">' . $item->version. '</option>';
}


