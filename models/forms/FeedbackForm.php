<?php

namespace app\models\forms;

use yii\base\Model;
use yii\helpers\BaseArrayHelper;

class FeedbackForm extends Model
{
    public $name;
    public $email;
    public $text;

    public function rules(): array
    {
        return BaseArrayHelper::merge(
            [
                [['name', 'email', 'text'], 'required', 'message' => 'Не заполнено поле'],
                [['name', 'text'], 'string'],
                ['email', 'email'],
                ['text', 'checkText'],
            ],
            parent::rules()
        );
    }

    /**
     * @return void
     */
    public function checkText(): void
    {
        if (\strpos($this->text, 'забор') !== false) {
            $this->addError('text', 'В поле текст нельзя писать слово "забор"');
        }
    }

    public function attributeLabels()
    {
        return BaseArrayHelper::merge([
            'name' => 'Ваше имя',
            'email' => 'Контактный email',
            'text' => 'Текст обращения',
        ], parent::attributeLabels());
    }
}
