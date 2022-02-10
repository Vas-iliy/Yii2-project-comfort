<? use yii\helpers\Html;

if ($this->beginCache('filters_home_page', ['duration' => 3600 * 24 * 30])):?>
    <?if(!empty($filters)):?>
        <section class="projects">
            <div class="wrap">
                <div class="projects-block">
                    <span class="title">Каталог наших <span class="color-text"> проектов</span></span>
                    <div class="projects-block__wrap">
                        <div class="projects-block__items first">
                            <div class="projects-block__hidden">
                                <div class="projects-block__item bigitem">
                                    <div class="projects-block__image">
                                        <?=Html::img($filters[0]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                        <a href="#">
                                            <div class="projects-block__title big">
                                                <span class="projects-block__name bigT"><?=$filters[0]->filter?></span>
                                                <img src="img/icons/arrow-icon.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="projects-block__item hidden">
                                    <div class="projects-block__image">
                                        <?=Html::img($filters[1]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                        <a href="#">
                                            <div class="projects-block__title big">
                                                <span class="projects-block__name bigT"><?=$filters[1]->filter?></span>
                                                <img src="img/icons/arrow-icon.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="projects-block__cards">
                                <div class="projects-block__item mini visible">
                                    <div class="projects-block__image">
                                        <?=Html::img($filters[1]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                        <a href="#">
                                            <div class="projects-block__title big">
                                                <span class="projects-block__name bigT"><?=$filters[1]->filter?></span>
                                                <img src="img/icons/arrow-icon.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="projects-block__item mini">
                                    <div class="projects-block__image">
                                        <?=Html::img($filters[2]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                        <a href="#">
                                            <div class="projects-block__title big">
                                                <span class="projects-block__name bigT"><?=$filters[2]->filter?></span>
                                                <img src="img/icons/arrow-icon.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="projects-block__item hidden">
                                    <div class="projects-block__image">
                                        <?=Html::img($filters[3]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                        <a href="#">
                                            <div class="projects-block__title big">
                                                <span class="projects-block__name bigT"><?=$filters[3]->filter?></span>
                                                <img src="img/icons/arrow-icon.svg" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="projects-block__items">
                            <div class="projects-block__item visible">
                                <div class="projects-block__image">
                                    <?=Html::img($filters[3]->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                    <a href="#">
                                        <div class="projects-block__title big">
                                            <span class="projects-block__name bigT"><?=$filters[3]->filter?></span>
                                            <img src="img/icons/arrow-icon.svg" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?foreach ($filters as $k => $filter):?>
                                <?if($k > 3):?>
                                    <div class="projects-block__item">
                                        <div class="projects-block__image">
                                            <?=Html::img($filter->getUploadedFileUrl('image'), ['class' => 'image'])?>
                                            <a href="#">
                                                <div class="projects-block__title">
                                                    <span class="projects-block__name"><?=$filter->filter?></span>
                                                    <img src="img/icons/arrow-icon.svg" alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?endif;
    $this->endCache();
endif;?>

<?if ($this->beginCache('projects_home_page', ['duration' => 3600 * 24 * 30])):?>
<?if(!empty($projects)):?>
    <section class="popular">
        <div class="wrap">
            <span class="title project">Популярные <span class="color-text"> Проекты</span></span>
        </div>
        <?foreach ($projects as $project):?>
            <section class="block">
                <div class="wrap">
                    <span class="popular-block__title active"><?=$project->title?></span>
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
                                    <span class="popular-block__name"><?=$project->material?></span>
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
    </section>
<?endif;
    $this->endCache();
endif;?>
