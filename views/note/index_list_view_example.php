<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;

/* @var $searchModel app\models\search\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_item',
]);
