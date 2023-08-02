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
    <form action="/auth/reset" method="post">
        <label for="email">Write your email address:</label>
        <input type="email" name="email"> </br>
        <button type="submit">Get link</button>
    </form>
</div>
<?= $this->endSection(); ?>