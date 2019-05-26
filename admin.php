<?php
require 'bootstrap.php';
$title = "Admin";
$userDetails = getAdminDetailsAndRestrictAccess();
include ROOT_PATH ."templates/header.php";
include ROOT_PATH ."templates/menu.php";
?>

<section class="section blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 hello-admin">
                <h3>Hello, <?= $userDetails['name']; ?>!</h3>
                <a href="<?= SITE_URL;?>addpost.php" class="btn btn-secondary">Add post</a>
                <a href="<?= SITE_URL;?>users.php" class="btn btn-secondary">Show users</a>
            </div>
        </div>
    </div>
</section>

<?php include ROOT_PATH . "templates/footer.php"; ?>