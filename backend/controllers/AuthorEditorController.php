<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class AuthorEditorController extends Controller
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
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id)
    {
        $author = $this->findOneAuthor($id);

        return $this->render('view', [
            'author' => $author,
        ]);
    }

    public function actionCreate()
    {
        $author = new Author();

        if (
            Yii::$app->request->isPost &&
            $author->load(Yii::$app->request->post())
        ) {
            $valid = $author->validate();
            if ($valid) {
                if (false === $author->insert()) {
                    Yii::$app->session->setFlash('author-error', "Возникла непредвиденная проблема при создании записи. Попробуйте чуть позже.");
                }

                return $this->redirect(['author-editor/index']);
            }

            Yii::$app->session->setFlash('author-error', "Возникла ошибка валидации данных.");
            return $this->redirect(['author-editor/index']);
        }

        return $this->render('editor-form', [
            'author' => $author,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $author = $this->findOneAuthor($id);

        if (
            Yii::$app->request->isPost &&
            $author->load(Yii::$app->request->post())
        ) {
            $valid = $author->validate();
            if ($valid) {
                if (false === $author->update()) {
                    Yii::$app->session->setFlash('author-error', "Возникла непредвиденная проблема при обновлении записи. Попробуйте чуть позже.");
                }

                return $this->redirect(['author-editor/index']);
            }

            Yii::$app->session->setFlash('author-error', "Возникла ошибка валидации данных.");
            return $this->redirect(['author-editor/index']);
        }

        return $this->render('editor-form', [
            'author' => $author,
        ]);
    }

    public function actionDelete(int $id)
    {
        $author = $this->findOneAuthor($id);

        if (false === $author->delete()) {
            Yii::$app->session->setFlash('author-error', "Возникла непредвиденная проблема при удалении записи с id: $id. Попробуйте чуть позже.");

            return $this->redirect(['author-editor/index']);
        }

        return $this->redirect(['author-editor/index']);
    }

    private function findOneAuthor(int $id) : Author
    {
        $author = Author::findOne(['id' => $id]);
        if (null === $author) {
            throw new NotFoundHttpException("Запись об авторе с id: $id не найдена!");
        }

        return $author;
    }
}