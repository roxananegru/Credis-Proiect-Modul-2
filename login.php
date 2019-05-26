<?php
require 'bootstrap.php';
// define page variables 
$title = "Login";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>

<?php
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$emailRegister = $_GET["email"] ?? "";
$rememberMe = isset($_POST['remember_me']) ?? false;

if (isset($_POST['submit'])) {
    $hasErrors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hasErrors['email'] = true;
    }

    if (strlen($password) <= 5) {
        $hasErrors['password'] = true;
    }
    if (sizeof($hasErrors) === 0) {
        $user = getUserByEmailAndPassword($email, $password);

        if (!empty($user)) {
            $_SESSION['user_id'] = $user['id'];
            if (!empty($rememberMe)) {
                setcookie("user_id", $user['id'], time() + 3600 * 24);
            }
            die(header("Location: " . SITE_URL . "index.php"));
        } else {
            $hasErrors['email'] = true;
            $hasErrors['password'] = true;
        }
    }
}
?>

<section class="login articles-area blog-area">
    <div class="container">
        <div class="row">
            <div class="col-8 login-background">
                <div class="leave-comment-area">
                    <h4 class="title"><b class="light-color">Login</b></h4>
                    <div class="leave-comment">
                        <form method="post">
                            <div class="row">
                                <div class="container">
                                <?php if (!empty($emailRegister)): ?>
                                    <div class="alert alert-success">Your account has been created, you can now login!</div>
                                <?php endif; ?>
                                <div class="col-12 <?php echo isset($hasErrors["email"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="email" value="<?= !empty($email) ? $email : $emailRegister; ?>" type="text" placeholder="Email" >
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["password"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="col-12 forgot-pass">
                                    <input type="checkbox" class="remember-me" id="remember-me" name="remember_me" />
                                    <label class="remember-me-label" for="remember-me">Remember Me</label>
                                    <p><a href="register.php">Don`t have an account? Register now!</a></p>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-2 login-btn" name="submit"><b>Login</b></button>
                                </div>
                            </div><!-- row -->
                            </div>
                        </form>
                    </div><!-- leave-comment -->
                </div>
            </div>
        </div>
</section>

<?php include ROOT_PATH . "templates/footer.php"; ?>

