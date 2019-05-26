<?php
require 'bootstrap.php';
$title = "Contact";
ROOT_PATH . include "templates/header.php";
ROOT_PATH . include "templates/menu.php";
?>


<?php
$userDetails = getUserDetails();
//validare formular
$name = isset($_POST['name']) ? $_POST['name'] : (!empty($userDetails['name']) ? $userDetails['name'] : "");
$email = isset($_POST['email']) ? $_POST['email'] : (!empty($userDetails['email']) ? $userDetails['email'] : "");
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';



if (isset($_POST['submitButton'])) {
    $hasErrors = [];

    //validare nume
    if (strlen($name) < 5) {
        $hasErrors['name'] = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hasErrors['email'] = true;
    }

    if (strlen($subject) < 5) {
        $hasErrors['subject'] = true;
    }

    if (strlen($text) < 10) {
        $hasErrors['text'] = true;
    }
    if (sizeof($hasErrors) === 0) {
        sendContactForm($name, $email, $subject, $text);
    }
}
?>

<section class="blog-area">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="blog-posts">

                    <div class="single-post">
                        <div class="image-wrapper"><img src="<?= getAssetsUrl("images/blog-8-1000x600.jpg");?>" alt="Blog Image"></div>

                        <h3 class="title"><b class="light-color">Contact me</b></h3>
                        <p class="desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem.</p>

                    </div><!-- single-post -->

                    <div class="leave-comment-area">

                        <div class="leave-comment">
                            <?php if (isset($_POST["submitButton"]) && sizeof($hasErrors) === 0): ?>
                                <div class="alert alert-success">Congratulation!</div>
                            <?php endif;?>
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-sm-6 <?php echo isset($hasErrors["name"]) ? 'has-error' : ""; ?>">
                                        <input class="name-input" name="name" type="text" placeholder="Name" value="<?php echo $name; ?>">
                                    </div>
                                    <div class="col-sm-6  <?php echo isset($hasErrors["email"]) ? 'has-error' : ""; ?>">

                                        <input class="email-input" name="email" type="text" placeholder="Email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="col-sm-12 <?php echo isset($hasErrors["subject"]) ? 'has-error' : ""; ?>">
                                        <input class="subject-input" name="subject" type="text" placeholder="Subject" value="<?php echo $subject; ?>">
                                    </div>
                                    <div class="col-sm-12 <?php echo isset($hasErrors["text"]) ? 'has-error' : ""; ?>">
                                        <textarea class="message-input" name="text" rows="6" placeholder="Message"><?php echo $text; ?></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-2" name="submitButton"><b>Submit</b></button>
                                    </div>

                                </div><!-- row -->
                            </form>
                        </div><!-- leave-comment -->
                    </div><!-- comments-area -->
                </div><!-- blog-posts -->
            </div><!-- col-lg-4 -->
            <?php include ROOT_PATH . "templates/sidebar.php"; ?>
        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->
<?php include ROOT_PATH . "templates/footer.php"; ?>