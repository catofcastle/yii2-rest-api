<?php

namespace api\modules\v1\models;

use common\models\Book;

class BookResource extends Book
{
    public function fields()
    {
        return [
            'id',
            'title',
            'author' => function ($model) {
                return $model->author->name . ' ' . $model->author->surname;
            },
        ];
    }
}