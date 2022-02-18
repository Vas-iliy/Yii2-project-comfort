<? use core\entities\State;
use yii\helpers\Html;
use yii\helpers\Url;

if ($this->beginCache('states_page', ['duration' => 3600*24*30])):
if(!empty($categories) && !empty($categories[0]->states)):?>
<section class="advice">
    <div class="wrap">
        <span class="title"><?=$categories[0]->title?></span>
        <div class="advice-block">
            <?foreach ($categories[0]->getStates()->andWhere(['status' => State::STATUS_ACTIVE])->all() as $state):?>
            <a href="<?=Url::to(['state', 'id' => $state->id])?>">
                <div class="advice-block__item">
                    <div class="advice-block__image">
                        <?=Html::img($state->getUploadedFileUrl('image'))?>
                        <div class="mask"></div>
                    </div>
                    <span class="advice-block__title"><?=$state->title?></span>
                </div>
            </a>
            <?endforeach;?>
        </div>
    </div>
</section>
<?endif;?>
<?if(!empty($question)):?>
<section class="questions">
    <div class="wrap">
        <a href="<?=Url::to([$question->alias])?>"><div class="questions-block">
                <div class="questions-block__image">
                    <?=Html::img($question->getUploadedFileUrl('image'))?>
                    <div class="mask"></div>
                    <p><?=$question->title?></p>
                </div>
            </div>
        </a>
    </div>
</section>
<?endif;?>
<?if(!empty($categories)):?>
<?foreach ($categories as $k => $category): if ($k > 0 && !empty($category->getStates()->andWhere(['status' => State::STATUS_ACTIVE])->all())):?>
<section class="advice">
    <div class="wrap">
        <span class="title"><?=$category->title?></span>
        <div class="advice-block">
            <?foreach ($category->getStates()->andWhere(['status' => State::STATUS_ACTIVE])->all() as $state):?>
                <a href="<?=Url::to(['state', 'id' => $state->id])?>">
                    <div class="advice-block__item">
                        <div class="advice-block__image">
                            <?=Html::img($state->getUploadedFileUrl('image'))?>
                            <div class="mask"></div>
                        </div>
                        <span class="advice-block__title"><?=$state->title?></span>
                    </div>
                </a>
            <?endforeach;?>
        </div>
    </div>
</section>
<?endif; endforeach;?>
<?endif;?>
<?  $this->endCache();
endif;?>
