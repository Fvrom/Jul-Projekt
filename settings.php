<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/header.php'; ?>

<?php
if (isset($_SESSION['user']['username'])) {
    $username = filter_var($_SESSION['user']['username'], FILTER_SANITIZE_STRING);

    $userProfile = getUser($pdo, $username);

    $profileId = $userProfile['id'];
}
?>

<?php if (isset($_SESSION['errors'])) :  ?>
    <p class="error-message"> <?php errorMessage(); ?>
    <?php unset($_SESSION['errors']);  //delete error message after displayed
endif; ?> </p>
    <?php if (isset($_SESSION['successful'])) : ?>
        <p class="error-message"> <?php successfulMessage(); ?>
        <?php unset($_SESSION['successful']);
    endif; ?> </p>

        <?php if (isset($_SESSION['user'])) : ?>
            <section class="sign-up-form">
                <form action="/users/updateSettings.php" method="post">
                    <div class="sign-up">
                        <label for="username"> Change username </label>
                        <input type="text" name="username" id="username" placeholder=" <?php echo $userProfile['username']; ?>">
                        <button type="submit" class="submit-button"> Change username </button>
                    </div>
                </form>
                <form action="/users/updateSettings.php" method="post">
                    <div class="sign-up">
                        <label for="biography"> Biography </label>
                        <input type="text" name="biography" id="biography" placeholder=" <?php echo $userProfile['biography']; ?>">
                        <button type="submit"> Update bio </button>
                    </div>
                </form>
                <form action="/users/avatar.php" method="post" enctype="multipart/form-data">
                    <div class="sign-up">
                        <label for="avatar"> Choose profile image to upload. (Max 2MB) </label>
                        <input type="file" accept="image/jpeg,image/jpg,image/png" name="avatar" id="avatar">
                        <button type="submit" class="submit-button"> Update image </button>
                    </div>
                </form>
                <form action="/users/updateSettings.php" method="post">
                    <div class="sign-up">
                        <label for="email"> Change email </label>
                        <input type="email" name="changeEmail" id="changeEmail" placeholder="<?php echo $_SESSION['user']['email']; ?>">
                        <button type="submit" class="submit-button"> Change Email</button>
                    </div>
                    <div class="sign-up">
                </form>
                <form action="/users/updateSettings.php" method="post">
                    <div class="sign-up">
                        <label for="password"> Current password </label>
                        <input type="password" name="currentPwd" id="currentPwd" required>
                        <label for="password"> Change password </label>
                        <input type="password" name="changePwd" id="changePwd">
                        <label for="password"> Repeat new password </label>
                        <input type="password" name="repeatPwd" id="repeatPwd">
                        <button type="submit" class="submit-button"> Change password </button>
                    </div>
                </form>
                <div class="sign-up">
                    <button> <a href="profile.php?username=<?php echo $_SESSION['user']['username']; ?>"> Back to your profile </a> </button>
                </div>
            <?php endif; ?>
            </section>
