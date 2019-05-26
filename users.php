<?php
require 'bootstrap.php';
$title = "Admin Users";
$userDetails = getAdminDetailsAndRestrictAccess();
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";

$users = getWebsiteUsers();
?>

<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="title"><b>Website users</b></h5><br>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Firstname</th>
                      <th scope="col">Lastname</th>
                      <th scope="col">Email</th>
                      <th scope="col">Newsletter Subscription</th>
                      <th scope="col">Role</th>
                      <th scope="col">Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($users as $key => $user):?>
                        <tr>
                          <th scope="row"><?= $key + 1?></th>
                          <td><?= $user['firstname'];?></td>
                          <td><?= $user['lastname'];?></td>
                          <td><?= $user['email'];?></td>
                          <td><?= !empty($user['newsletter_subscription']) ? 'True' : 'False';?></td>
                          <td><?= !empty($user['is_admin']) ? 'Admin' : 'Member';?></td>
                          <td><?= date('d.m.Y H:i', strtotime($user['created_at']));?></td>
                        </tr>
                      <?php endforeach;?>
                  </tbody>
                </table>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- section -->