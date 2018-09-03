<?php

use app\objects\viewModels\NoteView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Note */
/* @var $viewModel NoteView */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($viewModel->isAuthor($model)): ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif;?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text:html',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y'],
                'label' => 'Дата создания',
            ],
        ],
    ]) ?>

</div>
