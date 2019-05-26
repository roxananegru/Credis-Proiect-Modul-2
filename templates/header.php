<?php $userDetails = getUserDetails();?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title><?php echo empty($title) ? SITE_NAME : SITE_NAME . " - $title"; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        <!-- Stylesheets -->
        <link href="<?= getAssetsUrl("css/bootstrap.css");?>" rel="stylesheet">
        <link href="<?= getAssetsUrl("css/ionicons.css");?>" rel="stylesheet">
        <link href="<?= getAssetsUrl("css/layerslider.css");?>" rel="stylesheet">
        <link href="<?= getAssetsUrl("css/01-homepage/css/styles.css");?>" rel="stylesheet">
        <link href="<?= getAssetsUrl("css/01-homepage/css/responsive.css");?>" rel="stylesheet">
        <link href="<?= getAssetsUrl("css/style.css");?>" rel="stylesheet">
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo SITE_URL;?>/favicon.ico' />
        <?php if (getCurrentPage() === "contact" || getCurrentPage() === "login" || getCurrentPage() === "register"  || getCurrentPage() === "myaccount" || getCurrentPage() === "users" || getCurrentPage() === "addpost") : ?>
            <link href="<?= getAssetsUrl("css/04-Contact/css/styles.css");?>" rel="stylesheet">
            <link href="<?= getAssetsUrl("css/04-Contact/css/responsive.css");?>" rel="stylesheet">
        <?php endif; ?>

        <?php if (getCurrentPage() === "about" || getCurrentPage() === "articles" || getCurrentPage() === "newsletter" || getCurrentPage() === "users") : ?>
            <link href="<?= getAssetsUrl("css/03-About-me/css/styles.css");?>" rel="stylesheet">
            <link href="<?= getAssetsUrl("css/03-About-me/css/responsive.css");?>" rel="stylesheet">
        <?php endif; ?>
        <?php if (getCurrentPage() === "singlepost") : ?>
            <link href="<?= getAssetsUrl("css/02-Single-post/css/styles.css");?>" rel="stylesheet">
            <link href="<?= getAssetsUrl("css/02-Single-post/css/responsive.css");?>" rel="stylesheet">
        <?php endif; ?>
    </head>
    <body>
        <header>
            <div class="top-menu">
                <ul class="left-area welcome-area">
                    <li class="hello-blog">Hello <?= !empty($userDetails['name']) ? $userDetails['name'] : 'nice people';?>, welcome to my blog</li>
                    <li><a href="mailto:contact@juliblog.com">contact@juliblog.com</a></li>
                </ul><!-- left-area -->

                <div class="right-area">
                    <div class="src-area">
                        <form action="<?= SITE_URL;?>articles.php" method="GET">
                            <input class="src-input" type="text" placeholder="Search" name="search">
                            <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                        </form>
                    </div><!-- src-area -->
                    
                    <ul class="social-icons">
                        <li><a href="https://www.facebook.com/"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="https://twitter.com/?lang=ro"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="https://instagram.com/?lang=ro"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="https://pinterest.com/?lang=ro"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul><!-- right-area -->
                </div><!-- right-area -->
            </div><!-- top-menu -->
            <div class="middle-menu center-text"><a href="<?= SITE_URL;?>" class="logo"><img src="<?= getAssetsUrl("images/logo.png");?>" alt="Logo Image"></a></div>