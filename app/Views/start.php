<link rel="stylesheet" href="<?= base_url()?>/public/libs/swiper/swiper-bundle.min.css">
<script src="<?= base_url()?>/public/libs/swiper/swiper-bundle.min.js"></script>
<style media="screen">
:root {
    --swiper-theme-color: var(--bg-primary);
}
#presentacion{
	background: #efefef;
}
.swiper-slide {
	text-align: center;
	font-size: 18px;
	display: flex;
	justify-content: center;
	align-items: center;
}
#categorias {
	max-width: 1480px;
    margin: 30px auto !important;
    padding: 0;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #5d5d5d;
    text-align: center;
    font-size: 1em;
    font-weight: bold;

}
#categorias li img {
	width: 60px;
    opacity: .9;
   
}
/* #categorias li p{
	size: 50px;

} */
#categorias li{
	
	margin: 20px;
}
#cate a{
	color: #424242;
	
}

}
</style>
<div id="presentacion">
	<div class="swiper-container container">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<img src="<?= base_url()?>/public/images/010720-slider-amd-1.png" style="width: 100%">
			</div>
			<div class="swiper-slide">
				<img src="<?= base_url()?>/public/images/010720-slider-lb-1.png" style="width: 100%">
			</div>
			<div class="swiper-slide">
				<img src="<?= base_url()?>/public/images/010720-slider-pads-1.png" style="width: 100%">
			</div>
			<div class="swiper-slide">
				<img src="<?= base_url()?>/public/images/010720-slider-celulares-1.png" style="width: 100%">
			</div>
		</div>
		<!-- Add Arrows -->
		 <div class="swiper-pagination"></div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
</div>

<div class="container">
	<div  id="cate" >
			<ul class="row" id="categorias">
				<li class="col s1">
					<a href="">
						<img src="public/images/Televisores.svg">
						<p>Televisores</p>
					</a>
				</li>
				<li class="col s1">
					<a href="">
						<img src="public/images/Audio.svg">
						<p>Audio</p>
					</a>
				</li>		
				<li class="col s1">
					<a href="">
						<img src="public/images/computo.svg">
						<p>Cómputo</p>
					</a>
				</li>			
				<li class="col s1">
					<a href="">
						<img src="public/images/linea-blanca.svg">
						<p>Línea Blanca</p>
					</a>
				</li>			
				<li class="col s1">
					<a href="">
						<img src="public/images/deporte.svg">
						<p>Deportes</p>
					</a>
				</li>			
				<li class="col s1">
					<a href="">
						<img src="public/images/celulares.svg">
						<p>Celulares</p>
					</a>
				</li>			
				<li class="col s1">
					<a href="">
						<img src="public/images/hogar.svg">
						<p>Hogar</p>
					</a>
				</li class="col s1">			
				<li>
					<a href="">
						<img src="public/images/electrodomesticos.svg">
						<p>Electrodomésticos</p>
					</a>
				</li>
			</ul>

	</div>
</div>







<div id="content" class="f-c">
	<div class="container padding">
		<div class="head-container">
			<h2 class="primary">Articulos en oferta!</h2>
			<p>Escoja entre una gran variedad de productos que ofrecemos a su dispocision y con la mejor oferta</p>
		</div>
		<?php print_r($_SESSION['ateneaapp']) ?>
		<div class="row">
			<?php
			for ($e=0; $e < 5; $e++) {
				echo "
				<div class='col s12 f-c'>
				<div style='height: 50px; width: 100%'></div>
					<h3 style='font-family: var(--title-font)'> <i class='fas fa-layer-group'></i> Categoria #0$e</h3>

				</div>";

				for ($i=0; $i < 4; $i++) {
					echo '
						<div class="col s6 m3">
							<div class="card-panel f-c" style="width: 100%; height: 300px;">
								<h4>Lavadora</h4>
								
								<img src="public/images/lavadora.jpg" alt="" />
							</div>
						</div>

					';
				}
			}

			?>
		</div>

	</div>
</div>


<script type="text/javascript">
var swiper = new Swiper('.swiper-container', {
	calculateHeight:true,
	loop: true,
	speed: 100,
	autoplay: true,
	fadeEffect: {
    crossFade: true
  },
	pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});
</script>
