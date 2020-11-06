<?php include rootPath() . '/templates/header.php'; ?>
    <div style="text-align: center;">
        <h1>LOGIN</h1>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
        <form action="/users/login" method="POST">
            <label>Nickname <input type="text" name="nickname[nickname]" value="<?= $_POST['email'] ?? '' ?>"></label>
            <br><br>
            <label>Password <input type="password" name="password[password]" value="<?= $_POST['password'] ?? '' ?>"></label>
            <br><br>
            <input type="submit" value="Sign in">
        </form>
    </div>
<?php include rootPath() . '/templates/footer.php'; ?>