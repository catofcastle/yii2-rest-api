<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id Первичный ключ
 * @property int $fid_author Связь с таблицей авторов
 * @property string $title Название книги
 *
 * @property-read Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fid_author', 'title'], 'required'],
            [['fid_author'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['fid_author'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['fid_author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор книги',
            'fid_author' => 'Автор книги',
            'title' => 'Наименование книги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'fid_author']);
    }
}
