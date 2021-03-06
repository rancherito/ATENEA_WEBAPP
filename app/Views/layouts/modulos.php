<?php
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>ATENEA</title>
	<link rel="stylesheet" href="<?= base_url()?>/styles/normalize.css">
	<link rel="stylesheet" href="<?= base_url()?>/libs/animate/animate.min.css">
	<link rel="icon" href="<?= base_url()?>/images/ICON.svg" type="image/svg" sizes="16x16">
	<link rel="stylesheet" href="<?= base_url()?>/libs/materialize/css/materialize.min.css">
	<!--JQUERY-->
	<script src="<?= base_url()?>/libs/Jquery/jquery-3.5.0.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url()?>/libs/materialize/js/materialize.min.js"></script>
	<script src="<?= base_url() ?>/libs/vue/vue.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url()?>/styles/colors.css">
	<link rel="stylesheet" href="<?= base_url()?>/styles/custom_materialize.css">
	<link rel="stylesheet" href="<?= base_url()?>/styles/style_components.css">
	<link rel="stylesheet" href="<?= base_url()?>/styles/styles.css">
	<link rel="stylesheet" href="<?= base_url()?>/styles/main.css">
	<!--FUENTE DE ICONOS-->
	<link rel="stylesheet" href="<?= base_url()?>/font/fontawesome/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Rosario:ital@1&display=swap" rel="stylesheet">
	<style media="screen">
		#modal-login{
			background-image: url('<?= base_url()?>/images/bg_003.jpg');
		}
		#modal-login::before{
			content: '';
			background: #213240;
			opacity: .7;
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: -1;
		}
		.footer-imgs-wrapper1 img{
			vertical-align: middle;
    		margin: 20px 14px!important;
    		width: 65px;
		}

		.footer-top-text{
			margin-top: 10px;
		    margin-bottom: 0;
		    margin-left: 20px;
		    margin-right: 20px;
		    color: #fff;
		    font-size: 13px;
		    line-height: 16px;
		    font-weight: 400;
		    text-align: center;
		    letter-spacing: 0;
		    text-transform: none;
		    justify-content: center;
    		align-items: center;
		}
		.servicios{
			margin-left: 20px;
		    margin-right: 20px;
			margin-top: 10px;
		    margin-bottom: 0;
		    color: #fff;
		    font-size: 13px;
		    line-height: 16px;
		    font-weight: 400;
		    text-align: center;
		    letter-spacing: 0;
		    text-transform: none;
		    justify-content: center;
    		align-items: center;
		}
		#search{
			height: 30px;
			width: 500px;
			padding: 10px;
			margin: auto;
			border-radius:  19px 19px 19px 19px;
		}




	</style>
</head>
<body>
	<div id="modal-login" class="modal cover" style="max-width: 420px">
		<div class="modal-content f-c">

			<form id="form-acceso">
				<div class="row">
					<div class="col s12">
						<div class="w100">
							<br>
							<br>
							<br>
							<br>
							<br>
							<h1 class="white-text c" style="font-size: 3rem">Bienvenido</h1>
							<h3 class="white-text c" style="font-size: 1.5rem">Explora un gran catalogo de opcciones que tenemos para ofrecerte</h3>
							<p class="white-text c">INGRESE SUS CREDENCIALES DE ACCESO</p>
						</div>

					</div>
					<div class="input-field col s12">
						<input placeholder="ingrese usuario" name="user" type="text" required>
						<label for="user">USUARIO</label>
					</div>
					<div class="input-field col s12">
						<input placeholder="ingrese contraseña" name="pass" type="password" required>
						<label for="pass">CONTRASEÑA</label>
					</div>
					<div class="col s12">
						<div class="w100 r">
							<a class="btn-flat modal-close waves-effect">CERRAR</a>
							<button class="btn waves-effect bg-secondary">ACCEDER</button>
						</div>
					</div>
				</div>


			</form>
		</div>
	</div>
	<header>
		<div class="container header_content">

			<a href="#" data-target="menu-responsive" class="sidenav-trigger">
				<i  class="fal fa-bars"></i>
			</a>

			<ul class="sidenav" id="menu-responsive">
				<li>
					<div class="user-view">
						<div class="background">
							<img src="images/fondo.jpg" alt="">

						</div>
						<a href="" >
							<img src="images/avatar_hombre.png" class="circle">
						</a>
						<a href="">
							<span class="name white-text">Nickie</span>
						</a>
						<a href="">
							<span class="email white-text">nickietubebito@hotmail.com</span>
						</a>
					</div>
				</li>
				<li>
					<a href="">
						Categorias
					</a>
				</li>
				<li>
					<div class="divider"></div>
				</li>
				<li>
					<a href="">
						<i class="fas fa-question-circle"></i>
						Ayuda
					</a>
				</li>

			</ul>



			<a href="." id="content-title-web">
				<img src="<?= base_url()?>/images/ICON.svg" alt="UNAMAD" class="logo-index">
				<span><?= $_ENV['varialbe.webname']?></span>

			</a>

				<div  class="buscar1">
					<input id='search' placeholder="Buscar..." v-model="categoria">

					<a id='' class='f-c waves-effect waves-light' ></a>

				</div>
			<div class="header-links">

				<a class="btn btn-large">
					<i class="fal fa-shopping-cart"></i>
				</a>
				<a class="btn btn-large modal-trigger " href="#modal-login">
					<i class="fal fa-user-circle"></i>
				</a>
			</div>
		</div>

		<div class="" style="height: 4px"></div>
	</header>
	<section id="content-body"  style="min-height: 600px;">
		<?= $body?>
	</section>
	<body>
		 <div class="carousel">
		 	<h1 class="c">Productos más vendidos</h1>
		    <a class="carousel-item" href="#"><img src="images/celular.jpg"></a>
		    <a class="carousel-item" href="#"><img src="images/lavadora.jpg"></a>
		    <a class="carousel-item" href="#"><img src="images/celular.jpg"></a>
		    <a class="carousel-item" href="#"><img src="images/lavadora.jpg"></a>
		    <a class="carousel-item" href="#"><img src="images/celular.jpg"></a>
 		 </div>
	</body>

	<footer>

		<div id="footer-top" class="#263238 blue-grey darken-2 white-text f-c" style="height: 150px;">
			<div class="container" style="display: block">
				<div class="servicios row">
				<a href="" class="">
					<img src="images/retiro_compra.svg" height="30px">
					<h3 class="footer-top-text" style="line-height: 19px">
						Retira tu compra en
						<br>
						<b>76 tiendas</b>
						en todo el pais
					</h3>
				</a>
				<a href="" class="">
					<img src="images/despachos.svg" height="30px">
					<h3  class="footer-top-text" style="line-height: 19px">
						Envios a todo el Perú.
						<br>
						<b></b>
						Más de 1800 distritos
					</h3>
				</a>
				<a href="" class="">
					<img src="images/servicios_esp.svg" height="30px">
					<h3 class="footer-top-text" style="line-height: 19px">
						Atencion al cliente
						<br>
						<b></b>
						(01) 983-4734
					</h3>
				</a>
				<a href="" class="">
					<img src="images/libroreclam.svg" height="30px">
					<h3 class="footer-top-text" style="line-height: 19px">
						Servicios
						<br>
						<b></b>
						Especializados
					</h3>
				</a>
				<a href="" class="">
					<img src="images/atencion_cliente.svg" height="30px">
					<h3 class="footer-top-text" style="line-height: 19px">
						Libro de
						<br>
						<b></b>
						Reclamaciones
					</h3>
				</a>
				</div>

			</div>

		</div>
		<!--<div id="copyright" class="black white-text f-c" style="height: 60px;">COPYRIGHT</div>-->

		<div id="contato" class="#263238 blue-grey darken-4 white-text f-c" style="height: 350px;">
			<div class="container" style="display: block">
				<div class="footer-pagos">
					<br><br>
					<h4 class="footer-h4" >Haz tus compras facilmente<br>
					<span>Con total seguridad y privacidad</span>
					</h4>
				</div>
				<div class="footer-imgs-wrapper1 row">
					<img class="col s1 " src="images/visa.svg" width="4" >

					<img class="col s1 " src="images/mastercard.svg" width="4">
					<img class="col s1" src="images/americanexpress.svg" width="4">

					<img class="col s1" src="images/dinnersclub.svg" width="4">

					<img class="col s1" src="images/pagoefectivo.svg" width="4">

					<img class="col s1" src="images/secure1.png" width="4">
				</div>

				<div class="social-media">
					<h3>Siguenos en</h3>
					<ul class="row">
						<i class="material-icons" >facebook</i>

					</ul>
				</div>
			</div>
		</div>

	</footer>



	<script type="text/javascript">
	const modalLogin = $('#modal-login').modal()
	const form_acceso = $('#form-acceso');
	form_acceso.submit( e => {
		e.preventDefault();
		const serialize = form_acceso.serialize()
		$.post('<?= base_url()?>/validar_acceso', serialize, function (res) {
			console.log(res);
			switch (res) {
				case 'A':
					console.log('ADMINSTRADOR');
					location.href = '<?= base_url()?>/administrator'
				break;
				case 'U':
					console.log('USUARIO');
				break;
				default: M.toast({html: 'CREDENCIALES ERRONEAS', classes: 'bg-alert'});

			}
		})
	})
	//modalLogin.modal('open')

	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems,{
    	duration:300,
    	shift:100,
    	dist:10,
    	fullWidth:false
    	});

    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
    });



	  // Or with jQuery

	  // $(document).ready(function(){
	  //   $('.carousel').carousel();
	  // });

	</script>
</body>
</html>
