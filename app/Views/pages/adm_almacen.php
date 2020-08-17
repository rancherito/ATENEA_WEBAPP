<?php color_modulo('var(--bg-purple)') ?>
<style>
	#content-body{
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}

</style>
<h2 class="c opm">GESTION ALMACEN</h2>
<br>
<div class="container opm">

	<div class="row dashbox-container">
		<div class="col m6 l3">
			<div class="dashbox disable">
				<i class="fal fa-map-marker-check"></i>
				<div class="dashbox-info">
					<h4 class="dashbox-title">Locacion</h4>
					<div class="dashbox-description">
						Idique los puntos de ubicacion de sus almacenes.
					</div>
				</div>
			</div>
		</div>
		<div class="col m6 l3">
			<a class="dashbox" href="<?= base_url() ?>/administrator/almacen/stock/consulta">
				<i class="fal fa-store"></i>
				<div class="dashbox-info">
					<h4 class="dashbox-title">Stock</h4>
					<div class="dashbox-description">
						Consulte el stock de productos de sus almacenes
					</div>
				</div>
			</a>
		</div>
		<div class="col m6 l3">
			<a class="dashbox" href="<?= base_url() ?>/administrator/almacen/stock/registro">
				<i class="fal fa-box"></i>
				<div class="dashbox-info">
					<h4 class="dashbox-title">Agregar Lote</h4>
					<div class="dashbox-description">
						Gestione de productos adquiridos a traves de sus proveedores
					</div>
				</div>
			</a>
		</div>
		<div class="col m6 l3">
			<div class="dashbox disable">
				<i class="fal fa-truck-container"></i>
				<div class="dashbox-info">
					<h4 class="dashbox-title">Despacho</h4>
					<div class="dashbox-description">
						Vea si sus productos estan listos para entregar.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
