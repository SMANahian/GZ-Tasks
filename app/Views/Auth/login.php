<?= $this->extend('templates/layout'); ?>
<?= $this->section("content"); ?>
    <div align='center'>
    <h2>Log In</h2>
    <?php if(session()->getFlashdata('error')):?>
        <div style='color: red;'>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif;?>
    <?php if(session()->getFlashdata('success')):?>
        <div style='color: green;'>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif;?>
    <form action="/auth/login" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email"> </br>
        <label for="password">Password:</label>
        <input type="password" name="password"> </br>
        <button type="submit">Login</button> </br>
        <a href="/auth/reset">Forgot your password?</a>
    </form>
</div>
<?= $this->endSection(); ?>