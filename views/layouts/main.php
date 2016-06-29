<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Dropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Countries', 'url' => ['/country/index']],
            ['label' => 'Form', 'url' => ['/site/entry']],
            [
                'label' => 'App',
                'items' => [
                    ['label' => 'App', 'url' => ['/app/index']],
                    ['label' => 'App version', 'url' => ['/app-version/index']],
                    ['label' => 'App output structure', 'url' => ['/app-output-structure/index']],
                    ['label' => 'App output key', 'url' => ['/app-output-key/index']],
                    ['label' => 'App settings', 'url' => ['/app-settings/index']],
                    ['label' => 'Data grid jQuery', 'url' => ['/app/data-grid-jquery']],
                    ['label' => 'Data grid Angular', 'url' => ['/app/data-grid-angular']]
                ]
            ],
            [
                'label' => 'Cpu',
                'items' => [
                    ['label' => 'Cpu', 'url' => ['cpu/index']],
                    ['label' => 'Cpu Attribute Group', 'url' => ['cpu-attribute-group/index']],
                    ['label' => 'Cpu Attribute', 'url' => ['cpu-attribute/index']],
                    ['label' => 'Cpu Attribute Value', 'url' => ['cpu-attribute-value/index']]
                ]
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
