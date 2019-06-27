<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\alert\Alert;

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Редактор авторов';
$this->params['breadcrumbs'][] = ['label' => 'Общая точка входа', 'url' => ['entry/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>
            <?php
            if (\Yii::$app->session->hasFlash('author-error')) {
                echo Alert::widget([
                    'type' => Alert::TYPE_DANGER,
                    'title' => 'Ошибка!',
                    'icon' => 'glyphicon glyphicon-remove',
                    'body' => \Yii::$app->session->getFlash('author-error'),
                    'showSeparator' => true,
                ]);
            }
            ?>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <?= Html::a('<span class="glyphicon glyphicon-plus-sign"></span> Добавить автора',
                        ['author-editor/create'],
                        ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    [
                        'label' => 'Имя автора',
                        'attribute' => 'name',
                    ],
                    [
                        'label' => 'Фамилия автора',
                        'attribute' => 'surname',
                    ],
                    [
                        'label' => 'Дата рождения',
                        'attribute' => 'birthday',
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::class,
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['author-editor/view', 'id' => $model->id], [
                                    'title' => 'Просмотр автора',
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['author-editor/update', 'id' => $model->id], [
                                    'title' => 'Обновление автора',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['author-editor/delete', 'id' => $model->id], [
                                    'title' => 'Удаление автора',
                                    'data-confirm' => "Вы уверены, что хотите удалить эту запись?"
                                ]);
                            },
                        ],
                    ]
                ]
            ]); ?>
        </div>
    </div>
</div>