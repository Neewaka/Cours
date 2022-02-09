<?php

namespace app\controllers;

use app\models\Status;
use Yii;

class AppController extends \yii\web\Controller
{

    public $testInfo;

    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl

        if (!parent::beforeAction($action)) {
            return false;
        }

        $session = Yii::$app->session;
        if (!$session->isActive)
        {
            $session->open();
        }

        return true; // or false to not run the action
    }
}
