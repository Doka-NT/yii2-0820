<?php

use app\models\Note;
use app\objects\NoteAccessChecker;
use app\objects\viewModels\NoteView;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $viewModel NoteView */

$this->title = 'Notes';
$this->params['breadcrumbs'][] = $this->title;

$isAllowedToWriteCallback = function (app\models\Note $note) {
    return (new \app\objects\NoteAccessChecker())->isAllowedToWrite($note);
};

?>
<div class="note-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Note', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($this->beginCache('view_note_index', $viewModel->getCacheParams())):?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => \yii\grid\SerialColumn::class],
                'name',
                [
                    'label' => "Автор",
                    'format' => 'raw',
                    'value' => function (Note $model) use ($viewModel) {
                        return $viewModel->getUserLink($model);
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d.m.Y'],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:d.m.Y H:i:s'],
                ],
                [
                    'class' => \yii\grid\ActionColumn::class,
                    'visibleButtons' => [
                        'view' => function (\app\models\Note $model) {
                            return (new NoteAccessChecker())->isAllowedToRead($model);
                        },
                        'update' => $isAllowedToWriteCallback,
                        'delete' => $isAllowedToWriteCallback,
                    ],
                ],
            ],
        ]); ?>
    <?php $this->endCache();?>
    <?php endif;?>
</div>
