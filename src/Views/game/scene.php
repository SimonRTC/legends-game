<div class="container py-5">
    <form method="POST">
        <h2><?= $_DATAS_["SCENE"]->question ?></h2><br />
        <div class="form-group">
            <?php foreach ($_DATAS_["SCENE"]->answers as $Answer): ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="<?= $Answer->name ?>" value="<?= $Answer->name ?>" name="response" class="custom-control-input">
                    <label class="custom-control-label" for="<?= $Answer->name ?>"><?= $Answer->label ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-primary" type="submit">GO!</button>
    </form>
</div>