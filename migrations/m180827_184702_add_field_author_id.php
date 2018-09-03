<?php

use app\models\Note;
use app\models\User;
use yii\db\Migration;

/**
 * Добавление поля note.author_id и внешнего ключа
 */
class m180827_184702_add_field_author_id extends Migration
{
    private const FK_NOTE_AUTHOR_ID = 'fk_note_author_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $noteTable = $this->getNoteTable();

        $this->addColumn($noteTable, 'author_id', $this->integer());

        $this->addForeignKey(
            self::FK_NOTE_AUTHOR_ID,
            $noteTable,
            'author_id',
            User::tableName(),
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $noteTable = $this->getNoteTable();

        $this->dropForeignKey(self::FK_NOTE_AUTHOR_ID, $noteTable);
        $this->dropColumn($noteTable, 'author_id');
    }

    /**
     * @return string
     */
    private function getNoteTable(): string
    {
        return Note::tableName();
    }
}
