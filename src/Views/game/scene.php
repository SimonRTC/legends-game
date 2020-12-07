<div class="overlay overlay-scene">
	<div class="fadeout">
		<div class="container">
			<div class="col-md-6 p-lg-5 mx-auto my-5">
				<h1>En route pour l'<span class="text-warning">Aventure</span> !</h1>
			</div>
		</div>
	</div>
</div>

<main class="bg-parchment test" role="main">
		<!-- Avatar player
		============================================= -->
	<div class="avatar-player-scene" style="background-image: url(<?= $_DATAS_["QUESTION"]->characters[0]->image ?>);"></div>
		<!--Avatar player end -->

	<div class="container container-game col-lg-6">
		<!-- Page Title
		============================================= -->

		<div class="header-game">
			<br>
			<div class=" image-class-scene">
				<img class="rounded-circle" src="/assets/img/scene/icon-header.png" alt="icon header image" width="220" height="160">
			</div>
			<div class="header-text">
				<h1><?= $_DATAS_["CHAPTER"] ?></h1>
				<span><?= $_ACCOUNT_->Player->username ?><?= (!empty($_ACCOUNT_->Player->character->name)? " | Alias, {$_ACCOUNT_->Player->character->name}": null) ?></span>
				<span>{{Classe}}</span>
				<span>Lvl: <?= (!empty($_ACCOUNT_->Player->lvltag)? (string) $_ACCOUNT_->Player->lvltag: "0.0.0") ?></span>
			</div>

		</div>
		<!--Page title end -->

		<!-- Content
		============================================= -->
		<div style="margin-bottom: 0px;">
			<table class="table-game">

				<thead>

					<tr>
						<th></th>
						<th>ENDURANCE</th>
						<th>FORCE</th>
						<th>AGILITÉ</th>
						<th>INTELLIGENCE</th>
						<th>OR</th>
						<th>SAC A DOS</th>
						<th></th>
					</tr>

            	</thead>
              
				<tbody>

					<tr>
						<td></td>
						<td>27</td>
						<td>27</td>
						<td>10</td>
						<td>10</td>
						<td>29</td>
						<td>
							<div class="inventory popup" role="button" onclick="showInventory()">
							<img src="/assets/img/scene/inventory-bag.png" alt="" width="50" height="50">
								<span class="popuptext" id="inventoryPopup">
									<span class="close-popup"></span>
									<h1>Inventaire</h1>
										<p>Vide!</p>
										<!--
										<button class="btn-scene">Pain</button>
										<button class="btn-scene">Jambon</button>
										<button class="btn-scene"> Slot vide </button>
										-->
									</span>
								</span>
							</div>
						</td>
						<td></td>
					</tr>

				</tbody>
			</table>
				
			<div class="content-wrap">
						
				<div class="container">

					<div class="content-game"><?= $_DATAS_["QUESTION"]->narration ?></div>
					<?php foreach ($_DATAS_["QUESTION"]->characters as $character): ?>
						<span class="d-block text-muted"><u><?= $character->name ?>:</u></span>
						<div class="content-game">« <?= $character->dialogue ?> »</div>
					<?php endforeach; ?>

					<hr class="hr-style mb-4">

					<?php foreach ($_DATAS_["QUESTION"]->responses as $index => $response): ?>
						<a class="btn btn-lg btn-scene" href="/game/<?= $_DATAS_["permalien"] ?>/<?= $index ?>"><?= $index + 1 ?>) - <?= $response->label ?></a>
					<?php endforeach; ?>  
					
					<hr class="hr-style">

				</div>
			</div>
		</div><!-- #content end -->
	</div>
</main>

<script>
	var typewriters = document.getElementsByClassName("content-game");
	for (var i = 0; i < typewriters.length; i +=1){
		type(typewriters[i]);
	}
	function type(elem) {
		var originalString = elem.innerText;
		elem.innerText = '';
		var steps = [];
		var step = 0;
		for (var i = 0; i <= originalString.length; i += 1) {
			steps.push(originalString.slice(0, i));
		}
	function doType() {
		if (step < steps.length) {
			elem.innerText = steps[step];
			step += 1;
			} else {
			clearInterval(timer);
			return;
			}
		}
		var timer = setInterval(doType, 40);
	}

	var popupInventory = document.getElementById("inventoryPopup");
	function showInventory() {
        popupInventory.classList.toggle("show");
        }
</script>