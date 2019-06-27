<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


/** @var \yii\web\View $this */
/** @var \common\models\Book $book */
/** @var array $authors */

$action = $book->isNewRecord ? ['book-editor/create'] : ['book-editor/update', 'id' => $book->id];
$contentSubmitButton = $book->isNewRecord ? 'Создать' : 'Обновить';

$this->title = "$contentSubmitButton запись";

$this->params['breadcrumbs'][] = ['label' => 'Общая точка входа', 'url' => ['entry/index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактор книг', 'url' => ['book-editor/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>
            <hr>

            <?php
            $form = ActiveForm::begin([
                'id' => 'form-book-editor',
                'action' => $action,
                'options' => [
                    'class' => 'form-vertical',
                ],
            ]); ?>

            <?php
            // for update action
            if (false === $book->isNewRecord) {
                echo $form->field($book, 'id')->hiddenInput()->label(false);
            }
            ?>

            <?= $form->field($book, 'fid_author')->dropDownList($authors, [
                'prompt' => 'Выберите автора...'
            ]) ?>
            <?= $form->field($book, 'title')->textInput(); ?>

            <?= Html::a('Назад', \Yii::$app->request->referrer, ['class' => 'btn btn-warning']); ?>
            <?= Html::submitButton($contentSubmitButton, ['class' => 'btn btn-success']); ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
