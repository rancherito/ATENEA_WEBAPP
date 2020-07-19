<?php
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>INVERSIONES ATENEA</title>
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/normalize.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/libs/animate/animate.min.css">
	<link rel="icon" href="<?= base_url()?>/public/images/ICON.svg" type="image/svg" sizes="16x16">
	<link rel="stylesheet" href="<?= base_url()?>/public/libs/materialize/css/materialize.min.css">
	<!--JQUERY-->
	<script src="<?= base_url()?>/public/libs/Jquery/jquery-3.5.0.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url()?>/public/libs/materialize/js/materialize.min.js"></script>


	<link rel="stylesheet" href="<?= base_url()?>/public/styles/colors.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/custom_materialize.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/style_components.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/styles.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/main.css">
	<!--FUENTE DE ICONOS-->
	<link rel="stylesheet" href="<?= base_url()?>/public/font/fontawesome/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Rosario:ital@1&display=swap" rel="stylesheet">
	<style media="screen">
		#modal-login{
			background-image: url('<?= base_url()?>/public/images/bg_003.jpg');
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
							<a class="btn bg-white modal-close waves-effect">CERRAR</a>
							<button class="btn waves-effect bg-secondary">ACCEDER</button>
						</div>
					</div>
				</div>


			</form>
		</div>
	</div>
	<header>
		<div class="container header_content">
			<a href="." id="content-title-web">
				<img src="<?= base_url()?>/public/images/ICON.svg" alt="UNAMAD" class="logo-index">
				<span><?= $_ENV['varialbe.webname']?></span>
			</a>
			<div class="header-links">

				<a class="btn btn-large">
					<i class="fal fa-shopping-cart"></i>
				</a>
				<a class="btn btn-large modal-trigger " href="#modal-login">
					<i class="fal fa-user-circle"></i>
				</a>
			</div>
		</div>
		<div class="blue darken-3" style="height: 4px"></div>
	</header>
	<section id="content-body"  style="min-height: 600px;">
		<?= $body?>
	</section>
	<footer>
		<div id="contato" class="#263238 blue-grey darken-4 white-text f-c" style="height: 300px;">PIE DE PAGINA</div>
		<div id="copyright" class="black white-text f-c" style="height: 60px;">COPYRIGHT</div>
	</footer>
	<script type="text/javascript">
	const modalLogin = $('#modal-login').modal()
	const form_acceso = $('#form-acceso');
	form_acceso.submit( e => {
		e.preventDefault();
		const serialize = form_acceso.serialize()
		$.post('<?= base_url()?>/validar_acceso', serialize, function (res) {
			switch (res) {
				case 'A':
					console.log('ADMINSTRADOR');
					location.href = '<?= base_url()?>/dadmin'
				break;
				case 'U':
					console.log('USUARIO');
				break;
				default: M.toast({html: 'CREDENCIALES ERRONEAS', classes: 'bg-alert'});

			}
		})
	})
	//modalLogin.modal('open')
	</script>
</body>
</html>
