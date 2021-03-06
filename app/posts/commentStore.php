<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['comment'], $_POST['post_id'])) {
    $comment = $_POST['comment'];

    $userId = $_SESSION['user']['id'];
    $commentDate = date("Y-m-d D H:i:s");  //("Y-m-d H:i");
    $postId = $_POST['post_id'];

    $_SESSION['successful'] = [];

    $_SESSION['errors'] = [];

    $sql = "INSERT INTO Comments (comment, comment_date, user_id, post_id) VALUES (:comment, :commentDate, :userId, :postId);";
    $statement = $pdo->prepare($sql);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
        $_SESSION['errors'][] = "Ops, something went wrong! Try again.";
        redirect("/submit.php");
    }

    $statement->BindParam(':comment', $comment);
    $statement->BindParam(':commentDate', $commentDate);
    $statement->BindParam(':userId', $userId);
    $statement->BindParam(':postId', $postId);

    $statement->execute();

    $_SESSION['successful'][] = "Your comment has successfully been posted!";

    redirect("/../comments.php?id=$postId");
} else {
    $_SESSION['errors'][] = "Ops, something went wrong! Try again.";
    redirect("/index.php");
}
