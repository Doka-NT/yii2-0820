<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accesses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Access', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Заметка',
                'format' => 'raw',
                'value' => function (\app\models\Access $model) {
                    return Html::a($model->note->name, ['note/view', 'id' => $model->note_id]);
                }
            ],
            [
                'label' => 'Пользователь',
                'format' => 'raw',
                'value' => function (\app\models\Access $model) {

                    return Html::a($model->user->username, ['user/view', 'id' => $model->user_id]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
