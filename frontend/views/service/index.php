<? use yii\helpers\Html;

if(!empty($services)):?>
<div class="trim">
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
        </div>
    </div>
</div>
<?endif;?>
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
<section class="example">
    <div class="wrap">
        <div class="example-block">
            <span class="example-block__title">Примеры работ : </span>
            <div class="example-block__images">
                <div class="example-block__image">
                    <img src="img/blocks/example/example-image1.png" alt="">
                </div>
                <div class="example-block__image">
                    <img src="img/blocks/example/example-image2.png" alt="">
                </div>
                <div class="example-block__image">
                    <img src="img/blocks/example/example-image3.png" alt="">
                </div>
                <div class="example-block__image">
                    <img src="img/blocks/example/example-image4.png" alt="">
                </div>
                <div class="example-block__image">
                    <img src="img/blocks/example/example-image5.png" alt="">
                </div>
            </div>
            <p class="text">
                Приглашайте для отделки любых домов под ключ опытных специалистов компании &laquo;Артикомфорт&raquo;.<br>
                Все работы в&nbsp;домах под ключ нашими профессионалами осуществляются строго в&nbsp;соответствии
                с&nbsp;пожеланиями
                владельцев недвижимости. При отделке используются лучшие современные материалы, что позволяет нам
                гарантировать длительный срок службы строительного объекта.
            </p>
        </div>
    </div>
</section>
<section class="house">
    <div class="wrap">
        <div class="house-block">
            <span class="title">Внешняя отделка <span class="color-text"> деревянных домов</span></span>
            <p class="text">Шлифовка, покраска и конопатка стен деревянного дома традиционно выполняются после основной
                усадки стен сруба, и перед началом отделочных работ. Чтобы профессионально осуществить конопатку сруба и
                шлифовку – требуется опыт, время и силы, поскольку все эти виды отделочных работ являются трудоемкими.</p>
            <span class="house-block__title">КОНОПАТКА</span>
            <p class="text">После того, как Ваш дом из бревна построен, он должен отстояться от 6 месяцев до года.<br>
                За это время между бревнами в результате их деформации возникнут щели.<br>
                Поэтому, всегда дом из оцилиндрованного бревна или бревна ручной рубки конопатят два раза в год: первый -
                конопатка дома проводится при монтаже бревен.<br>
                Волокнистый материал укладывается непосредственно между венцами, затем после возведения строения, вбивается
                в межвенцовые швы, второй – через год-полтора, когда уже произошла еще одна, так называемая, окончательная
                усадка дома.<br>
                Такая операция способствует утеплению дома, а также улучшает его эстетический вид. Основное правило при
                правильной конопатке дома - конопатку следует выполнять с двух сторон дома: с внутренней и внешней. Также не
                следует забывать, что при проведении конопатки сруб поднимется, его высота увеличивается вплоть до 10-15 см.
                Это говорит о том, что конопатить сруб следует перед внутренней отделкой дома. Дом из бревна конопатится
                льноватином, паклей или джутовым утеплителем. Неправильно утепление может послужить причиной постоянного
                холода в доме, а также сократить срок службы.</p>
            <span class="house-block__title">Шлифовка</span>
            <p class="text">За время строительства деревянного дома под действием окружающей среды бревна теряют свою
                естественную окраску. Шлифовка позволяет восстановить цвет древесины, удалить остатки луба. При шлифовке
                проводится механическая обработка поверхностей сруба со снятием слоя древесины.</p>

            <p class="text"> Шлифовка домов и срубов в процессе эксплуатации помогает избавиться от слоя древесины,
                пораженного грибками.
                После шлифовки деревянные поверхности дома или бани пропитывают антисептиками и антипиренами для защиты от
                гниения и возгорания. Шлифованная древесина лучше впитывает пропиточные средства.</p>

            <p class="text">Ручная шлифовка применяется при обработке труднодоступных мест. Шлифовка стен дома из бруса и
                бревна
                проводится до вторичной конопатки дома. Для ускорения процесса шлифовки применяются шлифовальные машинки.
            </p>
            <span class="house-block__title">Покраска</span>
            <p class="text">Завершающий этап - окраска стен деревянного дома является менее трудоемким процессом, но это
                совсем не означает, что относится к нему надо с ненадлежащим вниманием. Главное, что следует помнить при
                окраске дома, это то,что наносить краску надо в несколько слоев, в зависимости от рекомендаций
                производителя:</p>

            <p class="text">Первый слой (подготовительный) - наносится грунт или грунт - антисептик.</p>

            <p class="text">Следующий слой (основной) - используем лазурь с добавлением соответствующего Вашим пожеланиям
                пигмента.
                Наносится 2 - 3 слоя.</p>

            <p class="text">Своевременно и правильно проведенная конопатка, шлифовка, защита и окраска древесины позволят
                вашему дому
                многие годы радовать вас красотой и комфортом.</p>
        </div>
    </div>
</section>
<section class="roof">
    <div class="wrap">
        <div class="roof-block">
            <span class="title">Кровельные <span class="color-text"> работы</span></span>
            <p class="text">То, как выглядит дом внешне, является своего рода визитной карточкой владельца. При этом,
                каким бы креативным и красивым ни был фасад, невозможно представить его без крыши. Кровельные работы,
                которые качественно проводят, обеспечивают надежную защиту дома от погодных проявлений на долгие годы.
            </p>
            <p class="text">Что подразумевается под качеством кровельных работ? Идеальное покрытие, которое обеспечивает
                тепло и
                гидроизоляцию. Профессиональные сотрудники компании «Артикомфорт» подскажут подходящие решения для крыши
                вашего дома. Стоимость кровельных работ определяется в зависимости от сложности, размеров и необходимых
                материалов.
            </p>
            <div class="roof-block__image">
                <img src="img/blocks/roof/roof-image1.png" alt="">
            </div>
            <div class="roof-block__items">
                <div class="roof-block__content">
                    <span class="roof-block__title">Что входит в услугу?</span>
                    <p class="text">Качественное покрытие крыши&nbsp;&mdash; это важный этап при строительстве дома
                        и&nbsp;неважно, какое у
                        него будет предназначение. Защита дома и&nbsp;комфорт нахождения в&nbsp;нём полностью зависит
                        от&nbsp;наличия кровли.
                        Разделяют несколько видов кровли: скатная и&nbsp;плоская. Надёжность кровли определяется качеством
                        применяемых материалов, и&nbsp;правильными расчетами. Также, важно, чтобы соблюдалась технология
                        укладки,
                        именно поэтому монтаж кровли следует доверять только профессионалам.</p>
                    <div class="trim-block__points rf">
                        <ul>
                            <li class="trim-block__title">Проектирование со всеми расчетами.</li>
                            <li class="trim-block__title">Приобретение необходимых материалов.</li>
                            <li class="trim-block__title">Монтаж несущих элементов конструкции.</li>
                            <li class="trim-block__title">Установка элементов защиты.</li>
                            <li class="trim-block__title">Укладка утеплителя, гидроизоляционных материалов.</li>
                            <li class="trim-block__title">Монтаж непосредственно кровельного материала.</li>
                        </ul>
                    </div>

                    <p class="text">Мы выполняем монтажные и демонтажные работы с соблюдением всех
                        технических норм. Гарантируем качество выполненных работ и соответствие указанным срокам.</p>
                    <span class="roof-block__title mar">Какие виды кровли ?</span>
                    <p class="text"> Наша команда предоставляет услуги по монтажу нескольких видов кровли,
                        а именно:</p>
                    <div class="trim-block__points m25">
                        <ul>
                            <li class="trim-block__title">Мягкая</li>
                            <li class="trim-block__title">Фальцевая </li>
                            <li class="trim-block__title">Металлочерепичная</li>
                            <li class="trim-block__title">Черепичная</li>
                        </ul>
                    </div>
                    <p class="text">Кровельные работы в Москве и МО по доступной цене – это к нам. Мы знаем, как сэкономить
                        Ваш
                        бюджет и сделать качественную кровлю. Оговаривается каждый отдельный этап проведения работ, всё
                        согласовывается и только после этого приступают к началу монтажа.</p>
                </div>
                <div class="roof-block__images">
                    <img src="img/blocks/roof/roof-image1.png" alt="">
                    <img src="img/blocks/roof/roof-image2.png" alt="">
                    <img src="img/blocks/roof/roof-image3.png" alt="">
                    <img src="img/blocks/roof/roof-image4.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>