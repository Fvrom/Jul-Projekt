<?php

declare(strict_types=1);

require __DIR__ . '/../app/autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


    $pdo = new PDO('sqlite:../database/newsdatabase.db');
    //die(var_dump($pdo->errorInfo()));

    $statement = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
    $statement->BindParam(':email', $email);
    $statement->execute();

    //Fetching user as an array
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        redirect('/login.php');
    }

    if (password_verify($_POST['password'], $user['password'])) {

        unset($user['password']);

        $_SESSION['user'] = $user;
        // If password is correct we save the user in the session. 
        // we do not store password in session. 
    }
}

redirect('/');
