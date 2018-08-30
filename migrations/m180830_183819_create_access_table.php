<?php

use yii\db\Migration;

/**
 * Handles the creation of table `access`.
 */
class m180830_183819_create_access_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('access', [
            'id' => $this->primaryKey(),
			'note_id' => $this->integer()->notNull(),
			'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_access_note_id', 'access', 'note_id', 'note', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_access_user_id', 'access', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('fk_access_note_id', 'access');
    	$this->dropForeignKey('fk_access_user_id', 'access');

        $this->dropTable('access');
    }
}
