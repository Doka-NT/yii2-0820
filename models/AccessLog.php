<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $access_time
 *
 * @property User $user
 */
class AccessLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['access_time'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'access_time' => 'Access Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Фиксируем время авторизации пользователя
     *
     * @param User $user
     */
    public static function addToLog(User $user)
    {
        $model = new static();
        $model->setAttributes([
            'user_id' => $user->id,
            'access_time' => date('Y-m-d H:i:s'),
        ]);

        $model->save();
    }
}
