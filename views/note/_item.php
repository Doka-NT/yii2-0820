<?php

use app\models\Note;
use app\objects\viewModels\NoteView;

/* @var $model Note */
/* @var $viewModel NoteView */

?>

<div class="panel panel-default">
	<div class="panel-heading">
        <?=$model->name;?>,
        создана <?=$viewModel->getDateString($model);?>,
        пользователем
        <?=$viewModel->getUserLink($model);?>
    </div>
	<div class="panel-body"><?=$model->text;?></div>
</div>
