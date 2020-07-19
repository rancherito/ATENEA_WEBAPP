<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>ATENEA ADMINISTRADOR</title>
	<link rel="stylesheet" href="<?= base_url() ?>/public/styles/normalize.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/libs/animate/animate.min.css">
	<link rel="icon" href="<?= base_url() ?>/public/images/ICON.svg" type="image/svg" sizes="16x16">
	<link rel="stylesheet" href="<?= base_url() ?>/public/libs/materialize/css/materialize.min.css">

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<!--JQUERY-->
	<script src="<?= base_url() ?>/public/libs/Jquery/jquery-3.5.0.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url() ?>/public/libs/materialize/js/materialize.min.js"></script>
	<link rel="stylesheet" href="<?= base_url()?>/public/libs/searchBox2/searchBox2.css">
	<script src="<?= base_url()?>/public/libs/searchBox2/searchBox2.js"></script>


	<link rel="stylesheet" href="<?= base_url() ?>/public/styles/colors.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/styles/custom_materialize.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/styles/style_components.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/styles/styles.css">
	<!--FUENTE DE ICONOS-->
	<link rel="stylesheet" href="<?= base_url() ?>/public/font/fontawesome/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Rosario:ital@1&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url()?>/public/styles/admin-module.css">
</head>
<body>

	<ul id='dropdown1' class='dropdown-content'>
		<li><a><i class="fas fa-cog"></i>Configuracion 01</a></li>
		<li><a><i class="fas fa-cog"></i>Configuracion 02</a></li>
	</ul>
	<aside>
		<a id="logo" class="f-c" href="<?= base_url()?>/dadmin">
			<img src="<?= base_url() ?>/public/images/icon_color.svg" alt="UNAMAD" id="logoapp">
		</a>
		<div id="menu-aside">

			<a href="<?= base_url()?>/dadmin/ventas" class="aside-item-menu" data-tooltip="VENTAS" data-position="right"><i class="fal fa-shopping-cart"></i></a>
			<a href="<?= base_url()?>/dadmin/productos" class="aside-item-menu" data-tooltip="PRODUCTOS" data-position="right">
				<i class="fal fa-store"></i>
			</a>
			<a href="<?= base_url()?>/dadmin/categorias" class="aside-item-menu" data-tooltip="CATEGORIAS" data-position="right">
				<i class="fal fa-ballot"></i>
			</a>
			<a href="<?= base_url()?>/dadmin/marcas" class="aside-item-menu" data-tooltip="MARCAS" data-position="right">
				<i class="fal fa-tag"></i>
			</a>

			<a href="<?= base_url()?>/dadmin/proveedores" class="aside-item-menu" data-tooltip="PROVEEDORES" data-position="right">
				<i class="fal fa-shipping-fast"></i>
			</a>
			<a href="<?= base_url()?>/dadmin/almacen" class="aside-item-menu" data-tooltip="ALMACEN" data-position="right">
				<i class="fal fa-box"></i>
			</a>
			<a href="<?= base_url()?>/dadmin/reportes" class="aside-item-menu" data-tooltip="REPORTES" data-position="right">
				<i class="fal fa-file"></i>
			</a>
		</div>
		<div id="options-aside">
			<a class="aside-item-opt dropdown-trigger" data-target='dropdown1'><div class="cover" style="background-image: url('<?= base_url() ?>/public/images/avatar_hombre.png')"></div></a>
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
