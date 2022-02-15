<section class="items">
    <div class="wrap">
        <span class="title">Каталог наших <span class="color-text"> проектов</span></span>
        <? use yii\helpers\Url;
        use yii\widgets\LinkPager;

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
                                    <a href="<?=Yii::$app->request->get('filter') ? Url::to(['', 'filter' => Yii::$app->request->get('filter').','.$filter['id']]) : Url::to(['', 'filter' => $filter['id']])?>">
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

            <a href="<?=Yii::$app->request->get('filter') ? Url::to(['', 'filter' => Yii::$app->request->get('filter').','.$filter['id']]) : Url::to(['', 'filter' => $filter['id']])?>">
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
<?if(!empty($projects)):?>
    <?=$this->render('_project', [
        'projects' => $projects['projects'],
    ])?>
    <?=LinkPager::widget([
    'pagination' => $projects['pages']
    ])?>
<?else:?>
<h2>В данном разделе проетов пока нет</h2>
<?endif;?>

