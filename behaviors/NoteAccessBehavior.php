<?php


namespace app\behaviors;


use app\models\Note;
use app\objects\NoteAccessChecker;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class NoteAccessBehavior extends AccessControl
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $id = \Yii::$app->getRequest()->get('id', 0);

        $model = $this->findModel($id);

        $checker = new NoteAccessChecker();

        if (!$checker->isAllowedToRead($model)) {
            $this->denyAccess($this->user);
            return false;
        }

        return true;
    }

    /**
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}