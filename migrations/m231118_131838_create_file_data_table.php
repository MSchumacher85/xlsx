<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file_data}}`.
 */
class m231118_131838_create_file_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_data}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'line_number' => $this->integer(),
            'date' => $this->date(),
            'price' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-file_id-file_data-to-id-file_name',
            'file_data',
            'file_id',
            'file_name',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-file_id-file_data-to-id-file_name',
            'file_data'
        );

        $this->dropTable('{{%file_data}}');
    }
}
