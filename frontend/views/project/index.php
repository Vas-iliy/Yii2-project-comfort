<section class="items">
    <div class="wrap">
        <span class="title">Каталог наших <span class="color-text"> проектов</span></span>
        <? use yii\helpers\Url;

        if(!empty($filters)):?>
        <div class="items-block hide">
            <div class="items-block__change">
                <div class="modalitems-block__window">
                    <div class="modalitems-block__wrapper">
                        <div class='dropdown'>
                            <div class='titleitems pointerCursor'>
                                <?if(!empty($isActive)):?>
                                    <?foreach ($filters as $filter):?>
                                        <?if (is_string($isActive)):?>
                                        <?=($filter['id'] == $isActive) ? $filter['filter'] : ''?>
                                        <?elseif (is_array($isActive)):?>
                                        <?=($filter['id'] == $isActive[0]) ? $filter['filter'] : ''?>
                                        <?endif;?>
                                    <?endforeach;?>
                                <?else:?>
                                    Выберите фильтр
                                <?endif;?>
                                <img class="fa fa-angle-right" src="img/icons/js-arrow.svg" alt="">
                            </div>
                            <div class='menuitems pointerCursor hide'>
                                <?foreach ($filters as $filter):?>
                                    <a href="<?=(preg_match('/filter=/', Url::current())) ? Url::current() . ',' . $filter['id'] : Url::to(['', 'filter' => $filter['id']])?>">
                                    <div class="
                                    items-block__point
                                    <?=(is_string($isActive) && $filter['id'] == $isActive) ? ' active' : ''?>
                                    <?if (is_array($isActive)) {
                                        foreach ($isActive as $item) {
                                            if ($item == $filter['id']) echo ' active';
                                        }
                                    }?>
                                    ">
                                        <span><?=$filter['filter']?></span>
                                        <img src="img/icons/delete-icon.svg" class="hide" alt="">
                                    </div>
                                </a>
                                <?endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="items-block visible">
            <?foreach ($filters as $k => $filter):?>
            <?if($k == 0 || ($k/4) == 1):?>
            <div class="items-block__points">
            <?endif;?>

            <a href="<?=(preg_match('/filter=/', Url::current())) ? Url::current() . ',' . $filter['id'] : Url::to(['', 'filter' => $filter['id']])?>">
                <div class="
                items-block__point
                <?=(is_string($isActive) && $filter['id'] == $isActive) ? ' active' : ''?>
                <?if (is_array($isActive)) {
                            foreach ($isActive as $item) {
                                if ($item == $filter['id']) echo ' active';
                            }
                        }?>
                ">
                        <span><?=$filter['filter']?></span>
                        <img src="img/icons/delete-icon.svg" class="hide" alt="">
                </div>
            </a>
            <?if($k == 3 || $k == 7 || $k == 11 || $k == count($filters) - 1):?>
            </div>
            <?endif;?>
            <?endforeach;?>
        </div>
        <?endif;?>
    </div>
</section>
<section class="block">
    <div class="wrap">
        <span class="popular-block__title active">Баня Рибера</span>

        <div class="popular-block">

            <div class="swiper popular-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-1.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-2.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-3.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-4.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-5.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-6.png" class="border" />
                    </div>
                </div>
                <div class="popular-pagination">
                </div>
            </div>

            <div class="popular-block__info">
                <span class="popular-block__title disabled">Баня Рибера</span>
                <div class="popular-block__characteristic">
                    <div class="popular-block__block">
                        <span class="popular-block__name">92 м²</span>
                    </div>
                    <div class="popular-block__block">
                        <span class="popular-block__name">Из клееного бруса</span>
                    </div>
                    <div class="popular-block__block">
                        <span class="popular-block__name">1 этаж</span>
                    </div>
                </div>
                <div class="popular-block__text">
                    <p>
                        Баня, построенная из клееного бруса Рибера является многофункциональным сооружением, сочетающее в себе
                        оптимальную планировку, комфорт и возможность адаптировать помещения под Ваши пожелания.
                    </p>
                    <p>
                        Продуманная конструкция бани оптимизирует количество строительных материалов и, следовательно,
                        стоимость строительства. Мобильные внутренние стены позволяют изменять параметры комнат и, например,
                        заменить кладовую на котельную при автономном расположении здания.
                    </p>
                </div>
                <div class="popular-block__buy">
                    <div class="popular-block__btn">
                        <a href="#">Построить</a>
                    </div>
                    <div class="popular-block__value">
                        <span class="popular-block__price"><span class="small-text">от</span> 3 320 500</span> <img
                            src="img/icons/ruble-icon.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="block">
    <div class="wrap">
        <span class="popular-block__title active">Баня Рибера</span>

        <div class="popular-block">


            <div class="swiper popular-slider hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-1.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-2.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-3.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-4.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-5.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-6.png" class="border" />
                    </div>
                </div>
                <div class="popular-pagination">
                </div>
            </div>

            <div class="popular-block__info">
                <span class="popular-block__title disabled">Баня Рибера</span>
                <div class="popular-block__characteristic">
                    <div class="popular-block__block">
                        <span class="popular-block__name">92 м²</span>
                    </div>
                    <div class="popular-block__block">
                        <span class="popular-block__name">Из клееного бруса</span>
                    </div>
                    <div class="popular-block__block">
                        <span class="popular-block__name">1 этаж</span>
                    </div>
                </div>
                <div class="popular-block__text">
                    <p>
                        Баня, построенная из клееного бруса Рибера является многофункциональным сооружением, сочетающее в себе
                        оптимальную планировку, комфорт и возможность адаптировать помещения под Ваши пожелания.
                    </p>
                    <p>
                        Продуманная конструкция бани оптимизирует количество строительных материалов и, следовательно,
                        стоимость строительства. Мобильные внутренние стены позволяют изменять параметры комнат и, например,
                        заменить кладовую на котельную при автономном расположении здания.
                    </p>
                </div>
                <div class="popular-block__buy">
                    <div class="popular-block__btn">
                        <a href="#">Построить</a>
                    </div>
                    <div class="popular-block__value">
                        <span class="popular-block__price"><span class="small-text">от</span> 3 320 500</span> <img
                            src="img/icons/ruble-icon.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="swiper popular-slider visible">
                <div class="swiper-wrapper">
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-1.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-2.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-3.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-4.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-5.png" class="border" />
                    </div>
                    <div class="swiper-slide popular-slide">
                        <img src="img/blocks/popular/popular-6.png" class="border" />
                    </div>
                </div>
                <div class="popular-pagination">
                </div>
            </div>

        </div>
    </div>
</section>