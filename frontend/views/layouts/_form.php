<div class="modal-block__form">
    <? use yii\captcha\Captcha;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $form = ActiveForm::begin([
        'options' => ['class' => 'form-block__action modal-window'],
        'fieldConfig' => [
            'errorOptions' => ['class' => 'error']
        ],
        'method' => 'post',
        'action' => ['subject/client'],
    ])?>
    <span class="title fz16">оставьте свой номер,</span> <span class="color-text fz16"> мы перезвоним
                  вам</span>
    <div class="form-block__inputs">
        <div class="form-block__input h20">
        <?= $form->field($model, 'name')->textInput(['id' => 'name', 'placeholder' => 'Ваше имя'])->label(false)?>
        </div>
        <div class="form-block__input h20">
            <?= $form->field($model, 'phone')->textInput(['id' => 'cphones', 'placeholder' => 'Номер телефона'])->label(false)?>
        </div>
    </div>
    <span class="modal-block__title">Определились с материалом?</span>
    <div class="form-block__inputs">
        <div class="form-block__input h20">
            <?= $form->field($model, 'material')->dropDownList($materials, ['prompt' => 'Материал'])->label(false)?>
        </div>
    </div>
    <?= $form->field($model, 'reCaptcha')->widget(\kekaadrenalin\recaptcha3\ReCaptchaWidget::class) ?>
    <div class="form-block__btn">
        <?= Html::submitButton('Отправить', ['class' => 'form-block__button small disabled', 'id' => 'submit']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>