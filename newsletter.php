<?php
require 'bootstrap.php';
$title = "Newsletter";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>


<?php
    // validate newsletter form
    $email = !empty($_GET['email']) ? $_GET['email'] : "";
    
    if(!empty($email)) {
        $newsletterSubscriptionSuccess = false;
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            subscribeToNewsletter($email);
            $newsletterSubscriptionSuccess = true;
        }
    }

?>

<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-8 col-12">
                        <div class="sidebar-section newsletter-area">
                            <h5 class="title"><b>Subscribe to our newsletter</b></h5>
                            <?php if(isset($newsletterSubscriptionSuccess)):?>
                                <?php if($newsletterSubscriptionSuccess === false):?>
                                    <div class="alert alert-danger">Invalid email!</div>
                                <?php else: ?>
                                    <div class="alert alert-success alert-subscribe">You are now subscribed to our newsletter!</div>
                                <?php endif;?>
                            <?php endif;?>
                            <form method="GET">
                                <input class="email-input" name="email" type="text" placeholder="Your email here" value="<?= $email;?>">
                                <button class="btn btn-2" name="submitSubscribe" type="submit">SUBSCRIBE</button>
                            </form>
                        </div><!-- sidebar-section newsletter-area -->
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->

<?php include ROOT_PATH . "templates/footer.php"; ?>