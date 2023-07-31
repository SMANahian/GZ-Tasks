<?= $this->extend('templates/layout'); ?>
<?= $this->section("content"); ?>
    <div align='center'>
    <h2>Sign Up</h2>
    <?php if(session()->getFlashdata('error')):?>
        <div style='color: red;'>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif;?>
    <form action="signup" method="post">
        <label for="name">Full Name:</label>
        <input type="text" name="name"> </br>
        <label for="email">Email:</label>
        <input type="email" name="email"> </br>
        <label for="password">Password:</label>
        <input type="password" name="password"> </br>
        <button type="submit">Sign up</button>
    </form>
    </div>
<?= $this->endSection(); ?>
