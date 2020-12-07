<div class="container py-5 mt-5">
    <form method="POST">
        <h2><?= $_DATAS_["CHAPTER"] ?></h2><br />
        <p><?= $_DATAS_["QUESTION"]->narration ?></p>
        <div class="mt-4 mb-4">
            <?php foreach ($_DATAS_["QUESTION"]->characters as $character): ?>
                <h5><?= $character->name ?></h5>
                <img src="<?= $character->image ?>" alt="<?= $character->name ?>">
                <p><?= $character->dialogue ?></p>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <?php foreach ($_DATAS_["QUESTION"]->responses as $i => $response): ?>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="response-<?= ($i + 1) ?>" value="response-<?= ($i + 1) ?>" name="response" class="custom-control-input">
                    <label class="custom-control-label" for="response-<?= ($i + 1) ?>"><?= $response->label ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-primary" type="submit">GO!</button>
    </form>
</div>