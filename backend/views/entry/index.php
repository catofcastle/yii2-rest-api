<?php

use yii\helpers\Html;

/** @var \yii\web\View $this */

$this->title = 'Общая точка входа';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <?= Html::a('Редактор авторов', ['author-editor/index'], ['class' => 'btn btn-primary']); ?>
            <?= Html::a('Редактор книг', ['book-editor/index'], ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
</div>
