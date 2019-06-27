<?php

namespace backend\controllers;

use yii\web\Controller;

class EntryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}