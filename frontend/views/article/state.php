<?if(!empty($page)):?>
<section class="point">
    <div class="wrap">
        <div class="point-block">
            <div class="point-block__item">
            <span class="title"><?=$page->title_recommendation ? $page->title_recommendation : ''?></span>
            <div class="text">
                <?=$page->content?>
            </div>
        </div>
    </div>
</section>
<?endif;?>