<?php
require 'bootstrap.php';
$title = "My acount";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";

if(empty($userDetails)) {
    die(header("Location: " . SITE_URL . "index.php"));
}

?>


<?php
$email = isset($_POST['email']) ? $_POST['email'] : $userDetails['email'];
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : $userDetails['firstname'];
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : $userDetails['lastname'];

if (isset($_POST['registerButton'])) {
    $hasErrors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50) {
        $hasErrors['email'] = true;
    }

    if (strlen($firstName) < 5 || strlen($firstName) > 30) {
        $hasErrors['firstName'] = true;
    }

    if (strlen($lastName) < 5 || strlen($lastName) > 30) {
        $hasErrors['lastName'] = true;
    }

    if (!empty($password) || !empty($confirmPassword)) {
        if (strlen($password) <= 5) {
            $hasErrors['password'] = true;
        }

        if ($confirmPassword !== $password) {
            $hasErrors['confirmPassword'] = true;
            $hasErrors['password'] = true;
        }
    }

    if (!isset($hasErrors['email']) && $email != $userDetails['email']) {
        $usersWithEmail = getUsersByEmail($email);
        
        if (!empty($usersWithEmail)) {
            $hasErrors['email'] = true;
        }
    }

    if (empty($hasErrors)) {
        $updateUser = updateUserDetails($userDetails['id'], $firstName, $lastName, $email, $password);

        if (empty($updateUser)) {
            die("Database error!");
        }
    }
}
?>
<section class="login articles-area blog-area">
    <div class="container">
        <div class="row">
            <div class="col-8 login-background">
                <div class="leave-comment-area">
                    <h4 class="title"><b class="light-color">My account</b></h4>
                    <div class="leave-comment">
                        <?php if (isset($_POST["registerButton"]) && sizeof($hasErrors) === 0): ?>
                            <div class="alert alert-success">Congratulation!</div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="row">
                                <div class="col-12 <?php echo isset($hasErrors["email"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="email" type="text" placeholder="Email" value="<?php echo $email; ?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["firstName"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="firstName" type="text" placeholder="First Name" value="<?php echo $firstName; ?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["lastName"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="lastName" type="text" placeholder="Last Name" value="<?php echo $lastName; ?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["password"]) ? 'has-error' : ""; ?>">
                                    <input class="email-input input-background" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["confirmPassword"]) ? 'has-error' : ""; ?>">
                                    <input class="email-input input-background" name="confirmPassword" type="password" placeholder="Confirm password">
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-2 login-btn" name="registerButton"><b>Update</b></button>
                                </div>
                            </div><!-- row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php include ROOT_PATH . "templates/footer.php"; ?>
