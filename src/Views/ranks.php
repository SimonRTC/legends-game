<div class="overlay overlay-ranks">
	<div class="fadeout">
		<div class="container">
			<div class="col-md-6 p-lg-5 mx-auto my-5">
				<h1>Découvrez le classement des <span class="text-warning">meilleurs</span> joueurs</h1>
			</div>
		</div>
	</div>
</div>

<main class="bg-parchment" role="main">
    <div class="container">
        <div class="grcard card-deck">
            <div class="row justify-content-center">
                <?php foreach ($_DATAS_["PLAYERS"] as $i => $Player): ?>
                    <?php if ($i <= 2): ?>
                        <div class="col-xl-3 col-lg-4 col-md-7 card-rank">
                            <fieldset class="wood">
                                <div class="card truc <?= ($i == 0? "bg_card_one": ($i == 1? "bg_card_two": ($i == 2? "bg_card_three": null))) ?>">
                                    <img class="card-img-top" src="/assets/img/ranks/person-male.png" alt="No one">
                                    <div class="divider"></div>
                                    <div class="card-body">
                                        <h6 class="card-title">#<?= $i + 1 ?> <?= $Player->username ?></h6>
                                        <p class="card-text">
                                            Peuple: <strong><?= ($Player->character->name == "ELF"? "Elfe": ($Player->character->name == "DWARF"? "Nain": ($Player->character->name == "HUMAN"? "Humain": null))) ?></strong>,
                                            Classe: <strong><?= ($Player->character->class == "WAR"? "Guerrier": ($Player->character->class == "MAGE"? "Mage": ($Player->character->class == "ARCHER"? "Archer": null))) ?></strong>    
                                        </p>
                                        <a href="/profils/<?= $Player->username ?>/" class="btn btn-parchment btn-center">Voir</a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    <?php else: break; endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="img-ranking"><img src="/assets/img/ranks/lantern.png" alt="" class="lantern"></div>
    <div class="container">
        <div class="grcard card-deck">
            <div class="row justify-content-center">
                <?php foreach ($_DATAS_["PLAYERS"] as $i => $Player): ?>
                    <?php if ($i > 2): ?>
                        <div class="col-xl-3 col-lg-4 col-md-7 card-rank">
                            <fieldset class="wood">
                                <div class="card truc bg_next">
                                    <img class="card-img-top" src="/assets/img/ranks/person-male.png" alt="No one">
                                    <div class="divider"></div>
                                    <div class="card-body">
                                        <h6 class="card-title">#<?= $i + 1 ?> <?= $Player->username ?></h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="/profils/<?= $Player->username ?>/" class="btn btn-parchment btn-center">Voir</a>
                                    </div>
                                </div>
                            </fieldset>    
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>