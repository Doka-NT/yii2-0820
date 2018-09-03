<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180827_183943_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'user',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull(),
                'password' => $this->string()->notNull(),
                'auth_key' => $this->string()->notNull(),
                'access_token' => $this->string(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
