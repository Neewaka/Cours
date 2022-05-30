<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<? $url = Url::to(['test/view', 'hash_link' => $model->hash_link], true) ?>

<h2 class="page-name">Стартовая страница</h2>

<p>Стартовая страница теста, содержащая невероятно полезную информацию.</p>

<h3 class="ml-4">Задачи</h3>
<div class="content start-page-container">
    <button class=" btn-block row start-page-row btn-hash-link" data-url=<?= $url ?> data-trigger="focus" data-toggle="popover" data-placement="bottom" data-content="Ссылка скопирована">
        <div class="col-1 start-page-number">0.</div>
        <div class="col">
            <p class='start-page-label'>Сохраните ссылку на эту страницу и запишите пароль</p>
            <p class='start-page-text'><b>Это действие является обязательным!</b> Утерянные тесты возврату не подлежат.</p>
        </div>
    </button>
    <a href="settings" class="btn btn-block row start-page-row">
        <div class="col-1 start-page-number">1.</div>
        <div class="col">
            <p class='start-page-label'>Подкрутите настройки</p>
            <p class='start-page-text'>Измените название теста или добавате для него тему.</p>
        </div>
    </a>
    <a href="questions" class="btn btn-block row start-page-row">
        <div class="col-1 start-page-number">2.</div>
        <div class="col-11">
            <p class='start-page-label'>Добавьте вопросы</p>
            <p class='start-page-text'>Нельзя называть тест тестом если в нем нет вопросов.</p>
        </div>
    </a>
    <a href="publish" class="btn btn-block row start-page-row">
        <div class="col-1 start-page-number">3.</div>
        <div class="col-11">
            <p class='start-page-label'>Опубликуйте тест</p>
            <p class='start-page-text'>Откройте доступ к прохождению вашего теста и начинайте собирать результаты.</p>
        </div>
    </a>
    <a href="results" class="btn btn-block row start-page-row">
        <div class="col-1 start-page-number">4.</div>
        <div class="col">
            <p class='start-page-label'>Просмотрите результаты</p>
            <p class='start-page-text'>Узнайте как хорошо были пройдены ваши тесты.</p>
        </div>
    </a>
</div>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/settings.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>