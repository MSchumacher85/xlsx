<?php

use yii\db\Migration;

/**
 * Class m231119_083144_alter_date_to_datetime
 */
class m231119_083144_alter_date_to_datetime extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product', 'date', $this->dateTime());
        $this->alterColumn('file_data', 'date', $this->dateTime());
        $this->alterColumn('file_name', 'date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('product', 'date', $this->date());
        $this->alterColumn('file_data', 'date', $this->date());
        $this->alterColumn('file_name', 'date', $this->date());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231119_083144_alter_date_to_datetime cannot be reverted.\n";

        return false;
    }
    */
}
