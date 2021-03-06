<? use yii\helpers\Html;

if ($this->beginCache('questions_page', ['duration' => 3600*24*30])):?>
<?if(!empty($questions)):?>
<section class="point">
    <div class="wrap">
        <div class="point-block hidden">
            <?foreach ($questions as $question):?>
            <div class="point-block__item">
            <span class="title"><?=$question->title?></span>
                <p class="text"><?=$question->description?></p>
            </div>
            <?endforeach;?>
        </div>

        <div class="point-block mobile">
            <?foreach ($questions as $question):?>
                <div class="point-block__item">
                    <div class="point-block__title">
                        <div class="point-block__name">
                            <span class="title"><?=$question->title?></span>
                        </div>
                        <div class="point-block__arrow">
                            <?=Html::img(Yii::getAlias('@static/origin/icons/js-arrow.svg'))?>
                        </div>
                    </div>
                    <div class="point-block__info">
                        <p class="text"><?=$question->description?></p>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    </div>
</section>
<?endif;?>
<?$this->endCache();
endif;?>
