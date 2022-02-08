<?if(!empty($contacts)):?>
<section class="contacts">
    <div class="wrap">
        <div class="contacts-block">
            <?foreach ($contacts as $contact):?>
            <div class="contacts-block__item">
                <span class="contacts-block__name"><?=$contact['title']?></span>
                <span class="contacts-block__info"><?=$contact['content']?></span>
            </div>
            <?endforeach;?>
        </div>
    </div>
</section>
<?endif;?>
<!--<section class="map">
    <div style="position:relative;overflow:hidden;"><a
            href="https://yandex.ru/maps/213/moscow/?utm_medium=mapframe&utm_source=maps"
            style="color:#eee;font-size:12px;position:absolute;top:0px;">Москва</a><a
            href="https://yandex.ru/maps/geo/moskva/53000094/?ll=37.621951%2C55.752564&utm_medium=mapframe&utm_source=maps&z=18.26"
            style="color:#eee;font-size:12px;position:absolute;top:14px;">Москва — Яндекс.Карты</a><iframe
            src="https://yandex.ru/map-widget/v1/-/CCUyrVvv3D" width="100%" height="505" frameborder="0"
            allowfullscreen="true" style="position:relative;"></iframe></div>
</section>-->