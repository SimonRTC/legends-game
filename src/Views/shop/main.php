<div class="overlay overlay-shop">
	<div class="fadeout">
		<div class="container">
			<div class="col-md-6 p-lg-5 mx-auto my-5">
				<h1>Boutique <span class="text-warning">Legends</span></h1>
				<p>Achetez de nouveaux équipements pour devenir la légende la plus stylée de tous les temps !</p>
			</div>
		</div>
	</div>
</div>
<main class="bg-parchment" role="main">
<div style="height: 5rem; visibility: hidden;"></div>
    <div class="container"id="container">
    <ul class="fireflies">
        <li class="pix"></li>
        <li class="pix"></li>
        <li class="pix"></li>
        <li class="pix"></li>
        <li class="pix"></li>
    </ul>
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                <div class="gold-deco" id="gold-deco"></div>
                    <a href="#gold-deco" class="btn btn-parchment" onclick="showOnlyWar()">Guerrier</a>
                    <a href="#gold-deco" class="btn btn-parchment" onclick="showOnlyMage()">Mage</a>
                    <a href="#gold-deco" class="btn btn-parchment" onclick="showOnlyArcher()">Archer</a>
                </div>
            </div>
            
            <div class="col-lg-9" >
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 mb-4 " id="war-item-1">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Haume de guerrier doré</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="war-item-2">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Plastron de guerrier doré</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="war-item-3">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Epée de guerrier dorée</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="mage-item-1">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Tiare de mage rouge</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="mage-item-2">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Robe de mage rouge</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="mage-item-3">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Bâton épique rouge</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="archer-item-1">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Protège-tête d'archer vert</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="archer-item-2">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Tunique d'archer vert</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" id="archer-item-3">
                        <div class="card h-100">
                            <h4 class="card-title">
                                <a href="#">Arc d'archer vert</a>
                            </h4>
                            <a href="#"><img class="card-img-top" src="/assets/img/shop/coming-soon.png" alt=""></a>
                            <div class="card-body">
                                <h5><div class="coin-deco"></div>100g</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>

    var warItem1 = document.getElementById("war-item-1");
    var warItem2 = document.getElementById("war-item-2");
    var warItem3 = document.getElementById("war-item-3");

    var mageItem1 = document.getElementById("mage-item-1");
    var mageItem2 = document.getElementById("mage-item-2");
    var mageItem3 = document.getElementById("mage-item-3");

    var archerItem1 = document.getElementById("archer-item-1");
    var archerItem2 = document.getElementById("archer-item-2");
    var archerItem3 = document.getElementById("archer-item-3");
    

    function showOnlyWar() {
            if (
            archerItem1.style.display === "none" && archerItem2.style.display === "none" && archerItem3.style.display === "none" 
            && mageItem1.style.display === "none" && mageItem2.style.display === "none" && mageItem3.style.display === "none") {

            archerItem1.style.display = "block";
            archerItem2.style.display = "block";
            archerItem3.style.display = "block";

            mageItem1.style.display = "block";
            mageItem2.style.display = "block";
            mageItem3.style.display = "block";

        } else {
            warItem1.style.display = "block";
            warItem2.style.display = "block";
            warItem3.style.display = "block";

            archerItem1.style.display = "none";
            archerItem2.style.display = "none";
            archerItem3.style.display = "none";

            mageItem1.style.display = "none";
            mageItem2.style.display = "none";
            mageItem3.style.display = "none";
        }
    }
    function showOnlyMage() {
        if (
            archerItem1.style.display === "none" && archerItem2.style.display === "none" && archerItem3.style.display === "none" 
            && warItem1.style.display === "none" && warItem2.style.display === "none" && warItem3.style.display === "none") {

            archerItem1.style.display = "block";
            archerItem2.style.display = "block";
            archerItem3.style.display = "block";

            warItem1.style.display = "block";
            warItem2.style.display = "block";
            warItem3.style.display = "block";

        } else {
            mageItem1.style.display = "block";
            mageItem2.style.display = "block";
            mageItem3.style.display = "block";

            archerItem1.style.display = "none";
            archerItem2.style.display = "none";
            archerItem3.style.display = "none";

            warItem1.style.display = "none";
            warItem2.style.display = "none";
            warItem3.style.display = "none";
        }
    }
    function showOnlyArcher() {
        if (
            warItem1.style.display === "none" && warItem2.style.display === "none" && warItem3.style.display === "none" 
            && mageItem1.style.display === "none" && mageItem2.style.display === "none" && mageItem3.style.display === "none") {

            warItem1.style.display = "block";
            warItem2.style.display = "block";
            warItem3.style.display = "block";

            mageItem1.style.display = "block";
            mageItem2.style.display = "block";
            mageItem3.style.display = "block";

        } else {
            archerItem1.style.display = "block";
            archerItem2.style.display = "block";
            archerItem3.style.display = "block";

            warItem1.style.display = "none";
            warItem2.style.display = "none";
            warItem3.style.display = "none";

            mageItem1.style.display = "none";
            mageItem2.style.display = "none";
            mageItem3.style.display = "none";
        }
    }
    
</script>