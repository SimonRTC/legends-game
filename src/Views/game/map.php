<br /><br /><br /><br /><br />

<?php foreach ($_DATAS_["CHAPTERS"] as $Chapter): ?>
    <a href="<?= "/maps/chapter/{$Chapter->permalien}/" ?>"><?= $Chapter->name ?></a><br />
<?php endforeach; ?>

<br /><br /><br />