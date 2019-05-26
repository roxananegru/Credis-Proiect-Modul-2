<?php
require 'bootstrap.php';
$title = "Register";
include ROOT_PATH . "templates/header.php";
include ROOT_PATH . "templates/menu.php";
?>

<?php
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$newsletterSubscription = !empty($_POST['newsletter']) ? $_POST['newsletter'] : 0;

if (isset($_POST['registerButton'])) {
    $hasErrors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50) {
        $hasErrors['email'] = true;
    }

    if (strlen($password) <= 5) {
        $hasErrors['password'] = true;
    }

    if ($confirmPassword !== $password) {
        $hasErrors['confirmPassword'] = true;
        $hasErrors['password'] = true;
    }

    if (strlen($firstName) < 5 || strlen($firstName) > 30) {
        $hasErrors['firstName'] = true;
    }

    if (strlen($lastName) < 5 || strlen($lastName) > 30) {
        $hasErrors['lastName'] = true;
    }


    if (isset($_POST["terms"]) == false) {
        $hasErrors["terms"] = true;
    }

    if (!isset($hasErrors['email'])) {
        $usersWithEmail = getUsersByEmail($email);

        if (!empty($usersWithEmail)) {
            $hasErrors['email'] = true;
        }
    }
    //redirect login
    if (sizeof($hasErrors) === 0) {
        registerUser($firstName, $lastName, $email, $password, $newsletterSubscription);
        die(header("Location:  " . SITE_URL . "login.php?email=$email"));
    }
}
?>

<section class="login articles-area blog-area">
    <div class="container">
        <div class="row">
            <div class="col-8 login-background">
                <div class="leave-comment-area">
                    <h4 class="title"><b class="light-color">Register</b></h4>
                    <div class="leave-comment">
                        <?php if (isset($_POST["registerButton"]) && sizeof($hasErrors) === 0): ?>
                            <div class="alert alert-success">Congratulation!</div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="row">
                                <div class="col-12 <?php echo isset($hasErrors["email"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="email" type="text" placeholder="Email" value="<?php echo $email; ?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["password"]) ? 'has-error' : ""; ?>">
                                    <input class="email-input input-background" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["confirmPassword"]) ? 'has-error' : ""; ?>">
                                    <input class="email-input input-background" name="confirmPassword" type="password" placeholder="Confirm password">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["firstName"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="firstName" type="text" placeholder="First Name" value="<?php echo $firstName; ?>">
                                </div>
                                <div class="col-12 <?php echo isset($hasErrors["lastName"]) ? 'has-error' : ""; ?>">
                                    <input class="name-input input-background" name="lastName" type="text" placeholder="Last Name" value="<?php echo $lastName; ?>">
                                </div>
                                <div class="col-12 newsletter">
                                    <p><strong>Email Newsletter Subscription:</strong></p>
                                    <input id="btn-yes" type="radio" name="newsletter" value="1">
                                    <label for="btn-yes">Yes</label>
                                    <input id="btn-no" type="radio" name="newsletter" value="0" checked>
                                    <label for="btn-no">No, thanks</label>
                                </div>
                                <div class="col-12 newsletter <?php echo isset($hasErrors["terms"]) ? 'has-error' : ""; ?>">
                                    <input type="checkbox" id="terms" name="terms">
                                    <label for="terms">I agree to Terms of Services</label>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-2 login-btn" name="registerButton"><b>Register</b></button>
                                </div>
                            </div><!-- row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php include ROOT_PATH . "templates/footer.php"; ?>

