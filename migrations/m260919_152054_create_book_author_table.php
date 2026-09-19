<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m260919_152054_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book_author}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // Составной первичный ключ (исключает дублирование связей)
        $this->addPrimaryKey('pk-book_author', '{{%book_author}}', ['book_id', 'author_id']);

        // Индексы для ускорения JOIN-запросов
        $this->createIndex('idx-book_author-book_id', '{{%book_author}}', 'book_id');
        $this->createIndex('idx-book_author-author_id', '{{%book_author}}', 'author_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
