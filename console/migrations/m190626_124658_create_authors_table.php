<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m190626_124658_create_authors_table extends Migration
{
    private $tableName = 'authors';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(11)->comment('Первичный ключ'),
            'name' => $this->string(200)->notNull()->comment('Имя автора'),
            'surname' => $this->string(300)->notNull()->comment('Фамилия автора'),
            'birthday' => $this->date()->notNull()->comment('Дата рождения автора')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
