<?php

namespace app\models\query;

use yii\db\ActiveQuery;

class NoteQuery extends ActiveQuery
{
    /**
     * Фильтрует заметки доступные текущему пользователю
     *
     * @return self
     */
    public function forCurrentUser(): self
    {
        $user = \Yii::$app->getUser();

        $this
            ->joinWith('access', true)
            ->andWhere([
                'or',
                ['=', 'note.author_id', $user->getId()],
                ['=', 'access.user_id', $user->getId()],
            ]);

        return $this;
    }

    /**
     * @return self
     */
    public function orderByName(): self
    {
        $this->orderBy(['name' => \SORT_ASC]);

        return $this;
    }
}
