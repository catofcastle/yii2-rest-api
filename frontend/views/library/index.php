<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Библиотека авторов и книг';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>

            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    [
                        'label' => 'Имя и фамилия автора',
                        'value' => function ($model) {
                            return $model->name . ' ' . $model->surname;
                        }
                    ],
                    [
                        'label' => 'Дата рождения',
                        'attribute' => 'birthday',
                    ],
                    [
                        'label' => 'Книги автора',
                        'value' => function ($model) {
                            $books = $model->getBooks()->asArray()->all();

                            if (empty($books)) {
                                return '<span class="text-danger">У этого автора ещё нет книг в библиотеке</span>';
                            }

                            return implode('<br>', ArrayHelper::map($books, 'id', function ($model) {
                                return Html::encode($model['title']);
                            }));
                        },
                        'format' => 'html',
                    ]
                ]
            ]); ?>
        </div>
    </div>
</div>