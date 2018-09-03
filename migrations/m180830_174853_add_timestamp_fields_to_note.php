<?php

use app\models\Note;
use yii\db\Migration;

/**
 * Class m180830_174853_add_timestamp_fields_to_not
 */
class m180830_174853_add_timestamp_fields_to_note extends Migration
{
    /**
     * {@inheritdoc}
     */
    private const FIELD_CREATED_AT = 'created_at';
    private const FIELD_UPDATED_AT = 'updated_at';

    public function safeUp()
    {
        $tableName = $this->tableName();

        $this->addColumn($tableName, self::FIELD_CREATED_AT, $this->timestamp()->defaultExpression('NOW()'));
        $this->addColumn($tableName, self::FIELD_UPDATED_AT, $this->timestamp()->defaultExpression('NOW()'));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableName = $this->tableName();
        $this->dropColumn($tableName, self::FIELD_CREATED_AT);
        $this->dropColumn($tableName, self::FIELD_UPDATED_AT);
    }

    /**
     * @return string
     */
    private function tableName(): string
    {
        return Note::tableName();
    }
}
