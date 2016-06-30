<?php

namespace app\modules\backend\controllers;

use yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
