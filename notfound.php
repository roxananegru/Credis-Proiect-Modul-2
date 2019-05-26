<?php
require 'bootstrap.php';
$title = "Not found";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>

<section class="notFound">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-secondary">
                    <h1>Oops!</h1>
                    <h4>404 - PAGE NOT FOUND</h4>
                    <p>The page you are looking for might have been removed had its bane changed or is temporarily unavailable.</p>
                    <a class="btn btn-secondary" href="<?= SITE_URL; ?>">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include ROOT_PATH . "templates/footer.php"; ?>
