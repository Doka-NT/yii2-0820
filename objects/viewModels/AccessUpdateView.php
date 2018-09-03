<?php

namespace app\objects\viewModels;

use app\models\Note;
use app\models\User;
use yii\helpers\BaseArrayHelper;

class AccessUpdateView
{
    /**
     * @return array
     */
    public function getUserOptions(): array
    {
        return BaseArrayHelper::map(User::find()->all(), 'id', 'username');
    }

    /**
     * @return array
     */
    public function getNoteOptions(): array
    {
        return BaseArrayHelper::map(Note::find()->all(), 'id', 'name');
    }
}
