<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Результаты';
?>
<div class="test-index mt-2">

  <button class='btn btn-primary mb-2' id='download-json' data-test=<?= $model->id ?>>Скачать все результаты в формате JSON</button>

  <h2 class=""><?= Html::encode('Статистика процентов правильных ответов (%)') ?></h2>

  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col">100-80</th>
        <th scope="col">79-50</th>
        <th scope="col">49-20</th>
        <th scope="col">19-0</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $procents[0] ?? 0 ?></td>
        <td><?= $procents[1] ?? 0 ?></td>
        <td><?= $procents[2] ?? 0 ?></td>
        <td><?= $procents[3] ?? 0 ?></td>
      </tr>
    </tbody>
  </table>



  <h2 class="page-name"><?= Html::encode($this->title) ?></h2>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      // 'id',
      // 'test_id',
      'name',
      'email:email',
      'date:datetime',
      ['attribute' => 'result', 'value' => function ($data) {

        $answers = array_count_values(array_column((array)json_decode($data->result), 'correct'));
        $true = $answers[1] ?? 0;

        $studentResults = $true . '/' . ($answers[1] + $answers[0]) . ' (' . round($answers[1] / ($answers[1] + $answers[0]) * 100, 1) . '%)';

        return $studentResults;
      }],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}',
        'buttons' => [
          'view' => function ($url, $model, $key) {
            return Html::tag('button', 'Ответы', ['class' => 'btn btn-primary m-1 modal-answers', 'data-id' => $model->id]);
          }
        ]
      ],
    ],
  ]); ?>


</div>


<?
Modal::begin([
  'title' => 'Результаты',
  'id' => 'resultsModal',
  'scrollable' => true,
  'size' => 'modal-lg',
  'centerVertical' => true,
]);

Modal::end();
?>


<? $this->registerJsVar('hash_link', $this->context->testInfo->hash_link, static::POS_BEGIN); ?>
<? $this->registerJsVar('url_path', Url::to(['/test/student-result']), static::POS_BEGIN); ?>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/results.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>