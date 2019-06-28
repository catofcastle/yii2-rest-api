<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use api\modules\v1\models\BookResource;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class BookController extends ActiveController
{

    public $modelClass = BookResource::class;

    protected function verbs()
    {
        return [
            'get-one' => ['GET'],
            'get-all' => ['GET'],
            'update' => ['POST'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionGetAll()
    {
        return $this->modelClass::find()
            ->all();
    }

    public function actionGetOne(int $id)
    {
        return $this->findOneBook($id);
    }

    public function actionUpdate(int $id)
    {
        $book = $this->findOneBook($id);

        $book->load(Yii::$app->getRequest()->getBodyParams(), '');
        if (false === $book->update() && !$book->hasErrors()) {
            throw new ServerErrorHttpException('Не удалось обновить запись о книге по неизвестным причинам.');
        }

        return $book;
    }

    public function actionDelete(int $id)
    {
        $book = $this->findOneBook($id);

        if (false === $book->delete()) {
            throw new ServerErrorHttpException('Не удалось удалить запись о книге по неизвестным причинам.');
        }

        Yii::$app->getResponse()->setStatusCode(204);
    }

    private function findOneBook(int $id): BookResource
    {
        $book = BookResource::findOne(['id' => $id]);
        if (null === $book) {
            throw new NotFoundHttpException("Запись о книге с id: $id не найдена!");
        }

        return $book;
    }
}