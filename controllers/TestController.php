<?php

namespace app\controllers;

use app\models\Test;
use app\models\TestBaseForm;
use app\models\TestForm;
use app\models\TestSearch;
use app\models\TestResultSearch;
use app\models\QuestionForm;
use yii\web\NotFoundHttpException;

class TestController extends AppController
{

    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $testBase = new TestBaseForm();

        if ($testBase->load(\Yii::$app->request->post()) && $testBase->validate()) {

            \Yii::$app->session['testBase'] = $testBase;
            if ($test = $testBase->createTest()) {
                return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
            }
        }

        return $this->render('create', [
            'model' => $testBase,
        ]);
    }

    public function actionSettings($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        return $this->render('settings', [
            'model' => $model,
        ]);
    }

    public function actionQuestions($hash_link)
    {
        if(\Yii::$app->request->isAjax){
            return $this->renderAjax('questions', [
                'things' => ['123']
            ]);
        }

        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        $model = new QuestionForm(); 

        return $this->render('questions', [
            'model' => $model,
            'things' => ['321','123']
        ]);
    }

    public function actionPublish($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        return $this->render('publish', [
            'model' => $model,
        ]);
    }

    public function actionResults($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        $searchModel = new TestResultSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($hash_link)
    {
        $test = $this->findModel($hash_link);
        $this->testInfo = $test;
        $model = new TestForm;
        $model->test = $test;

        //admin entrance
        if ($model->load(\Yii::$app->request->post()) && $model->validateAdminPassword())
        {
            return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
        }

        return $this->render('view', [
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

    public function actionAddQuestion()
    {

    }
}
