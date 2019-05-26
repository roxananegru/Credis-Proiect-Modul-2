<?php 
require 'bootstrap.php';
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
include ROOT_PATH . "templates/carousel.php"
?>

<section class="section blog-area">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="blog-posts">
                       
                    <?php $articles = getLastPosts(2, 2);?>
                    
                    <?php foreach($articles as $article):?>
                        <div class="single-post">
                            <div class="image-wrapper"><img src="<?= getAssetsUrl('images/'.$article['thumbnail']); ?>" alt="Blog Image"></div>
                            <div class="icons">
                                <div class="left-area">
                                    <a class="btn caegory-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><b><?= $article['category']; ?></b></a>
                                </div>
                                <ul class="right-area social-icons">
                                    <li><i class="ion-android-textsms"></i> Created by <b><?= $article['author'];?></b></li>
                                </ul>
                            </div>
                            <p class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?><?= $article['title']; ?></em></p>
                            <h3 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b class="light-color">This is post about travel, adventure and fun</b></a></h3>
                            <p><?= substr($article['content'], 0, 299)."..."; ?></p>
                            <a class="btn read-more-btn" href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b>READ MORE</b></a>
                        </div><!-- single-post -->
                    <?php endforeach;?>
                        
                    <?php $articles = getLastPosts(4, 4);?>
                        
                    <div class="row">
                        <?php foreach($articles as $article):?>
                            <div class="col-lg-6 col-md-12">
                                <div class="single-post">
                                    <div class="image-wrapper"><img src="<?= getAssetsUrl('images/'.$article['thumbnail']); ?>" alt="Blog Image"></div>
                                    <div class="icons">
                                        <div class="left-area">
                                            <a class="btn caegory-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><b><?= $article['category']; ?></b></a>
                                        </div>
                                        <ul class="right-area social-icons">
                                            <li><i class="ion-android-textsms"></i> Created by <b><?= $article['author'];?></b></li>
                                        </ul>
                                    </div>
                                    <h6 class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?></em></h6>
                                    <h3 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b class="light-color"><?= $article['title']; ?></b></a></h3>
                                    <p><?= substr($article['content'], 0, 299)."..."; ?></p>
                                    <a class="btn read-more-btn" href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b>READ MORE</b></a>
                                </div><!-- single-post -->
                            </div><!-- col-sm-6 -->
                        <?php endforeach;?>
                           
                        <?php if(!empty(($articles = getLastPosts(1, 8))[0])):?>
                            <?php $lastHomepageArticle = $articles[0];?>
                            <div class="col-lg-12 col-md-12">
                                <div class="single-post post-style-2">
                                    <div class="image-wrapper width-50 left-area">
                                        <img src="<?= getAssetsUrl('images/'.$lastHomepageArticle['thumbnail']); ?>" alt="Blog Image"></div>
                                    <div class="post-details width-50 right-area">
                                        <div class="icons">
                                            <div class="left-area">
                                                <a class="btn caegory-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><b><?= $lastHomepageArticle['category']; ?></b></a>
                                            </div>
                                            <ul class="right-area social-icons">
                                                <li><i class="ion-android-textsms"></i> Created by <b><?= $article['author'];?></b></li>
                                            </ul>
                                        </div>
                                        <h6 class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?></em></h6>
                                        <h3 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $lastHomepageArticle['id']?>"><b class="light-color"><?= $lastHomepageArticle['title']; ?></b></a></h3>
                                        <p><?= substr($lastHomepageArticle['content'], 0, 299)."..."; ?></p>
                                        <a class="btn read-more-btn" href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $lastHomepageArticle['id']?>"><b>READ MORE</b></a>
                                    </div><!-- post-details -->
                                </div><!-- single-post -->
                            </div><!-- col-sm-6 -->
                        <?php endif;?>
                    </div><!-- row -->
                </div><!-- blog-possts -->
            </div><!-- col-lg-4 -->

            <?php include ROOT_PATH . "templates/sidebar.php"; ?>


        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->

<?php include ROOT_PATH . "templates/footer.php"; ?>