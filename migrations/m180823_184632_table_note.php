<?php

use yii\db\Migration;

/**
 * Class m180823_184632_table_note
 */
class m180823_184632_table_note extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('note', [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Название'),
            'text' => $this->string()->comment('Содержание'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('note');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180823_184632_table_note cannot be reverted.\n";

        return false;
    }
    */
}
