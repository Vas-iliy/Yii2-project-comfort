<? use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
<section class="form">
    <div class="form-block__image invis">
        <img src="img/blocks/contact/contact-image1.png" alt="">
    </div>
    <div class="wrap">
        <div class="form-block">
            <?$form = ActiveForm::begin([
                /*'id' => 'form-block__action',*/
                'options' => ['class' => 'form-block__action'],
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'error']
                ],
                'method' => 'post',
                /*'action' => ['subject/review'],*/
            ])?>
                <span class="title">оставьте<span class="color-text"> отзыв</span></span>
                <div class="form-block__inputs">
                    <div class="form-block__input">
                        <?= $form->field($model, 'name')->textInput(['id' => 'name', 'placeholder' => 'Ваше имя'])->label(false)?>
                    </div>
                    <div class="form-block__input">
                        <?= $form->field($model, 'phone')->textInput(['id' => 'cphones', 'placeholder' => 'Номер телефона'])->label(false)?>
                    </div>
                    <div class="form-block__input">
                        <?= $form->field($model, 'email')->textInput(['id' => 'email', 'placeholder' => 'Ваш email'])->label(false)?>
                    </div>
                </div>
                <div class="form-block__textarea">
                    <?= $form->field($model, 'subject')->textarea(['cols' => 30, 'rows' => 10, 'placeholder' => 'Напишите нам'])->label(false)?>
                </div>
                <div class="form-block__btn">
                    <?= Html::submitButton('Отправить', ['class' => 'form-block__button disabled', 'id' => 'submit']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <div class="form-block__images showd">
                <div class="form-block__image">
                    <img src="img/blocks/contact/contact-image1.png" alt="">
                </div>
                <div class="form-block__image">
                    <img src="img/blocks/contact/contact-image1.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modalform <?if(Yii::$app->session->hasFlash('success')) echo 'activity';?>">
    <div class="modalform-block">
        <div class="modalform-block__window">
            <div class="modalform-block__wrap">
                <div class="modalform-block__head">
                    <div class="modalform-block__exit">
                        <img src="img/icons/close-icon.png" alt="">
                    </div>
                </div>
                <div class="modalform-block__body">
                    <div class="modalform-block__image">
                        <img src="img/icons/form-icon.svg" alt="">
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
