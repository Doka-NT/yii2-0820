<?php

namespace app\models;

use app\models\query\NoteQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "note".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $text Содержание
 * @property int $author_id
 * @property User $author
 * @property string $created_at
 * @property string $updated_at
 */
class Note extends ActiveRecord
{
    public static function find(): NoteQuery
    {
        return new NoteQuery(static::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (!$this->author_id) {
            $this->author_id = \Yii::$app->user->getId();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'text' => 'Содержание',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAccess(): ActiveQuery
    {
        return $this->hasMany(Access::class, ['note_id' => 'id']);
    }
}
