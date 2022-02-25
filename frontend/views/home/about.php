<? use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
if ($this->beginCache('about_page', ['duration' => 3600*24*30])):
if(!empty($states)):?>
<section class="point">
    <div class="wrap">
        <div class="point-block">
            <?foreach ($states as $k => $state):?>
            <div class="point-block__item <?if ($k > 0) echo ' about';?>">
            <span class="title"><?=$state->title?></span>
                <p class="text"><?=$state->description?></p>
            </div>
            <?endforeach;?>
        </div>
    </div>
</section>
<?endif;?>
    <?    $this->endCache();
endif;?>
<!--<h1>
<?/*=Yii::$app->cache->get('banClient')*/?>
</h1>-->
<section class="form">
    <?if(!empty($images)):?>
    <div class="form-block__image invis">
        <?=Html::img($images[1]->getUploadedFileUrl('image'))?>
    </div>
    <?endif;?>
    <div class="wrap">
        <div class="form-block">
            <?$form = ActiveForm::begin([
                'options' => ['class' => 'form-block__action '],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error']
                ],
                'method' => 'post',
                'action' => ['subject/review'],
            ])?>
                <span class="title">оставьте<span class="color-text"> отзыв</span></span>
                <div class="form-block__inputs">
                    <div class="form-block__input">
                        <?= $form->field($model, 'name')->textInput(['id' => 'name', 'placeholder' => 'Ваше имя'])->label(false)?>
                    </div>
                    <div class="form-block__input">
                        <?= $form->field($model, 'phone')->textInput(['id' => 'phone', 'placeholder' => 'Номер телефона', 'maxlength' => 18])->label(false)?>
                    </div>
                    <div class="form-block__input">
                        <?= $form->field($model, 'email')->textInput(['id' => 'email', 'placeholder' => 'Ваш email'])->label(false)?>
                    </div>
                </div>
                <div class="form-block__textarea">
                    <?= $form->field($model, 'subject')->textarea(['cols' => 30, 'rows' => 10, 'placeholder' => 'Напишите нам'])->label(false)?>
                </div>
                <div class="form-block__inputs">
                <div class="form-block__input">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-3">{input}</div></div>',
                        'captchaAction' => 'home/captcha'
                    ])->label(false) ?>
                </div>
                </div>
                <div class="form-block__btn">
                    <?= Html::submitButton('Отправить', ['class' => 'form-block__button disabled', 'id' => 'submit']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <?if(!empty($images)):?>
            <div class="form-block__images showd">
                <?foreach ($images as $image):?>
                <div class="form-block__image">
                    <?=Html::img($image->getUploadedFileUrl('image'))?>
                </div>
                <?endforeach;?>
            </div>
            <?endif;?>
        </div>
    </div>
</section>
<div class="modalform <?if(Yii::$app->session->hasFlash('success')) echo 'activity';?>">
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
                    <span class="modalform-block__title">Спасибо за Ваш отзыв</span>
                    <span class="modalform-block__subtitle">Мы надеемся, что наше совместное
                творение не станет последним... </span>
                    <a href="<?=Url::home()?>" class="modalform-block__btn">На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>


