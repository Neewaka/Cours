<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute' => 'title', 'format' => 'raw', 'value' => function($data){
                return '<a href="' . 'test/' . $data->hash_link . '">' . $data->title . '</a>';
            }],
            'subject',
            // 'created_by',
            'created_at',
            //'test_body:ntext',
            'hash_link',
            //'password',
            //'is_published',

            
        ],
    ]); ?>


</div>
