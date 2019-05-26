<?php
    $articles = getLastPosts(2);
?>
<div class="main-slider">
    <div id="slider">
        <?php foreach($articles as $article):?>
            <div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:4000; transition2d:104; kenburnsscale:1.00;">
                <img src="<?= getAssetsUrl('images/'.$article['thumbnail']); ?>" class="ls-bg" alt="" />
                <div class="slider-content ls-l" style="top:60%; left:30%;" data-ls="offsetyin:100%; offsetxout:-50%; durationin:800; delayin:100; durationout:400; parallaxlevel:0;">
                    <a class="btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><?= $article['category'];?></a>
                    <h3 class="title"><b><?= $article['title'];?></b></h3>
                    <h6><?= date('d F, Y', strtotime($article['created_at']));?></h6>
                </div>
            </div><!-- ls-slide -->
        <?php endforeach;?>
    </div><!-- slider -->
</div><!-- main-slider -->