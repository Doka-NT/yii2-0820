<?php

namespace app\objects\viewModels;

use app\models\Note;
use app\objects\NoteAccessChecker;
use yii\helpers\Html;

class NoteView
{
    /**
     * Является ли текущий пользователь авторов заметки
     *
     * @param Note $model
     * @return bool
     */
    public function isAuthor(Note $model): bool
    {
        return (new NoteAccessChecker)->isAllowedToWrite($model);
    }

    /**
     * @param Note $model
     * @return string
     */
    public function getDateString(Note $model): string
    {
        return date('d.m.Y H:i', strtotime($model->created_at));
    }

    /**
     * @param Note $model
     * @return string
     */
    public function getUserLink(Note $model): string
    {
        return Html::a($model->author->username, ['user/view', 'id' => $model->author_id]);
    }
}
