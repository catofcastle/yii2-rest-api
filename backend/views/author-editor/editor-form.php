<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;


/** @var \yii\web\View $this */
/** @var \common\models\Author $author */
/** @var array $authors */

$action = $author->isNewRecord ? ['author-editor/create'] : ['author-editor/update', 'id' => $author->id];
$contentSubmitButton = $author->isNewRecord ? 'Создать' : 'Обновить';

$this->title = "$contentSubmitButton запись";

$this->params['breadcrumbs'][] = ['label' => 'Общая точка входа', 'url' => ['entry/index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактор авторов', 'url' => ['author-editor/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1><?= Html::encode($this->title); ?></h1>
            <hr>

            <?php
            $form = ActiveForm::begin([
                'id' => 'form-author-editor',
                'action' => $action,
                'options' => [
                    'class' => 'form-vertical',
                ],
            ]); ?>

            <?php
            // for update action
            if (false === $author->isNewRecord) {
                echo $form->field($author, 'id')->hiddenInput()->label(false);
            }
            ?>

            <?= $form->field($author, 'name')->textInput(); ?>
            <?= $form->field($author, 'surname')->textInput(); ?>
            <?= $form->field($author, 'birthday')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Введите дату рождения ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ],
            ]); ?>

            <?= Html::a('Назад', \Yii::$app->request->referrer, ['class' => 'btn btn-warning']); ?>
            <?= Html::submitButton($contentSubmitButton, ['class' => 'btn btn-success']); ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
