<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m190626_124723_create_books_table extends Migration
{
    private $tableName = 'books';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(11)->comment('Первичный ключ'),
            'fid_author' => $this->integer(11)->comment('Связь с таблицей авторов'),
            'title' => $this->string(300)->notNull()->comment('Название книги'),
        ]);

        $this->addForeignKey('FK_FIDAUTH_IDAUTH', $this->tableName, 'fid_author', 'authors', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('FK_FIDAUTH_IDAUTH', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
