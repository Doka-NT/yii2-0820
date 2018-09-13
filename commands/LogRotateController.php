<?php

namespace app\commands;

use app\models\AccessLog;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Ротация логов приложения
 */
class LogRotateController extends Controller
{
    public $defaultAction = 'access';

    /**
     * Удаляем логи
     * @param string $date Дата для удаления логов. Если указана, то будут удалены логи только за указанный день
     * @return int
     */
    public function actionAccess(string $date = ''): int
    {
        $cond = '';
        $params = [];

        if ($date) {
            if (strtotime($date) === false) {
                $msg = Console::ansiFormat('Дата указана в неправильном формата', [Console::FG_RED, Console::BG_CYAN]);
                Console::error($msg);
                echo \PHP_EOL;

                return ExitCode::UNSPECIFIED_ERROR;
            }

            $cond = 'DATE(access_time) = :date';
            $params[':date'] = $date;
        }

        AccessLog::deleteAll($cond, $params);

        return ExitCode::OK;
    }

    /**
     * @return int
     */
    public function actionProgress(): int
    {
        $total = 100000;
        $batchSize = 2000;
        Console::startProgress(0, $total);

        for ($i = 0; $i < $total; $i++) {
            if ($i % $batchSize === 0) {
                Console::updateProgress($i, $total);
            }
        }

        Console::updateProgress($total, $total);
        Console::endProgress();

        return ExitCode::OK;
    }
}