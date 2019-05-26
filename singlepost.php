<?php
require 'bootstrap.php';
$title = "Single post";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";

if(empty($id = intval($_GET['id'])) || !is_int($id)) {
    die(header("Location: /notfound.php"));
}

$article = getArticle($id);

if(empty($article)) {
    die(header("Location: /notfound.php"));
}
?>

<section class="blog-area">
    <div class="container">
        <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-posts">
                        <div class="single-post">
                            <div class="image-wrapper"><img src="<?= getAssetsUrl('images/' . $article['thumbnail']); ?>" alt="Blog Image"></div>

                            <div class="icons">
                                <div class="left-area">
                                    <a class="btn caegory-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><b><?= $article['category']; ?></b></a>
                                </div>
                                <ul class="right-area social-icons">
                                    <li><i class="ion-android-textsms"></i> Created by <b><?= $article['author'];?></b></li>
                                </ul>
                            </div>
                            <p class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?></em></p>
                            <h3 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b class="light-color"><?= $article['title']; ?></b></a></h3>
                            <p class="desc"><?= $article['content']; ?></p>
                        </div><!-- single-post -->

                    <div class="post-author">
                        <div class="author-image"><img src="<?= getAssetsUrl("images/author-1-200x200.jpg");?>" alt="Autohr Image"></div>

                        <div class="author-info">
                            <h4 class="name"><b class="light-color">Cristnne Smith</b></h4>

                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                dolore magnam aliquam quaerat voluptatem.</p>

                            <ul class="social-icons">
                                <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                            </ul><!-- right-area -->

                        </div><!-- author-info -->
                    </div><!-- post-author -->
                </div><!-- blog-posts -->
            </div><!-- col-lg-4 -->

            <?php include ROOT_PATH . "templates/sidebar.php"; ?>

        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->

<?php include ROOT_PATH . "templates/footer.php"; ?>