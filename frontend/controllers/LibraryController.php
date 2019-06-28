<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Book;
use yii\data\ActiveDataProvider;

class LibraryController extends Controller
{
    public function actionIndex()
    {
        $books = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $books,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}