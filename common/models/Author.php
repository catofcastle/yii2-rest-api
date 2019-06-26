<?php

namespace common\models;

use Yii;

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
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'birthday' => 'Birthday',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['fid_author' => 'id']);
    }
}
