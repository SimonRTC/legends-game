<br />

<?php foreach ($_DATAS_["BLIPS"] as $Blip): ?>
    <a href="<?= $Blip->permalien ?>"><?= $Blip->name ?></a><br />
<?php endforeach; ?>