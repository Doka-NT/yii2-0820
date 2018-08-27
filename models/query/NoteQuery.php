<?php

namespace app\models\query;

use yii\db\ActiveQuery;

class NoteQuery extends ActiveQuery
{
	/**
	 * @return self
	 */
	public function onlyWithFooName(): self
	{
		$this->andWhere(['like', 'name', 'foo']);

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