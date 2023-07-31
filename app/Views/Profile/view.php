<?= $this->extend('templates/layout'); ?>
<?= $this->section("content"); ?>
    <div align='center'>
        <h2><?= 'Profile of '.$name ?></h2>
        <p>Name: <?=$name?> </p>
        <p>Email: <?=$email?> </p>
        <?php if(session()->get('id') == $id): ?>
            <a href="/profile/<?=$id?>/edit"><button>Edit</button></a>
        <?php endif; ?>
    </div>
<?= $this->endSection(); ?>