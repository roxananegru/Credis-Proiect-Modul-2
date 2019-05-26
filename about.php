<?php
require 'bootstrap.php';
$title = "About";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>


<section class="blog-area">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="blog-posts">

                    <div class="single-post">
                        <div class="image-wrapper"><img src="<?= getAssetsUrl("images/blog-2-1000x600.jpg");?>" alt="Blog Image"></div>
                        <h3 class="title"><a href="<?php echo SITE_URL;?>singlepost.php"><b class="light-color">This is post about travel, adventure and fun</b></a></h3>
                        <p class="desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem.</p>

                        <p class="desc">Eerror sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            dolore magnam aliquam quaerat voluptatem.</p>

                        <h5 class="quoto"><em><i class="ion-quote"></i>Eerror sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                                consectetur, adipisci velit
                            </em></h5>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="image-wrapper"><img src="<?= getAssetsUrl("images/blog-9-600x600.jpg");?>" alt="Blog Image"></div>
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <div class="image-wrapper"><img src="<?= getAssetsUrl("images/blog-10-600x600.jpg");?>" alt="Blog Image"></div>
                            </div><!-- col-sm-6 -->
                        </div><!-- row -->


                        <p class="desc">Eerror sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            dolore magnam aliquam quaerat voluptatem.</p>

                        <div class="circular-pregress center-text">
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="circliful" data-animation="1" data-animationStep="5" data-percent="75" data-foregroundBorderWidth="3"
                                         data-backgroundBorderWidth="3" data-foregroundColor="#FFAD4D" data-backgroundColor="#ddd"
                                         data-fontColor="#222"></div>
                                    <h4><b class="light-color">Awsome</b></h4>
                                    <h6 class="pre-writing">Etium nec odio</h6>
                                </div><!-- col-sm-4 -->

                                <div class="col-sm-4">
                                    <div class="circliful" data-animation="1" data-animationStep="5" data-percent="83" data-foregroundBorderWidth="3"
                                         data-backgroundBorderWidth="3" data-foregroundColor="#FFAD4D" data-backgroundColor="#ddd"
                                         data-fontColor="#222"></div>
                                    <h4><b class="light-color">Creative</b></h4>
                                    <h6 class="pre-writing">Odio vestibum</h6>
                                </div><!-- col-sm-4 -->

                                <div class="col-sm-4">
                                    <div class="circliful" data-animation="1" data-animationStep="5" data-percent="97" data-foregroundBorderWidth="3"
                                         data-backgroundBorderWidth="3" data-foregroundColor="#FFAD4D" data-backgroundColor="#ddd"
                                         data-fontColor="#222"></div>
                                    <h4><b class="light-color">Oustsanding</b></h4>
                                    <h6 class="pre-writing">Etium nec odio</h6>
                                </div><!-- col-sm-4 -->

                            </div><!-- row -->
                        </div><!-- circular-pregress -->


                        <p class="desc">Eerror sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            dolore magnam aliquam quaerat voluptatem.</p>


                        <div class="embed-video" data-source="youtube"
                             data-video-url="https://www.youtube.com/watch?v=C-Q7GeQG6iE"></div>

                    </div><!-- single-post -->

                    <div class="recomend-area">
                        <h4 class="title"><b class="light-color">My recommendation</b></h4>
                        <?php $articles = getLastPosts(2);?>
                        <div class="row">
                            <?php foreach($articles as $article):?>
                                <div class="col-md-6">
                                    <div class="recomend">
                                        <div class="post-image"><img src="<?= getAssetsUrl('images/'.$article['thumbnail']); ?>" alt="Post Image"></div>

                                        <div class="post-info">
                                            <a class="btn category-btn" href=<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>><?= $article['category']; ?></a>
                                            <h5 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b class="light-color"><?= $article['title']; ?></b></a></h5>
                                            <h6 class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?></em></h6>
                                            <p><?= substr($article['content'], 0, 35)."..."; ?></p>
                                        </div><!-- post-info -->
                                    </div><!-- recomend -->
                                </div><!-- col-md-6 -->
                            <?php endforeach;?>
                        </div><!-- row -->
                    </div><!-- recomend-area -->
                </div><!-- blog-posts -->
            </div><!-- col-lg-4 -->
            <?php include ROOT_PATH . "templates/sidebar.php"; ?>
        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->

<?php include ROOT_PATH . "templates/footer.php"; ?>