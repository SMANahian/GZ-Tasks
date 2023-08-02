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
    <form action="/auth/reset_pass" method="post">
        <label for="password">New password:</label>
        <input type="password" name="password"> </br>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="verify_key" value="<?= $verify_key ?>">
        <button type="submit">Reset your password</button>
    </form>
</div>
<?= $this->endSection(); ?>