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
	<div class="avatar-player-scene"></div>
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
				<h1>Titre du Chapitre en Cour</h1>
				<span> Pseudo</span>
				<span> Classe</span>
				<span> LvL</span>
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
									<button class="btn-scene">Pain</button>
									<button class="btn-scene">Jambon</button>
									<button class="btn-scene"> Slot vide </button>
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

					<div class="content-game">			
					Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia consequuntur eos necessitatibus? Cumque ea tempora odio incidunt, quibusdam, sequi tenetur cupiditate, minima cum dolore ad voluptatum? Tempora veniam dignissimos adipisci!
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eum non molestias quis maiores, blanditiis, placeat fugiat repellendus autem atque nam reprehenderit totam maxime temporibus id officiis? Possimus, voluptatem autem!
					</div>

					<hr class="hr-style">

					<form action="textChangeTo1.1" method="post">
                        <button type="submit" class="btn-lg btn-block btn-scene">Choix 1.1</button>
                    </form>
                      
                         
					<form action="textChangeTo1.2" method="post">
						<button type="submit" class="btn-lg btn-block btn-scene">Choix 1.2</button>
                    </form>

                        
                    <form action="textChangeTo1.3" method="post">
						<button type="submit" class="btn-lg btn-block btn-scene">Choix 1.3</button>
					</form>	
					
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