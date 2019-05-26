<?php

function siteTitle(string $title): string {
    return $title . " | " . SITE_NAME;
}

function getCurrentPage(): string {
    return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
}

function getDataBaseConnection() {
    $connect = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
    if (!$connect) {
        die(mysqli_coonect_error());
    }
    return $connect;
}

function getAssetsUrl(string $name): string {
    return SITE_URL . 'assets/' . $name;
}

function getSiteUrl(string $url): string {
    return SITE_URL . $url;
}

function getUserDetails() {
    $userDetails = [];

    if (!empty($_SESSION['user_id']) || !empty($_COOKIE['user_id'])) {
        $userId = (int) !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
          
        $connection = getDataBaseConnection();
        
        $sql = "SELECT * FROM users WHERE  id = " . mysqli_real_escape_string($connection, $userId) ;
        $resultUser = mysqli_query($connection, $sql);
        $userDetails = $resultUser->fetch_assoc();
        if (!empty($userDetails['lastname']) && !empty($userDetails['firstname'])) {
            $userDetails['name'] = $userDetails['firstname'] . " " . $userDetails['lastname'];
        }
    }

    return $userDetails;
}

function getAdminDetailsAndRestrictAccess(): array {
    $userDetails = getUserDetails();

    if (empty($userDetails) || empty($userDetails['is_admin'])) {
        die(header("Location: " . SITE_URL . "index.php"));
    }

    return $userDetails;
}

function isUserAdmin(): bool {
    $userDetails = getUserDetails();

    if (empty($userDetails) || empty($userDetails['is_admin'])) {
        return false;
    }

    return true;
}

function getLastPosts(int $limit = 0, int $offset = 0, string $category = null, string $contentSearch = null): array {
    $connection = getDatabaseConnection();

    $sql = "SELECT SQL_CALC_FOUND_ROWS *, p.*, CONCAT(u.firstname, ' ', u.lastname) AS `author`
        FROM posts AS p
        LEFT JOIN users AS u ON p.user_id = u.id ";

    if (!empty($category)) {
        $sql .= "WHERE p.category = '" . mysqli_real_escape_string($connection, $category) . "' ";
    }

    if (!empty($contentSearch)) {
        $sql .= (!empty($category) ? "AND" : "WHERE") . " p.content LIKE '%" . mysqli_real_escape_string($connection, $contentSearch) . "%'";
    }


    $sql .= " ORDER BY p.created_at DESC ";

    if (!empty($limit)) {
        $sql .= "LIMIT " . mysqli_real_escape_string($connection, $limit) . " OFFSET " . mysqli_real_escape_string($connection, $offset) . "";
    }

    $resultArticle = mysqli_query($connection, $sql);

    $articles = $resultArticle->fetch_all(MYSQLI_ASSOC);
        
    // calculate total rows
    $sql = "SELECT FOUND_ROWS() as total;";
    $resultTotal = mysqli_query($connection, $sql);
    $_SESSION['articles_total'] = $resultTotal->fetch_assoc()['total'];

    return $articles;
}

function getAllCategories(): array {
    $sql = "SELECT category FROM posts GROUP BY category;";

    $resultCategories = mysqli_query(getDataBaseConnection(), $sql);

    return $resultCategories->fetch_all(MYSQLI_ASSOC);
}

function getWebsiteUsers(): array {
    $sql = "SELECT * FROM users;";

    $resultUsers = mysqli_query(getDataBaseConnection(), $sql);

    return $resultUsers->fetch_all(MYSQLI_ASSOC);
}

function subscribeToNewsletter(string $email): void {
    $message = "{$email} \r\n";

    $bytes_written = file_put_contents('./'.NEWSLETTER_SUBSCRIPTIONS_FILE_NAME, $message, FILE_APPEND | LOCK_EX);

    if ($bytes_written === false) {
        die("Error, no bytes written");
    }
}

function getMenu(): array {
    $sql = "SELECT * FROM menu";
    
    $menuResult = mysqli_query(getDataBaseConnection(), $sql);
    
    return $menuResult->fetch_all(MYSQLI_ASSOC);
}

function getArticle(int $id) {
    $connection = getDataBaseConnection();
    
    $sql = "SELECT p.*, CONCAT(u.firstname, ' ', u.lastname) AS `author`
    FROM posts AS p
    LEFT JOIN users AS u ON p.user_id = u.id
    WHERE p.id = ". mysqli_real_escape_string($connection, $id);

    $resultArticle = mysqli_query($connection, $sql);
    
    return $resultArticle->fetch_assoc();
}

function registerUser(string $firstName, string $lastName, string $email, string $password, int $newsletterSubscription) : void {
    $connection = getDataBaseConnection();
    //insert into database
    $password = md5(md5($password));
    $sql = "INSERT INTO users(firstname, lastname, email, password, newsletter_subscription) "
            . "VALUES ('" . mysqli_real_escape_string($connection, $firstName) . "', "
            . "'" . mysqli_real_escape_string($connection, $lastName) . "',"
            . " '" . mysqli_real_escape_string($connection, $email) . "',"
            . " '$password',"
            . " '" . mysqli_real_escape_string($connection, $newsletterSubscription) . "')";
    $result = mysqli_query($connection, $sql);

    if (empty($result)) {
        die("Database error!");
    }

    if (!empty($newsletterSubscription)) {
        subscribeToNewsletter($email);
    }
}

function getUsersByEmail(string $email) {
    $connection = getDataBaseConnection();
    $sql = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($connection, $email) . "'";
    $resultEmail = mysqli_query($connection, $sql);
    
    return $resultEmail->fetch_assoc();
}

function updateUserDetails(int $userId, string $firstName, string $lastName, string $email, $password = null) : bool {
    $connection = getDataBaseConnection();
    $sql = "UPDATE users SET `firstname` = '" . mysqli_real_escape_string($connection, $firstName) . "', "
            . "`lastname` = '" . mysqli_real_escape_string($connection, $lastName) . "', "
            . "`email` = '" . mysqli_real_escape_string($connection, $email) . "'";

    if (!empty($password)) {
        $password = md5(md5($password));
        $sql .= ", `password` = '$password'";
    }

    $sql .= " WHERE id = " . mysqli_real_escape_string($connection, $userId);
    
    return mysqli_query($connection, $sql);
}

function getUserByEmailAndPassword(string $email, string $password) {
    $connection = getDataBaseConnection();
    $password = md5(md5($password));
    $sql = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($connection, $email)."' AND password = '{$password}'";
    $resultLogin = mysqli_query($connection, $sql);
    
    return $resultLogin->fetch_assoc();
}

function addPost(string $title, string $content, string $category, string $fileName, int $userId, $connection) : bool {
    $sql = "INSERT INTO posts(title, content, user_id, category, thumbnail) "
         . "VALUES ('".mysqli_real_escape_string($connection, $title)."', "
            . "'".mysqli_real_escape_string($connection, $content)."', "
            . mysqli_real_escape_string($connection, $userId).", '".mysqli_real_escape_string($connection, $category)."', "
            . "'".mysqli_real_escape_string($connection, $fileName)."')";

    return mysqli_query($connection, $sql);
}

function sendContactForm(string $name, string $email, string $subject, string $text) : void {
    $connection = getDataBaseConnection();
    $sql = "INSERT INTO contact(name, email, subject, message) VALUES ('". mysqli_real_escape_string($connection, $name)."',"
            . " '". mysqli_real_escape_string($connection, $email)."',"
            . " '". mysqli_real_escape_string($connection, $subject)."',"
            . " '". mysqli_real_escape_string($connection, $text)."')";
    $result = mysqli_query($connection, $sql);

    //insert into txt
    $message = "";
    $message .= "Name: {$name} \r\n";
    $message .= "Email: {$email} \r\n";
    $message .= "Subject: {$subject} \r\n";
    $message .= "Message: {$text} \r\n";
    $message .= "Message Date: " . date('Y-m-d H:i:s') . "\r\n";
    $message .= "------------------------ \r\n";

    $bytes_written = file_put_contents('./'.CONTACT_MESSAGES_FILE_NAME, $message, FILE_APPEND | LOCK_EX);

    if ($bytes_written === false) {
        die("Error, no bytes written");
    }
}