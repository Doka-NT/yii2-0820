<?php

use app\models\forms\FeedbackForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model FeedbackForm */

?>
<?php $form = ActiveForm::begin(); ?>
	<?=$form->field($model, 'name')->textInput();?>
	<?=$form->field($model, 'email')->textInput(['type' => 'email']);?>
	<?=$form->field($model, 'text')->textarea();?>

	<?=Html::submitButton('Отправить');?>
<?php ActiveForm::end();?>
