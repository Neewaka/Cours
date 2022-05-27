<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тесты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'title', 'format' => 'raw', 'value' => function ($data) {
                return '<a href="' . 'test/' . $data->hash_link . '/settings' . '">' . $data->title . '</a>';
            }],
            'subject',
            'created_at',
            'hash_link',

        ],
    ]); ?>


</div>