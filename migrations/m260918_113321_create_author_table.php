<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m260918_113321_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        /*
         * Проверка нужна, чтобы миграция не падала, если проект в будущем запустят на СУБД PostgreSQL или SQLite,
         * где параметр $tableOptions в таком виде не поддерживается.
         * utf8mb4 - 4 байта (включая эмодзи и спецсимволы). utf8mb4_unicode_ci - поиск нечувствительный к регистру.
         * InnoDB - транзакции и внешние ключи.
         */

        $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable('{{%author}}', [
                'id' => $this->primaryKey(),
                'last_name' => $this->string(255)->notNull()->comment('Фамилия'),
                'first_name' => $this->string(255)->notNull()->comment('Имя'),
                'patronymic' => $this->string(255)->null()->comment('Отчество'),
                'birth_year' => $this->smallInteger()->null()->comment('Год рождения'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);

            $this->createIndex('idx-author-last_name', '{{%author}}', 'last_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
