<?php
require 'bootstrap.php';
$title = "Add post";
$userDetails = getAdminDetailsAndRestrictAccess();
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>


<?php
$postTitle = isset($_POST['postTitle']) ? $_POST['postTitle'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$thumbnail = isset($_FILES['thumbnail']) ? $_FILES['thumbnail'] : '';

if (isset($_POST['addPostButton'])) {
    $hasErrors = [];

    if (strlen($postTitle) <= 10) {
        $hasErrors['postTitle'] = true;
    }

    if (strlen($content) <= 10) {
        $hasErrors['content'] = true;
    }

    if (strlen($category) <= 2) {
        $hasErrors['category'] = true;
    }
    
    if(empty($thumbnail)) {
        $hasErrors['thumbnail'] = true;
    }
    
    if(empty($hasErrors)) {
        $uploadFolder = "assets/images/";
        $fileName = basename($_FILES["thumbnail"]["name"]);
        
        if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadFolder . $fileName)) {
            $connection = getDataBaseConnection();

            $post = addPost($postTitle, $content, $category, $fileName, $userDetails['id'], $connection);

            if(empty($post)) {
                die("Database error!");
            }
            
            die(header("Location: /singlepost?id=" . mysqli_insert_id($connection)));
        } else {
           $hasErrors['thumbnail'] = true;
        }
    }
}
?>


<section class="login articles-area blog-area">
    <div class="container">
        <div class="row">
            <div class="col-8 login-background">
                <div class="leave-comment-area">
                    <div class="leave-comment">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 <?php echo isset($hasErrors["postTitle"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="postTitle" type="text" placeholder="Enter title" value="<?= $postTitle;?>" >
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["category"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="category" type="text" placeholder="Enter category" value="<?= $category;?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["content"]) ? 'has-error' : ""; ?>">
                                    <textarea class="email-input input-background" name="content" type="text" placeholder="Enter content" rows="10"><?= $content;?></textarea>
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["thumbnail"]) ? 'has-error' : ""; ?>">
                                    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail">
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-2 login-btn" name="addPostButton"><b>Add Post</b></button>
                                </div>
                            </div><!-- row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>