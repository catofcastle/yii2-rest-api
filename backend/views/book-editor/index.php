<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\alert\Alert;

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Редактор книг';
$this->params['breadcrumbs'][] = ['label' => 'Общая точка входа', 'url' => ['entry/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>
            <?php
            if (\Yii::$app->session->hasFlash('book-error')) {
                echo Alert::widget([
                    'type' => Alert::TYPE_DANGER,
                    'title' => 'Ошибка!',
                    'icon' => 'glyphicon glyphicon-remove',
                    'body' => \Yii::$app->session->getFlash('book-error'),
                    'showSeparator' => true,
                ]);
            }
            ?>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <?= Html::a('<span class="glyphicon glyphicon-plus-sign"></span> Добавить книгу',
                        ['book-editor/create'],
                        ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    [
                        'label' => 'Автор книги',
                        'value' => function ($model) {
                            return $model->author->name . ' ' . $model->author->surname;
                        },
                    ],
                    [
                        'label' => 'Наименование книги',
                        'attribute' => 'title',
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['book-editor/view', 'id' => $model->id], [
                                    'title' => 'Просмотр книги',
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['book-editor/update', 'id' => $model->id], [
                                    'title' => 'Обновление книги',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['book-editor/delete', 'id' => $model->id], [
                                    'title' => 'Удаление книги',
                                    'data-confirm' => "Вы уверены, что хотите удалить запись об этой книге?"
                                ]);
                            },
                        ],
                    ]
                ]
            ]); ?>
        </div>
    </div>
</div>
