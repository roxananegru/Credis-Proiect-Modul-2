
<?php
require 'bootstrap.php';
$title = "Articles";
ROOT_PATH . include "templates/header.php";
ROOT_PATH . include "templates/menu.php";

$category = !empty($_GET['category']) ? $_GET['category'] : null;
$search = !empty($_GET['search']) ? $_GET['search'] : null;
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;

$offset = ($page - 1) * POSTS_PER_PAGE;
$articles = getLastPosts(POSTS_PER_PAGE, $offset, $category, $search);

if (!empty($category) && empty($articles)) {
    die(header("Location: /notfound.php"));
}
?>


<section class="section blog-area articles-area">
    <div class="container">
        <div class="row">
            <div class="row">
                <?php if (!empty($search)): ?>
                    <div class="col-12">
                        <div class="sidebar-section newsletter-area search-area">
                            <h5 class="title">You are looking for <b><?= $search; ?></b>.</h5>
                        </div>
                    </div>
                <?php endif; ?>
                <?php foreach ($articles as $article): ?> 
                    <div class="col-lg-6 col-md-12 article-margin">
                        <div class="single-post">
                            <div class="image-wrapper"><img src="<?= getAssetsUrl('images/' . $article['thumbnail']); ?>" alt="Blog Image"></div>

                            <div class="icons">
                                <div class="left-area">
                                    <a class="btn caegory-btn" href="<?php echo SITE_URL; ?>articles.php?category=<?= $article['category'] ?>"><b><?= $article['category']; ?></b></a>
                                </div>
                                <ul class="right-area social-icons">
                                    <li><i class="ion-android-textsms"></i> Created by <b><?= $article['author']; ?></b></li>
                                </ul>
                            </div>
                            <h6 class="date"><em><?php date("l, F d, Y", strtotime($article['created_at'])); ?></em></h6>
                            <h3 class="title"><a href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id'] ?>"><b class="light-color"><?= $article['title']; ?></b></a></h3>
                            <p><?= substr($article['content'], 0, 299) . "..."; ?></p>
                            <a class="btn read-more-btn" href="<?php echo SITE_URL; ?>singlepost.php?id= <?= $article['id'] ?>"><b>READ MORE</b></a>
                        </div><!-- single-post -->
                    </div><!-- col-sm-6 -->
                <?php endforeach; ?>
            </div><!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- pagination -->
                    <div>
                        <?php if (!empty($total = $_SESSION['articles_total'])): ?>
                            <?php $total = ceil($total / POSTS_PER_PAGE); ?>
                            <nav class="container">
                                <ul class="pagination">
                                    <li class="page-item <?= $page === 1 ? 'disabled' : ''; ?>">
                                        <a class="page-link custom-pag" href="<?php echo SITE_URL . "articles.php?page=" . ($page - 1); ?>">Previous</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $total; $i++): ?>
                                        <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link custom-pag" href="<?php echo SITE_URL . "articles.php?page=$i"; ?>"><?= $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?= $page == $total ? 'disabled' : ''; ?>">
                                        <a class="page-link custom-pag" href="<?php echo SITE_URL . "articles.php?page=" . ($page + 1); ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    </div>
                    <!-- end of pagination -->
                </div>

            </div>

        </div>
    </div>
</div>
</section>



<?php include ROOT_PATH . "templates/footer.php"; ?>