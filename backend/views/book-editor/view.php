<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var \common\models\Book $book */

$this->title = 'Просмотр записи';

$this->params['breadcrumbs'][] = ['label' => 'Общая точка входа', 'url' => ['entry/index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактор авторов', 'url' => ['author-editor/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>
            <hr>

            <?= DetailView::widget([
                'model' => $book,
                'attributes' => [
                    [
                        'attribute' => 'fid_author',
                        'value' => function ($model, $widget) {
                            return $model->author->name . ' ' . $model->author->surname;
                        },
                    ],
                    'title',
                ]
            ]); ?>

            <?= Html::a('Назад', \Yii::$app->request->referrer, ['class' => 'btn btn-warning']); ?>

        </div>
    </div>
</div>
