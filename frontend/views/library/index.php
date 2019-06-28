<?php

use kartik\grid\GridView;
use yii\helpers\Html;

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
                        'label' => 'Наименование книги',
                        'attribute' => 'title'
                    ],
                    [
                        'label' => 'Имя и фамилия автора',
                        'value' => function ($model) {
                            return $model->author->name . ' ' . $model->author->surname;
                        }
                    ],
                    [
                        'label' => 'Дата рождения автора',
                        'value' => function ($model) {
                            return $model->author->birthday;
                        }
                    ],
                ]
            ]); ?>
        </div>
    </div>
</div>