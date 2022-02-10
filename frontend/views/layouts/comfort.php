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
<header>
    <!-- Модальное окно -->
    <div class="modal">
        <div class="modal-block">
            <div class="modal-block__window">
                <div class="modal-block__wrapper">
                    <div class="modal-block__head">
                        <div class="modal-block__logo">
                            <img src="img/icons/form-logo.png" alt="">
                        </div>
                        <div class="modal-block__exit">
                            <img src="img/icons/form-close.png" alt="">
                        </div>
                    </div>
                    <div class="modal-block__form">
                        <form action="#" class="form-block__action modal-window" id="form-block__action">
                            <span class="title fz16">оставьте свой номер,</span> <span class="color-text fz16"> мы перезвоним
                  вам</span>
                            <div class="form-block__inputs">
                                <div class="form-block__input h20">
                                    <input type="text" placeholder="Ваше имя" id="name" name="cname">
                                </div>
                                <div class="form-block__input h20">
                                    <input type="text" placeholder="Ваш телефон" id="cphone" name="cphone">
                                </div>
                            </div>
                            <span class="modal-block__title">Определились с материалом?</span>
                            <div class="form-block__inputs">
                                <div class="form-block__input h20">
                                    <input type="text" placeholder="Ваше имя" id="name" name="cname">
                                </div>
                            </div>
                            <div class="form-block__btn">
                                <input type="submit" value="Отправить" id="submit" class="form-block__button small disabled">
                            </div>
                        </form>
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
                        <img src="img/icons/menu-btn.png" alt="">
                    </div>
                    <a href="<?=Url::home()?>">
                        <div class="head-block__logo">
                            <img src="img/icons/head-logo.png" alt="">
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
                        <img src="img/blocks/burger/burger-icon1.svg" alt="">
                    </div>
                </div>
            </a>
            <a href="#" target="_blank">
                <div class="menu-block__item">
                    <div class="menu-block__image">
                        <img src="img/blocks/burger/burger-icon2.svg" alt="">
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
<footer>
    <section class="footer">
        <div class="wrap">
            <div class="footer-block">
                <div class="footer-block__contacts">
                    <div class="footer-block__links">
                        <a href="<?=Url::home()?>">
                            <img src="img/icons/footer-logo.png" alt="">
                        </a>
                        <a href="projects.html">Проекты</a>
                        <a href="services.html">Услуги</a>
                        <a href="<?=Url::to(['home/about'])?>">О компании</a>
                    </div>
                    <div class="footer-block__social foothide">
                        <a href="#" target="_blank">
                            <img src="img/icons/facebook-icon.svg" alt="">
                        </a>
                        <a href="#" target="_blank">
                            <img src="img/icons/twitter-icon.svg" class="twitter" alt="">
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
                            <img src="img/icons/phone-icon.svg" alt="">
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
                        <img src="img/icons/facebook-icon.svg" alt="">
                    </a>
                    <a href="#" target="_blank">
                        <img src="img/icons/twitter-icon.svg" class="twitter" alt="">
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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();