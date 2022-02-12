<? use yii\helpers\Html;

foreach ($projects as $project):?>
    <section class="block">
        <div class="wrap">
            <span class="popular-block__title active"><?=$project->id?></span>
            <div class="popular-block">
                <div class="swiper popular-slider">
                    <div class="swiper-wrapper">
                        <?foreach ($project->images as $image):?>
                            <div class="swiper-slide popular-slide">
                                <?=Html::img($image->getUploadedFileUrl('image'), ['class' => 'border'])?>
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="popular-pagination">
                    </div>
                </div>

                <div class="popular-block__info">
                    <span class="popular-block__title disabled"><?=$project->title?></span>
                    <div class="popular-block__characteristic">
                        <div class="popular-block__block">
                            <span class="popular-block__name"><?=$project->square?> м²</span>
                        </div>
                        <div class="popular-block__block">
                            <span class="popular-block__name"><?=$project->material->material?></span>
                        </div>
                        <div class="popular-block__block">
                            <span class="popular-block__name"><?=$project->count_floors?> этаж</span>
                        </div>
                    </div>
                    <div class="popular-block__text">
                        <?=$project->description?>
                    </div>
                    <div class="popular-block__buy">
                        <div class="popular-block__btn">
                            <a href="#">Построить</a>
                        </div>
                        <div class="popular-block__value">
                            <span class="popular-block__price"><span class="small-text">от</span> <?=number_format($project->prise, 0, '', ' ')?></span> <img
                                src="img/icons/ruble-icon.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?endforeach;?>