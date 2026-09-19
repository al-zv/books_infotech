<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m260918_123719_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Название книги'),
            'year' => $this->smallInteger()->notNull()->comment('Год выпуска'),
            'description' => $this->text()->null()->comment('Описание'),
            'isbn' => $this->string(24)->notNull()->comment('ISBN'),
            'uploaded_file_id' => $this->integer()->null()->comment('ID обложки из таблицы uploaded_file'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // Обычный индекс по названию для фильтрации и поиска по названию
        $this->createIndex('idx-book-title', '{{%book}}', 'title');

        // Индекс по году выпуска для отчета «ТОП-10»
        $this->createIndex('idx-book-year', '{{%book}}', 'year');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
