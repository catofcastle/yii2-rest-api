<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Author;
use yii\data\ActiveDataProvider;

class LibraryController extends Controller
{
    public function actionIndex()
    {
        $authors = Author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $authors,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}