<?php

use app\objects\viewModels\NoteView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $viewModel NoteView */

$this->title = 'Список заметок';

?>

<h1><?=$this->title;?></h1>

<?=\yii\widgets\ListView::widget([
    'itemView' => '_item',
    'dataProvider' => $dataProvider,
    'viewParams' => [
        'viewModel' => $viewModel,
    ]
]);?>
