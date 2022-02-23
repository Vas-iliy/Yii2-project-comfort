<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <base href="<?=Url::home()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<?if(empty(Yii::$app->errorHandler->exception)):?>
<header>
    <!-- Модальное окно -->
    <div class="modal">
        <div class="modal-block">
            <div class="modal-block__window">
                <div class="modal-block__wrapper">
                    <div class="modal-block__head">
                        <div class="modal-block__logo">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/form-logo.png'))?>

                        </div>
                        <div class="modal-block__exit">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/form-close.png'))?>
                        </div>
                    </div>
                    <?=$this->render('_form', [
                        'model' => $this->context->client,
                        'materials' => $this->context->materials,
                    ])?>
                </div>
            </div>
        </div>
    </div>

    <div class="modalform <?if(Yii::$app->session->hasFlash('success') == 'client' || Yii::$app->session->hasFlash('success') == 'error') echo 'activity';?>">
        <div class="modalform-block">
            <div class="modalform-block__window">
                <div class="modalform-block__wrap">
                    <div class="modalform-block__head">
                        <div class="modalform-block__exit">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/close-icon.png'))?>
                        </div>
                    </div>
                    <div class="modalform-block__body">
                        <div class="modalform-block__image">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/form-icon.svg'))?>
                        </div>
                        <span class="modalform-block__title">Спасибо за Вашу активность</span>
                        <span class="modalform-block__subtitle">В скором времени с вами свяжутся </span>
                        <a href="<?=Url::home()?>" class="modalform-block__btn">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <section class="background">
        <?=Html::img($this->context->page->getUploadedFileUrl('image'), ['class' => 'fon'])?>
        <div class="head">
            <div class="wrap">
                <div class="head-block">
                    <div class="burger-menu">
                        <?=Html::img(Yii::getAlias('@static/origin/icons/menu-btn.png'))?>
                    </div>
                    <a href="<?=Url::home()?>">
                        <div class="head-block__logo">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/head-logo.png'))?>
                        </div>
                    </a>
                    <?if(!empty($this->context->pages)):?>
                    <nav class="head-block__nav">
                        <ul>
                            <?foreach ($this->context->pages as $page):?>
                            <?if ($page->alias != ''):?>
                            <li><a href="<?=Url::to(['/' . $page->alias])?>"><?=$page->title?></a></li>
                            <?endif;?>
                            <?endforeach;?>
                        </ul>
                    </nav>
                    <?endif;?>
                </div>
            </div>
        </div>
        <div class="hero center">
            <div class="wrap">
                <div class="hero-block">
                    <h1><?=$this->context->page->title?></h1>
                    <?if(Url::current([], true) == 'http://comfort/'):?>
                    <div class="hero-block__btn">
                        <a href="#">Заказать дом</a>
                    </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </section>
</header>
<?endif;?>

<!-- Burger-menu -->
<div class="menu-bg">
</div>
<?if(!empty($this->context->pages)):?>
<div class="menu" id="menu">
    <div class="menu-block">
        <nav class="menu-block__items">
            <?foreach ($this->context->pages as $page):?>
            <a href="<?=Url::to(['/'.$page->alias])?>">
                <div class="menu-block__item">
                    <div class="menu-block__image">
                        <?=Html::img($page->getUploadedFileUrl('icon'))?>
                    </div>
                    <span><?=$page->title_menu?></span>
                </div>
            </a>
            <?endforeach;?>
            <a href="#" target="_blank">
                <div class="menu-block__item">
                    <div class="menu-block__image">
                        <?=Html::img(Yii::getAlias('@static/origin/blocks/burger/burger-icon1.svg'))?>
                    </div>
                </div>
            </a>
            <a href="#" target="_blank">
                <div class="menu-block__item">
                    <div class="menu-block__image">
                        <?=Html::img(Yii::getAlias('@static/origin/blocks/burger/burger-icon2.svg'))?>
                    </div>
                </div>
            </a>
        </nav>
    </div>
</div>
<?endif;?>
<main>
    <?=$content?>
    <?=$this->render('_contacts', [
        'contacts' => $this->context->contacts,
    ])?>
</main>
<?if(empty(Yii::$app->errorHandler->exception)):?>
<footer>
    <section class="footer">
        <div class="wrap">
            <div class="footer-block">
                <div class="footer-block__contacts">
                    <div class="footer-block__links">
                        <a href="<?=Url::home()?>">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/footer-logo.png'))?>
                        </a>
                        <?foreach ($this->context->pages as $page):?>
                            <?if ($page->alias != ''):?>
                                <a href="<?=Url::to(['/' . $page->alias])?>"><?=$page->title_menu?></a>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
                    <div class="footer-block__social foothide">
                        <a href="#" target="_blank">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/facebook-icon.svg'))?>
                        </a>
                        <a href="#" target="_blank">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/twitter-icon.svg'), ['class' => 'twitter'])?>
                        </a>
                    </div>
                    <div class="footer-block__politic foothide">
                        <span>Все права защищены</span>
                        <a href="#" target="_blank"><span>Политика конфиденциальности</span></a>
                    </div>
                </div>
                <div class="footer-block__question">
                    <span class="footer-block__title">Остались вопросы ?</span>
                    <div class="footer-block__call">
                        <div class="footer-block__vision">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/phone-icon.svg'))?>
                        </div>
                        <span class="footer-block__pol">Позвоните нам,
                мы с радостью внесём ясность и ответим на все вопросы </span>
                    </div>
                    <div class="footer-block__btn foothide">
                        <span>Позвонить</span>
                    </div>
                </div>
                <div class="footer-block__social footvisible">
                    <a href="#" target="_blank">
                        <?=Html::img(Yii::getAlias('@static/origin/icons/facebook-icon.svg'))?>
                    </a>
                    <a href="#" target="_blank">
                        <?=Html::img(Yii::getAlias('@static/origin/icons/twitter-icon.svg'), ['class' => 'twitter'])?>
                    </a>
                </div>
                <div class="footer-block__politic footvis">
                    <span>Все права защищены</span>
                    <a href="#" target="_blank"><span>Политика конфиденциальности</span></a>
                </div>
            </div>
        </div>
    </section>
</footer>
<?endif;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();