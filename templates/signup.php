<?php include 'components/header.php'; ?>
    <div style="text-align: center;">
        <h1>Registration</h1>
        <?php if (!empty($error)): ?>
            <p style="color: red"><?= $error ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label>Username <input type="text" name="username" value="<?= $_POST['username'] ?>"></label>
            <br><br>
            <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?>"></label>
            <br><br>
            <label>Password <input type="password" name="password" value="<?= $_POST['password'] ?>"></label>
            <br><br>
            <input type="submit" value="Sign up">
        </form>
    </div>
<?php include 'components/footer.php'; ?>