<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?= base_url() ?>/styles/normalize.css">
	<link rel="stylesheet" href="<?= base_url() ?>/libs/animate/animate.min.css">
	<link rel="icon" href="<?= base_url() ?>/images/ICON.svg" type="image/svg" sizes="16x16">
	<link rel="stylesheet" href="<?= base_url() ?>/libs/materialize/css/materialize.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/colors.css">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/custom_materialize.css">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/style_components.css">
	<link rel="stylesheet" href="<?= base_url() ?>/styles/styles.css">
	<link rel="stylesheet" href="<?= base_url() ?>/font/fontawesome/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Rosario:ital@1&display=swap" rel="stylesheet">
	<style media="screen">
		html, body, .ccc{
			height: 100vh;

		}
		.ccc{
			background: var(--bg-primary)
		}
	</style>
</head>
<body>
	<div class="f-c ccc white-text c opm">
		<p>
			<i class="fal fa-heart-broken" style="font-size: 8rem"></i>
		</p>
		<h2>404 - Uy! no encontramos nada</h2>
		<p>
			<?php if (! empty($message) && $message !== '(null)') : ?>
				<?= esc($message) ?><br><br>
				<a href="<?= base_url()?>" class="btn-flat">REGRESE AL INICIO</a>
			<?php else : ?>
				Sorry! Cannot seem to find the page you were looking for.
			<?php endif ?>
		</p>
	</div>
</body>
</html>
