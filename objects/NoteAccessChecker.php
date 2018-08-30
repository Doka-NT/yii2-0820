<?php

namespace app\objects;

use app\models\Access;
use app\models\Note;

class NoteAccessChecker
{
	/**
	 * @param Note $note
	 *
	 * @return bool
	 */
	public function isAllowedToWrite(Note $note): bool
	{
		return \Yii::$app->user->getId() === (int)$note->author_id;
	}

	/**
	 * @param Note $note
	 *
	 * @return bool
	 */
	public function isAllowedToRead(Note $note): bool
	{
		if ($this->isAllowedToWrite($note)) {
			return true;
		}

		$userId = \Yii::$app->user->getId();
		$count = (int)Access::find()
			->andWhere(
				[
					'note_id' => $note->id,
					'user_id' => $userId,
				]
			)
			->count('id');

		return $count > 0;
	}
}