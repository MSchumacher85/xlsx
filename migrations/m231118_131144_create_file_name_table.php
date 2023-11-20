<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file_name}}`.
 */
class m231118_131144_create_file_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_name}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'date' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_name}}');
    }
}
