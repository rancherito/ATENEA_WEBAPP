<link rel="stylesheet" href="<?= base_url()?>/public/styles/admin-module.css">
<?php color_modulo('var(--bg-sky)') ?>
<style media="screen">
	
</style>
<div id="divider-main">
	<!--BUSCARDOR DEL MODULO, PROVEIDO POR HELPERS PHP-->
	<?= search_admin([
		'placeholder' => 'BUSCAR PROVEEDOR',
		'title' => 'Gestion de Proveedores'
	])?>
	<!--CONTENEDOR DE ITEMS-->

			<table class="table-items open-module">
				<tr>
					<th class="table-index">#</th>
					<th style="width: 200px">NOMBRE</th>
					<th>DESCRIPCION</th>
					<th class="c">TELEFONO</th>
					<th class="c">EMAIL</th>
					<th class="c">CALIFICACION</th>
					<th class="c">ESTADO</th>
					<th style="width: 1px"></th>
				</tr>
				<tbody>
					<?php for ($i = 0; $i < 10; $i++): ?>
						<tr>
							<td class="table-index"><?= ($i+1) ?></td>
							<td>NOMBRE DE PROVEEDOR</td>
							<td>Descripcion del proveedor</td>
							<td class="c">### ### ###</td>
							<td class="c">string@string.str</td>
							<td class="c">⭐⭐⭐⭐⭐</td>
							<td class="c">Estado</td>
							<td class="row-menu">
								<i class="fal fa-ellipsis-v table-menu" data-target='dmenu<?= ($i+1) ?>'></i>
								<ul id='dmenu<?= ($i+1) ?>' class='dropdown-content'>
								    <li><a><i class="fal fa-edit"></i> MODIFICAR</a></li>
								    <li><a><i class="fal fa-trash-alt"></i> ELIMINAR</a></li>
								 </ul>
							</td>
						</tr>
					<?php endfor; ?>

				</tbody>
			</table>
</div>
<div id="divider-option" class="f-c">
	<i class="fal fa-comment-alt-smile white-text open-module" style="font-size: 4rem"></i>
	<br>
	<span class="c white-text open-module">Contacto, calificacion e informacion relevante de tus proveedores, organizalos para tener un control de tu flujo origen de productos</span>
</div>

<script type="text/javascript">
$('.table-menu').dropdown(
	{
		alignment: 'right',
		constrainWidth: false,
		coverTrigger: false,
		closeOnClick: false
	}
);
</script>
