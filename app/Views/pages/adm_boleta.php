<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="icon" href="<?= base_url() ?>/public/images/ICON.svg" type="image/svg" sizes="16x16">
		<link rel="stylesheet" href="<?= base_url() ?>/public/libs/materialize/css/materialize.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>/public/styles/normalize.css">

		<link rel="stylesheet" href="<?= base_url() ?>/public/styles/style_components.css">
		<link rel="stylesheet" href="<?= base_url() ?>/public/styles/styles.css">
		<title>IMPRESION COMPROBANTE</title>
	</head>
	<style media="screen">
		.invoice{
			background: white;
			width: 800px;
			margin: 0 auto;
		}
		.info{
			width: 100px;
			text-align: right;
		}
		.info img{
			width: 100px;
		}
	</style>
	<body>
		<?php
			$newDate = date("d/m/Y", strtotime($venta['fecha']));
		?>
		<div class="invoice" style="padding: 32px;">
			<div class="f-b">
				<div>
					<h2 style="margin: 0">INVERSIONES ATENEA</h2>
					<p style="margin: 0">ELECTRODOMESTICOS Y LINEA BLANCA</p>
					<span><?=$newDate?></span>
				</div>
				<div class="info f-c">
					<img width="100" src="http://localhost:4000/public/images/icon_color.svg" alt="UNAMAD" id="logoapp">
					<b>R-<?= substr(($_POST['id_venta'] + 100000) . '', 1,5)?> </b>
				</div>
			</div>
			<div class="space-32"></div>
			<p>
				<b>NOMBRE:</b> <span><?= $venta['NombreCompleto'] ?></span>
			</p>
			<p>
				<b>DNI:</b> <span><?= $venta['Cliente_DNI'] ?></span>
			</p>
			<?php if ($venta['RUC']): ?>
				<p><b>RUC:</b> <span><?= $venta['RUC'] ?></span></p>
			<?php endif; ?>
			<?php if ($venta['telefono']): ?>
				<p><b>TELEFONO:</b> <span><?= $venta['telefono'] ?></span></p>
			<?php endif; ?>
			<?php if ($venta['email']): ?>
				<p><b>EMAIL:</b> <span><?= $venta['email'] ?></span></p>
			<?php endif; ?>
			<div class="space-32"></div>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>PRODUCTO</th>
						<th class="c">UNIDADES</th>
						<th class="r">SUBTOTAL</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detalles as $key => $producto): ?>
						<tr>
							<td><?= $key+1 ?></td>
							<td><?= $producto['NombreProducto'] ?> <?= $producto['Descripcion'] ?></td>
							<td class="c"><?= $producto['Unidades'] ?></td>
							<td class="r">S/<?= $producto['Total'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr style="border-bottom: 0">
						<td></td>
						<td></td>
						<td class="c"><b>TOTAL</b></td>
						<td class="r">S/<?= $venta['Total'] ?></td>
					</tr>
				</tfoot>
			</table>
			<?php

			?>
		</div>
		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>
