<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $layout = '@app/views/layouts/_main';
    public $controllerNamespace = __NAMESPACE__ . '\\controllers';
}
