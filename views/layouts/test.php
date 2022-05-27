<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'О нас', 'url' => ['/site/about']],
                Yii::$app->user->isGuest ? (['label' => 'Регистрация', 'url' => ['/site/registration']]
                ) : (['label' => 'Мои тесты', 'url' => ['/test/']]
                ),
                Yii::$app->user->isGuest ? (['label' => 'Войти', 'url' => ['/site/login']]
                ) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>

    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <h1>Конфигурация теста <b><?= $this->context->testInfo->title ?></b></h1>

            <hr>
            <div class="row">
                <div class="col-3 config-menu">
                    <div class="btn-group-vertical config-menu-group">
                        <a href="settings" type="button" class="btn btn-secondary config-menu-button">Настройки</a>
                        <a href="questions" type="button" class="btn btn-secondary config-menu-button">Вопросы</a>
                        <a href="publish" type="button" class="btn btn-secondary config-menu-button">Публикация</a>
                        <a href="results" type="button" class="btn btn-secondary config-menu-button">Результаты</a>
                    </div>

                    <div class="config-menu-questions d-none">
                        <div class="row">
                            <div class="col form-add-question-label">- Добавить вопрос -</div>
                        </div>
                        <div class="row">
                            <div class="col-6 btn btn-secondary form-add-question" data-type=1>Множественный выбор</div>
                            <div class="col-6 btn btn-secondary form-add-question" data-type=2>Множественный ответ</div>

                        </div>
                        <div class="row">
                            <div class="col btn btn-secondary form-add-question" data-type=3>Правда/неправда</div>
                            <div class="col btn btn-secondary form-add-question" data-type=4>Заполнить</div>
                        </div>
                    </div>


                </div>
                <div id='page-content' class="col-9">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; Neewaka Co <?= date('Y') ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>