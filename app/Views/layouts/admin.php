<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>ATENEA ADMINISTRADOR</title>

	<link rel="stylesheet" href="<?= base_url() ?>/libs/animate/animate.min.css">
	<link rel="icon" href="<?= base_url() ?>/images/icon_color.svg" type="image/svg" sizes="16x16">
	<link rel="stylesheet" href="<?= base_url() ?>/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/normalize.css">
	<link rel="stylesheet" href="<?= base_url() ?>/libs/simplebar/simplebar.css"/>
	<script src="<?= base_url() ?>/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= base_url() ?>/libs/vue/vue.min.js"></script>
	<script src="<?= base_url() ?>/js/vuecomponents/layout-components.js"></script>
	<script src="<?= base_url() ?>/js/vuecomponents/components.js"></script>
	<!--JQUERY-->
	<script src="<?= base_url() ?>/libs/Jquery/jquery-3.5.0.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url() ?>/libs/materialize/js/materialize.min.js"></script>
	<link rel="stylesheet" href="<?= base_url()?>/libs/searchBox2/searchBox2.css">
	<script src="<?= base_url()?>/libs/searchBox2/searchBox2.js"></script>
	<script src="<?= base_url() ?>/libs/JaroWrinker/JaroWrinker.js"></script>
	<script src="<?= base_url()?>/libs/inputmask/inputmask.min.js" charset="utf-8"></script>
	<script src="<?= base_url()?>/libs/numeral/numeral.min.js" charset="utf-8"></script>
	<script src="<?= base_url()?>/js/script.js"  charset="utf-8"></script>

	<link rel="stylesheet" href="<?= base_url() ?>/styles/colors.css?=2">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/custom_materialize.css?=2">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/style_components.css?=2">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/styles.css?=2">
	<!--FUENTE DE ICONOS-->
	<link rel="stylesheet" href="<?= base_url() ?>/font/fontawesome/css/all.css">
	<link href="<?= base_url() ?>/font/globalfont/globalfont.css" rel="stylesheet?=2">
	<link rel="stylesheet" href="<?= base_url()?>/styles/admin-module.css?=2">
	<style media="screen">

	</style>
</head>
<body>

	<ul id='dropdown1' class='dropdown-content'>
		<li><a><i class="fas fa-cog"></i>Configuracion 01</a></li>
		<li><a><i class="fas fa-cog"></i>Configuracion 02</a></li>
	</ul>
	<div id="admin-background">
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<aside>
		<a id="logo" class="f-c" href="<?= base_url()?>/administrator">
			<img src="<?= base_url() ?>/images/icon_color.svg" alt="UNAMAD" id="logoapp">
		</a>
		<div id="menu-aside">

			<a href="<?= base_url()?>/administrator/ventas" class="aside-item-menu" data-tooltip="VENTAS" data-position="right">
				<i class="fal fa-shopping-cart"></i>
			</a>
			<a href="<?= base_url()?>/administrator/categorias" class="aside-item-menu" data-tooltip="CATEGORIAS" data-position="right">
				<i class="fal fa-ballot"></i>
			</a>
			<a href="<?= base_url()?>/administrator/marcas" class="aside-item-menu" data-tooltip="MARCAS" data-position="right">
				<i class="fal fa-tag"></i>
			</a>

			<a href="<?= base_url()?>/administrator/proveedores" class="aside-item-menu" data-tooltip="PROVEEDORES" data-position="right">
				<i class="fal fa-shipping-fast"></i>
			</a>
			<a href="<?= base_url()?>/administrator/almacen" class="aside-item-menu" data-tooltip="ALMACEN" data-position="right">
				<i class="fal fa-box"></i>
			</a>
			<a href="<?= base_url()?>/administrator/usuarios" class="aside-item-menu" data-tooltip="USUARIOS" data-position="right">
				<i class="fal fa-user"></i>
			</a>
		</div>
		<div id="options-aside">
			<a class="aside-item-opt dropdown-trigger" data-target='dropdown1'><div class="cover" style="background-image: url('<?= base_url() ?>/images/avatar_hombre.png')"></div></a>
			<a class="aside-item-opt" href="<?= base_url()?>/close"><i class="fal fa-power-off"></i></a>
		</div>
	</aside>
	<section id="content-body">

		<?= $body?>
	</section>

	<script type="text/javascript">
		const aside_items = $('.aside-item-menu').tooltip();
		$('.dropdown-trigger').dropdown({
			alignment: 'right',
			constrainWidth: false,
			coverTrigger: false,
			closeOnClick: false
		});
		console.log('<?= base_url()  ?>');
		aside_items.each(function(i, el) {
			const obj = $(el);
			if (obj.attr('href') == window.location.href) obj.addClass('active')
		});
	</script>

</body>
</html>
