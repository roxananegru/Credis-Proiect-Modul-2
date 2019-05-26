<?php
$userDetails = getUserDetails();
$menuItems = getMenu();
?>
<div class="bottom-area">
    <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

    <ul class="main-menu visible-on-click" id="main-menu">
        <?php foreach($menuItems as $menuItem): ?> 
            <?php if($menuItem['name'] === "login" && !empty($userDetails)) continue;?>
            <li class="<?= $menuItem['link'] === basename($_SERVER['PHP_SELF']) ? 'active' : '' ?>"><a href="<?= SITE_URL.$menuItem['link'];?>"><?= strtoupper($menuItem['name']); ?></a></li>
        <?php endforeach; ?>
            
        <?php if(isUserAdmin()):?>
            <li class="<?= basename($_SERVER['PHP_SELF']) === 'admin.php' ? 'active' : '' ?>"><a href="<?= SITE_URL.'admin.php';?>">ADMIN</a></li>
        <?php endif;?>
            
        <?php if(!empty($userDetails)):?>
            <li class="<?= basename($_SERVER['PHP_SELF']) === 'myaccount.php' ? 'active' : '' ?>"><a href="<?= SITE_URL.'myaccount.php';?>">MY ACCOUNT</a></li>
            <li><a href="<?= SITE_URL.'logout.php';?>" name="logout">LOGOUT</a></li>
        <?php endif;?>
    </ul><!-- main-menu -->
</div><!-- conatiner -->
</header>