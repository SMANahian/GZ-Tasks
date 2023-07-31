<?= $this->extend('templates/layout'); ?>
<?= $this->section("content"); ?>
    <div align='center'>
        <h1>Editing</h1>
        <h2><?= 'Profile of '.$name ?></h2>
        <?php if(session()->getFlashdata('error')):?>
            <div style='color: red;'>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif;?>
        <form action="/profile/update" method="post">
            <label for="name">Full Name:</label>
            <input type="text" name="name" value="<?=$name?>"> </br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?=$email?>" disabled> </br>
            <label for="password">Password:</label>
            <input type="password" name="password"> </br>
            <button type="submit">Update</button>
        </form>
    </div>
<?= $this->endSection(); ?>