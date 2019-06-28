<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id Первичный ключ
 * @property string $name Имя автора
 * @property string $surname Фамилия автора
 * @property string $birthday Дата рождения автора
 *
 * @property-read Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'birthday'], 'required'],
            [['birthday'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['surname'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор автора',
            'name' => 'Имя автора',
            'surname' => 'Фамилия автора',
            'birthday' => 'Дата рождения автора',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['fid_author' => 'id']);
    }

    /**
     * @return array
     */
    public static function getMappedAuthors() : array
    {
        $authors = self::find()
            ->asArray()
            ->all();

        return ArrayHelper::map($authors, 'id', function ($model) {
            return $model['name'] . ' ' . $model['surname'];
        });
    }
}
