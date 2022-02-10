<? use yii\helpers\Html;

if(!empty($services)):?>
<div>
    <div class="wrap">
        <span class="title"><?=$services[0]->title?></span>
        <div class="trim-block">
            <p class="text"><?=$services[0]->description?></p>
            <div class="trim-block__points">
                <ul>
                    <?if(!empty($services[0]->items)): foreach ($services[0]->items as $item):?>
                    <li class="trim-block__title"><?=$item?></li>
                    <? endforeach; endif;?>
                </ul>
            </div>
            <?if(!empty($services[0]->images)):?>
            <div class="roof-block__image">
                <?=Html::img($services[0]->images[0]->getUploadedFileUrl('image'))?>
            </div>
            <?endif;?>
        </div>
    </div>
</div>
<?endif;?>
<?if(!empty($advantages) && !empty($advantage)):?>
<section class="benefits">
    <div class="wrap">
        <div class="benefits-block">
            <span class="benefits-block__title"><?=$advantage->title?></span>
            <div class="benefits-block__items">
                <?=Html::img($advantage->getUploadedFileUrl('image'), ['class' => 'benefit'])?>
                <div class="benefits-block__wrap">
                    <?foreach ($advantages as $k => $value):?>
                    <?if($k == 0 || $k == 2):?>
                    <div class="benefits-block__cards">
                    <?endif;?>
                        <div class="benefits-block__card">
                            <div class="benefits-block__text">
                                <span class="benefits-block__name"><?=$value['title']?></span>
                                <p><?=$value['description']?></p>
                            </div>
                        </div>
                    <?if($k == 1 || $k == 3):?>
                    </div>
                    <?endif;?>
                    <?endforeach;?>
                </div>
                <div class="benefits-block__wrap vis">
                    <?foreach ($advantages as $k => $value):?>
                        <?if($k == 0 || $k == 2):?>
                            <div class="benefits-block__cards">
                        <?endif;?>
                        <div class="benefits-block__card">
                            <div class="benefits-block__text">
                                <span class="benefits-block__name"><?=$value['title']?></span>
                            </div>
                        </div>
                        <?if($k == 1 || $k == 3):?>
                            </div>
                        <?endif;?>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?endif;?>
<?if(!empty($workImages)):?>
<section class="example">
    <div class="wrap">
        <div class="example-block">
            <span class="example-block__title">Примеры работ : </span>
            <div class="example-block__images">
                <?foreach ($workImages as $image):?>
                    <div class="example-block__image">
                        <?=Html::img($image->getUploadedFileUrl('image'))?>
                    </div>
                <?endforeach;?>
            </div>
            <p class="text"><?=$workTexts->description ?? ''?></p>
        </div>
    </div>
</section>
<?endif;?>
<?if(!empty($services)): foreach ($services as $k => $service): if ($k > 0):?>
    <section>
        <div class="wrap">
            <div class="house-block">
                <span class="title"><?=$service->title?></span>
                <p class="text"><?=$services[0]->description?></p>
                <div class="trim-block__points">
                    <ul>
                        <?if(!empty($services[0]->items)): foreach ($services[0]->items as $item):?>
                            <li class="trim-block__title"><?=$item?></li>
                        <? endforeach; endif;?>
                    </ul>
                </div>
                <?if(!empty($service->images)):?>
                <div class="roof-block__image">
                    <?=Html::img($service->images[0]->getUploadedFileUrl('image'))?>
                </div>
                <?endif;?>
                <div class="house-block__items">
                <?if(!empty($service->points)): foreach ($service->points as $point):?>
                    <div class="house-block__content">
                        <span class="house-block__title"><?=$point->title?></span>
                        <p class="text"><?=$point->description?></p>
                        <?if($point->items):?>
                            <div class="house-block__points rf">
                                <ul>
                                    <?foreach ($point->items as $item):?>
                                    <li class="house-block__title"><?=$item?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        <?endif;?>
                    </div>
                <?endforeach; endif;?>
                    <?if($service->images):?>
                    <div class="roof-block__images">
                        <?foreach ($service->images as $image):?>
                            <?=Html::img($image->getUploadedFileUrl('image'))?>
                        <?endforeach;?>
                    </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </section>
<?endif; endforeach; endif;?>