<? use yii\helpers\Html;
use yii\helpers\Url;

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
                                        <a href="<?=Url::to(['project/index', 'filter' => $filters[0]->id])?>">
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
                                        <a href="<?=Url::to(['project/index', 'filter' => $filters[1]->id])?>">
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
                                        <a href="<?=Url::to(['project/index', 'filter' => $filters[1]->id])?>">
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
                                        <a href="<?=Url::to(['project/index', 'filter' => $filters[2]->id])?>">
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
                                        <a href="<?=Url::to(['project/index', 'filter' => $filters[3]->id])?>">
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
                                    <a href="<?=Url::to(['project/index', 'filter' => $filters[3]->id])?>">
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
                                            <a href="<?=Url::to(['project/index', 'filter' => $filter->id])?>">
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
        <?=$this->render('//project/_project', [
                'projects' => $projects,
        ])?>
    </section>
<?endif;
    $this->endCache();
endif;?>
