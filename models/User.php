<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\BaseArrayHelper;

/**
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $access_token
 * @property string $password
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
	public static function tableName(): string
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules(): array
	{
		return BaseArrayHelper::merge(
			[
				[['username', 'password'], 'string'],
				[['username', 'password'], 'required'],
			],
			parent::rules()
		);
	}

	/**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
		return self::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
		return self::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		return self::findOne(['username' => $username]);
	}

	/**
	 * @inheritdoc
	 * @throws \yii\base\Exception
	 */
	public function beforeSave($insert): bool
	{
		if (!parent::beforeSave($insert)) {
			return false;
		}

		if ($this->isAttributeChanged('password')) {
			$this->password = \password_hash($this->password, \PASSWORD_BCRYPT);
		}

		if (!$this->auth_key) {
			$this->auth_key = \Yii::$app->security->generateRandomString();
		}

		if (!$this->access_token) {
			$this->access_token = \Yii::$app->security->generateRandomString();
		}

		return true;
	}

	/**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
		return \password_verify($password, $this->password);
    }
}
