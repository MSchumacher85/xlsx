<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m231117_074916_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'line_number' => $this->integer()->notNull()->unique(),
            'date' => $this->date(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
