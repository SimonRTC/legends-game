<div class="overlay overlay-gamelist">
	<div class="fadeout">
		<div class="container">
			<div class="col-md-6 p-lg-5 mx-auto my-5">
				<h1>Naviguez sur <span class="text-warning">Kappa</span> ! Et vivez des aventures incroyables !</h1>
			</div>
		</div>
	</div>
</div>

<main class="bg-parchment gl-body" role="main">
    <div class="container">
    <div class="grcard card-deck">
            <div class="row justify-content-center">
                <?php foreach ($_DATAS_["CHAPTERS"] as $i => $Chapter): ?>
                    <div class="col-xl-4 col-lg-4 col-md-7">
                        <?php if ($i == 0): ?>
                            <img class="decor-top-left-gl" src="/assets/img/home/border-page-home-top-left.png">
                        <?php endif; ?>
                        <div style="height: 10rem; visibility: hidden;"></div>
                        <div class="card bg-gl">
                            <div class="card-body">
                                <h6 class="card-title-gl">#<?= ($i + 1) ?> <?= $Chapter->name ?></h6>
                                <p class="card-text-gl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt quas vel veniam?</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <?php if ($_DATAS_["EXPLORER"]($Chapter->tag) <= $_DATAS_["PLYTAG"]): ?>
                                <a href="/game/<?= $Chapter->permalien ?>/" class="btn btn-parchment btn-gl d-flex justify-content-center">Début</a>
                            <?php else: ?>
                                <p class="text-center text-muted mt-3"><i><small>> Disponible au niveau <?= $Chapter->tag ?></small></i></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div style="height: 10rem; visibility: hidden;"></div>
</main>