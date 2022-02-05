<?php

namespace app\controllers;

use app\models\Test;
use app\models\TestBase;
use yii\web\NotFoundHttpException;

class TestController extends AppController
{
    public function actionCreate()
    {
        $testBase = new TestBase();
        
        if ($testBase->load(\Yii::$app->request->post()) && $testBase->validate()) {

            \Yii::$app->session['testBase'] = $testBase;
            if($test = $testBase->createTest())
            {
                return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
            }
        }

        return $this->render('create',[
            'model' => $testBase,
        ]);
    }

    public function actionSettings($hash_link)
    {
        $this->layout = 'test';
        $this->hash_link = $hash_link;
        
        $model = $this->findModel($hash_link);

        // var_dump($model);die;

        return $this->render('settings',[
            'model' => $model,
        ]);
    }

    public function actionQuestions($hash_link)
    {
        $this->layout = 'test';

        
        $model = $this->findModel($hash_link);

        // var_dump($model);die;

        return $this->render('questions',[
            'model' => $model,
        ]);
    }

    public function actionPublish($hash_link)
    {
        $this->layout = 'test';

        
        $model = $this->findModel($hash_link);

        // var_dump($model);die;

        return $this->render('publish',[
            'model' => $model,
        ]);
    }

    public function actionResults($hash_link)
    {
        $this->layout = 'test';

        
        $model = $this->findModel($hash_link);

        // var_dump($model);die;

        return $this->render('results',[
            'model' => $model,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }

    
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
