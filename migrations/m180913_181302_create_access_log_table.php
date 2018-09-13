<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `access_log`.
 */
class m180913_181302_create_access_log_table extends Migration
{
    private const TABLE_ACCESS_LOG = 'access_log';
    private const FK_ACCESS_LOG_USER_ID = 'fk_access_log_user_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_ACCESS_LOG, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'access_time' => $this->timestamp(),
        ]);

        $this->addForeignKey(self::FK_ACCESS_LOG_USER_ID, self::TABLE_ACCESS_LOG, 'user_id', User::tableName(), 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(self::FK_ACCESS_LOG_USER_ID, self::TABLE_ACCESS_LOG);
        $this->dropTable(self::TABLE_ACCESS_LOG);
    }
}
