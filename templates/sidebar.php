<?php $categories = getAllCategories();?>

<div class="col-lg-4 col-md-12">
    <div class="sidebar-area">

        <div class="sidebar-section about-author center-text">
            <div class="author-image"><img src="<?= getAssetsUrl("images/author-1-200x200.jpg");?>" alt="Autohr Image"></div>

            <ul class="social-icons">
                <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
            </ul><!-- right-area -->

            <h4 class="author-name"><b class="light-color">Cristine Smith</b></h4>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                dolore magnam aliquam quaerat voluptatem.</p>

            <div class="signature-image"><img src="<?= getAssetsUrl("images/signature-image.png");?>" alt="Signature Image"></div>
            <a class="read-more-link" href="<?php echo SITE_URL;?>about.php"><b>READ MORE</b></a>

        </div><!-- sidebar-section about-author -->

        <div class="sidebar-section src-area">

            <form action="<?= SITE_URL;?>articles.php" method="GET">
                <input class="src-input" type="text" placeholder="Search" name="search">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
            </form>

        </div><!-- sidebar-section src-area -->

        <div class="sidebar-section newsletter-area">
            <h5 class="title"><b>Subscribe to our newsletter</b></h5>
            <form method="get" action="<?= SITE_URL;?>newsletter.php">
                <input class="email-input" type="text" name="email" value="<?= !empty($userDetails['email']) ? $userDetails['email'] : "";?>" placeholder="Your email here">
                <button class="btn btn-2" type="submit" name="submitSubscribe">SUBSCRIBE</button>
            </form>
        </div><!-- sidebar-section newsletter-area -->

        <div class="sidebar-section category-area">
            <h4 class="title"><b class="light-color">Categories</b></h4>
            <?php if(in_array("Travel", $categories)):?>
                <a class="category" href="<?php echo SITE_URL;?>articles.php?category=travel">
                    <img src="<?= getAssetsUrl("images/category-1-400x150.jpg");?>" alt="Category Image">
                    <h6 class="name">TRAVEL</h6>
                </a>
            <?php endif;?>
            <?php if(in_array("Fashion", $categories)):?>
                <a class="category" href="<?php echo SITE_URL;?>articles.php?category=fashion">
                    <img src="<?= getAssetsUrl("images/category-2-400x150.jpg");?>" alt="Category Image">
                    <h6 class="name">FASHION</h6>
                </a>
            <?php endif;?>
            <?php if(in_array("Lifestyle", $categories)):?>
                <a class="category" href="<?php echo SITE_URL;?>articles.php?category=lifestyle">
                    <img src="<?= getAssetsUrl("images/category-3-400x150.jpg");?>" alt="Category Image">
                    <h6 class="name">LIFESTYLE</h6>
                </a>
            <?php endif;?>
            <?php if(in_array("Design", $categories)):?>
                <a class="category" href="<?php echo SITE_URL;?>articles.php?category=design">
                    <img src="<?= getAssetsUrl("images/category-4-400x150.jpg");?>" alt="Category Image">
                    <h6 class="name">DESIGN</h6>
                </a>
            <?php endif;?>
        </div><!-- sidebar-section category-area -->

        <div class="sidebar-section latest-post-area">
            <h4 class="title"><b class="light-color">Latest Posts</b></h4>
            
            <?php $articles = getLastPosts(4);?>
            
            <?php foreach($articles as $article):?>
                <div class="latest-post" href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>">
                    <div class="l-post-image"><img src="<?= getAssetsUrl('images/'.$article['thumbnail']); ?>" alt="Category Image"></div>
                    <div class="post-info">
                        <a class="btn category-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category']?>"><?= $article['category']; ?></a>
                        <h5><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id']?>"><b class="light-color"><?= $article['title']; ?></b></a></h5>
                        <h6 class="date"><em><?php date("l, F d, Y", strtotime($article['created_at']));?></em></h6>
                    </div>
                </div>
            <?php endforeach;?>
        </div><!-- sidebar-section latest-post-area -->

        <div class="sidebar-section advertisement-area">
            <h4 class="title"><b class="light-color">Advertisement</b></h4>
            <a class="advertisement-img" href="<?php echo SITE_URL;?>articles.php">
                <img src="<?= getAssetsUrl("images/advertise-1-400x500.jpg");?>" alt="Advertisement Image">
                <h6 class="btn btn-2 discover-btn">DISCOVER</h6>
            </a>
        </div><!-- sidebar-section advertisement-area -->

        <div class="sidebar-section instagram-area">
            <h4 class="title"><b class="light-color">Instagram</b></h4>
            <ul class="instagram-img">
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-1-150x150.jpg");?>" alt="Instagram Image"></a></li>
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-2-150x150.jpg");?>" alt="Instagram Image"></a></li>
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-3-150x150.jpg");?>" alt="Instagram Image"></a></li>
                <div class="clearfix"></div>
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-4-150x150.jpg");?>" alt="Instagram Image"></a></li>
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-5-150x150.jpg");?>" alt="Instagram Image"></a></li>
                <li><a href="#"><img src="<?= getAssetsUrl("images/instragram-side-6-150x150.jpg");?>" alt="Instagram Image"></a></li>
            </ul>
        </div><!-- sidebar-section instagram-area -->

        <div class="sidebar-section tags-area">
            <h4 class="title"><b class="light-color">Tags</b></h4>
            <ul class="tags">
                <?php foreach($categories as $category):?>
                    <li><a class="btn" href="<?php echo SITE_URL;?>articles.php?category=<?= $category['category'];?>"><?= $category['category'];?></a></li>
                <?php endforeach;?>
            </ul>
        </div><!-- sidebar-section tags-area -->


    </div><!-- about-author -->
</div><!-- col-lg-4 -->