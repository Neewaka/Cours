<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Results';
?>
<div class="test-index">

    <h2 class="page-name"><?= Html::encode($this->title) ?></h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'test_id',
            'name',
            'email:email',
            'date:datetime',
            ['attribute' => 'result', 'value' => function($data){
                $true = substr_count($data->result, 'true');
                $count = explode(',', $data->result);
                return $true . '/' . count($count);
            }],       
        ],
    ]); ?>


</div>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>