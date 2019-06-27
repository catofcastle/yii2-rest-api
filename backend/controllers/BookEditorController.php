<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Book;
use common\models\Author;
use yii\web\NotFoundHttpException;

class BookEditorController extends Controller
{
    public function actionIndex()
    {
        $books = Book::find()
            ->joinWith('author', true, 'INNER JOIN');

        $dataProvider = new ActiveDataProvider([
            'query' => $books,
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
        $book = $this->findOneBook($id);

        return $this->render('view', [
            'book' => $book,
        ]);
    }

    public function actionCreate()
    {
        $book = new Book();
        $authors = Author::getMappedAuthors();

        if (
            Yii::$app->request->isPost &&
            $book->load(Yii::$app->request->post())
        ) {
            $valid = $book->validate();
            if ($valid) {
                if (false === $book->insert()) {
                    Yii::$app->session->setFlash('book-error', "Возникла непредвиденная проблема при создании записи. Попробуйте чуть позже.");
                }

                return $this->redirect(['book-editor/index']);
            }

            Yii::$app->session->setFlash('book-error', "Возникла ошибка валидации данных.");
            return $this->redirect(['book-editor/index']);
        }

        return $this->render('editor-form', [
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $book = $this->findOneBook($id);
        $authors = Author::getMappedAuthors();

        if (
            Yii::$app->request->isPost &&
            $book->load(Yii::$app->request->post())
        ) {
            $valid = $book->validate();
            if ($valid) {
                if (false === $book->update()) {
                    Yii::$app->session->setFlash('book-error', "Возникла непредвиденная проблема при обновлении записи. Попробуйте чуть позже.");
                }

                return $this->redirect(['book-editor/index']);
            }

            Yii::$app->session->setFlash('book-error', "Возникла ошибка валидации данных.");
            return $this->redirect(['book-editor/index']);
        }

        return $this->render('editor-form', [
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    public function actionDelete(int $id)
    {
        $book = $this->findOneBook($id);

        if (false === $book->delete()) {
            Yii::$app->session->setFlash('book-error', "Возникла непредвиденная проблема при удалении записи с id: $id. Попробуйте чуть позже.");

            return $this->redirect(['book-editor/index']);
        }

        return $this->redirect(['book-editor/index']);
    }

    private function findOneBook(int $id): Book
    {
        $book = Book::findOne(['id' => $id]);
        if (null === $book) {
            throw new NotFoundHttpException("Запись о книге с id: $id не найдена!");
        }

        return $book;
    }
}