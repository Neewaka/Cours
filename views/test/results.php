<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Результаты';
?>
<div class="test-index">

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
        $studentResults = $true . '/' . ($answers[1] + $answers[0]). ' (' . $answers[1]/($answers[1] + $answers[0]) * 100 .'%)';

        return $studentResults;
      }],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}',
        'buttons' => [
          'view' => function ($url, $model, $key) {
            return Html::tag('button', 'Ответы', ['class' => 'btn btn-primary m-1 modal-answers', 'data-id' => $model->id]);
            // return Html::a('Ответы', 'view?id=' . $model->id,[ 'class' => 'btn btn-primary m-1']);
          }
        ]
      ],
    ],
  ]); ?>


</div>



<div class="modal" tabindex="-1" id="resultsModal">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="">
          <h5 class="modal-title">Результат</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<? $this->registerJsVar('hash_link', $this->context->testInfo->hash_link, static::POS_BEGIN); ?>
<? $this->registerJsVar('url_path', Url::to(['/test/student-result']), static::POS_BEGIN); ?>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>