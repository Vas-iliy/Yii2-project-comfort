<?if(!empty($states)):?>
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
